@extends('layouts.app')
@section('content')
@include('partials.swal')

<div class="p-6">

    {{-- Header --}}
<div class="flex items-center justify-between mb-6">

    {{-- LEFT --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Course Streams</h1>
        <p class="text-sm text-gray-500 mt-1">Manage all course specializations</p>
    </div>

    {{-- RIGHT --}}
    <div class="flex items-center gap-3">

        {{-- SEARCH --}}
        <div class="relative">
            <input type="text"
                   id="searchBox"
                   placeholder="Search stream..."
                   class="w-72 border rounded-lg pl-10 pr-3 py-2 text-sm focus:ring focus:border-amber-500">
            <span class="absolute left-3 top-2.5 text-gray-400">🔍</span>
        </div>

        {{-- ADD BUTTON --}}
        <a href="{{ route('university.streams.create') }}"
           class="text-white text-sm font-medium px-4 py-2 rounded-lg"
           style="background-color:#6b4a36;">
            + Add Stream
        </a>

    </div>
</div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr style="background-color:#6b4a36;">
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">#</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Stream Name</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Course</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Fees Range</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
               <tbody id="tableBody" class="bg-white divide-y divide-gray-100">

                    @include('university.courseStream.partials.table_body')

                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($streams->hasPages())
        <div class="px-5 py-4 border-t border-gray-100 bg-gray-50">
            {{ $streams->links() }}
        </div>
        @endif
    </div>
</div>

<script>
function deleteStream(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This will delete the stream permanently!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#6b4a36',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`university/streams/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Remove row instantly
                    const row = document.getElementById('stream-row-' + id);
                    if (row) row.remove();
                    // Show second popup for confirmation
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: data.message ?? 'Stream deleted successfully!',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#6b4a36'
                    });
                }
            })
            .catch(() => Swal.fire('Error', 'Failed to delete stream.', 'error'));
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