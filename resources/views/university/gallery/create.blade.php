@extends('layouts.app')
@section('content')
@include('partials.swal')

<div class="p-6">

    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Create New Album</h1>
            <p class="text-sm text-gray-500 mt-1">Fill in the details below to create a new album.</p>
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

    <form id="galleryForm" method="POST" action="{{ route('university.gallery.store') }}" enctype="multipart/form-data">
        @csrf
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
                                   value="{{ old('name') }}"
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
                                   value="{{ old('category') }}"
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
                                   value="{{ old('date') }}"
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
                                  placeholder="Write a short description of this album…"
                                  class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm text-gray-900 outline-none resize-y transition
                                         focus:ring-2 focus:ring-[#6b4a36]/20 focus:border-[#6b4a36]
                                         @error('description') border-red-400 bg-red-50 @enderror">{{ old('description') }}</textarea>
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
                <div class="p-5 flex flex-col gap-3">

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
                        Click to select images
                    </label>

                    <input id="imagesInput"
                           type="file"
                           name="images[]"
                           accept="image/*"
                           multiple
                           class="hidden"
                           onchange="previewImages(event)">

                    <p class="text-xs text-gray-400">JPG, PNG, WEBP — max 5 MB each — up to 15 images.</p>

                    @error('images')
                        <p class="text-xs text-red-600">{{ $message }}</p>
                    @enderror

                    {{-- Preview Grid --}}
                    <div id="imagePreview" class="flex flex-wrap gap-3"></div>
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
                    Create Album →
                </button>
            </div>

        </div>
    </form>
</div>

{{-- TinyMCE Free CDN --}}
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
// TinyMCE Editor Init
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
            editor.save(); // syncs content back to textarea on change
        });
    }
});

// Image preview
let selectedFiles = [];

function previewImages(event) {
    const files = Array.from(event.target.files);
    if (files.length > 15) {
        alert('You can upload a maximum of 15 images.');
        document.getElementById('imagesInput').value = '';
        selectedFiles = [];
        renderPreviews();
        return;
    }
    selectedFiles = files;
    renderPreviews();
}

function renderPreviews() {
    const preview = document.getElementById('imagePreview');
    const badge   = document.getElementById('countBadge');
    preview.innerHTML = '';

    if (selectedFiles.length === 0) {
        badge.classList.add('hidden');
        return;
    }

    badge.classList.remove('hidden');
    badge.textContent = selectedFiles.length + ' image' + (selectedFiles.length > 1 ? 's' : '') + ' selected';

    selectedFiles.forEach((file, idx) => {
        if (!file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = function (e) {
            const div = document.createElement('div');
            div.style.cssText = 'width:88px;height:88px;position:relative;flex-shrink:0;';
            div.innerHTML = `
                <img src="${e.target.result}"
                     style="width:88px;height:88px;object-fit:cover;border-radius:8px;border:1px solid #e5e7eb;"
                     alt="preview ${idx + 1}">
                <button type="button"
                        onclick="removeImage(${idx})"
                        style="position:absolute;top:-8px;right:-8px;width:22px;height:22px;
                               border-radius:50%;background:#dc2626;color:#fff;border:none;
                               cursor:pointer;font-size:15px;line-height:1;display:flex;
                               align-items:center;justify-content:center;"
                        title="Remove">&times;</button>`;
            preview.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}

function removeImage(idx) {
    selectedFiles.splice(idx, 1);
    const dt = new DataTransfer();
    selectedFiles.forEach(f => dt.items.add(f));
    document.getElementById('imagesInput').files = dt.files;
    renderPreviews();
}

document.getElementById('galleryForm').addEventListener('submit', function (e) {
    // Sync TinyMCE content to textarea before validation
    tinymce.triggerSave();

    if (selectedFiles.length === 0) {
        alert('Please select at least one image.');
        e.preventDefault(); return;
    }
    if (selectedFiles.length > 15) {
        alert('You can upload a maximum of 15 images.');
        e.preventDefault(); return;
    }
    for (let file of selectedFiles) {
        if (file.size > 5 * 1024 * 1024) {
            alert('Each image must be less than 5 MB.');
            e.preventDefault(); return;
        }
    }
});
</script>

@endsection