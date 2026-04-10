@extends('layouts.app')
@section('content')
@include('partials.swal')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Course Streams</h1>
            <p class="text-sm text-gray-500 mt-1">Manage all course specializations</p>
        </div>
        <a href="{{ route('streams.create') }}"
           class="inline-flex items-center gap-2 text-white text-sm font-medium px-4 py-2 rounded-lg transition"
           style="background-color:#6b4a36;">
            + Add Stream
        </a>
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
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($streams as $index => $sp)
                    <tr class="hover:bg-gray-50 transition" id="stream-row-{{ $sp->id }}">

                        {{-- # --}}
                        <td class="px-4 py-4 text-sm text-gray-400">
                            {{ $streams->firstItem() + $index }}
                        </td>

                        {{-- Stream Name --}}
                        <td class="px-4 py-4">
                            <div class="text-sm font-semibold text-gray-800">{{ $sp->name }}</div>
                        </td>

                        {{-- Course --}}
                        <td class="px-4 py-4">
                            <div class="text-sm text-gray-700">{{ $sp->course->course_name ?? '—' }}</div>
                        </td>

                        {{-- Fees Range --}}
                        <td class="px-4 py-4">
                            <div class="text-sm font-medium text-gray-800">
                                ₹{{ number_format($sp->min_fee ?? 0) }}
                                <span class="text-gray-400 mx-1">—</span>
                                ₹{{ number_format($sp->max_fee ?? 0) }}
                            </div>
                        </td>

                        {{-- Actions --}}
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-1.5">
                                <a href="{{ route('streams.edit', $sp->id) }}"
                                   class="text-xs font-medium text-amber-600 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-2.5 py-1.5 rounded-lg transition">
                                    Edit
                                </a>
                                <button onclick="deleteStream({{ $sp->id }})"
                                        class="text-xs font-medium text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-2.5 py-1.5 rounded-lg transition">
                                    Delete
                                </button>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-16 text-center">
                            <div class="text-gray-400 text-sm">No streams found.</div>
                            <a href="{{ route('streams.create') }}"
                               class="inline-flex items-center gap-1 mt-3 text-sm font-medium"
                               style="color:#6b4a36;">
                                + Add your first stream
                            </a>
                        </td>
                    </tr>
                    @endforelse
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
            fetch(`/streams/${id}`, {
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