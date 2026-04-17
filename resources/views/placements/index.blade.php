@extends('layouts.app')
@section('content')
<div class="p-6">
{{-- Header --}}
{{-- Header --}}
<div class="flex items-center justify-between mb-6">

    {{-- LEFT --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Placement Records</h1>
        <p class="text-sm text-gray-500 mt-1">Manage all placement data</p>
    </div>

    {{-- RIGHT (SEARCH + BUTTON) --}}
    <div class="flex items-center gap-3">

        {{-- SEARCH --}}
        <div class="relative">
            <input type="text"
                   id="searchBox"
                   placeholder="Search placement..."
                   class="w-64 border rounded-lg pl-10 pr-3 py-2 text-sm focus:outline-none focus:ring focus:border-[#6b4a36]">

            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                🔍
            </span>
        </div>

        {{-- BUTTON --}}
        <a href="{{ route('university.placements.create') }}"
           class="inline-flex items-center gap-2 text-white text-sm font-medium px-4 py-2 rounded-lg transition"
           style="background-color: #6b4a36;">
            + Add Placement
        </a>

    </div>

</div>

{{-- Success Alert --}}
@if(session('success'))
    <div class="mb-4 px-4 py-3 rounded-lg bg-green-100 text-green-700 text-sm">
        {{ session('success') }}
    </div>
@endif

{{-- Table --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">

            {{-- Table Head --}}
            <thead>
                <tr style="background-color: #6b4a36;">
                    <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Year</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Highest</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Average</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Rate (%)</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Recruiters</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Actions</th>
                </tr>
            </thead>

            {{-- Table Body --}}
                 <tbody id="tableBody" class="bg-white divide-y divide-gray-100">
                    @include('placements.partials.table_body')
                </tbody>

        </table>
    </div>
</div>
</div>

@include('components.swal')
<script>
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const form = btn.closest('form');
        Swal.fire({
            icon: 'warning',
            title: 'Are you sure?',
            text: 'This will delete the placement and all its data!',
            iconColor: '#b07a4a',
            showCancelButton: true,
            confirmButtonColor: '#6b4a36',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            customClass: {
                title: 'swal2-title',
                confirmButton: 'swal2-confirm',
                cancelButton: 'swal2-cancel',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

// Show SweetAlert2 success popup after deletion
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Deleted!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#6b4a36',
        iconColor: '#b07a4a',
    });
@endif
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
