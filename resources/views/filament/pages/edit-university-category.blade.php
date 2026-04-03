<x-filament-panels::page>
    <div class="space-y-4">
        <div class="rounded">
            <div class="flex items-center justify-between px-6 py-1">
                <div>
                    <h2 class="font-semibold text-[var(--color-text-dark)]">
                        Edit Category
                    </h2>

                    <p class="text-xs text-[var(--color-text-subtle)]">
                        Update university category details.
                    </p>
                </div>

                <a
                    href="{{ url('/admin/university-categories') }}"
                    class="inline-flex items-center rounded bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300"
                >
                    ⬅ Back to Categories
                </a>
            </div>

            <div class="mt-4 rounded border border-[var(--color-border-light)] bg-white p-6">
                <form wire:submit.prevent="updateCategory" class="space-y-6">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Category Name
                            </label>

                            <input
                                type="text"
                                wire:model="name"
                                placeholder="Enter category name"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Category Slug
                            </label>

                            <input
                                type="text"
                                value="{{ \Illuminate\Support\Str::slug($name) }}"
                                readonly
                                placeholder="Category slug will be auto generated"
                                class="w-full rounded-[5px] border border-gray-200 bg-gray-100 px-3 py-2 text-sm text-gray-500 cursor-not-allowed"
                            >
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Status
                            </label>

                            <select
                                wire:model="status"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >
                                <option value="">Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>

                            @error('status')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div wire:ignore>
                        <label class="mb-1 block text-sm font-medium text-gray-700">
                            Description
                        </label>

                        <textarea
                            id="description-editor"
                            class="w-full rounded-[5px] border border-gray-300"
                        >{!! $description ?? '' !!}</textarea>

                        @error('description')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3 border-t border-gray-200 pt-4">
                        <a
                            href="{{ url('/admin/university-categories') }}"
                            class="rounded-[5px] border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="rounded-[5px] bg-[#775042] px-5 py-2 text-sm font-medium text-white"
                        >
                            Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-filament-panels::page>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    document.addEventListener('livewire:initialized', () => {
        const editorElement = document.querySelector('#description-editor')

        if (editorElement && !window.categoryDescriptionEditor) {
            ClassicEditor
                .create(editorElement)
                .then(editor => {
                    window.categoryDescriptionEditor = editor

                    editor.model.document.on('change:data', () => {
                        @this.set('description', editor.getData())
                    })
                })
                .catch(error => {
                    console.error(error)
                })
        }
    })
</script>
@endpush