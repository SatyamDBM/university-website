@extends('layouts.app')
@section('content')

<div class="p-6">

    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ $album->name }}</h1>
            <p class="text-sm text-gray-500 mt-1">Category: {{ $album->category }} &nbsp;|&nbsp; Date: {{ \Carbon\Carbon::parse($album->date)->format('d M Y') }}</p>
        </div>
        <a href="{{ route('university.gallery.index') }}"
           class="inline-flex items-center gap-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition">
            ← Back to Gallery
        </a>
    </div>

    <div class="space-y-6">

        {{-- Album Info Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-5 py-3 border-b border-gray-100" style="background-color:#6b4a36;">
                <h2 class="text-sm font-semibold text-white">🖼️ Album Information</h2>
            </div>
            <div class="p-5" style="display:grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">

                <div class="flex flex-col gap-1">
                    <span class="text-xs font-medium text-gray-400 uppercase tracking-wide">Album Name</span>
                    <span class="text-sm text-gray-800 font-medium">{{ $album->name }}</span>
                </div>

                <div class="flex flex-col gap-1">
                    <span class="text-xs font-medium text-gray-400 uppercase tracking-wide">Category</span>
                    <span class="text-sm text-gray-800 font-medium">{{ $album->category }}</span>
                </div>

                <div class="flex flex-col gap-1">
                    <span class="text-xs font-medium text-gray-400 uppercase tracking-wide">Date</span>
                    <span class="text-sm text-gray-800 font-medium">{{ \Carbon\Carbon::parse($album->date)->format('d M Y') }}</span>
                </div>

                <div class="flex flex-col gap-1" style="grid-column: span 3;">
                    <span class="text-xs font-medium text-gray-400 uppercase tracking-wide">Description</span>
                    <div class="text-sm text-gray-700 leading-relaxed">{!! $album->description !!}</div>
                </div>

            </div>
        </div>

        {{-- Images Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-5 py-3 border-b border-gray-100 flex items-center justify-between" style="background-color:#6b4a36;">
                <h2 class="text-sm font-semibold text-white">📷 Images</h2>
                <span class="text-xs text-white/70">{{ $images->count() }} {{ Str::plural('image', $images->count()) }}</span>
            </div>
            <div class="p-5">
                @if($images->count())
                    <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 16px;">
                        @foreach($images as $image)
                            <div class="relative group rounded-lg overflow-hidden border border-gray-200"
                                 style="aspect-ratio: 1;">
                                <img src="{{ asset('storage/' . $image->image_url) }}"
                                     class="w-full h-full object-cover transition duration-200 group-hover:scale-105"
                                     alt="{{ $image->caption ?? $album->name }}">
                                @if($image->caption)
                                    <div class="absolute bottom-0 left-0 right-0 px-2 py-1.5 text-xs text-white"
                                         style="background: linear-gradient(to top, rgba(0,0,0,0.65), transparent);">
                                        {{ $image->caption }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-16 text-gray-400">
                        <svg class="w-10 h-10 mb-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25
                                     2.25 0 013.182 0l2.909 2.909M3 3h18M3 21h18"/>
                        </svg>
                        <p class="text-sm">No images uploaded for this album yet.</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection