@extends('layouts.app')
@section('content')
@include('partials.swal')

<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Finance & Admission Data</h1>
            <p class="text-sm text-gray-500 mt-1">Update admission process, scholarships and loan partners</p>
        </div>
        <a href="{{ route('university.finance.index') }}"
           class="inline-flex items-center gap-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition">
            ← Back
        </a>
    </div>

    @if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
        <span class="text-red-500 text-lg mt-0.5">⚠️</span>
        <ul class="text-sm text-red-600 space-y-1">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('university.finance.update', $record->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            @include('university.university_data.form', ['record' => $record])

            {{-- Actions --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center justify-between">
                <a href="{{ route('university.finance.index') }}"
                   class="inline-flex items-center gap-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-5 py-2.5 rounded-lg transition">
                    Cancel
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 text-white text-sm font-medium px-6 py-2.5 rounded-lg transition"
                        style="background-color:#6b4a36;">
                    Update All →
                </button>
            </div>
        </div>
    </form>
</div>

@include('partials.dynamic-rows-script')
@endsection