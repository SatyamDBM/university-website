@extends('layouts.app')
@section('content')
@include('partials.swal')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Campus Facilities</h1>
            <p class="text-sm text-gray-500 mt-1">Manage all your campus facilities</p>
        </div>
        <a href="{{ route('facilities.create') }}"
           class="inline-flex items-center gap-2 bg-[#6b4a36] hover:bg-[#5a3d2e] text-white text-sm font-medium px-4 py-2 rounded-lg transition">
            + Add Facility
        </a>
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
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($facilities as $index => $facility)
                    <tr class="hover:bg-gray-50 transition" id="row-{{ $facility->id }}">

                        {{-- Index --}}
                        <td class="px-4 py-4 text-sm text-gray-400">
                            {{ $facilities->firstItem() + $index }}
                        </td>

                        {{-- Facility Name --}}
                        <td class="px-4 py-4">
                            <div class="text-sm font-semibold text-gray-800">
                                {{ $facility->facility_name }}
                            </div>
                        </td>

                        {{-- Type --}}
                        <td class="px-4 py-4 text-sm text-gray-600">
                            {{ $facility->facility_type ?? '—' }}
                        </td>

                        {{-- Status --}}
                        <td class="px-4 py-4">
                            @php
                                $statusColor = match($facility->status) {
                                    'active' => 'bg-green-100 text-green-700',
                                    'inactive' => 'bg-gray-100 text-gray-600',
                                    'maintenance' => 'bg-amber-100 text-amber-700',
                                    default => 'bg-blue-100 text-blue-700',
                                };
                            @endphp
                            <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold {{ $statusColor }}">
                                {{ ucfirst($facility->status) }}
                            </span>
                        </td>

                        {{-- Featured --}}
                        <td class="px-4 py-4 text-sm">
                            <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold 
                                {{ $facility->is_featured ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $facility->is_featured ? 'Yes' : 'No' }}
                            </span>
                        </td>

                        {{-- Active Toggle --}}
                        <td class="px-4 py-4">
                            <button
                                onclick="toggleFacility({{ $facility->id }}, this)"
                                data-active="{{ $facility->is_active ?? 1 }}"
                                class="relative inline-flex h-6 w-11 items-center rounded-full transition
                                {{ ($facility->is_active ?? 1) ? 'bg-purple-600' : 'bg-gray-300' }}">
                                
                                <span class="inline-block h-4 w-4 transform bg-white rounded-full shadow transition
                                {{ ($facility->is_active ?? 1) ? 'translate-x-6' : 'translate-x-1' }}">
                                </span>
                            </button>
                        </td>

                        {{-- Actions --}}
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-1.5">
                                <a href="{{ route('facilities.show', $facility) }}"
                                   class="text-xs text-blue-600 bg-blue-50 px-2.5 py-1.5 rounded-lg hover:bg-blue-100">
                                    View
                                </a>

                                <a href="{{ route('facilities.edit', $facility) }}"
                                   class="text-xs text-amber-600 bg-amber-50 px-2.5 py-1.5 rounded-lg hover:bg-amber-100">
                                    Edit
                                </a>

                                <button onclick="deleteFacility({{ $facility->id }})"
                                        class="text-xs text-red-600 bg-red-50 px-2.5 py-1.5 rounded-lg hover:bg-red-100">
                                    Delete
                                </button>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-16 text-center text-gray-400">
                            No facilities found.
                        </td>
                    </tr>
                    @endforelse
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

    fetch(`/facilities/${id}/toggle-active`, {
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
            fetch(`/facilities/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    showSwal('success', data.message, '{{ route('facilities.index') }}');
                }
            });
        }
    });
}
</script>

@endsection