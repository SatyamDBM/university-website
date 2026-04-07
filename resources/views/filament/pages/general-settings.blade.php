<x-filament-panels::page>
    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 xl:grid-cols-3">
        <a href="#"
           class="group rounded border border-gray-200 bg-white p-3 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:border-primary-500 hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
            <div class="flex items-start justify-between">
                <div>
                    <div class="mb-2 flex h-9 w-9 items-center justify-center rounded bg-primary-50 text-primary-600 dark:bg-primary-500/10 dark:text-primary-400">
                        <x-heroicon-o-globe-alt class="h-5 w-5" />
                    </div>

                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                        Website Information
                    </h3>

                    <p class="mt-1 text-xs leading-4 text-gray-500 dark:text-gray-400">
                        Manage website name, title, meta description, and branding text.
                    </p>
                </div>

                <x-heroicon-o-arrow-right
                    class="h-4 w-4 text-gray-400 transition-transform duration-300 group-hover:translate-x-1 group-hover:text-primary-500" />
            </div>
        </a>

        <a href="{{ \App\Filament\Pages\LogoBrandingSettings::getUrl() }}"
           class="group rounded border border-gray-200 bg-white p-3 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:border-primary-500 hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
            <div class="flex items-start justify-between">
                <div>
                    <div class="mb-2 flex h-9 w-9 items-center justify-center rounded bg-pink-50 text-pink-600 dark:bg-pink-500/10 dark:text-pink-400">
                        <x-heroicon-o-photo class="h-5 w-5" />
                    </div>

                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                        Logo & Branding
                    </h3>

                    <p class="mt-1 text-xs leading-4 text-gray-500 dark:text-gray-400">
                        Upload website logo, favicon, admin logo, and email branding assets.
                    </p>
                </div>

                <x-heroicon-o-arrow-right
                    class="h-4 w-4 text-gray-400 transition-transform duration-300 group-hover:translate-x-1 group-hover:text-primary-500" />
            </div>
        </a>

        <a href="#"
           class="group rounded border border-gray-200 bg-white p-3 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:border-primary-500 hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
            <div class="flex items-start justify-between">
                <div>
                    <div class="mb-2 flex h-9 w-9 items-center justify-center rounded bg-green-50 text-green-600 dark:bg-green-500/10 dark:text-green-400">
                        <x-heroicon-o-phone class="h-5 w-5" />
                    </div>

                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                        Contact Information
                    </h3>

                    <p class="mt-1 text-xs leading-4 text-gray-500 dark:text-gray-400">
                        Manage email address, phone number, office address, and support details.
                    </p>
                </div>

                <x-heroicon-o-arrow-right
                    class="h-4 w-4 text-gray-400 transition-transform duration-300 group-hover:translate-x-1 group-hover:text-primary-500" />
            </div>
        </a>

        <a href="#"
           class="group rounded border border-gray-200 bg-white p-3 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:border-primary-500 hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
            <div class="flex items-start justify-between">
                <div>
                    <div class="mb-2 flex h-9 w-9 items-center justify-center rounded bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                        <x-heroicon-o-share class="h-5 w-5" />
                    </div>

                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                        Social Media Links
                    </h3>

                    <p class="mt-1 text-xs leading-4 text-gray-500 dark:text-gray-400">
                        Add and manage Facebook, Instagram, LinkedIn, Twitter, and YouTube URLs.
                    </p>
                </div>

                <x-heroicon-o-arrow-right
                    class="h-4 w-4 text-gray-400 transition-transform duration-300 group-hover:translate-x-1 group-hover:text-primary-500" />
            </div>
        </a>

        <a href="{{ \App\Filament\Pages\SmtpSettings::getUrl() }}"
           class="group rounded border border-gray-200 bg-white p-3 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:border-primary-500 hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
            <div class="flex items-start justify-between">
                <div>
                    <div class="mb-2 flex h-9 w-9 items-center justify-center rounded bg-orange-50 text-orange-600 dark:bg-orange-500/10 dark:text-orange-400">
                        <x-heroicon-o-envelope class="h-5 w-5" />
                    </div>

                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                        SMTP Settings
                    </h3>

                    <p class="mt-1 text-xs leading-4 text-gray-500 dark:text-gray-400">
                        Configure mail driver, SMTP host, port, username, and password.
                    </p>
                </div>

                <x-heroicon-o-arrow-right
                    class="h-4 w-4 text-gray-400 transition-transform duration-300 group-hover:translate-x-1 group-hover:text-primary-500" />
            </div>
        </a>

        <a href="#"
           class="group rounded border border-gray-200 bg-white p-3 shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:border-primary-500 hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
            <div class="flex items-start justify-between">
                <div>
                    <div class="mb-2 flex h-9 w-9 items-center justify-center rounded bg-purple-50 text-purple-600 dark:bg-purple-500/10 dark:text-purple-400">
                        <x-heroicon-o-magnifying-glass class="h-5 w-5" />
                    </div>

                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                        SEO Settings
                    </h3>

                    <p class="mt-1 text-xs leading-4 text-gray-500 dark:text-gray-400">
                        Manage meta title, keywords, analytics code, and SEO configurations.
                    </p>
                </div>

                <x-heroicon-o-arrow-right
                    class="h-4 w-4 text-gray-400 transition-transform duration-300 group-hover:translate-x-1 group-hover:text-primary-500" />
            </div>
        </a>
    </div>
</x-filament-panels::page>