<?php

namespace App\Services;

use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

class RazorpayService
{
    protected $api;

    public function __construct()
    {
        $this->api = new Api(
            config('razorpay.key'),
            config('razorpay.secret')
        );
    }

    /*
    |----------------------------------------
    | Create Order
    |----------------------------------------
    */
    public function createOrder($amount, $receipt)
    {
        return $this->api->order->create([
            'receipt' => $receipt,
            'amount' => $amount * 100, // paisa
            'currency' => 'INR'
        ]);
    }

    /*
    |----------------------------------------
    | Verify Payment Signature
    |----------------------------------------
    */
    public function verifySignature($attributes)
    {
        try {
            $this->api->utility->verifyPaymentSignature([
                'razorpay_order_id' => $attributes['razorpay_order_id'],
                'razorpay_payment_id' => $attributes['razorpay_payment_id'],
                'razorpay_signature' => $attributes['razorpay_signature'],
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Signature Error: ' . $e->getMessage());
            return false;
        }
    }
}
