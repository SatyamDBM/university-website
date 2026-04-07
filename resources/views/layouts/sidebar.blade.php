    
@php
    $status = auth()->user()->linking_status ?? 'not_linked';
    $isLocked = in_array($status, ['not_linked', 'pending', 'rejected']);
@endphp

<div
    class="fixed inset-y-0 left-0 z-40 w-64 flex flex-col
           transform transition-transform duration-300
           -translate-x-full md:translate-x-0 bg-white border-r border-gray-200"
    :class="{ 'translate-x-0': sidebarOpen }"
>
    {{-- Logo at top center --}}
    <div class="flex flex-col items-center justify-center py-6 border-b border-gray-200 flex-shrink-0">
        <img src="{{ asset('storage/logo/logo.jpeg') }}"
             class="h-12 w-12 object-contain rounded-full mb-1"
             alt="Logo">
        <span class="text-gray-500 text-xs tracking-widest uppercase fo nt-medium">
            {{ config('app.name', 'UniPortal') }}
        </span>
    </div>

    {{-- Scrollable Nav --}}
    <nav class="flex-1 overflow-y-auto py-4 px-4 space-y-0.5
                {{ $isLocked ? 'pointer-events-none opacity-50' : '' }}">

        {{-- Dashboard --}}
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

        {{-- Academics --}}
        <div class="pt-4 pb-1 px-3">
            <span class="text-gray-400 text-xs uppercase tracking-widest font-semibold">Academics</span>
        </div>

        <a href="{{ route('courses.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all
                  {{ request()->routeIs('courses*')
                     ? 'bg-violet-50 text-violet-700 font-medium'
                     : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
            </svg>
            <span>Courses</span>
        </a>

        <a href="{{ route('facilities.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all
                  {{ request()->routeIs('facilities*')
                     ? 'bg-violet-50 text-violet-700 font-medium'
                     : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21"/>
            </svg>
            <span>Campus Facility</span>
        </a>
            <a href="{{ route('university.gallery.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all
                  {{ request()->routeIs('university.gallery*') ? 'bg-black/15 text-black font-medium' : 'text-black/70 hover:bg-black/10 hover:text-black' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5 5 5M12 15V3"/></svg>
            <span>Gallery</span>
        </a>
              {{-- <span>Campus Facility</span> --}}
        </a>
            <a href="{{ route('university.gallery.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all
                  {{ request()->routeIs('university.gallery*') ? 'bg-black/15 text-black font-medium' : 'text-black/70 hover:bg-black/10 hover:text-black' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5 5 5M12 15V3"/></svg>
            <span>Placement</span>
        </a>

         </a>
            <a href="{{ route('university.gallery.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all
                  {{ request()->routeIs('university.gallery*') ? 'bg-black/15 text-black font-medium' : 'text-black/70 hover:bg-black/10 hover:text-black' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5 5 5M12 15V3"/></svg>
            <span>Overview</span>
        </a>
        

        {{-- Admissions --}}
        <div class="pt-4 pb-1 px-3">
            <span class="text-gray-400 text-xs uppercase tracking-widest font-semibold">Admissions</span>
        </div>

        <a href="#"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all
                  {{ request()->routeIs('leads*')
                     ? 'bg-violet-50 text-violet-700 font-medium'
                     : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
            </svg>
            <span>Direct Enquiries</span>
            <span class="ml-auto bg-gray-200 text-gray-600 text-xs px-2 py-0.5 rounded-full">32</span>
        </a>

        {{-- <a href="#"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all
                  {{ request()->routeIs('students*')
                     ? 'bg-violet-50 text-violet-700 font-medium'
                     : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
            </svg>
            <span>Students</span>
        </a> --}}

        <a href="#"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all
                  {{ request()->routeIs('enquiries*')
                     ? 'bg-violet-50 text-violet-700 font-medium'
                     : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
            </svg>
            <span>Admin Leads</span>
        </a>

        {{-- Marketing --}}
        <div class="pt-4 pb-1 px-3">
            <span class="text-gray-400 text-xs uppercase tracking-widest font-semibold">Marketing</span>
        </div>

        <a href="#"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all
                  {{ request()->routeIs('banners*')
                     ? 'bg-violet-50 text-violet-700 font-medium'
                     : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
            </svg>
            <span>Banners</span>
            <span class="ml-auto bg-amber-100 text-amber-700 text-xs px-2 py-0.5 rounded-full">2</span>
        </a>

        {{-- <a href="#"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all
                  {{ request()->routeIs('reports*')
                     ? 'bg-violet-50 text-violet-700 font-medium'
                     : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z"/>
            </svg>
            <span>Reports</span>
        </a> --}}

        {{-- Billing --}}
        <div class="pt-4 pb-1 px-3">
            <span class="text-gray-400 text-xs uppercase tracking-widest font-semibold">Billing</span>
        </div>

        <a href="#"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all
                  {{ request()->routeIs('subscription*')
                     ? 'bg-violet-50 text-violet-700 font-medium'
                     : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/>
            </svg>
            <span>Featured Listing</span>
        </a>

        <a href="#"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all
                  {{ request()->routeIs('transactions*')
                     ? 'bg-violet-50 text-violet-700 font-medium'
                     : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75"/>
            </svg>
            <span>Payment History</span>
        </a>

        {{-- Account --}}
        <div class="pt-4 pb-1 px-3">
            <span class="text-gray-400 text-xs uppercase tracking-widest font-semibold">Account</span>
        </div>

        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all
                  {{ request()->routeIs('profile*')
                     ? 'bg-violet-50 text-violet-700 font-medium'
                     : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
            </svg>
            <span>Profile</span>
        </a>

        <a href="#"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-all
                  {{ request()->routeIs('settings*')
                     ? 'bg-violet-50 text-violet-700 font-medium'
                     : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <svg class="w-5 h-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span>Settings</span>
        </a>

    </nav>

    {{-- Bottom: User info + version --}}
    {{-- <div class="flex-shrink-0 border-t border-gray-200 p-4"> --}}
        {{-- <div class="flex items-center gap-3 mb-3">
            <div class="w-8 h-8 rounded-full bg-violet-100 flex items-center justify-center text-violet-700 font-bold text-sm flex-shrink-0">
                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <div class="text-sm font-medium text-gray-900 truncate">
                    {{ Auth::user()->name ?? 'University' }}
                </div>
                <div class="text-xs text-gray-500 truncate">
                    {{ Auth::user()->email ?? '' }}
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" title="Logout"
                    class="text-gray-400 hover:text-red-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                    </svg>
                </button>
            </form>
        </div> --}}

        {{-- Version label --}}
        {{-- <div class="text-center">
            <span class="text-gray-400 text-xs tracking-widest uppercase">
                {{ config('app.name', 'UniPortal') }}
            </span>
            <span class="text-gray-600 text-xs font-bold ml-1">V1.0</span>
        </div> --}}
    {{-- </div> --}}

</div>