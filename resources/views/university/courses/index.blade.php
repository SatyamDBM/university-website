@extends('layouts.app')
@section('content')
@include('partials.swal')
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showSwal('success', @json(session('success')));
        });
    </script>
@endif

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Course List</h1>
        <a href="{{ route('courses.create') }}"
           class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            + Add New Course
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($courses as $course)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-4 text-sm font-medium text-gray-800">
                            {{ $course->course_name }}
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-600">
                            {{ $course->category->name ?? '—' }}
                        </td>
                        <td class="px-5 py-4">
                            @php
                                $statusColor = match($course->status) {
                                    'approved' => 'bg-green-100 text-green-700',
                                    'pending'  => 'bg-amber-100 text-amber-700',
                                    'draft'    => 'bg-gray-100 text-gray-600',
                                    'rejected' => 'bg-red-100 text-red-600',
                                    default    => 'bg-blue-100 text-blue-700',
                                };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $statusColor }}">
                                {{ ucfirst($course->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('courses.show', $course) }}"
                                   class="text-xs font-medium text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition">
                                    View
                                </a>
                                <a href="{{ route('courses.edit', $course) }}"
                                   class="text-xs font-medium text-amber-600 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-3 py-1.5 rounded-lg transition">
                                    Edit
                                </a>
                                <button onclick="deleteCourse({{ $course->id }})"
                                        class="text-xs font-medium text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-5 py-16 text-center">
                            <div class="text-gray-400 text-sm">No courses found.</div>
                            <a href="{{ route('courses.create') }}"
                               class="inline-flex items-center gap-1 mt-3 text-purple-600 hover:text-purple-800 text-sm font-medium">
                                + Add your first course
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($courses->hasPages())
        <div class="px-5 py-4 border-t border-gray-100 bg-gray-50">
            {{ $courses->links() }}
        </div>
        @endif
    </div>
</div>

<script>
function deleteCourse(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#7c3aed',
        cancelButtonColor: '#6b7280',
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