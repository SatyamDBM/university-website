@extends('layouts.public')

@section('content')

<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">

        <h1 class="text-3xl font-bold mb-8">
            Universities in India
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @for($i = 1; $i <= 12; $i++)
                <x-university-card />
            @endfor
        </div>

    </div>
</section>

@endsection
