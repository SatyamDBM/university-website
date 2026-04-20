@extends('layouts.app')
@section('content')
@include('partials.swal')

<div class="p-6">

    {{-- Header --}}
   <div class="flex items-center justify-between mb-6">

    {{-- LEFT --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Campus Gallery</h1>
        <p class="text-sm text-gray-500 mt-1">Manage all your campus albums</p>
    </div>

    {{-- RIGHT (SEARCH + BUTTON) --}}
    <div class="flex items-center gap-3">

        {{-- SEARCH --}}
        <div class="relative">
            <input type="text"
                   id="searchBox"
                   placeholder="Search album..."
                   class="w-64 border rounded-lg pl-10 pr-3 py-2 text-sm focus:outline-none focus:ring focus:border-[#6b4a36]">

            <span class="absolute left-3 top-2.5 text-gray-400">🔍</span>
        </div>

        {{-- BUTTON --}}
        <a href="{{ route('university.gallery.create') }}"
           class="inline-flex items-center gap-2 text-white text-sm font-medium px-4 py-2 rounded-lg transition"
           style="background-color: #6b4a36;">
            + Create New Album
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
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Album</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Category</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Images</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Active</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
               <tbody id="tableBody" class="bg-white divide-y divide-gray-100">
                    @include('university.gallery.partials.table_body')
                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        @if(method_exists($albums, 'hasPages') && $albums->hasPages())
        <div class="px-5 py-4 border-t border-gray-100 bg-gray-50">
            {{ $albums->links() }}
        </div>
        @endif
    </div>
</div>

<script>
function toggleActive(id, btn) {
    const isActive = btn.dataset.active === '1' ? 0 : 1;
    fetch(`/university/gallery/${id}/toggle-active`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ is_active: isActive })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            btn.dataset.active = isActive;
            if (isActive) {
                btn.style.backgroundColor = '#6b4a36';
                btn.querySelector('span').classList.remove('translate-x-1');
                btn.querySelector('span').classList.add('translate-x-6');
            } else {
                btn.style.backgroundColor = '#d1d5db';
                btn.querySelector('span').classList.remove('translate-x-6');
                btn.querySelector('span').classList.add('translate-x-1');
            }
        }
    })
    .catch(() => alert('Failed to update status'));
}

// function deleteAlbum(id) {
//     Swal.fire({
//         title: 'Are you sure?',
//         text: 'This will delete the album and all its images!',
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#6b4a36',
//         cancelButtonColor: '#6b7280',
//         confirmButtonText: 'Yes, delete it!'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             const form = document.createElement('form');
//             form.method = 'POST';
//             form.action = `/university/gallery/${id}`;
//             form.innerHTML = `
//                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
//                 <input type="hidden" name="_method" value="DELETE">
//             `;
//             document.body.appendChild(form);
//             form.submit();
//         }
//     });
// }
function deleteAlbum(id) {
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
            fetch(`/gallery/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ _method: 'DELETE' })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showSwal('success', data.message, '{{ route('university.gallery.index') }}');
                }
            });
        }
    });
}
function deleteAlbum(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This will delete the album and all its images!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#6b4a36',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/gallery/${id}`;
            form.innerHTML = `
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="DELETE">
            `;
            document.body.appendChild(form);
            form.submit();
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
