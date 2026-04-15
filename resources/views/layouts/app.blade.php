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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>           
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
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });

        @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        @endif

        @if(session('error'))
            Toast.fire({
                icon: 'error',
                title: "{{ session('error') }}"
            });
        @endif

        @if(session('warning'))
            Toast.fire({
                icon: 'warning',
                title: "{{ session('warning') }}"
            });
        @endif

        @if(session('info'))
            Toast.fire({
                icon: 'info',
                title: "{{ session('info') }}"
            });
        @endif

    });
</script>
</body>
</html>
