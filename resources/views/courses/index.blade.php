@extends('layouts.app')
@section('content')
@include('components.swal')
<div class="container">
    <h1>Course List</h1>
    <a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">Add New Course</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->course_name }}</td>
                <td>{{ $course->category->name ?? '' }}</td>
                <td><span class="badge bg-info">{{ $course->status }}</span></td>
                <td>
                    <a href="{{ route('courses.show', $course) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning btn-sm">Edit</a>
                    <button onclick="deleteCourse({{ $course->id }})" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $courses->links() }}
</div>
<script>
function deleteCourse(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/courses/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                showSwal('success', data.message, '{{ route('courses.index') }}');
            });
        }
    });
}
</script>
@endsection
