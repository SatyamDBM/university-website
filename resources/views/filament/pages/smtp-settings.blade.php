<x-filament-panels::page>
    <div class="mx-auto w-full">

        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded shadow" style="background: var(--color-brand) !important;">
                    <x-heroicon-o-envelope class="h-5 w-5 text-white" />
                </div>
                <div>
                    <h2 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white">SMTP Configuration</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Outgoing mail server settings</p>
                </div>
            </div>
            <span class="inline-flex items-center gap-2 rounded-full border border-green-200 bg-green-50 px-3 py-1.5 text-xs font-medium text-green-700 dark:border-green-500/20 dark:bg-green-500/10 dark:text-green-400">
                <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-green-500"></span>
                Connected
            </span>
        </div>

        {{-- Card --}}
        <div class="overflow-hidden rounded border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <form wire:submit="save">

                {{-- Server Settings --}}
                <div class="border-b border-gray-100 px-6 py-5 dark:border-gray-800">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="text-xs font-semibold uppercase tracking-widest" style="color:var(--color-brand) !important;">Server Settings</span>
                        <div class="h-px flex-1 bg-gray-100 dark:bg-gray-800"></div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">

                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-semibold text-gray-600 dark:text-gray-300">Mail Driver</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <x-heroicon-o-arrow-right-circle class="h-4 w-4 text-gray-400" />
                                </span>
                                <input type="text" wire:model="mail_driver" placeholder="smtp"
                                    class="w-full rounded border border-gray-200 bg-gray-50 py-2.5 pl-9 pr-3 text-sm text-gray-900 outline-none transition focus:border-violet-500 focus:bg-white focus:ring-2 focus:ring-violet-500/15 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:focus:border-violet-500 dark:focus:bg-gray-800" />
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-semibold text-gray-600 dark:text-gray-300">Mail Host</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <x-heroicon-o-globe-alt class="h-4 w-4 text-gray-400" />
                                </span>
                                <input type="text" wire:model="mail_host" placeholder="smtp.gmail.com"
                                    class="w-full rounded border border-gray-200 bg-gray-50 py-2.5 pl-9 pr-3 text-sm text-gray-900 outline-none transition focus:border-violet-500 focus:bg-white focus:ring-2 focus:ring-violet-500/15 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:focus:border-violet-500 dark:focus:bg-gray-800" />
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-semibold text-gray-600 dark:text-gray-300">Port</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <x-heroicon-o-hashtag class="h-4 w-4 text-gray-400" />
                                </span>
                                <input type="text" wire:model="mail_port" placeholder="587"
                                    class="w-full rounded border border-gray-200 bg-gray-50 py-2.5 pl-9 pr-3 text-sm text-gray-900 outline-none transition focus:border-violet-500 focus:bg-white focus:ring-2 focus:ring-violet-500/15 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:focus:border-violet-500 dark:focus:bg-gray-800" />
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-semibold text-gray-600 dark:text-gray-300">Encryption</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <x-heroicon-o-lock-closed class="h-4 w-4 text-gray-400" />
                                </span>
                                <select wire:model="mail_encryption"
                                    class="w-full appearance-none rounded border border-gray-200 bg-gray-50 py-2.5 pl-9 pr-8 text-sm text-gray-900 outline-none transition focus:border-violet-500 focus:bg-white focus:ring-2 focus:ring-violet-500/15 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:focus:border-violet-500 dark:focus:bg-gray-800">
                                    <option value="">Select Encryption</option>
                                    <option value="tls">TLS</option>
                                    <option value="ssl">SSL</option>
                                </select>
                                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                    <x-heroicon-o-chevron-down class="h-4 w-4 text-gray-400" />
                                </span>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Authentication --}}
                <div class="border-b border-gray-100 px-6 py-5 dark:border-gray-800">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="text-xs font-semibold uppercase tracking-widest" style="color:var(--color-brand) !important;">Authentication</span>
                        <div class="h-px flex-1 bg-gray-100 dark:bg-gray-800"></div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">

                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-semibold text-gray-600 dark:text-gray-300">Username</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <x-heroicon-o-user class="h-4 w-4 text-gray-400" />
                                </span>
                                <input type="text" wire:model="mail_username" placeholder="example@gmail.com"
                                    class="w-full rounded border border-gray-200 bg-gray-50 py-2.5 pl-9 pr-3 text-sm text-gray-900 outline-none transition focus:border-violet-500 focus:bg-white focus:ring-2 focus:ring-violet-500/15 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:focus:border-violet-500 dark:focus:bg-gray-800" />
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-semibold text-gray-600 dark:text-gray-300">Password</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <x-heroicon-o-key class="h-4 w-4 text-gray-400" />
                                </span>
                                <input type="password" wire:model="mail_password" placeholder="••••••••"
                                    class="w-full rounded border border-gray-200 bg-gray-50 py-2.5 pl-9 pr-3 text-sm text-gray-900 outline-none transition focus:border-violet-500 focus:bg-white focus:ring-2 focus:ring-violet-500/15 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:focus:border-violet-500 dark:focus:bg-gray-800" />
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Sender Details --}}
                <div class="px-6 py-5">
                    <div class="mb-4 flex items-center gap-3">
                        <span class="text-xs font-semibold uppercase tracking-widest" style="color:var(--color-brand) !important;">Sender Details</span>
                        <div class="h-px flex-1 bg-gray-100 dark:bg-gray-800"></div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">

                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-semibold text-gray-600 dark:text-gray-300">From Email</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <x-heroicon-o-envelope class="h-4 w-4 text-gray-400" />
                                </span>
                                <input type="email" wire:model="mail_from_address" placeholder="noreply@example.com"
                                    class="w-full rounded border border-gray-200 bg-gray-50 py-2.5 pl-9 pr-3 text-sm text-gray-900 outline-none transition focus:border-violet-500 focus:bg-white focus:ring-2 focus:ring-violet-500/15 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:focus:border-violet-500 dark:focus:bg-gray-800" />
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="text-xs font-semibold text-gray-600 dark:text-gray-300">From Name</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                    <x-heroicon-o-building-office class="h-4 w-4 text-gray-400" />
                                </span>
                                <input type="text" wire:model="mail_from_name" placeholder="Top University In India"
                                    class="w-full rounded border border-gray-200 bg-gray-50 py-2.5 pl-9 pr-3 text-sm text-gray-900 outline-none transition focus:border-violet-500 focus:bg-white focus:ring-2 focus:ring-violet-500/15 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:focus:border-violet-500 dark:focus:bg-gray-800" />
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Footer --}}
                <div class="flex items-center justify-between border-t border-gray-100 bg-gray-50 px-6 py-4 dark:border-gray-800 dark:bg-gray-800/50">
                    <div class="flex items-center gap-2 text-xs text-gray-400">
                        <x-heroicon-o-information-circle class="h-3.5 w-3.5 flex-shrink-0" />
                        Changes apply to all outgoing emails
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="submit"
                            class="inline-flex items-center gap-1.5 rounded px-4 py-2 text-xs font-semibold text-white shadow-md shadow " style="background: var(--color-brand) !important;">
                            <x-heroicon-o-check class="h-3.5 w-3.5" />
                            Save Settings
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
</x-filament-panels::page>