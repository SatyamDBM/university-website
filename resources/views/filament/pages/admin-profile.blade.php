<x-filament-panels::page>
    <div class="mx-auto w-full">

        {{-- Profile Header Card --}}
        <div class="overflow-hidden rounded border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">

            {{-- Top Banner --}}
            <div class="h-20" style="background: linear-gradient(to right, #775042, #a07060);"></div>

            {{-- Avatar + Info --}}
            <div class="px-6 pb-5">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div class="flex items-end gap-4 -mt-8">
                        <div class="flex h-16 w-16 items-center justify-center rounded border-4 border-white text-xl font-bold text-white shadow-md dark:border-gray-900" style="background:#775042;">
                            {{ strtoupper(substr($admin->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="pb-1">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">{{ $admin->name ?? '-' }}</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ ucfirst($admin->role ?? 'admin') }}</p>
                        </div>
                    </div>
                    <div class="pb-1">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700 border border-green-200 dark:bg-green-500/10 dark:border-green-500/20 dark:text-green-400">
                            <span class="h-1.5 w-1.5 rounded-full bg-green-500 animate-pulse"></span>
                            {{ ucfirst($admin->status ?? 'active') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Editable Form Card --}}
        <div class="mt-4 overflow-hidden rounded border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <form wire:submit="updateProfile">

                {{-- Section Label --}}
                <div class="px-6 pt-5 pb-4">
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-semibold uppercase tracking-widest dark:text-[#a07060]" style="color:#775042;">Profile Information</span>
                        <div class="h-px flex-1 bg-gray-100 dark:bg-gray-800"></div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 px-6 sm:grid-cols-2">

                    {{-- Full Name --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-semibold text-gray-600 dark:text-gray-300">Full Name</label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                <x-heroicon-o-user class="h-4 w-4 text-gray-400" />
                            </span>
                            <input
                                type="text"
                                wire:model="name"
                                value="{{ $admin->name ?? '-' }}"
                                placeholder="Enter full name"
                                class="w-full rounded border border-gray-200 bg-gray-50 py-2.5 pl-9 pr-3 text-sm text-gray-900 outline-none transition focus:bg-white dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                                style="--tw-ring-color: rgba(119,80,66,0.15);"
                                onfocus="this.style.borderColor='#775042'; this.style.boxShadow='0 0 0 2px rgba(119,80,66,0.15)';"
                                onblur="this.style.borderColor=''; this.style.boxShadow='';"
                            >
                        </div>
                        @error('name')
                            <p class="flex items-center gap-1 text-xs text-red-500">
                                <x-heroicon-o-exclamation-circle class="h-3.5 w-3.5" />{{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-semibold text-gray-600 dark:text-gray-300">Email Address</label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                <x-heroicon-o-envelope class="h-4 w-4 text-gray-400" />
                            </span>
                            <input
                                type="email"
                                wire:model="email"
                                value="{{ $admin->email ?? '-' }}"
                                placeholder="Enter email address"
                                class="w-full rounded border border-gray-200 bg-gray-50 py-2.5 pl-9 pr-3 text-sm text-gray-900 outline-none transition focus:bg-white dark:border-gray-700 dark:bg-gray-800 dark:text-white"
                                onfocus="this.style.borderColor='#775042'; this.style.boxShadow='0 0 0 2px rgba(119,80,66,0.15)';"
                                onblur="this.style.borderColor=''; this.style.boxShadow='';"
                            >
                        </div>
                        @error('email')
                            <p class="flex items-center gap-1 text-xs text-red-500">
                                <x-heroicon-o-exclamation-circle class="h-3.5 w-3.5" />{{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Role (readonly) --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-semibold text-gray-600 dark:text-gray-300">
                            Role
                            <span class="ml-1 rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-400 dark:bg-gray-800 dark:text-gray-500">Read only</span>
                        </label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                <x-heroicon-o-shield-check class="h-4 w-4 text-gray-300" />
                            </span>
                            <input
                                type="text"
                                value="{{ ucfirst($admin->role ?? '-') }}"
                                readonly
                                class="w-full rounded border border-gray-100 bg-gray-100 py-2.5 pl-9 pr-3 text-sm text-gray-400 outline-none cursor-not-allowed dark:border-gray-700 dark:bg-gray-800/60 dark:text-gray-500"
                            >
                        </div>
                    </div>

                    {{-- Status (readonly) --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-semibold text-gray-600 dark:text-gray-300">
                            Status
                            <span class="ml-1 rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-400 dark:bg-gray-800 dark:text-gray-500">Read only</span>
                        </label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                <x-heroicon-o-check-circle class="h-4 w-4 text-gray-300" />
                            </span>
                            <input
                                type="text"
                                value="{{ ucfirst($admin->status ?? '-') }}"
                                readonly
                                class="w-full rounded border border-gray-100 bg-gray-100 py-2.5 pl-9 pr-3 text-sm text-gray-400 outline-none cursor-not-allowed dark:border-gray-700 dark:bg-gray-800/60 dark:text-gray-500"
                            >
                        </div>
                    </div>

                    {{-- Email Verified (readonly) --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-semibold text-gray-600 dark:text-gray-300">
                            Email Verified
                            <span class="ml-1 rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-400 dark:bg-gray-800 dark:text-gray-500">Read only</span>
                        </label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                <x-heroicon-o-envelope-open class="h-4 w-4 text-gray-300" />
                            </span>
                            <input
                                type="text"
                                value="{{ $admin->email_verified_at ? 'Verified' : 'Not Verified' }}"
                                readonly
                                class="w-full rounded border border-gray-100 bg-gray-100 py-2.5 pl-9 pr-3 text-sm text-gray-400 outline-none cursor-not-allowed dark:border-gray-700 dark:bg-gray-800/60 dark:text-gray-500"
                            >
                        </div>
                    </div>

                    {{-- Created At (readonly) --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-semibold text-gray-600 dark:text-gray-300">
                            Member Since
                            <span class="ml-1 rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-400 dark:bg-gray-800 dark:text-gray-500">Read only</span>
                        </label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                <x-heroicon-o-calendar class="h-4 w-4 text-gray-300" />
                            </span>
                            <input
                                type="text"
                                value="{{ $admin->created_at ? $admin->created_at->format('d M Y, h:i A') : '-' }}"
                                readonly
                                class="w-full rounded border border-gray-100 bg-gray-100 py-2.5 pl-9 pr-3 text-sm text-gray-400 outline-none cursor-not-allowed dark:border-gray-700 dark:bg-gray-800/60 dark:text-gray-500"
                            >
                        </div>
                    </div>

                </div>

                {{-- Footer --}}
                <div class="mt-5 flex items-center justify-between border-t border-gray-100 bg-gray-50 px-6 py-4 dark:border-gray-800 dark:bg-gray-800/50">
                    <div class="flex items-center gap-2 text-xs text-gray-400">
                        <x-heroicon-o-information-circle class="h-3.5 w-3.5 flex-shrink-0" />
                        Only name and email can be updated
                    </div>
                    <button
                        type="submit"
                        class="inline-flex items-center gap-1.5 rounded px-4 py-2 text-xs font-semibold text-white transition hover:-translate-y-px active:translate-y-0"
                        style="background:#775042; box-shadow: 0 4px 12px rgba(119,80,66,0.25);"
                        onmouseover="this.style.background='#5e3d31';"
                        onmouseout="this.style.background='#775042';"
                    >
                        <x-heroicon-o-check class="h-3.5 w-3.5" />
                        Save Changes
                    </button>
                </div>

            </form>
        </div>

    </div>
</x-filament-panels::page>