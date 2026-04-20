@php
    $status = auth()->user()->linking_status ?? 'not_linked';
    $isLocked = in_array($status, ['not_linked', 'pending', 'rejected']);
    $settings = \App\Models\GeneralSetting::whereIn('key', ['website_logo', 'favicon', 'brand_name'])
                    ->pluck('value', 'key');
    $websiteLogo = $settings['website_logo'] ?? null;
    $favicon     = $settings['favicon'] ?? null;
    $brandName   = $settings['brand_name'] ?? config('app.name', 'UniPortal');
@endphp

<div
    class="fixed inset-y-0 left-0 z-40 w-64 flex flex-col
           transform transition-transform duration-300
           -translate-x-full md:translate-x-0 bg-white border-r border-gray-200"
    :class="{ 'translate-x-0': sidebarOpen }"
>
    {{-- Logo at top center --}}
    <div class="flex flex-col items-center justify-center border-b border-gray-200 flex-shrink-0">
        @if($websiteLogo)
            <img src="{{ asset($websiteLogo) }}"
                 class="h-14 w-20 object-contain"
                 alt="{{ $brandName }}">
        @elseif($favicon)
            <img src="{{ asset($favicon) }}"
                 class="h-14 w-20 object-contain"
                 alt="{{ $brandName }}">
        @else
            {{-- Fallback: Brand name ka pehla letter --}}
            <div class="h-14 w-20  bg-violet-100 flex items-center justify-center">
                <span class="text-violet-700 font-bold text-lg">
                    {{ strtoupper(substr($brandName, 0, 1)) }}
                </span>
            </div>
        @endif

        <span class="text-gray-500 text-xs tracking-widest uppercase mb-2 font-medium">
            {{ $brandName }}
        </span>
    </div>
    <nav class="flex-1 overflow-y-auto py-4 px-4 space-y-0.5
                {{ $isLocked ? 'pointer-events-none opacity-50' : '' }}">
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all
                  {{ request()->routeIs('dashboard')
                     ? 'bg-violet-50 text-violet-700 font-medium'
                     : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            <span>Dashboard</span>
        </a>
        <div x-data="{ academicsOpen: {{ request()->routeIs('university.courses*') || request()->routeIs('university.streams*') || request()->routeIs('university.facilities*') || request()->routeIs('university.gallery*') || request()->routeIs('university.placements*') || request()->routeIs('university.overview.*') || request()->routeIs('university.finance.*') || request()->routeIs('university.leads*') || request()->routeIs('university.enquiries*') ? 'true' : 'false' }} }" class="space-y-1">

            <button
                type="button"
                @click="academicsOpen = !academicsOpen"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition-all
                    {{ request()->routeIs('university.courses*') || request()->routeIs('university.streams*') || request()->routeIs('university.facilities*') || request()->routeIs('university.gallery*') || request()->routeIs('university.placements*') || request()->routeIs('university.overview.*') || request()->routeIs('university.finance.*') || request()->routeIs('university.leads*') || request()->routeIs('university.enquiries*')
                            ? 'bg-violet-50 text-violet-700 font-medium'
                            : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">

                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                    </svg>

                    <span>Academics</span>
                </div>

                <svg class="w-4 h-4 transition-transform duration-200"
                    :class="{ 'rotate-180': academicsOpen }"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="academicsOpen"
                x-transition
                class="ml-4 pl-4 border-gray-200 space-y-1">

                <a href="{{ route('university.courses.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all
                        {{ request()->routeIs('university.courses*')
                                ? 'bg-violet-50 text-violet-700 font-medium'
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                    </svg>
                    <span>Courses</span>
                </a>

                <a href="{{ route('university.streams.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all
                        {{ request()->routeIs('university.streams*')
                                ? 'bg-violet-50 text-violet-700 font-medium'
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                    </svg>
                    <span>Stream</span>
                </a>

                <a href="{{ route('university.facilities.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all
                        {{ request()->routeIs('university.facilities*')
                                ? 'bg-violet-50 text-violet-700 font-medium'
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21"/>
                    </svg>
                    <span>Campus Facility</span>
                </a>

                <a href="{{ route('university.gallery.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all
                        {{ request()->routeIs('university.gallery*')
                                ? 'bg-violet-50 text-violet-700 font-medium'
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5 5 5M12 15V3"/>
                    </svg>
                    <span>Gallery</span>
                </a>

                <a href="{{ route('university.placements.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all
                        {{ request()->routeIs('university.placements*')
                                ? 'bg-violet-50 text-violet-700 font-medium'
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.7" fill="none"/>
                    </svg>
                    <span>Placements</span>
                </a>

                <a href="{{ route('university.overview.show') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all
                        {{ request()->routeIs('university.overview.*')
                                ? 'bg-violet-50 text-violet-700 font-medium'
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5 5 5M12 15V3"/>
                    </svg>
                    <span>Overview</span>
                </a>

                <a href="{{ route('university.finance.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all
                        {{ request()->routeIs('university.finance.*')
                                ? 'bg-violet-50 text-violet-700 font-medium'
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a4 4 0 014-4h2a4 4 0 014 4v2M9 17v2a4 4 0 004 4h2a4 4 0 004-4v-2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    <span>Admission</span>
                </a>

                <a href="{{route('university.lead')}}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all
                        {{ request()->routeIs('university.lead*')
                                ? 'bg-violet-50 text-violet-700 font-medium'
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                    </svg>
                    <span>Direct Enquiries</span>
                    <span class="ml-auto bg-gray-200 text-gray-600 text-xs px-2 py-0.5 rounded-full">32</span>
                </a>

                <a href="{{route('university.admin.lead')}}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all
                        {{ request()->routeIs('university.admin-lead*')
                                ? 'bg-violet-50 text-violet-700 font-medium'
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                    </svg>
                    <span>Admin Leads</span>
                </a>
            </div>
        </div>
        <div x-data="{ marketingOpen: {{ request()->routeIs('banners*') ? 'true' : 'false' }} }" class="space-y-1">
            <button
                type="button"
                @click="marketingOpen = !marketingOpen"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition-all
                    {{ request()->routeIs('banners*')
                            ? 'bg-violet-50 text-violet-700 font-medium'
                            : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h18v4H3V3zm2 6h14v12H5V9zm2 2v2h10v-2H7zm0 4v2h6v-2H7z" />
                    </svg>

                    <span>Marketing</span>
                </div>

                <svg class="w-4 h-4 transition-transform duration-200"
                    :class="{ 'rotate-180': marketingOpen }"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="marketingOpen"
                x-transition
                class="ml-4 pl-4 border-gray-200 space-y-1">

                <a href=""
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all
                        {{ request()->routeIs('banners*')
                                ? 'bg-violet-50 text-violet-700 font-medium'
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">

                    <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                    </svg>

                    <span>Banners</span>

                    <span class="ml-auto bg-amber-100 text-amber-700 text-xs px-2 py-0.5 rounded-full">
                        2
                    </span>
                </a>
            </div>
        </div>
        <div x-data="{ billingOpen: {{ request()->routeIs('subscription*') || request()->routeIs('payment-history*') ? 'true' : 'false' }} }" class="space-y-1">
            <button
                type="button"
                @click="billingOpen = !billingOpen"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition-all
                    {{ request()->routeIs('subscription*') || request()->routeIs('payment-history*')
                            ? 'bg-violet-50 text-violet-700 font-medium'
                            : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/>
                    </svg>

                    <span>Billing</span>
                </div>

                <svg class="w-4 h-4 transition-transform duration-200"
                    :class="{ 'rotate-180': billingOpen }"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="billingOpen"
                x-transition
                class="ml-4 pl-4 border-gray-200 space-y-1">

                <a href=""
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all
                        {{ request()->routeIs('subscription*')
                                ? 'bg-violet-50 text-violet-700 font-medium'
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">

                    <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/>
                    </svg>

                    <span>Featured Listing</span>
                </a>

                <a href=""
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all
                        {{ request()->routeIs('payment-history*')
                                ? 'bg-violet-50 text-violet-700 font-medium'
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">

                    <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 14l6-6m0 0l6 6m-6-6v18"/>
                    </svg>

                    <span>Payment History</span>
                </a>
            </div>
        </div>
        <div x-data="{ accountOpen: {{ request()->routeIs('profile*') || request()->routeIs('settings*') || request()->routeIs('university.faq.*') ? 'true' : 'false' }} }" class="space-y-1">

            <button
                type="button"
                @click="accountOpen = !accountOpen"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm transition-all
                    {{ request()->routeIs('profile*') || request()->routeIs('settings*') || request()->routeIs('university.faq.*')
                            ? 'bg-violet-50 text-violet-700 font-medium'
                            : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                    </svg>

                    <span>Account</span>
                </div>

                <svg class="w-4 h-4 transition-transform duration-200"
                    :class="{ 'rotate-180': accountOpen }"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="accountOpen"
                x-transition
                class="ml-4 pl-4 border-gray-200 space-y-1">

                <a href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all
                        {{ request()->routeIs('profile*')
                                ? 'bg-violet-50 text-violet-700 font-medium'
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">

                    <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                    </svg>

                    <span>Profile</span>
                </a>

                <a href="#"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all
                        {{ request()->routeIs('settings*')
                                ? 'bg-violet-50 text-violet-700 font-medium'
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">

                    <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>

                    <span>Settings</span>
                </a>

                <a href="{{ route('university.faq.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm transition-all
                        {{ request()->routeIs('university.faq.*')
                                ? 'bg-violet-50 text-violet-700 font-medium'
                                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">

                    <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.75 6.75A2.25 2.25 0 017 4.5h10a2.25 2.25 0 012.25 2.25v10.5A2.25 2.25 0 0117 19.5H7A2.25 2.25 0 014.75 17.25V6.75z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 9h6M9 12h6m-6 3h6" />
                    </svg>

                    <span>FAQ</span>
                </a>
            </div>
        </div>
    </nav>  
</div>