@extends('layouts.public')

@section('content')

{{-- HERO --}}
<section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">

        <h1 class="text-4xl md:text-5xl font-bold">
            Discover Top Universities & Courses
        </h1>

        <p class="mt-4 text-lg text-blue-100">
            Compare colleges, explore courses and send enquiries instantly
        </p>

        <div class="mt-8 flex justify-center">
            <a href="/universities"
               class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">
                Browse Universities
            </a>
        </div>

    </div>
</section>

{{-- FEATURED UNIVERSITIES --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">

        <h2 class="text-2xl font-bold mb-8">
            Featured Universities
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @for($i = 1; $i <= 8; $i++)
                <x-university-card />
            @endfor
        </div>

    </div>
</section>

{{-- CALL TO ACTION --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 text-center">

        <h2 class="text-3xl font-bold">
            Are You a University?
        </h2>

        <p class="mt-4 text-gray-600">
            Get listed and start receiving student enquiries
        </p>

        <a href="/register"
           class="inline-block mt-6 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
            Register Your University
        </a>

    </div>
</section>

@endsection
