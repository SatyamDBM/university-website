<x-filament-panels::page>
    <div class="space-y-4">
        <div class="rounded">
            <div class="flex items-center justify-between px-6 py-1">
                <div>
                    <h2 class="font-semibold text-[var(--color-text-dark)]">
                        Create Blog
                    </h2>

                    <p class="text-xs text-[var(--color-text-subtle)]">
                        Add a new blog with content, SEO details, and publish settings.
                    </p>
                </div>

                <a
                    href="{{ url('/admin/blog') }}"
                    class="inline-flex items-center rounded bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300"
                >
                    ⬅ Back to Blog
                </a>
            </div>

            <div class="mt-4 rounded border border-[var(--color-border-light)] bg-white p-6">
                <form wire:submit.prevent="createBlog" class="space-y-6">

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Blog Title <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                wire:model="title"
                                placeholder="Enter blog title"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('title')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Slug <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                wire:model="slug"
                                placeholder="Enter slug"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('slug')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Category Name
                            </label>

                            <input
                                type="text"
                                wire:model="category_name"
                                placeholder="Enter category name"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('category_name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Featured Image
                            </label>

                            <input
                                type="file"
                                wire:model="featured_image"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm file:mr-4 file:rounded file:border-0 file:bg-[#775042] file:px-4 file:py-2 file:text-sm file:font-medium file:text-white"
                            >

                            @error('featured_image')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Publish Date
                            </label>

                            <input
                                type="datetime-local"
                                wire:model="publish_date"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('publish_date')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Status
                            </label>

                            <select
                                wire:model="status"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >
                                <option value="">Select Status</option>
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>

                            @error('status')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Publish Type
                            </label>

                            <select
                                wire:model="publish_type"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >
                                <option value="">Select Publish Type</option>
                                <option value="instant">Instant</option>
                                <option value="scheduled">Scheduled</option>
                            </select>

                            @error('publish_type')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">
                            Short Description
                        </label>

                        <textarea
                            wire:model="short_description"
                            rows="4"
                            placeholder="Enter short description"
                            class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                        ></textarea>

                        @error('short_description')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">
                            Blog Content
                        </label>

                        <div wire:ignore>
                            <textarea
                                id="content-editor"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            ></textarea>
                        </div>

                        @error('content')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="rounded border border-gray-200 p-4">
                        <h3 class="mb-4 text-sm font-semibold text-gray-800">
                            SEO Details
                        </h3>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div>
                                <label class="mb-1 block text-sm font-medium text-gray-700">
                                    Meta Title
                                </label>

                                <input
                                    type="text"
                                    wire:model="meta_title"
                                    placeholder="Enter meta title"
                                    class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                                >

                                @error('meta_title')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-1 block text-sm font-medium text-gray-700">
                                    Tags
                                </label>

                                <input
                                    type="text"
                                    wire:model="tags"
                                    placeholder="Enter tags"
                                    class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                                >

                                @error('tags')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Meta Description
                            </label>

                            <textarea
                                wire:model="meta_description"
                                rows="3"
                                placeholder="Enter meta description"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            ></textarea>

                            @error('meta_description')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Meta Keywords
                            </label>

                            <textarea
                                wire:model="meta_keywords"
                                rows="3"
                                placeholder="Enter meta keywords"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            ></textarea>

                            @error('meta_keywords')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a
                            href="{{ url('/admin/blog') }}"
                            class="rounded-[5px] border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="rounded-[5px] bg-[#775042] px-5 py-2 text-sm font-medium text-white"
                        >
                            Create Blog
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

        <script>
            document.addEventListener('livewire:navigated', initContentEditor);
            document.addEventListener('livewire:load', initContentEditor);

            function initContentEditor() {
                const editorElement = document.querySelector('#content-editor');

                if (!editorElement) {
                    return;
                }

                if (editorElement.dataset.editorInitialized === 'true') {
                    return;
                }

                editorElement.dataset.editorInitialized = 'true';

                ClassicEditor
                    .create(editorElement)
                    .then(editor => {
                        editor.setData(@this.get('content') || '');

                        editor.model.document.on('change:data', () => {
                            @this.set('content', editor.getData());
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        </script>
    @endpush
</x-filament-panels::page>