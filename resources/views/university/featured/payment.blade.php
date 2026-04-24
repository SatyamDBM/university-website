{{-- payment.blade.php — fallback only --}}
@extends('layouts.app')
@section('content')

<div class="p-6 max-w-lg mx-auto text-center">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
        <div class="text-5xl mb-4">💳</div>
        <h2 class="text-xl font-bold text-gray-800 mb-2">Complete Payment</h2>
        <p class="text-gray-500 text-sm mb-2">{{ $package->name }}</p>
        <p class="text-3xl font-bold mb-6" style="color:#6b4a36;">₹{{ number_format($package->price) }}</p>

        <button id="pay-btn"
                class="w-full text-white font-semibold py-3 rounded-xl"
                style="background-color:#6b4a36;">
            🔒 Pay Now
        </button>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.getElementById('pay-btn').onclick = function () {
    var options = {
        key:         "{{ config('razorpay.key') }}",
        amount:      {{ $package->price * 100 }},
        currency:    "INR",
        order_id:    "{{ $order_id }}",
        name:        "{{ config('app.name') }}",
        description: "{{ $package->name }}",
        theme:       { color: "#6b4a36" },
        handler: function (response) {
            var orderId = response.razorpay_order_id || "{{ $order_id }}";
            window.location.href =
                "{{ route('university.featured.payment.success') }}" +
                "?razorpay_order_id="   + orderId +
                "&razorpay_payment_id=" + response.razorpay_payment_id +
                "&razorpay_signature="  + response.razorpay_signature;
        }
    };
    new Razorpay(options).open();
};
</script>
@endsection