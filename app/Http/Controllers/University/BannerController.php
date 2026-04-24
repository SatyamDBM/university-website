<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\UniversityBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\RazorpayService;
use Barryvdh\DomPDF\Facade\Pdf;


class BannerController extends Controller
{
    /*
    |----------------------------------------
    | List Banners
    |----------------------------------------
    */
    public function index()
    {
        $banners = Banner::where('status', 'active')->get();
        return view('university.banner.index', compact('banners'));
    }

    /*
    |----------------------------------------
    | Upload Banner Form
    |----------------------------------------
    */
    public function create($id)
    {
        $banner = Banner::findOrFail($id);
        return view('university.banner.upload_banner', compact('banner'));
    }

    /*
    |----------------------------------------
    | Store Banner (Slot + Duplicate Safe)
    |----------------------------------------
    */
    public function store(Request $request, $id)
    {
        $request->validate([
            'banner_image' => 'required|image|max:2048',
            'campaign_name' => 'required|string|max:255',
            'redirect_url' => 'nullable|url',
        ]);

        DB::beginTransaction();

        try {
            $banner = Banner::lockForUpdate()->findOrFail($id);

            $universityId = auth()->user()->university->id;

            // ✅ Slot limit check (LOCKED)
            $activeCount = UniversityBanner::where('banner_id', $banner->id)
                ->whereIn('live_status', ['scheduled', 'live'])
                ->where('end_date', '>=', now())
                ->lockForUpdate()
                ->count();

            if ($activeCount >= $banner->max_banner_limit) {
                DB::rollBack();
                return back()->with('error', 'All slots are booked');
            }

            // ✅ Prevent duplicate booking
            $alreadyBooked = UniversityBanner::where('banner_id', $banner->id)
                ->where('university_id', $universityId)
                ->whereIn('live_status', ['scheduled', 'live'])
                ->where('end_date', '>=', now())
                ->exists();

            if ($alreadyBooked) {
                DB::rollBack();
                return back()->with('error', 'You already booked this slot');
            }

            $path = $request->file('banner_image')->store('banners', 'public');

            $startDate = now();
            $endDate = $banner->duration_type === 'days'
                ? now()->addDays($banner->duration)
                : now()->addMonths($banner->duration);

            $record = UniversityBanner::create([
                'university_id' => $universityId,
                'banner_id' => $banner->id,
                'campaign_name' => $request->campaign_name,
                'banner_image' => $path,
                'redirect_url' => $request->redirect_url,
                'price' => $banner->price,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'payment_status' => 'pending',
                'approval_status' => 'pending',
                'live_status' => 'draft',
                'status' => 'active',
            ]);

            DB::commit();

            return redirect()->route('university.banners.payment', $record->id);
        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('Banner Store Error: ' . $e->getMessage());

            return back()->with('error', 'Something went wrong');
        }
    }

    /*
    |----------------------------------------
    | Payment Page
    |----------------------------------------
    */
    public function payment($id, RazorpayService $razorpay)
    {
        $banner = UniversityBanner::findOrFail($id);

        // ✅ Ownership check
        if ($banner->university_id !== auth()->user()->university->id) {
            abort(403);
        }

        // ✅ Prevent re-payment
        if ($banner->payment_status === 'paid') {
            return redirect()->route('university.banners.index')
                ->with('success', 'Already paid');
        }

        try {
            // ✅ Create order once
            if (!$banner->razorpay_order_id) {

                $order = $razorpay->createOrder(
                    $banner->price,
                    'banner_' . $banner->id
                );

                $banner->update([
                    'razorpay_order_id' => $order->id
                ]);
            }

            return view('university.banner.payment', [
                'banner' => $banner->fresh(),
                'order_id' => $banner->razorpay_order_id
            ]);
        } catch (\Exception $e) {

            Log::error('Razorpay Order Error: ' . $e->getMessage());

            return back()->with('error', 'Payment initialization failed');
        }
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

        // ✅ Verify signature
        if (!$razorpay->verifySignature($attributes)) {
            abort(403, 'Payment verification failed');
        }

        $banner = UniversityBanner::where(
            'razorpay_order_id',
            $attributes['razorpay_order_id']
        )->first();

        if (!$banner) {
            abort(404, 'Banner not found');
        }

        // ✅ Prevent duplicate
        if ($banner->payment_status === 'paid') {
            return redirect()->route('university.banners.index')
                ->with('success', 'Already processed');
        }

        DB::beginTransaction();

        try {

            $banner->update([
                'razorpay_payment_id' => $attributes['razorpay_payment_id'],
                'razorpay_signature' => $attributes['razorpay_signature'],
                'payment_status' => 'paid',
                'paid_at' => now(),
                'live_status' => 'scheduled'
            ]);

            DB::commit();
        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('Payment Success Error: ' . $e->getMessage());

            return redirect()->route('university.banners.index')
                ->with('error', 'Payment processing failed');
        }

        return redirect()->route('university.banners.index')
            ->with('success', 'Payment successful');
    }

    /*
    |----------------------------------------
    | Razorpay Webhook (Server to Server)
    |----------------------------------------
    */
    public function webhook(Request $request)
    {
        try {
            $payloadRaw = $request->getContent();
            $signature = $request->header('X-Razorpay-Signature');
            $secret = config('razorpay.webhook_secret');

            // ✅ Verify webhook signature
            if ($secret) {
                try {
                    (new \Razorpay\Api\Api(
                        config('razorpay.key'),
                        config('razorpay.secret')
                    ))->utility->verifyWebhookSignature($payloadRaw, $signature, $secret);
                } catch (\Exception $e) {
                    Log::warning('Invalid webhook signature');
                    return response()->json(['status' => 'invalid signature'], 400);
                }
            }

            $payload = json_decode($payloadRaw, true);

            if (!isset($payload['event'])) {
                return response()->json(['status' => 'invalid payload'], 400);
            }

            if ($payload['event'] === 'payment.captured') {

                $payment = $payload['payload']['payment']['entity'] ?? null;

                if (!$payment || empty($payment['order_id'])) {
                    return response()->json(['status' => 'invalid payment'], 400);
                }

                $banner = UniversityBanner::where(
                    'razorpay_order_id',
                    $payment['order_id']
                )->first();

                if (!$banner) {
                    return response()->json(['status' => 'not found'], 404);
                }

                // ✅ Idempotent check
                if ($banner->payment_status === 'paid') {
                    return response()->json(['status' => 'already processed']);
                }

                DB::beginTransaction();

                try {

                    $banner->update([
                        'payment_status' => 'paid',
                        'razorpay_payment_id' => $payment['id'],
                        'paid_at' => now(),
                        'live_status' => 'scheduled',
                    ]);

                    DB::commit();
                } catch (\Exception $e) {

                    DB::rollBack();
                    Log::error('Webhook Error: ' . $e->getMessage());

                    return response()->json(['status' => 'error'], 500);
                }
            }

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {

            Log::error('Webhook Fatal Error: ' . $e->getMessage());

            return response()->json(['status' => 'error'], 500);
        }
    }

    public function history()
    {
        $universityId = auth()->user()->university->id;

        $banners = \App\Models\UniversityBanner::with('banner')
            ->where('university_id', $universityId)
            ->latest()
            ->paginate(10);

        return view('university.banner.history', compact('banners'));
    }


    public function downloadInvoice($id)
    {
        $banner = UniversityBanner::with(['banner', 'university'])->findOrFail($id);

        // Security
        if ($banner->university_id !== auth()->user()->university->id) {
            abort(403);
        }

        // Only paid
        if ($banner->payment_status !== 'paid') {
            return back()->with('error', 'Invoice available only for paid banners');
        }

        $pdf = Pdf::loadView('university.banner.invoice', [
            'banner' => $banner,
            'invoiceNo' => 'INV-' . str_pad($banner->id, 6, '0', STR_PAD_LEFT)
        ]);

        return $pdf->download('invoice-' . $banner->id . '.pdf');
    }
}
