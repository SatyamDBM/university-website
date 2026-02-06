<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png"
        href="{{ asset('storage/favicon/favicon.png') }}">

    <title>@yield('title', config('app.name'))</title>

    <meta name="description" content="@yield('meta_description', '')">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

    <x-header />

    <main>
        @yield('content')
    </main>

    <x-footer />

</body>
</html>
