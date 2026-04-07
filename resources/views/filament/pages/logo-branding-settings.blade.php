<x-filament::page>
    <form wire:submit="save" class="space-y-6">
        <div class="rounded border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">

            {{-- Header --}}
            <div class="border-b border-gray-200 px-6 py-3 dark:border-gray-800">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                    Logo & Branding Settings
                </h2>
                <p class=" text-sm text-gray-500 dark:text-gray-400">
                    Manage website logo, admin logo, favicon, brand name and footer text.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-3 p-6 md:grid-cols-2">

                {{-- Website Logo --}}
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Website Logo
                    </label>

                    {{-- Current Preview --}}
                    @if($website_logo)
                        <div class="mb-3 flex items-center gap-3 rounded border border-dashed border-gray-300 p-3 dark:border-gray-700">
                            <img src="{{ asset($website_logo) }}" class="h-12 object-contain" alt="Website Logo">
                            <span class="text-xs text-gray-400 break-all">{{ $website_logo }}</span>
                        </div>
                    @endif

                    {{-- Upload Input --}}
                    <div class="relative">
                        <input
                            type="file"
                            wire:model="website_logo_upload"
                            accept="image/*"
                            id="website_logo_file"
                            class="hidden"
                        >
                        <label
                            for="website_logo_file"
                            class="flex cursor-pointer items-center justify-center gap-2 rounded border-2 border-dashed border-gray-300 px-4 py-6 text-sm text-gray-500 transition hover:border-gray-400 hover:bg-gray-50 dark:border-gray-700 dark:hover:border-gray-600 dark:hover:bg-gray-800"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0L8 8m4-4l4 4"/>
                            </svg>
                            <span>Click to upload website logo</span>
                        </label>
                    </div>

                    {{-- New Upload Preview --}}
                    @if($website_logo_upload)
                        <div class="mt-1 rounded border border-dashed border-green-300 p-3 dark:border-green-700">
                            <p class="mb-1 text-xs font-medium text-green-600">New upload preview:</p>
                            <img src="{{ $website_logo_upload->temporaryUrl() }}" class="h-12 object-contain" alt="Preview">
                        </div>
                    @endif

                    <div wire:loading wire:target="website_logo_upload" class="mt-2 text-xs text-gray-400">
                        Uploading...
                    </div>
                    @error('website_logo_upload') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    <p class="mt-2 text-xs text-gray-400">Recommended: PNG or SVG, max 2MB</p>
                </div>

                {{-- Admin Logo --}}
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Admin Logo
                    </label>

                    @if($admin_logo)
                        <div class="mb-3 flex items-center gap-3 rounded border border-dashed border-gray-300 p-3 dark:border-gray-700">
                            <img src="{{ asset($admin_logo) }}" class="h-12 object-contain" alt="Admin Logo">
                            <span class="text-xs text-gray-400 break-all">{{ $admin_logo }}</span>
                        </div>
                    @endif

                    <div class="relative">
                        <input
                            type="file"
                            wire:model="admin_logo_upload"
                            accept="image/*"
                            id="admin_logo_file"
                            class="hidden"
                        >
                        <label
                            for="admin_logo_file"
                            class="flex cursor-pointer items-center justify-center gap-2 rounded border-2 border-dashed border-gray-300 px-4 py-6 text-sm text-gray-500 transition hover:border-gray-400 hover:bg-gray-50 dark:border-gray-700 dark:hover:border-gray-600 dark:hover:bg-gray-800"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0L8 8m4-4l4 4"/>
                            </svg>
                            <span>Click to upload admin logo</span>
                        </label>
                    </div>

                    @if($admin_logo_upload)
                        <div class="mt-1 rounded border border-dashed border-green-300 p-3 dark:border-green-700">
                            <p class="mb-1 text-xs font-medium text-green-600">New upload preview:</p>
                            <img src="{{ $admin_logo_upload->temporaryUrl() }}" class="h-12 object-contain" alt="Preview">
                        </div>
                    @endif

                    <div wire:loading wire:target="admin_logo_upload" class="mt-2 text-xs text-gray-400">
                        Uploading...
                    </div>
                    @error('admin_logo_upload') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    <p class="mt-2 text-xs text-gray-400">Recommended: PNG or SVG, max 2MB</p>
                </div>

                {{-- Favicon --}}
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Favicon
                    </label>

                    @if($favicon)
                        <div class="mb-3 flex items-center gap-3 rounded border border-dashed border-gray-300 p-3 dark:border-gray-700">
                            <img src="{{ asset($favicon) }}" class="h-10 w-10 object-contain" alt="Favicon">
                            <span class="text-xs text-gray-400 break-all">{{ $favicon }}</span>
                        </div>
                    @endif

                    <div class="relative">
                        <input
                            type="file"
                            wire:model="favicon_upload"
                            accept="image/*"
                            id="favicon_file"
                            class="hidden"
                        >
                        <label
                            for="favicon_file"
                            class="flex cursor-pointer items-center justify-center gap-2 rounded border-2 border-dashed border-gray-300 px-4 py-6 text-sm text-gray-500 transition hover:border-gray-400 hover:bg-gray-50 dark:border-gray-700 dark:hover:border-gray-600 dark:hover:bg-gray-800"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12V4m0 0L8 8m4-4l4 4"/>
                            </svg>
                            <span>Click to upload favicon</span>
                        </label>
                    </div>

                    @if($favicon_upload)
                        <div class="mt-3 rounded border border-dashed border-green-300 p-3 dark:border-green-700">
                            <p class="mb-1 text-xs font-medium text-green-600">New upload preview:</p>
                            <img src="{{ $favicon_upload->temporaryUrl() }}" class="h-10 w-10 object-contain" alt="Preview">
                        </div>
                    @endif

                    <div wire:loading wire:target="favicon_upload" class="mt-2 text-xs text-gray-400">
                        Uploading...
                    </div>
                    @error('favicon_upload') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    <p class="mt-2 text-xs text-gray-400">Recommended: ICO or PNG 32×32, max 2MB</p>
                </div>

                {{-- Brand Name --}}
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Brand Name
                    </label>
                    <input
                        type="text"
                        wire:model="brand_name"
                        placeholder="Enter brand name"
                        class="w-full rounded border border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white"
                    >
                    @error('brand_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- Footer Text --}}
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Footer Text
                    </label>
                    <textarea
                        wire:model="footer_text"
                        rows="4"
                        placeholder="Enter footer text"
                        class="w-full rounded border border-gray-300 px-4 py-1 text-sm shadow-sm focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500 dark:border-gray-700 dark:bg-gray-900 dark:text-white"
                    ></textarea>
                    @error('footer_text') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex justify-end border-t border-gray-200 px-6 py-2 dark:border-gray-800">
                <button
                    type="submit"
                    style="background: var(--color-brand);"
                    class="inline-flex items-center gap-2 rounded px-5 py-2 text-sm font-medium text-white shadow-sm transition hover:opacity-90"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-70 cursor-not-allowed"
                >
                    <span wire:loading.remove wire:target="save">Save Settings</span>
                    <span wire:loading wire:target="save">Saving...</span>
                </button>
            </div>

        </div>
    </form>
</x-filament::page>