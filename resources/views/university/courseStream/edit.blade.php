@extends('layouts.app')
@section('content')
@include('partials.swal')

<div class="p-6">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Course Stream</h1>
            <p class="text-sm text-gray-500 mt-1">Update stream details</p>
        </div>
        <a href="{{ route('university.streams.index') }}"
           class="inline-flex items-center gap-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition">
            ← Back to Streams
        </a>
    </div>

    @if ($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
        <span class="text-red-500 text-lg mt-0.5">⚠️</span>
        <ul class="text-sm text-red-600 space-y-1">
            @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
    @endif

    <form id="streamForm" method="POST" action="{{ route('university.streams.update', $stream) }}">
        @csrf
        @method('PUT')
        <div class="space-y-6">

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">📚 Stream Information</h2>
                </div>
                <div class="p-5">
                    @include('university.courseStream.partials.form', ['stream' => $stream])  {{-- ✅ reused --}}
                </div>
            </div>

            <div id="warningBox" class="hidden p-4 bg-amber-50 border border-amber-200 rounded-xl flex items-start gap-3">
                <span class="text-amber-500 text-lg">⚠️</span>
                <div id="warningText" class="text-sm text-amber-700"></div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center justify-between">
                <a href="{{ route('university.streams.index') }}"
                   class="inline-flex items-center gap-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-5 py-2.5 rounded-lg transition">
                    Cancel
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 text-white text-sm font-medium px-6 py-2.5 rounded-lg transition"
                        style="background-color:#6b4a36;">
                    Update Stream →
                </button>
            </div>
        </div>
    </form>
</div>

@include('university.courseStream.partials.fee-validation-script')
@endsection