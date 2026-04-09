<x-filament-panels::page>
    <div class="space-y-4">
        <div class="rounded">
            <div class="flex items-center justify-between px-6 py-1">
                <div>
                    <h2 class="font-semibold text-[var(--color-text-dark)]">
                        Edit Banner
                    </h2>

                    <p class="text-xs text-[var(--color-text-subtle)]">
                        Update banner details.
                    </p>
                </div>

                <a
                    href="{{ url('/admin/all-banners') }}"
                    class="inline-flex items-center rounded bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300"
                >
                    ⬅ Back to Banners
                </a>
            </div>

            <div class="mt-4 rounded border border-[var(--color-border-light)] bg-white p-6">
                <form wire:submit.prevent="updateBanner" class="space-y-6">

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Slot Name
                            </label>

                            <input
                                type="text"
                                wire:model="slot_name"
                                placeholder="Enter slot name"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('slot_name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Placement Page
                            </label>

                            <select
                                wire:model="placement_page"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >
                                <option value="">Select Placement Page</option>
                                <option value="homepage">Homepage</option>
                                <option value="search_page">Search Page</option>
                                <option value="listing_page">Listing Page</option>
                                <option value="course_detail_page">Course Detail Page</option>
                                <option value="university_detail_page">University Detail Page</option>
                                <option value="blog_page">Blog Page</option>
                            </select>

                            @error('placement_page')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Device Type
                            </label>

                            <select
                                wire:model="device_type"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >
                                <option value="">Select Device Type</option>
                                <option value="desktop">Desktop</option>
                                <option value="mobile">Mobile</option>
                                <option value="tablet">Tablet</option>
                                <option value="all">All</option>
                            </select>

                            @error('device_type')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Width
                            </label>

                            <input
                                type="number"
                                wire:model="width"
                                placeholder="Enter width"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('width')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Height
                            </label>

                            <input
                                type="number"
                                wire:model="height"
                                placeholder="Enter height"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('height')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Max Banner Limit
                            </label>

                            <input
                                type="number"
                                wire:model="max_banner_limit"
                                placeholder="Enter max banner limit"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('max_banner_limit')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Rotation Type
                            </label>

                            <select
                                wire:model="rotation_type"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >
                                <option value="">Select Rotation Type</option>
                                <option value="single_banner">Single Banner</option>
                                <option value="random_rotation">Random Rotation</option>
                                <option value="slider_rotation">Slider Rotation</option>
                            </select>

                            @error('rotation_type')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Priority
                            </label>

                            <select
                                wire:model="priority"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >
                                <option value="">Select Priority</option>
                                <option value="high">High</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>
                            </select>

                            @error('priority')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Price
                            </label>

                            <input
                                type="number"
                                wire:model="price"
                                placeholder="Enter price"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('price')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Duration
                            </label>

                            <input
                                type="number"
                                wire:model="duration"
                                placeholder="Enter duration"
                                min="1"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('duration')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Duration Type
                            </label>

                            <select
                                wire:model="duration_type"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >
                                <option value="">Select Duration Type</option>
                                <option value="days">Days</option>
                                <option value="months">Months</option>
                                <option value="years">Years</option>
                            </select>

                            @error('duration_type')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Status
                            </label>

                            <select
                                wire:model="status"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>

                            @error('status')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-700">
                            Description
                        </label>

                        <div wire:ignore>
                            <textarea
                                id="description-editor"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >{{ $description }}</textarea>
                        </div>

                        @error('description')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a
                            href="{{ url('/admin/all-banners') }}"
                            class="rounded-[5px] border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="rounded-[5px] bg-[#775042] px-5 py-2 text-sm font-medium text-white"
                        >
                            Update Banner
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        document.addEventListener('livewire:navigated', initDescriptionEditor);
        document.addEventListener('livewire:load', initDescriptionEditor);

        function initDescriptionEditor() {
            const editorElement = document.querySelector('#description-editor');

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
                    editor.setData(@this.get('description') || '');

                    editor.model.document.on('change:data', () => {
                        @this.set('description', editor.getData());
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        }
    </script>
    @endpush
</x-filament-panels::page>