{{-- ==================== PAGE 3: Payment ==================== --}}
@extends('layouts.app')
@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Complete Payment</h1>
            <p class="text-sm text-gray-500 mt-1">Secure payment powered by Razorpay</p>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6">

        {{-- Left: Payment Card --}}
        <div class="col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">💳 Payment Summary</h2>
                </div>
                <div class="p-6">

                    {{-- Amount Display --}}
                    <div class="text-center py-8 border-b border-gray-100 mb-6">
                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-2">Total Amount</div>
                        <div class="text-5xl font-bold text-gray-800">₹{{ number_format($banner->price) }}</div>
                        <div class="text-sm text-gray-400 mt-2">
                            for {{ $banner->slot_name }} · {{ $banner->duration }} {{ $banner->duration_type }}
                        </div>
                    </div>

                    {{-- Order Details --}}
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Banner Slot</span>
                            <span class="font-medium text-gray-700">{{ $banner->slot_name }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Placement</span>
                            <span class="font-medium text-gray-700">{{ $banner->placement_location }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Duration</span>
                            <span class="font-medium text-gray-700">{{ $banner->duration }} {{ $banner->duration_type }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Order ID</span>
                            <span class="font-mono text-xs text-gray-500">{{ $order_id }}</span>
                        </div>
                    </div>

                    {{-- Pay Button --}}
                    <button id="pay-btn"
                            class="w-full text-white font-semibold text-base py-3.5 rounded-xl transition"
                            style="background-color:#6b4a36;">
                        🔒 Pay ₹{{ number_format($banner->price) }} Securely
                    </button>

                    <p class="text-xs text-gray-400 text-center mt-3">
                        Secured by Razorpay · Your payment info is never stored
                    </p>

                </div>
            </div>
        </div>

        {{-- Right: Info --}}
        <div class="space-y-4">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">ℹ️ After Payment</h2>
                </div>
                <div class="p-5 space-y-3">
                    <div class="flex items-start gap-3">
                        <span class="text-lg">1️⃣</span>
                        <div>
                            <div class="text-sm font-semibold text-gray-700">Payment Confirmed</div>
                            <div class="text-xs text-gray-400">Your payment is recorded instantly</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-lg">2️⃣</span>
                        <div>
                            <div class="text-sm font-semibold text-gray-700">Admin Review</div>
                            <div class="text-xs text-gray-400">Banner reviewed within 24 hours</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-lg">3️⃣</span>
                        <div>
                            <div class="text-sm font-semibold text-gray-700">Goes Live</div>
                            <div class="text-xs text-gray-400">Banner published on approval</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                <div class="text-sm font-semibold text-green-800 mb-1">✅ Safe & Secure</div>
                <div class="text-xs text-green-700">
                    All payments processed via Razorpay with 256-bit SSL encryption.
                </div>
            </div>

        </div>

    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.getElementById('pay-btn').onclick = function () {
    var options = {
        key:      "{{ config('razorpay.key') }}",
        amount:   {{ $banner->price * 100 }},
        currency: "INR",
        order_id: "{{ $order_id }}",
        name:     "{{ config('app.name') }}",
        description: "{{ $banner->slot_name }}",
        theme: { color: "#6b4a36" },
        handler: function (response) {
            if (!response.razorpay_order_id) {
                alert('Order ID missing. Please try again.');
                return;
            }
            window.location.href =
                "{{ route('university.payment.success') }}" +
                "?razorpay_order_id="   + response.razorpay_order_id +
                "&razorpay_payment_id=" + response.razorpay_payment_id +
                "&razorpay_signature="  + response.razorpay_signature;
        },
        modal: {
            ondismiss: function() {
                console.log('Payment cancelled');
            }
        }
    };
    new Razorpay(options).open();
};
</script>
@endsection 