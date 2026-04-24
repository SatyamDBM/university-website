<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Subscription;
use App\Services\RazorpayService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;
use Barryvdh\DomPDF\Facade\Pdf;



class FeaturedController extends Controller
{
    /*
    |----------------------------------------
    | Show Packages
    |----------------------------------------
    */
    public function featured()
    {
        $packages = Package::where('status', 'active')->get();
        return view('university.featured.index', compact('packages'));
    }

    /*
    |----------------------------------------
    | Purchase Package
    |----------------------------------------
    */
    // public function purchase($id)
    // {
    //     $universityId = auth()->user()->university_id;

    //     $package = Package::where('status', 'active')->findOrFail($id);

    //     $current = Subscription::where('university_id', $universityId)
    //         ->where('status', 'active')
    //         ->where('end_date', '>=', now())
    //         ->latest()
    //         ->first();

    //     $start = now();

    //     // ✅ CASE 1: Same package → EXTEND
    //     if ($current && $current->package_id == $package->id) {
    //         $start = $current->end_date > now()
    //             ? $current->end_date
    //             : now();
    //     }

    //     // ✅ CASE 2: Different package → UPGRADE
    //     elseif ($current) {
    //         $current->update([
    //             'status' => 'expired',
    //             'end_date' => now()
    //         ]);
    //     }

    //     $subscription = Subscription::create([
    //         'university_id' => $universityId,
    //         'package_id' => $package->id,
    //         'amount' => $package->price,
    //         'final_amount' => $package->price,
    //         'payment_status' => 'pending',
    //         'status' => 'pending',
    //         'start_date' => $start
    //     ]);

    //     return redirect()->route('university.subscription.payment', $subscription->id);
    // }

    public function purchase($id, RazorpayService $razorpay)
    {
        $universityId = auth()->user()->university_id;
        $package      = Package::where('status', 'active')->findOrFail($id);

        $current = Subscription::where('university_id', $universityId)
            ->where('status', 'active')
            ->where('end_date', '>=', now())
            ->latest()
            ->first();

        $start = now();

        if ($current && $current->package_id == $package->id) {
            $start = $current->end_date > now() ? $current->end_date : now();
        } elseif ($current) {
            $current->update(['status' => 'expired', 'end_date' => now()]);
        }

        $subscription = Subscription::create([
            'university_id'  => $universityId,
            'package_id'     => $package->id,
            'amount'         => $package->price,
            'final_amount'   => $package->price,
            'payment_status' => 'pending',
            'status'         => 'pending',
            'start_date'     => $start,
        ]);

        // ✅ Create Razorpay order immediately
        $order = $razorpay->createOrder(
            $subscription->final_amount,
            'subscription_' . $subscription->id
        );

        $subscription->update(['razorpay_order_id' => $order->id]);

        // ✅ Return JSON for AJAX — Razorpay opens on same page
        return response()->json([
            'order_id'        => $order->id,
            'amount'          => $package->price * 100,
            'package_name'    => $package->name,
            'subscription_id' => $subscription->id,
            'success_url'     => route('university.featured.payment.success'),
        ]);
    }

    /*
    |----------------------------------------
    | Payment Page
    |----------------------------------------
    */
    public function payment($id, RazorpayService $razorpay)
    {
        $subscription = Subscription::with('package')->findOrFail($id);

        // Security: ownership check
        if ($subscription->university_id !== auth()->user()->university->id) {
            abort(403);
        }

        // Prevent duplicate payment
        if ($subscription->payment_status === 'paid') {
            return redirect()->route('university.featured.index')
                ->with('success', 'Already paid');
        }

        // Create order only once
        if (!$subscription->razorpay_order_id) {
            $order = $razorpay->createOrder(
                $subscription->final_amount,
                'subscription_' . $subscription->id
            );

            $subscription->update([
                'razorpay_order_id' => $order->id
            ]);

            $subscription->refresh();
        }

        // Add this log to confirm
        \Log::info('Order ID being sent to view: ' . $subscription->razorpay_order_id);

        return view('university.featured.payment', [
            'subscription' => $subscription,
            'package' => $subscription->package,
            'order_id' => $subscription->razorpay_order_id
        ]);
    }

    /*
    |----------------------------------------
    | Payment Success (Frontend Return)
    |----------------------------------------
    */
    public function paymentSuccess(Request $request, RazorpayService $razorpay)
    {
        $attributes = $request->only([
            'razorpay_order_id',
            'razorpay_payment_id',
            'razorpay_signature'
        ]);

        // Verify signature
        if (!$razorpay->verifySignature($attributes)) {
            abort(403, 'Payment verification failed');
        }

        $subscription = Subscription::where(
            'razorpay_order_id',
            $attributes['razorpay_order_id']
        )->first();

        if (!$subscription) {
            abort(404, 'Subscription not found');
        }

        // Already processed
        if ($subscription->payment_status === 'paid') {
            return redirect()->route('university.featured.index')
                ->with('success', 'Already activated');
        }

        DB::beginTransaction();

        try {
            $this->activateSubscription($subscription, $attributes);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment Success Error: ' . $e->getMessage());
            abort(500, 'Something went wrong');
        }

        return redirect()->route('university.featured.index')
            ->with('success', 'Featured activated successfully');
    }

    /*
    |----------------------------------------
    | Webhook (Razorpay)
    |----------------------------------------
    */
    public function webhook(Request $request)
    {
        $payload = $request->all();

        Log::info('Webhook Payload', $payload);

        if (!isset($payload['event'])) {
            return response()->json(['status' => 'invalid'], 400);
        }

        if ($payload['event'] === 'payment.captured') {

            $payment = $payload['payload']['payment']['entity'];

            $subscription = Subscription::where(
                'razorpay_order_id',
                $payment['order_id']
            )->first();

            if (!$subscription) {
                return response()->json(['status' => 'not found'], 404);
            }

            // Already processed
            if ($subscription->payment_status === 'paid') {
                return response()->json(['status' => 'already processed']);
            }

            DB::beginTransaction();
            try {

                $this->activateSubscription($subscription, [
                    'razorpay_payment_id' => $payment['id'],
                    'razorpay_signature' => null // webhook may not include signature
                ]);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Webhook Error: ' . $e->getMessage());
                return response()->json(['status' => 'error'], 500);
            }
        }
        return response()->json(['status' => 'ok']);
    }

    /*
    |----------------------------------------
    | Core Activation Logic (Reusable)
    |----------------------------------------
    */
    private function activateSubscription($subscription, $attributes)
    {
        $package = Package::findOrFail($subscription->package_id);

        $start = $subscription->start_date ?? now();

        $end = match ($package->duration_type) {
            'days' => \Carbon\Carbon::parse($start)->addDays($package->duration),
            'months' => \Carbon\Carbon::parse($start)->addMonths($package->duration),
            'years' => \Carbon\Carbon::parse($start)->addYears($package->duration),
            default => throw new \Exception('Invalid duration type'),
        };

        $subscription->update([
            'payment_status' => 'paid',
            'status' => 'active',
            'start_date' => $start,
            'end_date' => $end,
            'total_days' => \Carbon\Carbon::parse($start)->diffInDays($end),
            'remaining_days' => \Carbon\Carbon::parse($start)->diffInDays($end),
            'razorpay_payment_id' => $attributes['razorpay_payment_id'],
            'razorpay_signature' => $attributes['razorpay_signature'] ?? null,
        ]);
    }

    public function history()
    {
        $universityId = auth()->user()->university_id;

        $subscriptions = Subscription::with('package')
            ->where('university_id', $universityId)
            ->latest()
            ->paginate(10);

        return view('university.featured.history', compact('subscriptions'));
    }

    public function downloadInvoice($id)
    {
        $subscription = Subscription::with('package')->findOrFail($id);

        // सुरक्षा check
        if ($subscription->university_id !== auth()->user()->university_id) {
            abort(403);
        }

        // Only paid invoices allowed
        if ($subscription->payment_status !== 'paid') {
            return back()->with('error', 'Invoice available only for paid subscriptions');
        }

        $pdf = Pdf::loadView('university.featured.invoice', [
            'subscription' => $subscription,
            'package'      => $subscription->package,
            'user'         => auth()->user(),
        ]);

        return $pdf->download('invoice_' . $subscription->id . '.pdf');
    }
}
