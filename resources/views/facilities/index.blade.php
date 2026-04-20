@extends('layouts.app')
@section('content')
@include('partials.swal')

<div class="p-6">

    {{-- Header --}}
   <div class="flex items-center justify-between mb-6">

    {{-- LEFT --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Campus Facilities</h1>
        <p class="text-sm text-gray-500 mt-1">Manage all your campus facilities</p>
    </div>

    {{-- RIGHT (SEARCH + BUTTON) --}}
    <div class="flex items-center gap-3">

        {{-- SEARCH --}}
        <div class="relative">
            <input type="text"
                   id="searchBox"
                   placeholder="Search facility..."
                   class="w-64 border rounded-lg pl-10 pr-3 py-2 text-sm focus:outline-none focus:ring focus:border-[#6b4a36]">

            <span class="absolute left-3 top-2.5 text-gray-400">🔍</span>
        </div>

        {{-- BUTTON --}}
        <a href="{{ route('university.facilities.create') }}"
           class="inline-flex items-center gap-2 bg-[#6b4a36] hover:bg-[#5a3d2e] text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            + Add Facility
        </a>

    </div>

</div>
    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                
                {{-- Table Head --}}
                <thead>
                    <tr style="background-color: #6b4a36;">
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">#</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Facility</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Type</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Featured</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Active</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Actions</th>
                    </tr>
                </thead>

                {{-- Table Body --}}
                 <tbody id="tableBody" class="bg-white divide-y divide-gray-100">
                    @include('facilities.partials.table_body')
                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        @if($facilities->hasPages())
        <div class="px-5 py-4 border-t bg-gray-50">
            {{ $facilities->links() }}
        </div>
        @endif
    </div>
</div>

{{-- Scripts --}}
<script>
function toggleFacility(id, btn) {
    const isActive = btn.dataset.active === '1' ? 0 : 1;

    fetch(`university/facilities/${id}/toggle-active`, {
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
                btn.classList.add('bg-purple-600');
                btn.classList.remove('bg-gray-300');
                btn.querySelector('span').classList.add('translate-x-6');
                btn.querySelector('span').classList.remove('translate-x-1');
            } else {
                btn.classList.remove('bg-purple-600');
                btn.classList.add('bg-gray-300');
                btn.querySelector('span').classList.remove('translate-x-6');
                btn.querySelector('span').classList.add('translate-x-1');
            }
        }
    });
}

function deleteFacility(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This will delete the facility!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#7c3aed',
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`university/facilities/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showSwal('success', data.message, '{{ route('university.facilities.index') }}');
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