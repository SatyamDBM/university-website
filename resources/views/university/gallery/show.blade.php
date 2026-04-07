@extends('layouts.app')
@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <div class="mb-6 border-b border-gray-200 pb-4">
        <h1 class="text-2xl font-bold text-gray-900">Album: {{ $album->name }}</h1>
        <p class="mt-1 text-sm text-gray-500">Category: {{ $album->category }} | Date: {{ $album->date }}</p>
        <p class="mt-1 text-sm text-gray-500">{{ $album->description }}</p>
    </div>
    <div class="mb-4 font-semibold">Images:</div>
    <div class="flex flex-wrap gap-4">
        @foreach($images as $image)
            <div class="w-32 h-32 relative">
                <img src="{{ asset('storage/' . $image->image_url) }}" class="object-cover w-full h-full rounded border border-gray-200"/>
                @if($image->caption)
                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-1 rounded-b">{{ $image->caption }}</div>
                @endif
            </div>
        @endforeach
    </div>
    <div class="mt-6">
        <a href="{{ route('university.gallery.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition">← Back to Gallery</a>
    </div>
</div>
@endsection
