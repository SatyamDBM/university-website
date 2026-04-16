<x-filament-panels::page>
    <div class="space-y-4">
        <div class="rounded">
            <div class="flex items-center justify-between px-6 py-1">
                <div>
                    <h2 class="font-semibold text-[var(--color-text-dark)]">
                        Edit Admin FAQ
                    </h2>

                    <p class="text-xs text-[var(--color-text-subtle)]">
                        Update FAQ details, answer, status, and sorting order.
                    </p>
                </div>

                <a
                    href="{{ url('/admin/all-admin-faqs') }}"
                    class="inline-flex items-center rounded bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300"
                >
                    ⬅ Back to FAQs
                </a>
            </div>

            <div class="mt-4 rounded border border-[var(--color-border-light)] bg-white p-6">
                <form wire:submit.prevent="updateAdminFaq" class="space-y-6">

                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">
                            Question <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            wire:model="question"
                            placeholder="Enter question"
                            class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                        >

                        @error('question')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">
                            Answer
                        </label>

                        <div wire:ignore>
                            <textarea
                                id="answer-editor"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >{!! $answer !!}</textarea>
                        </div>

                        @error('answer')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Sort Order
                            </label>

                            <input
                                type="number"
                                wire:model="sort_order"
                                placeholder="Enter sort order"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('sort_order')
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

                    <div class="flex justify-end gap-3">
                        <a
                            href="{{ url('/admin/all-admin-faqs') }}"
                            class="rounded-[5px] border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="rounded-[5px] bg-[#775042] px-5 py-2 text-sm font-medium text-white"
                        >
                            Update FAQ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

        <script>
            document.addEventListener('livewire:navigated', initAnswerEditor);
            document.addEventListener('livewire:load', initAnswerEditor);

            function initAnswerEditor() {
                const editorElement = document.querySelector('#answer-editor');

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
                        editor.setData(@this.get('answer') || '');

                        editor.model.document.on('change:data', () => {
                            @this.set('answer', editor.getData());
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        </script>
    @endpush
</x-filament-panels::page>