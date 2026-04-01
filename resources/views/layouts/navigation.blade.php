@php
    $status = auth()->user()->linking_status ?? 'not_linked';
    $isLocked = in_array($status, ['not_linked', 'pending', 'rejected']);
@endphp

<nav class="bg-white border-b border-gray-200 sticky top-0 z-30 h-16 flex items-center">
    <div class="w-full px-4 sm:px-6">
        <div class="flex items-center justify-between h-full">

            {{-- Left: Hamburger (mobile) + Page Title --}}
            <div class="flex items-center gap-3">
                <button
                    @click="sidebarOpen = !sidebarOpen"
                    class="md:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div class="hidden sm:flex items-center gap-2 text-sm text-gray-500">
                    <span class="text-gray-400">🏛️</span>
                    <span class="font-600 text-gray-700">
                        @if(request()->routeIs('dashboard'))
                            Dashboard
                        @elseif(request()->routeIs('courses*'))
                            Courses
                        @elseif(request()->routeIs('students*'))
                            Students
                        @elseif(request()->routeIs('profile*'))
                            Profile
                        @else
                            {{ ucfirst(request()->segment(2) ?? 'Dashboard') }}
                        @endif
                    </span>
                </div>
            </div>

            {{-- Right --}}
            <div class="flex items-center gap-2 sm:gap-3 {{ $isLocked ? 'pointer-events-none opacity-40' : '' }}">
                  {{-- Show status pill when locked --}}
                @if($isLocked)
                <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold
                    {{ $status === 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-600' }}">
                    <span class="w-1.5 h-1.5 rounded-full
                        {{ $status === 'pending' ? 'bg-amber-500' : 'bg-red-500' }} inline-block"></span>
                    {{ $status === 'pending' ? 'Approval Pending' : 'Not Linked' }}
                </span>
                @endif

                {{-- ── Notification Dropdown ── --}}
                <div x-data="{ notifOpen: false }" class="relative {{ $isLocked ? 'pointer-events-none opacity-40' : '' }}" >

                    <button
                        @click="notifOpen = !notifOpen"
                        class="relative p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
                    </button>

                    <div
                        x-show="notifOpen"
                        @click.outside="notifOpen = false"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        style="display:none; width:300px;"
                        class="absolute right-0 top-full mt-2 z-50"
                    >
                        <div class="bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden">

                            {{-- Notif Header --}}
                            <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100 bg-gray-50">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-700 text-gray-800">Notifications</span>
                                    <span class="bg-red-500 text-white text-xs font-700 px-2 py-0.5 rounded-full leading-tight">3</span>
                                </div>
                                <button class="text-xs text-purple-600 font-600 hover:text-purple-800 transition">
                                    Mark all read
                                </button>
                            </div>

                            {{-- Notif List --}}
                            <div class="divide-y divide-gray-50" style="max-height:250px; overflow-y:auto;">

                                {{-- Unread items --}}
                                <div class="flex items-start gap-3 px-4 py-3 bg-purple-50 hover:bg-purple-100 transition cursor-pointer">
                                    <div class="w-9 h-9 rounded-xl bg-purple-100 flex items-center justify-center text-base flex-shrink-0 mt-0.5">📈</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-600 text-gray-800">New Lead Received</div>
                                        <div class="text-xs text-gray-500 mt-0.5 leading-relaxed">A student enquired about B.Tech CSE admission.</div>
                                        <div class="text-xs text-purple-500 font-600 mt-1">2 minutes ago</div>
                                    </div>
                                    <div class="w-2 h-2 bg-purple-500 rounded-full flex-shrink-0 mt-2"></div>
                                </div>

                                <div class="flex items-start gap-3 px-4 py-3 bg-purple-50 hover:bg-purple-100 transition cursor-pointer">
                                    <div class="w-9 h-9 rounded-xl bg-amber-100 flex items-center justify-center text-base flex-shrink-0 mt-0.5">🖼️</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-600 text-gray-800">Banner Approval Pending</div>
                                        <div class="text-xs text-gray-500 mt-0.5 leading-relaxed">Your 2 banners are waiting for admin approval.</div>
                                        <div class="text-xs text-purple-500 font-600 mt-1">1 hour ago</div>
                                    </div>
                                    <div class="w-2 h-2 bg-purple-500 rounded-full flex-shrink-0 mt-2"></div>
                                </div>

                                <div class="flex items-start gap-3 px-4 py-3 bg-purple-50 hover:bg-purple-100 transition cursor-pointer">
                                    <div class="w-9 h-9 rounded-xl bg-green-100 flex items-center justify-center text-base flex-shrink-0 mt-0.5">💳</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-600 text-gray-800">Subscription Renewed</div>
                                        <div class="text-xs text-gray-500 mt-0.5 leading-relaxed">Your Premium plan has been renewed successfully.</div>
                                        <div class="text-xs text-purple-500 font-600 mt-1">3 hours ago</div>
                                    </div>
                                    <div class="w-2 h-2 bg-purple-500 rounded-full flex-shrink-0 mt-2"></div>
                                </div>

                                {{-- Read items --}}
                                <div class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 transition cursor-pointer">
                                    <div class="w-9 h-9 rounded-xl bg-blue-100 flex items-center justify-center text-base flex-shrink-0 mt-0.5">✅</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-500 text-gray-500">Lead Converted</div>
                                        <div class="text-xs text-gray-400 mt-0.5 leading-relaxed">Rahul Sharma confirmed admission for MBA 2025.</div>
                                        <div class="text-xs text-gray-400 font-500 mt-1">Yesterday, 4:30 PM</div>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 transition cursor-pointer">
                                    <div class="w-9 h-9 rounded-xl bg-red-100 flex items-center justify-center text-base flex-shrink-0 mt-0.5">💰</div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-500 text-gray-500">Payment Received</div>
                                        <div class="text-xs text-gray-400 mt-0.5 leading-relaxed">₹15,000 payment received successfully.</div>
                                        <div class="text-xs text-gray-400 font-500 mt-1">Yesterday, 11:00 AM</div>
                                    </div>
                                </div>

                            </div>

                            {{-- Notif Footer --}}
                            <div class="px-4 py-2.5 border-t border-gray-100 bg-gray-50 text-center">
                                <a href="#" class="text-xs font-600 text-purple-600 hover:text-purple-800 transition">
                                    View all notifications →
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="hidden sm:block w-px h-6 bg-gray-200"></div>

                {{-- ── User Dropdown ── --}}
           {{-- ── User Dropdown ── --}}
<div x-data="{ userOpen: false, locked: {{ $isLocked ? 'true' : 'false' }} }" class="relative">
    <button
        @click="if(!locked) userOpen = !userOpen"
        class="flex items-center gap-2.5 px-2 py-1.5 rounded-lg transition
               {{ $isLocked ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50 cursor-pointer' }}"
    >
        <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-700 font-bold text-sm flex-shrink-0">
            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
        </div>
        <div class="hidden sm:block text-left">
            <div class="text-sm font-600 text-gray-800 leading-tight">
                {{ Str::limit(Auth::user()->name ?? 'User', 18) }}
            </div>
            <div class="text-xs text-gray-400 leading-tight">University Admin</div>
        </div>
        <svg class="w-4 h-4 text-gray-400 hidden sm:block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <div
        x-show="userOpen && !locked"
        @click.outside="userOpen = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 top-full mt-2 w-56 bg-white border border-gray-200 rounded-xl shadow-lg z-50 overflow-hidden"
        style="display: none;"
    >
        <div class="px-4 py-3 border-b border-gray-100 bg-gray-50">
            <div class="text-sm font-600 text-gray-800">{{ Auth::user()->name ?? 'User' }}</div>
            <div class="text-xs text-gray-500 truncate">{{ Auth::user()->email ?? '' }}</div>
        </div>

        <div class="py-1">
            <a href="{{ route('dashboard') }}" class="uni-dd-item">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('profile.edit') }}" class="uni-dd-item">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                </svg>
                My Profile
            </a>
            <a href="#" class="uni-dd-item">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Settings
            </a>
        </div>

        <div class="border-t border-gray-100 py-1">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="uni-dd-item w-full text-red-500 hover:bg-red-50 hover:text-red-600">
                    <sv
            </div>
        </div>
    </div>
</nav>