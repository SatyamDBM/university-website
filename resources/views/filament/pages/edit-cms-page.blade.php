<x-filament-panels::page>
    <div class="space-y-4">
        <div class="rounded">
            <div class="flex items-center justify-between px-6 py-1">
                <div>
                    <h2 class="font-semibold text-[var(--color-text-dark)]">
                        Edit CMS Page
                    </h2>

                    <p class="text-xs text-[var(--color-text-subtle)]">
                        Update CMS page content, SEO details, and status settings.
                    </p>
                </div>

                <a
                    href="{{ url('/admin/all-cms-pages') }}"
                    class="inline-flex items-center rounded bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300"
                >
                    ⬅ Back to CMS Pages
                </a>
            </div>

            <div class="mt-4 rounded border border-[var(--color-border-light)] bg-white p-6">
                <form wire:submit.prevent="updateCmsPage" class="space-y-6">

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Page Title <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                wire:model.live="page_title"
                                placeholder="Enter page title"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('page_title')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Slug <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                wire:model="page_slug"
                                placeholder="Auto generated slug"
                                readonly
                                class="w-full rounded-[5px] border border-gray-300 bg-gray-100 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('page_slug')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">
                            Page Content
                        </label>

                        <div wire:ignore>
                            <textarea
                                id="content-editor"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >{!! $content !!}</textarea>
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
                                    SEO Title
                                </label>

                                <input
                                    type="text"
                                    wire:model="seo_title"
                                    placeholder="Enter SEO title"
                                    class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                                >

                                @error('seo_title')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-1 block text-sm font-medium text-gray-700">
                                    Status
                                </label>

                                <select
                                    wire:model="is_active"
                                    class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                                >
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>

                                @error('is_active')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                SEO Description
                            </label>

                            <textarea
                                wire:model="seo_description"
                                rows="4"
                                placeholder="Enter SEO description"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            ></textarea>

                            @error('seo_description')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a
                            href="{{ url('/admin/all-cms-pages') }}"
                            class="rounded-[5px] border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="rounded-[5px] bg-[#775042] px-5 py-2 text-sm font-medium text-white"
                        >
                            Update CMS Page
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