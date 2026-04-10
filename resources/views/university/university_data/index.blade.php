@extends('layouts.app')

@section('content')
@include('partials.swal')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Finance & Admission</h1>
            <p class="text-sm text-gray-500 mt-1">Manage admission, scholarships & loans</p>
        </div>

        <a href="{{ route('university.finance.create') }}"
           class="bg-[#6b4a36] text-white px-4 py-2 rounded-lg text-sm">
            + Add Data
        </a>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow border overflow-hidden">
        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead style="background:#6b4a36;">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs text-white">Admission Steps</th>
                        <th class="px-4 py-3 text-left text-xs text-white">Dates</th>
                        <th class="px-4 py-3 text-left text-xs text-white">Cutoffs</th>
                        <th class="px-4 py-3 text-left text-xs text-white">Scholarships</th>
                        <th class="px-4 py-3 text-left text-xs text-white">Loans</th>
                        <th class="px-4 py-3 text-left text-xs text-white">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    {{-- ONE ROW = ONE UNIVERSITY FINANCE RECORD --}}
                    @if($process)

                    <tr class="hover:bg-gray-50">

                        {{-- STEPS --}}
                        <td class="px-4 py-4 text-sm text-gray-700">
                            @forelse($steps as $step)
                                <div>• {{ $step->title }}</div>
                            @empty
                                <span class="text-gray-400">No steps</span>
                            @endforelse
                        </td>

                        {{-- DATES --}}
                        <td class="px-4 py-4 text-sm text-gray-700">
                            @forelse($dates as $date)
                                <div>{{ $date->label }}: {{ $date->value }}</div>
                            @empty
                                <span class="text-gray-400">No dates</span>
                            @endforelse
                        </td>

                        {{-- CUTOFFS --}}
                        <td class="px-4 py-4 text-sm text-gray-700">
                            @forelse($cutoffs as $cutoff)
                                <div>{{ $cutoff->course }} - {{ $cutoff->cutoff }}</div>
                            @empty
                                <span class="text-gray-400">No cutoffs</span>
                            @endforelse
                        </td>

                        {{-- SCHOLARSHIPS --}}
                        <td class="px-4 py-4 text-sm text-gray-700">
                            {{ $scholarships->count() }} Items
                        </td>

                        {{-- LOANS --}}
                        <td class="px-4 py-4 text-sm text-gray-700">
                            {{ $loanPartners->count() }} Banks
                        </td>

                        {{-- ACTIONS --}}
                        <td class="px-4 py-4">
                            <div class="flex gap-2">

                                <a href="{{ route('university.finance.edit', $process->id) }}"
                                   class="text-xs bg-amber-100 text-amber-700 px-3 py-1 rounded">
                                    Edit
                                </a>

                               <a href="{{ route('university.finance.show', $process->id) }}"
                                    class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded">
                                        View
                                    </a>

                                    <button onclick="deleteRecord({{ $process->id }})"
                                    class="text-xs bg-red-100 text-red-700 px-3 py-1 rounded">
                                Delete
                            </button>

                            </div>
                        </td>

                    </tr>

                    @else
                    <tr>
                        <td colspan="6" class="text-center py-10 text-gray-400">
                            No Finance Data Found
                        </td>
                    </tr>
                    @endif

                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection
<script>
function deleteRecord(id) {

    Swal.fire({
        title: 'Are you sure?',
        text: "This will permanently delete this record!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {

        if (result.isConfirmed) {

            fetch(`/university/finance/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {

                if (data.success) {
                    Swal.fire('Deleted!', data.message, 'success')
                        .then(() => location.reload());
                } else {
                    Swal.fire('Error!', data.message, 'error');
                }

            })
            .catch(() => {
                Swal.fire('Error!', 'Something went wrong', 'error');
            });

        }

    });

}
</script>