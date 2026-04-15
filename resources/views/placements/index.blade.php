@extends('layouts.app')
@section('content')

<div class="p-6">

```
{{-- Header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Placement Records</h1>
        <p class="text-sm text-gray-500 mt-1">Manage all placement data</p>
    </div>
    <a href="{{ route('university.placements.create') }}"
       class="inline-flex items-center gap-2 bg-[#6b4a36] hover:bg-[#5a3d2e] text-white text-sm font-medium px-4 py-2 rounded-lg transition">
        + Add Placement
    </a>
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
            <tbody class="bg-white divide-y divide-gray-100">
            @foreach($placements as $placement)
                <tr class="hover:bg-gray-50 transition">

                    {{-- Year --}}
                    <td class="px-4 py-4 text-sm text-gray-700">
                        {{ $placement->academic_year }}
                    </td>

                    {{-- Highest --}}
                    <td class="px-4 py-4 text-sm font-semibold text-gray-800">
                        ₹{{ number_format($placement->highest_package, 2) }}
                    </td>

                    {{-- Average --}}
                    <td class="px-4 py-4 text-sm text-gray-700">
                        ₹{{ number_format($placement->average_package, 2) }}
                    </td>

                    {{-- Rate --}}
                    <td class="px-4 py-4 text-sm text-gray-700">
                        {{ $placement->placement_rate }}
                    </td>

                    {{-- Recruiters --}}
                    <td class="px-4 py-4">
                        @foreach($placement->recruiters as $recruiter)
                            <div class="flex items-center gap-2 mb-1">
                                @if($recruiter->logo)
                                    <img src="{{ asset('storage/' . $recruiter->logo) }}"
                                         class="w-8 h-8 rounded-full object-cover border">
                                @endif
                                <span class="text-sm text-gray-700">
                                    {{ $recruiter->company_name }}
                                </span>
                            </div>
                        @endforeach
                    </td>

                    {{-- Status --}}
                    <td class="px-4 py-4">
                        @php
                            $statusColor = match($placement->status) {
                                'approved' => 'bg-green-100 text-green-700',
                                'pending'  => 'bg-amber-100 text-amber-700',
                                'draft'    => 'bg-gray-100 text-gray-600',
                                'rejected' => 'bg-red-100 text-red-600',
                                default    => 'bg-blue-100 text-blue-700',
                            };
                        @endphp
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $statusColor }}">
                            {{ ucfirst($placement->status) }}
                        </span>
                    </td>

                    {{-- Actions --}}
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-2">

                            <a href="{{ route('placements.edit', $placement) }}"
                               class="text-xs font-medium text-amber-600 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-2.5 py-1.5 rounded-lg transition">
                                Edit
                            </a>

                            <form action="{{ route('university.placements.destroy', $placement) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        class="text-xs font-medium text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-2.5 py-1.5 rounded-lg transition delete-btn">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
            @endforeach
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
