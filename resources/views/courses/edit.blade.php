@extends('layouts.app')
@section('content')
@include('components.swal')
<div class="container max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Course</h1>
    <form id="courseForm" method="POST" action="{{ route('courses.update', $course) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('courses.partials.form', ['course' => $course])
        <div class="flex gap-3 mt-6">
            <button type="submit" class="btn btn-primary">Update Course</button>
        </div>
    </form>
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
