@extends('layouts.app')
@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                {{ ucfirst($facility->facility_name) }}
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Facility details and information
            </p>
        </div>

        <a href="{{ route('university.facilities.index') }}"
           class="inline-flex items-center gap-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition">
            ← Back
        </a>
    </div>

    {{-- Card --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">

        {{-- Info Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Type --}}
            <div>
                <p class="text-sm font-semibold text-gray-800">Type</p>
                <p class="text-sm font-semibold text-gray-800">{{ $facility->facility_type }}</p>
            </div>

            {{-- Status --}}
            <div>
                <p class="text-sm font-semibold text-gray-800">Status</p>
                @php
                    $statusColor = match($facility->status) {
                        'active' => 'bg-green-100 text-green-700',
                        'inactive' => 'bg-gray-100 text-gray-600',
                        'maintenance' => 'bg-amber-100 text-amber-700',
                        default => 'bg-blue-100 text-blue-700',
                    };
                @endphp
                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold {{ $statusColor }}">
                    {{ ucfirst($facility->status) }}
                </span>
            </div>

            {{-- Capacity --}}
            <div>
                <p class="text-sm font-semibold text-gray-800">Capacity</p>
                <p class="text-sm text-gray-700">{{ $facility->capacity ?? 'N/A' }}</p>
            </div>

            {{-- Availability --}}
            <div>
                <p class="text-sm font-semibold text-gray-800">Availability</p>
                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold 
                    {{ $facility->availability ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                    {{ $facility->availability ? 'Available' : 'Not Available' }}
                </span>
            </div>

            {{-- Gender --}}
            <div>
                <p class="text-sm font-semibold text-gray-800">Gender</p>
                <p class="text-sm text-gray-700">{{ $facility->gender_specific ?? 'N/A' }}</p>
            </div>

            {{-- Featured --}}
            <div>
                <p class="text-sm font-semibold text-gray-800">Featured</p>
                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold 
                    {{ $facility->is_featured ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-500' }}">
                    {{ $facility->is_featured ? 'Yes' : 'No' }}
                </span>
            </div>

        </div>

        {{-- Description --}}
        <div class="mt-6">
            <p class="text-sm font-semibold text-gray-800 mb-1">Description</p>
            <p class="text-sm text-gray-700 leading-relaxed">
                {{ $facility->description }}
            </p>
        </div>

        {{-- Images --}}
        @if($facility->images && $facility->images->count())
        <div class="mt-6">
            <p class="text-sm font-semibold text-gray-800 mb-2">Images</p>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($facility->images as $img)
                    <div class="rounded-lg overflow-hidden border">
                        <img src="{{ asset('storage/' . $img->image_url) }}"
                             alt="{{ $img->alt_text }}"
                             class="w-full h-32 object-cover hover:scale-105 transition">
                    </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>

</div>

@endsection