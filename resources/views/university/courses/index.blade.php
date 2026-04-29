@extends('layouts.app')
@section('content')
@include('partials.swal')

<div class="p-6">

    {{-- Header --}}
    {{-- HEADER --}}
<div class="flex items-center justify-between mb-6">

    {{-- LEFT --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Course List</h1>
        <p class="text-sm text-gray-500 mt-1">Manage all your university courses</p>
    </div>

    {{-- RIGHT (SEARCH END + BUTTON) --}}
    <div class="flex items-center gap-3">

        {{-- SEARCH --}}
        <div class="relative">
            <input type="text"
                   id="searchBox"
                   placeholder="Search course..."
                   class="w-72 border rounded-lg pl-10 pr-3 py-2 text-sm focus:ring focus:border-purple-500">

            {{-- <span class="absolute left-3 top-2.5 text-gray-400">🔍</span> --}}
        </div>

        {{-- OPTIONAL BUTTON --}}
        <a href="{{ route('university.courses.create') }}"
           class="bg-[#6b4a36] text-white px-4 py-2 rounded-lg text-sm">
            + Add Course
        </a>

    </div>
</div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
               <thead>
                    <tr style="background-color: #6b4a36;">
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">#</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Course</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Category</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Type / Mode</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Duration</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Fees</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Seats</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Admission</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Active</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                   <tbody id="tableBody" class="bg-white divide-y divide-gray-100">
                    @include('university.courses.partials.table_body')
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
function changeStatus(id, action, btn) {

    const url = btn.dataset.url;

    let label = action === 'draft' ? 'Move to Draft' : 'Submit for Approval';

    Swal.fire({
        title: label + '?',
        text: "Are you sure?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#6b4a36',
        confirmButtonText: 'Yes'
    }).then((result) => {

        if (!result.isConfirmed) return;

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ action: action })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Success', data.message, 'success');
                location.reload();
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        });
    });
}

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
            fetch(`university/courses/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showSwal('success', data.message, '{{ route('university.courses.index') }}');
                }
            });
        }
    });
}
</script>
@endsection
@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    if (window.initGlobalSearch) {
        window.initGlobalSearch(
            'searchBox',
            '{{ url()->current() }}',
            'tableBody'
        );
    }
});
</script>
@endpush
