<x-filament-panels::page>
    <div class="space-y-4">
        <div class="rounded">
            <div class="flex items-center justify-between px-6 py-1">
                <div>
                    <h2 class="font-semibold text-[var(--color-text-dark)]">
                        Create Banner
                    </h2>

                    <p class="text-xs text-[var(--color-text-subtle)]">
                        Create a new banner package.
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
                <form wire:submit.prevent="createBanner" class="space-y-6">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Banner Name
                            </label>

                            <input
                                type="text"
                                wire:model="name"
                                placeholder="Enter banner name"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Banner Slug
                            </label>

                            <input
                                type="text"
                                value="{{ \Illuminate\Support\Str::slug($name) }}"
                                readonly
                                placeholder="Banner slug will be auto generated"
                                class="w-full rounded-[5px] border border-gray-200 bg-gray-100 px-3 py-2 text-sm text-gray-500 cursor-not-allowed"
                            >
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Slot Name
                            </label>

                            <select
                                wire:model="slot_name"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >
                                <option value="">Select Slot</option>
                                <option value="homepage_top_banner">Homepage Top Banner</option>
                                <option value="homepage_slider_banner">Homepage Slider Banner</option>
                                <option value="listing_page_banner">Listing Page Banner</option>
                                <option value="search_page_banner">Search Page Banner</option>
                                <option value="blog_page_banner">Blog Page Banner</option>
                            </select>

                            @error('slot_name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Placement Location
                            </label>

                            <select
                                wire:model="placement_location"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >
                                <option value="">Select Placement</option>
                                <option value="homepage">Homepage</option>
                                <option value="listing_page">Listing Page</option>
                                <option value="search_page">Search Page</option>
                                <option value="blog_page">Blog Page</option>
                            </select>

                            @error('placement_location')
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
                                <option value="desktop">Desktop</option>
                                <option value="mobile">Mobile</option>
                                <option value="both">Both</option>
                            </select>

                            @error('device_type')
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

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Image Width
                            </label>

                            <input
                                type="number"
                                wire:model="image_width"
                                placeholder="e.g. 1920"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('image_width')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Image Height
                            </label>

                            <input
                                type="number"
                                wire:model="image_height"
                                placeholder="e.g. 600"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('image_height')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Monthly Price
                            </label>

                            <input
                                type="number"
                                wire:model="monthly_price"
                                placeholder="Enter monthly price"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('monthly_price')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Yearly Price
                            </label>

                            <input
                                type="number"
                                wire:model="yearly_price"
                                placeholder="Enter yearly price"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('yearly_price')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1 block text-sm font-medium text-gray-700">
                                Display Priority
                            </label>

                            <input
                                type="number"
                                wire:model="display_priority"
                                placeholder="Enter display priority"
                                class="w-full rounded-[5px] border border-gray-300 px-3 py-2 text-sm focus:border-[#775042] focus:outline-none"
                            >

                            @error('display_priority')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
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
                            Create Banner
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-filament-panels::page>