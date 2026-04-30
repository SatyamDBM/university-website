@extends('layouts.app')
@section('content')

<div class="p-6">

    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Album</h1>
            <p class="text-sm text-gray-500 mt-1">Update the details below to edit the album.</p>
        </div>
        <a href="{{ route('university.gallery.index') }}"
           class="inline-flex items-center gap-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition">
            ← Back to Gallery
        </a>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-5 py-4">
            <p class="text-sm font-semibold text-red-700 mb-2">Please fix the following errors:</p>
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li class="text-sm text-red-600">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="galleryForm"
          method="POST"
          action="{{ route('university.gallery.update', $album->id) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="space-y-6">

            {{-- Album Details Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">🖼️ Album Information</h2>
                </div>
                <div class="p-5">

                    {{-- Row 1: Three columns --}}
                    <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">

                        {{-- Album Name --}}
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-medium text-gray-700">
                                Album Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $album->name) }}"
                                   placeholder="e.g. Annual Day 2024"
                                   class="w-full rounded-lg border px-3 py-2 text-sm text-gray-900 outline-none transition
                                          focus:ring-2 focus:ring-[#6b4a36]/20 focus:border-[#6b4a36]
                                          @error('name') border-red-400 bg-red-50 @else border-gray-300 @enderror">
                            @error('name')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-medium text-gray-700">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="category"
                                   value="{{ old('category', $album->category) }}"
                                   placeholder="e.g. Events, Sports, Academics"
                                   class="w-full rounded-lg border px-3 py-2 text-sm text-gray-900 outline-none transition
                                          focus:ring-2 focus:ring-[#6b4a36]/20 focus:border-[#6b4a36]
                                          @error('category') border-red-400 bg-red-50 @else border-gray-300 @enderror">
                            @error('category')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Date --}}
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-medium text-gray-700">
                                Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date"
                                   name="date"
                                   value="{{ old('date', $album->date) }}"
                                   class="w-full rounded-lg border px-3 py-2 text-sm text-gray-900 outline-none transition
                                          focus:ring-2 focus:ring-[#6b4a36]/20 focus:border-[#6b4a36]
                                          @error('date') border-red-400 bg-red-50 @else border-gray-300 @enderror">
                            @error('date')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- Row 2: Description full width with editor --}}
                    <div class="flex flex-col gap-1.5 mt-5">
                        <label class="text-sm font-medium text-gray-700">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea id="descriptionEditor"
                                  name="description"
                                  class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 outline-none resize-y transition
                                         focus:ring-2 focus:ring-[#6b4a36]/20 focus:border-[#6b4a36]
                                         @error('description') border-red-400 bg-red-50 @enderror">{{ old('description', $album->description) }}</textarea>
                        @error('description')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Upload Images Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">📷 Upload Images</h2>
                </div>
                <div class="p-5 flex flex-col gap-4">

                    {{-- File Trigger --}}
                    <label for="imagesInput"
                           class="flex items-center gap-2 w-full cursor-pointer rounded-lg border border-dashed border-gray-300
                                  bg-gray-50 px-4 py-3 text-sm text-gray-500 transition
                                  hover:border-[#6b4a36] hover:text-[#6b4a36]">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5
                                     m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                        </svg>
                        Click to add more images
                    </label>

                    <input id="imagesInput"
                           type="file"
                           name="images[]"
                           accept="image/*"
                           multiple
                           class="hidden"
                           onchange="previewNewImages(event)">

                    <p class="text-xs text-gray-400 -mt-2">JPG, PNG, WEBP — max 5 MB each — up to 15 images total.</p>

                    @error('images')
                        <p class="text-xs text-red-600">{{ $message }}</p>
                    @enderror

                    {{-- Existing Images --}}
                    @if($album->images->count())
                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-3">
                                Existing Images
                                <span class="normal-case font-normal text-gray-400 ml-1">({{ $album->images->count() }} {{ Str::plural('image', $album->images->count()) }})</span>
                            </p>
                            <div id="existingImagesGrid" style="display:flex; flex-wrap:wrap; gap:12px;">
                                @foreach($album->images as $image)
                                    <div class="existing-image-item" style="position:relative; width:88px; height:88px; flex-shrink:0;" data-id="{{ $image->id }}">
                                        <img src="{{ asset('storage/' . $image->image_url) }}"
                                             style="width:88px; height:88px; object-fit:cover; border-radius:8px; border:1px solid #e5e7eb;"
                                             alt="existing image">
                                        <button type="button"
                                                onclick="removeExistingImage(this, {{ $image->id }})"
                                                style="position:absolute; top:-8px; right:-8px; width:22px; height:22px;
                                                       border-radius:50%; background:#dc2626; color:#fff; border:none;
                                                       cursor:pointer; font-size:15px; line-height:1; display:flex;
                                                       align-items:center; justify-content:center;"
                                                title="Remove">
                                            &times;
                                        </button>
                                        {{-- Hidden input to track which images to keep --}}
                                        <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- New Image Previews --}}
                    <div id="newImagesGrid" style="display:flex; flex-wrap:wrap; gap:12px;"></div>
                    <p id="countBadge" class="text-xs text-gray-500 hidden"></p>

                </div>
            </div>

            {{-- Action Bar --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center justify-end gap-3">
                <a href="{{ route('university.gallery.index') }}"
                   class="inline-flex items-center gap-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-5 py-2.5 rounded-lg transition">
                    Cancel
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 text-white text-sm font-medium px-6 py-2.5 rounded-lg transition hover:opacity-90"
                        style="background-color:#6b4a36;">
                    Update Album →
                </button>
            </div>

        </div>
    </form>
</div>

{{-- TinyMCE --}}
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
// TinyMCE Init
tinymce.init({
    selector: '#descriptionEditor',
    height: 250,
    menubar: false,
    plugins: 'lists link autolink wordcount',
    toolbar: 'bold italic underline | bullist numlist | link | removeformat',
    content_style: 'body { font-family: ui-sans-serif, system-ui, sans-serif; font-size: 14px; color: #111827; }',
    branding: false,
    promotion: false,
    skin: 'oxide',
    setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    }
});

// New image previews
let selectedFiles = [];

function previewNewImages(event) {
    const files = Array.from(event.target.files);
    if (files.length > 15) {
        alert('You can upload a maximum of 15 images.');
        document.getElementById('imagesInput').value = '';
        selectedFiles = [];
        renderNewPreviews();
        return;
    }
    selectedFiles = files;
    renderNewPreviews();
}

function renderNewPreviews() {
    const grid  = document.getElementById('newImagesGrid');
    const badge = document.getElementById('countBadge');
    grid.innerHTML = '';

    if (selectedFiles.length === 0) {
        badge.classList.add('hidden');
        return;
    }

    badge.classList.remove('hidden');
    badge.textContent = selectedFiles.length + ' new image' + (selectedFiles.length > 1 ? 's' : '') + ' selected';

    selectedFiles.forEach((file, idx) => {
        if (!file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = function (e) {
            const div = document.createElement('div');
            div.style.cssText = 'position:relative; width:88px; height:88px; flex-shrink:0;';
            div.innerHTML = `
                <img src="${e.target.result}"
                     style="width:88px; height:88px; object-fit:cover; border-radius:8px; border:1px solid #e5e7eb;"
                     alt="new preview ${idx + 1}">
                <button type="button"
                        onclick="removeNewImage(${idx})"
                        style="position:absolute; top:-8px; right:-8px; width:22px; height:22px;
                               border-radius:50%; background:#dc2626; color:#fff; border:none;
                               cursor:pointer; font-size:15px; line-height:1; display:flex;
                               align-items:center; justify-content:center;"
                        title="Remove">&times;</button>`;
            grid.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}

function removeNewImage(idx) {
    selectedFiles.splice(idx, 1);
    const dt = new DataTransfer();
    selectedFiles.forEach(f => dt.items.add(f));
    document.getElementById('imagesInput').files = dt.files;
    renderNewPreviews();
}

// Remove existing image (hides it and removes the hidden input so it won't be sent)
function removeExistingImage(btn, imageId) {
    const wrapper = btn.closest('.existing-image-item');
    // Remove the hidden input so this ID is not sent in existing_images[]
    const hiddenInput = wrapper.querySelector('input[type="hidden"]');
    if (hiddenInput) hiddenInput.remove();
    // Fade out and remove the preview
    wrapper.style.opacity = '0.3';
    wrapper.style.pointerEvents = 'none';
    btn.remove();
}

// Form submit
document.getElementById('galleryForm').addEventListener('submit', function (e) {
    tinymce.triggerSave();

    for (let file of selectedFiles) {
        if (file.size > 5 * 1024 * 1024) {
            alert('Each image must be less than 5 MB.');
            e.preventDefault(); return;
        }
    }
});
</script>

@endsection