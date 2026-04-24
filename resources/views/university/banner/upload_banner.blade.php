{{-- ==================== PAGE 2: Upload Banner ==================== --}}
@extends('layouts.app')
@section('content')
@include('partials.swal')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Upload Banner</h1>
            <p class="text-sm text-gray-500 mt-1">Set up your campaign for <strong>{{ $banner->slot_name }}</strong></p>
        </div>
        <a href="{{ route('university.banners.index') }}"
           class="inline-flex items-center gap-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition">
            ← Back to Slots
        </a>
    </div>

    @if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
        <span class="text-red-500 mt-0.5">⚠️</span>
        <ul class="text-sm text-red-600 space-y-1">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
    @endif

    <div class="grid grid-cols-3 gap-6">

        {{-- Left: Form --}}
        <div class="col-span-2 space-y-6">

            <form method="POST" enctype="multipart/form-data"
                  action="{{ route('university.banners.store', $banner->id) }}">
                @csrf

                {{-- Campaign Details --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-5 py-3" style="background-color:#6b4a36;">
                        <h2 class="text-sm font-semibold text-white">📋 Campaign Details</h2>
                    </div>
                    <div class="p-5 space-y-4">

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                Campaign Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="campaign_name"
                                   value="{{ old('campaign_name') }}"
                                   placeholder="e.g. MBA Admissions 2025"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                Redirect URL <span class="text-red-500">*</span>
                            </label>
                            <input type="url" name="redirect_url"
                                   value="{{ old('redirect_url') }}"
                                   placeholder="https://yourwebsite.com/admissions"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition"
                                   required>
                            <p class="text-xs text-gray-400 mt-1">Students will be redirected here when they click the banner</p>
                        </div>

                    </div>
                </div>

                {{-- Banner Upload --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-5 py-3" style="background-color:#6b4a36;">
                        <h2 class="text-sm font-semibold text-white">🖼️ Banner Image</h2>
                    </div>
                    <div class="p-5">

                        {{-- Upload Area --}}
                        <div id="uploadArea"
                             class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer hover:border-[#6b4a36] transition"
                             onclick="document.getElementById('bannerFile').click()">
                            <div id="uploadPlaceholder">
                                <div class="text-4xl mb-3">📁</div>
                                <div class="text-sm font-semibold text-gray-700">Click to upload banner image</div>
                                <div class="text-xs text-gray-400 mt-1">
                                    Recommended size: {{ $banner->width }} × {{ $banner->height }} px
                                </div>
                                <div class="text-xs text-gray-400">JPG, PNG · Max 5MB</div>
                            </div>
                            <img id="previewImg" src="" alt="Preview"
                                 class="hidden mx-auto rounded-lg max-h-48 object-contain mt-2">
                        </div>

                        <input type="file" id="bannerFile" name="banner_image"
                               accept="image/*" required class="hidden"
                               onchange="previewBanner(this)">

                    </div>
                </div>

                {{-- Actions --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center justify-between">
                    <a href="{{ route('university.banners.index') }}"
                       class="inline-flex items-center gap-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-5 py-2.5 rounded-lg transition">
                        Cancel
                    </a>
                    <button type="submit"
                            class="inline-flex items-center gap-2 text-white text-sm font-medium px-6 py-2.5 rounded-lg transition"
                            style="background-color:#6b4a36;">
                        Proceed to Payment →
                    </button>
                </div>

            </form>

        </div>

        {{-- Right: Summary --}}
        <div class="space-y-4">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">📊 Slot Summary</h2>
                </div>
                <div class="p-5 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Slot</span>
                        <span class="font-semibold text-gray-800">{{ $banner->slot_name }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Placement</span>
                        <span class="font-medium text-gray-700">{{ $banner->placement_location }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Size</span>
                        <span class="font-medium text-gray-700">{{ $banner->width }} × {{ $banner->height }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Duration</span>
                        <span class="font-medium text-gray-700">{{ $banner->duration }} {{ $banner->duration_type }}</span>
                    </div>
                    <div class="border-t border-gray-100 pt-3 flex justify-between">
                        <span class="text-sm font-semibold text-gray-700">Total Amount</span>
                        <span class="text-lg font-bold" style="color:#6b4a36;">₹{{ number_format($banner->price) }}</span>
                    </div>
                </div>
            </div>

            {{-- Info Card --}}
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                <div class="text-sm font-semibold text-amber-800 mb-2">ℹ️ What happens next?</div>
                <ul class="text-xs text-amber-700 space-y-1.5">
                    <li>✓ Upload your banner image</li>
                    <li>✓ Complete payment via Razorpay</li>
                    <li>✓ Banner goes to admin for approval</li>
                    <li>✓ Once approved, goes live instantly</li>
                </ul>
            </div>

        </div>

    </div>
</div>

<script>
function previewBanner(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('uploadPlaceholder').classList.add('hidden');
            const img = document.getElementById('previewImg');
            img.src = e.target.result;
            img.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection