@extends('layouts.app')
@section('content')
@include('partials.swal')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Featured Listing Packages</h1>
            <p class="text-sm text-gray-500 mt-1">Boost your university visibility across the platform</p>
        </div>
    </div>

      {{-- Benefits Section --}}
    <div class="mt-10 bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-10">
        <h2 class="text-sm font-semibold text-gray-700 mb-4">🎯 Why get Featured?</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach([
                ['🔝', 'Top Placement',   'Appear at the top of search results'],
                ['👁️', 'More Visibility', 'Reach 10x more students'],
                ['📈', 'More Enquiries',  'Get higher quality leads'],
                ['✅', 'Verified Badge',  'Build trust with students'],
            ] as [$icon, $title, $desc])
            <div class="text-center p-4 bg-gray-50 rounded-xl">
                <div class="text-2xl mb-2">{{ $icon }}</div>
                <div class="text-sm font-semibold text-gray-700">{{ $title }}</div>
                <div class="text-xs text-gray-400 mt-1">{{ $desc }}</div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Active Subscription Banner --}}
    @php
        $activeSub     = auth()->user()->university_id ? auth()->user()->university->activeSubscription : null;
        $activePackage = $activeSub?->package ?? null;
    @endphp
 @if($activeSub && $activePackage)
    <div class="mb-6 p-5 bg-green-50 border border-green-200 rounded-xl">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-2xl">✅</div>
                <div>
                    <div class="text-sm font-bold text-green-800">
                        Active Plan: {{ ucfirst($activePackage->name) }}
                    </div>
                    <div class="text-xs text-green-600 mt-0.5">
                        Started: {{ \Carbon\Carbon::parse($activeSub->start_date)->format('d M Y') }}
                        · Expires: {{ \Carbon\Carbon::parse($activeSub->end_date)->format('d M Y') }}
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-center px-4 py-2 bg-white rounded-xl border border-green-200">
                    <div class="text-lg font-bold text-green-700">{{ $activeSub->remaining_days ?? 0 }}</div>
                    <div class="text-xs text-green-500">Days Left</div>
                </div>
                <span class="text-xs font-semibold px-3 py-1.5 bg-green-600 text-white rounded-full">🟢 Active</span>
            </div>
        </div>

        {{-- Progress Bar --}}
        @php
            $totalDays     = $activeSub->total_days ?? 30;
            $remainingDays = $activeSub->remaining_days ?? 0;
            $usedPct       = $totalDays > 0 ? round((($totalDays - $remainingDays) / $totalDays) * 100) : 0;
        @endphp
        <div class="mt-4">
            <div class="flex justify-between text-xs text-green-600 mb-1">
                <span>Plan Usage</span>
                <span>{{ $usedPct }}% used</span>
            </div>
            <div class="w-full bg-green-100 rounded-full h-2">
                <div class="bg-green-500 h-2 rounded-full transition-all"
                     style="width: {{ $usedPct }}%"></div>
            </div>
        </div>
    </div>
    @endif

    {{-- Packages Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($packages as $package)
        @php
            $isPopular  = $loop->index === 1;
            $isActive   = $activeSub && $activeSub->package_id == $package->id;

            // Determine button label + action
            if ($isActive) {
                $btnLabel  = '🔄 Renew Plan';
                $btnAction = 'renew';
            } elseif (!$activeSub) {
                $btnLabel  = $isPopular ? '🚀 Get Started' : 'Buy Now';
                $btnAction = 'buy';
            } else {
                // Has active plan — compare prices
                $btnLabel  = $package->price > $activePackage->price ? '⬆️ Upgrade' : '⬇️ Downgrade';
                $btnAction = $package->price > $activePackage->price ? 'upgrade' : 'downgrade';
            }
        @endphp

        <div class="bg-white rounded-xl shadow-sm border-2 overflow-hidden transition hover:-translate-y-1 hover:shadow-lg relative
                    {{ $isActive ? 'border-green-400' : ($isPopular ? 'border-[#6b4a36]' : 'border-gray-200') }}">

            {{-- Active Badge --}}
            @if($isActive)
            <div class="absolute top-3 right-3 z-10">
                <span class="text-xs font-bold px-3 py-1 rounded-full text-white bg-green-500">
                    ✅ Current Plan
                </span>
            </div>
            @elseif($isPopular)
            <div class="absolute top-3 right-3 z-10">
                <span class="text-xs font-bold px-3 py-1 rounded-full text-white" style="background-color:#6b4a36;">
                    ⭐ Most Popular
                </span>
            </div>
            @endif

            {{-- Card Header --}}
            <div class="px-6 py-4"
                 style="{{ $isActive ? 'background-color:#16a34a;' : ($isPopular ? 'background-color:#6b4a36;' : '') }}
                        {{ (!$isActive && !$isPopular) ? 'border-bottom: 1px solid #f3f4f6;' : '' }}">
                <h3 class="text-lg font-bold {{ ($isActive || $isPopular) ? 'text-white' : 'text-gray-800' }}">
                    {{ ucfirst($package->name) }}
                </h3>
                <p class="text-xs {{ ($isActive || $isPopular) ? 'text-white/70' : 'text-gray-400' }} mt-0.5">
                    {{ ucfirst(str_replace('_', ' ', $package->coverage_type)) }} Coverage
                </p>
            </div>

            <div class="p-6">

                {{-- Price --}}
                <div class="mb-5">
                    <div class="text-4xl font-bold text-gray-800">
                        ₹{{ number_format($package->price) }}
                    </div>
                    <div class="text-sm text-gray-400 mt-1">
                        for {{ $package->duration }} {{ $package->duration_type }}
                    </div>
                </div>

                {{-- Features --}}
                <div class="mb-5 text-sm text-gray-600 space-y-1.5">
                    {!! $package->description !!}
                </div>

                {{-- Duration --}}
                <div class="flex items-center gap-2 mb-5 p-3 bg-gray-50 rounded-lg">
                    <span class="text-lg">⏱️</span>
                    <div>
                        <div class="text-xs font-semibold text-gray-500">Duration</div>
                        <div class="text-sm font-medium text-gray-800">
                            {{ $package->duration }} {{ $package->duration_type }}
                        </div>
                    </div>
                </div>

                {{-- Upgrade/Downgrade Info --}}
                @if($activeSub && !$isActive)
                <div class="mb-4 p-3 rounded-lg text-xs font-medium
                            {{ $btnAction === 'upgrade' ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                    @if($btnAction === 'upgrade')
                        ⬆️ Upgrading will replace your current plan immediately
                    @else
                        ⬇️ Downgrading will replace your current plan immediately
                    @endif
                </div>
                @endif

                @if($isActive)
                <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-lg text-xs text-green-700 font-medium">
                    🔄 Renewing will extend your plan by {{ $package->duration }} {{ $package->duration_type }}
                </div>
                @endif

                {{-- Action Button --}}
                <button
                    onclick="confirmAndBuy({{ $package->id }}, '{{ addslashes($package->name) }}', {{ $package->price }}, '{{ $btnAction }}')"
                    class="w-full text-sm font-semibold py-3 rounded-xl transition
                        @if($isActive)
                            bg-green-500 hover:bg-green-600 text-white
                        @elseif($btnAction === 'upgrade')
                            bg-blue-600 hover:bg-blue-700 text-white
                        @elseif($btnAction === 'downgrade')
                            bg-amber-500 hover:bg-amber-600 text-white
                        @elseif($isPopular)
                            text-white
                        @else
                            border-2 border-[#6b4a36] text-[#6b4a36] hover:text-white
                        @endif"
                    style="@if($isPopular && !$isActive && $btnAction === 'buy') background-color:#6b4a36; @endif
                           @if(!$isPopular && $btnAction === 'buy') @endif">
                    {{ $btnLabel }}
                </button>

            </div>
        </div>
        @endforeach
    </div>

  

</div>

{{-- Loading Overlay --}}
<div id="payLoading" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
    <div class="bg-white rounded-2xl p-8 text-center shadow-xl">
        <div class="text-4xl mb-3 animate-pulse">💳</div>
        <div class="text-base font-semibold text-gray-800">Opening Payment...</div>
        <div class="text-sm text-gray-400 mt-1">Please wait</div>
    </div>
</div>

{{-- Confirm Modal for Upgrade/Downgrade --}}
<div id="confirmModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm mx-4 p-6 text-center">
        <div id="confirmIcon" class="text-5xl mb-4"></div>
        <h3 id="confirmTitle" class="text-base font-bold text-gray-800 mb-2"></h3>
        <p id="confirmMsg" class="text-sm text-gray-500 mb-6"></p>
        <div class="flex gap-3">
            <button onclick="closeConfirm()"
                    class="flex-1 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 py-2.5 rounded-xl transition">
                Cancel
            </button>
            <button id="confirmBtn"
                    class="flex-1 text-sm text-white font-semibold py-2.5 rounded-xl transition"
                    style="background-color:#6b4a36;">
                Confirm
            </button>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
let pendingPackageId   = null;
let pendingPackageName = null;
let pendingPrice       = null;

function confirmAndBuy(packageId, packageName, price, action) {
    // For buy — directly proceed
    if (action === 'buy') {
        processBuy(packageId, packageName, price);
        return;
    }

    // For upgrade/downgrade/renew — show confirm modal
    pendingPackageId   = packageId;
    pendingPackageName = packageName;
    pendingPrice       = price;

    const icons   = { upgrade: '⬆️', downgrade: '⬇️', renew: '🔄' };
    const titles  = {
        upgrade:   'Upgrade Plan?',
        downgrade: 'Downgrade Plan?',
        renew:     'Renew Plan?'
    };
    const msgs = {
        upgrade:   `Upgrading to <strong>${packageName}</strong> will replace your current plan immediately.`,
        downgrade: `Downgrading to <strong>${packageName}</strong> will replace your current plan immediately.`,
        renew:     `Your <strong>${packageName}</strong> plan will be extended by the same duration.`,
    };

    document.getElementById('confirmIcon').textContent  = icons[action];
    document.getElementById('confirmTitle').textContent = titles[action];
    document.getElementById('confirmMsg').innerHTML     = msgs[action];

    const btn = document.getElementById('confirmBtn');
    btn.textContent = action === 'renew' ? 'Yes, Renew' : (action === 'upgrade' ? 'Yes, Upgrade' : 'Yes, Downgrade');
    btn.onclick = () => { closeConfirm(); processBuy(packageId, packageName, price); };

    const modal = document.getElementById('confirmModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeConfirm() {
    const modal = document.getElementById('confirmModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function processBuy(packageId, packageName, price) {
    const loader = document.getElementById('payLoading');
    loader.classList.remove('hidden');
    loader.classList.add('flex');

    fetch(`/university/featured/purchase/${packageId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept':       'application/json',
            'Content-Type': 'application/json',
        }
    })
    .then(res => res.json())
    .then(data => {
        loader.classList.add('hidden');
        loader.classList.remove('flex');

        if (data.error) {
            alert(data.error);
            return;
        }

        var options = {
            key:         "{{ config('razorpay.key') }}",
            amount:      data.amount,
            currency:    "INR",
            order_id:    data.order_id,
            name:        "{{ config('app.name') }}",
            description: packageName,
            image:       "{{ asset('storage/logo/logo.jpeg') }}",
            prefill: {
                name:    "{{ auth()->user()->name }}",
                email:   "{{ auth()->user()->email }}",
                contact: "{{ auth()->user()->mobile ?? '' }}",
            },
            theme: { color: "#6b4a36" },
            handler: function (response) {
                var orderId = response.razorpay_order_id || data.order_id;
                window.location.href =
                    data.success_url +
                    "?razorpay_order_id="   + orderId +
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
    })
    .catch(err => {
        loader.classList.add('hidden');
        loader.classList.remove('flex');
        console.error(err);
        alert('Something went wrong. Please try again.');
    });
}

// Close confirm modal on backdrop click
document.getElementById('confirmModal').addEventListener('click', function(e) {
    if (e.target === this) closeConfirm();
});
</script>
@endsection