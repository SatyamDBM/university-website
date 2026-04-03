<x-filament-panels::page>
    <div class="mx-auto w-full">

        {{-- Header --}}
        <div class="mb-6 flex items-center gap-3">
           <div class="flex h-11 w-11 items-center justify-center rounded-xl shadow" style="background: var(--color-brand) !important;">
                <x-heroicon-o-lock-closed class="h-5 w-5 text-white" />
            </div>
            <div>
                <h2 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white">Change Password</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400">Keep your admin account secure</p>
            </div>
        </div>

        {{-- Card --}}
        <div class="overflow-hidden rounded border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <form wire:submit="updatePassword">

                {{-- Fields --}}
                <div class="px-6 py-5">

                    {{-- Current Password --}}
                    <div class="mb-4">
                        <label class="mb-1.5 block text-xs font-semibold text-gray-600 dark:text-gray-300">
                            Current Password
                        </label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                <x-heroicon-o-lock-closed class="h-4 w-4 text-gray-400" />
                            </span>
                            <input
                                type="password"
                                wire:model="current_password"
                                placeholder="Enter current password"
                                class="w-full rounded border border-gray-200 bg-gray-50 py-2.5 pl-9 pr-3 text-sm text-gray-900 outline-none transition focus:border-violet-500 focus:bg-white focus:ring-2 focus:ring-violet-500/15 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:focus:border-violet-500 dark:focus:bg-gray-800"
                            >
                        </div>
                        @error('current_password')
                            <p class="mt-1.5 flex items-center gap-1 text-xs text-red-500">
                                <x-heroicon-o-exclamation-circle class="h-3.5 w-3.5 flex-shrink-0" />
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Divider --}}
                    <div class="my-5 flex items-center gap-3">
                        <div class="h-px flex-1 bg-gray-100 dark:bg-gray-800"></div>
                        <span class="text-xs font-semibold uppercase tracking-widest" style="color:var(--color-brand) !important;">New Password</span>
                        <div class="h-px flex-1 bg-gray-100 dark:bg-gray-800"></div>
                    </div>

                    {{-- New + Confirm --}}
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <div>
                            <label class="mb-1.5 block text-xs font-semibold text-gray-600 dark:text-gray-300">
                                New Password
                            </label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <x-heroicon-o-key class="h-4 w-4 text-gray-400" />
                                </span>
                                <input
                                    type="password"
                                    wire:model="new_password"
                                    placeholder="Enter new password"
                                    class="w-full rounded border border-gray-200 bg-gray-50 py-2.5 pl-9 pr-3 text-sm text-gray-900 outline-none transition focus:border-violet-500 focus:bg-white focus:ring-2 focus:ring-violet-500/15 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:focus:border-violet-500 dark:focus:bg-gray-800"
                                >
                            </div>
                            @error('new_password')
                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-500">
                                    <x-heroicon-o-exclamation-circle class="h-3.5 w-3.5 flex-shrink-0" />
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-1.5 block text-xs font-semibold text-gray-600 dark:text-gray-300">
                                Confirm Password
                            </label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <x-heroicon-o-shield-check class="h-4 w-4 text-gray-400" />
                                </span>
                                <input
                                    type="password"
                                    wire:model="confirm_password"
                                    placeholder="Confirm new password"
                                    class="w-full rounded border border-gray-200 bg-gray-50 py-2.5 pl-9 pr-3 text-sm text-gray-900 outline-none transition focus:border-violet-500 focus:bg-white focus:ring-2 focus:ring-violet-500/15 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:focus:border-violet-500 dark:focus:bg-gray-800"
                                >
                            </div>
                            @error('confirm_password')
                                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-500">
                                    <x-heroicon-o-exclamation-circle class="h-3.5 w-3.5 flex-shrink-0" />
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Footer --}}
                <div class="flex items-center justify-between border-t border-gray-100 bg-gray-50 px-6 py-4 dark:border-gray-800 dark:bg-gray-800/50">
                    <div class="flex items-center gap-2 text-xs text-gray-400">
                        <x-heroicon-o-information-circle class="h-3.5 w-3.5 flex-shrink-0" />
                        Use at least 8 characters with letters and numbers
                    </div>
                    <button
                        type="submit"
                        class="inline-flex items-center gap-1.5 rounded px-4 py-2 text-xs font-semibold text-white shadow-md shadow " style="background: var(--color-brand) !important;"
                    >
                        <x-heroicon-o-check class="h-3.5 w-3.5" />
                        Update Password
                    </button>
                </div>

            </form>
        </div>

    </div>
</x-filament-panels::page>