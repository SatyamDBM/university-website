{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <img
                    src="{{ asset('storage/logo/logo.jpeg') }}"
                    alt="Logo"
                    class="h-12 max-w-[120px] object-contain"
                >
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-200">
    

    <!-- Outer Container (Figma big box) -->
<div class="min-h-screen flex items-center justify-center relative">        

        <!-- Light background frame -->
        {{-- <div class="w-full max-w-3xl bg-gray-100 rounded-xl p-10 shadow-inner"> --}}

            <!-- Modal Card -->
            
            <div class="w-full max-w-md mx-auto bg-white rounded-lg shadow-md p-6 relative">
                <div class="absolute top-0 left-0 w-full h-10 bg-[#D2AF66] z-0"></div>

                <!-- Logo inside modal -->
              <div class="flex flex-col items-center mb-6">

    <!-- Logo Icon -->
    <img 
        src="{{ asset('storage/logo/logo.png') }}" 
        alt="Logo"
        class="object-contain mt-7"
    >

</div>

                {{ $slot }}

            </div>
        {{-- </div> --}}
    </div>
    

</body>
<script>
function togglePassword(fieldId, iconId) {
    const input = document.getElementById(fieldId);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>
</html>
