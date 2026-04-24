{{-- ==================== PAGE 1: Banner Listing ==================== --}}
@extends('layouts.app')
@section('content')
@include('partials.swal')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Advertise Your University</h1>
            <p class="text-sm text-gray-500 mt-1">Choose a banner slot to boost your university visibility</p>
        </div>
    </div>

    {{-- Banner Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($banners as $banner)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition hover:-translate-y-1">

            {{-- Slot Header --}}
            <div class="px-5 py-3" style="background-color:#6b4a36;">
                <h3 class="text-sm font-semibold text-white">{{ $banner->slot_name }}</h3>
            </div>

            <div class="p-5">

                {{-- Banner Preview Box --}}
                <div class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl flex items-center justify-center mb-4"
                     style="height: 120px;">
                    <div class="text-center">
                        <div class="text-3xl mb-1">🖼️</div>
                        <div class="text-xs text-gray-400 font-medium">
                            {{ $banner->width }} × {{ $banner->height }} px
                        </div>
                    </div>
                </div>

                {{-- Details --}}
                <div class="space-y-2 mb-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">📍 Placement</span>
                        <span class="font-medium text-gray-700">{{ $banner->placement_location }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">📐 Size</span>
                        <span class="font-medium text-gray-700">{{ $banner->width }} × {{ $banner->height }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">⏱️ Duration</span>
                        <span class="font-medium text-gray-700">{{ $banner->duration }} {{ $banner->duration_type }}</span>
                    </div>
                </div>

                {{-- Price + CTA --}}
                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div>
                        <div class="text-xl font-bold text-gray-800">₹{{ number_format($banner->price) }}</div>
                        <div class="text-xs text-gray-400">per {{ $banner->duration }} {{ $banner->duration_type }}</div>
                    </div>
                    <a href="{{ route('university.banners.create', $banner->id) }}"
                       class="inline-flex items-center gap-2 text-white text-sm font-medium px-4 py-2 rounded-lg transition"
                       style="background-color:#6b4a36;">
                        Book Now →
                    </a>
                </div>

            </div>
        </div>
        @empty
        <div class="col-span-3 bg-white rounded-xl border border-gray-200 p-16 text-center">
            <div class="text-4xl mb-3">📢</div>
            <div class="text-gray-500 text-sm">No banner slots available right now.</div>
        </div>
        @endforelse
    </div>

</div>
@endsection