@extends('layouts.app')
@section('content')
@include('partials.swal')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Course</h1>
            <p class="text-sm text-gray-500 mt-1">Update course details below</p>
        </div>
        <a href="{{ route('courses.index') }}"
           class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition">
            ← Back to Courses
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <form id="courseForm" method="POST" action="{{ route('courses.update', $course) }}" enctype="multipart/form-data">
                @csrf
            @method('PUT')

            @include('university.courses.partials.form', ['course' => $course])

            {{-- Actions --}}
            <div class="flex items-center gap-3 mt-8 pt-6 border-t border-gray-100">
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium px-6 py-2.5 rounded-lg transition">
                    Update Course
                </button>
                <a href="{{ route('courses.index') }}"
                   class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 px-6 py-2.5 rounded-lg transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('courseForm').onsubmit = function(e) {
    e.preventDefault();
    let form = this;
    let formData = new FormData(form);
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            showSwal('success', data.message, data.redirect);
        } else {
            showSwal('error', data.message || 'Error occurred');
        }
    })
    .catch(() => showSwal('error', 'Error occurred'));
};
</script>
@endsection