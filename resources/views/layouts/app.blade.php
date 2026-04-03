<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png"
          href="{{ asset('storage/favicon/favicon.png') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/css/university.css', 'resources/js/app.js'])

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
<div
    x-data="{ sidebarOpen: false }"
    class="min-h-screen bg-gray-100 dark:bg-gray-900 flex"
>

    {{-- ✅ SIDEBAR --}}
    @include('layouts.sidebar')

    {{-- RIGHT CONTENT --}}
    <div class="flex-1 flex flex-col md:ml-64">

        <div class="sticky top-0 z-30">
            @include('layouts.navigation')
        </div>

        {{-- PAGE HEADER --}}
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="px-6 py-4">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- PAGE CONTENT --}}
        <main class="flex-1 p-6">
           {{ $slot ?? '' }}
            @yield('content')
        </main>

    </div>

    {{-- MOBILE OVERLAY --}}
    <div
        x-show="sidebarOpen"
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"
    ></div>

</div>
</body>
</html>
