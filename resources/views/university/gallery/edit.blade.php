@extends('layouts.app')
@section('content')
<div class="p-6 max-w-2xl mx-auto">
    <div class="mb-6 border-b border-gray-200 pb-4">
        <h1 class="text-2xl font-bold text-gray-900">Edit Album</h1>
        <p class="mt-1 text-sm text-gray-500">Update the details below to edit the album.</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-[6px] border border-red-200 bg-red-50 px-4 py-3">
            <div class="mb-2 text-sm font-semibold text-red-700">
                Please fix the following errors:
            </div>
            <ul class="list-disc space-y-1 pl-5 text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('university.gallery.update', $album->id) }}" enctype="multipart/form-data" class="border border-gray-200 rounded-xl p-6 bg-white space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-semibold mb-1">Album Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" class="form-input w-full @error('name') border-red-500 @enderror" required value="{{ old('name', $album->name) }}">
            @error('name')
                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block font-semibold mb-1">Category <span class="text-red-500">*</span></label>
            <input type="text" name="category" class="form-input w-full @error('category') border-red-500 @enderror" required value="{{ old('category', $album->category) }}">
            @error('category')
                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block font-semibold mb-1">Description <span class="text-red-500">*</span></label>
            <textarea name="description" class="form-textarea w-full @error('description') border-red-500 @enderror" required>{{ old('description', $album->description) }}</textarea>
            @error('description')
                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block font-semibold mb-1">Date <span class="text-red-500">*</span></label>
            <input type="date" name="date" class="form-input w-full @error('date') border-red-500 @enderror" required value="{{ old('date', $album->date) }}">
            @error('date')
                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block font-semibold mb-1">Upload Images</label>
            <input id="imagesInput" type="file" name="images[]" class="form-input w-full @error('images') border-red-500 @enderror" accept="image/*" multiple onchange="previewImages(event)">
            <small class="text-gray-500">JPG, PNG, WEBP. Max 5MB each. You can select up to 15 images.</small>
            @error('images')
                <div class="text-xs text-red-600 mt-1">{{ $message }}</div>
            @enderror
            <div class="mt-4">
                <div class="mb-2 font-semibold">All Images:</div>
                <div id="allImagesPreview" class="flex flex-wrap gap-3">
                    @foreach($album->images as $image)
                        <div class="relative w-24 h-24 existing-image">
                            <img src="{{ asset('storage/' . $image->image_url) }}" class="object-cover w-24 h-24 rounded border border-gray-200"/>
                            <!-- Optionally, add a remove button here -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex flex-wrap items-center justify-end gap-3 border-t border-gray-200 pt-6">
            <a href="{{ route('university.gallery.index') }}"
               class="inline-flex items-center gap-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition">
                ← Back
            </a>
            <button type="submit"
                    class="rounded-[5px] bg-[#775042] px-5 py-2 text-sm font-medium text-white transition hover:bg-[#5e3d31]">
                Update Album
            </button>
        </div>
    </form>
    <script>
    // Combine existing and new image previews
    let selectedFiles = [];
    function previewImages(event) {
        const files = Array.from(event.target.files);
        const allPreview = document.getElementById('allImagesPreview');
        // Remove all new previews (keep only .existing-image)
        Array.from(allPreview.querySelectorAll('.new-image')).forEach(el => el.remove());
        selectedFiles = files.slice(0, 15);
        if (files.length > 15) {
            alert('You can upload a maximum of 15 images.');
            document.getElementById('imagesInput').value = '';
            selectedFiles = [];
            return;
        }
        selectedFiles.forEach((file, idx) => {
            if (!file.type.startsWith('image/')) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative w-24 h-24 new-image';
                div.innerHTML = `
                    <img src="${e.target.result}" class="object-cover w-24 h-24 rounded border border-gray-200"/>
                    <button type="button" onclick="removeImage(${idx})" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center -mt-2 -mr-2 shadow hover:bg-red-600" title="Remove">
                        &times;
                    </button>
                `;
                allPreview.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    }
    function removeImage(idx) {
        selectedFiles.splice(idx, 1);
        const dt = new DataTransfer();
        selectedFiles.forEach(f => dt.items.add(f));
        document.getElementById('imagesInput').files = dt.files;
        previewImages({ target: { files: dt.files } });
    }
    </script>
</div>
@endsection
