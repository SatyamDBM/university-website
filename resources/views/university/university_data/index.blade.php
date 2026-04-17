@extends('layouts.app')

@section('content')
@include('partials.swal')

<div class="p-6">

    {{-- Header --}}
   <div class="flex items-center justify-between mb-6">

    {{-- LEFT --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Finance & Admission</h1>
        <p class="text-sm text-gray-500 mt-1">Manage admission, scholarships & loans</p>
    </div>

    {{-- RIGHT (SEARCH + BUTTON) --}}
    <div class="flex items-center gap-3">

        {{-- SEARCH --}}
        <div class="relative">
            <input type="text"
                   id="searchBox"
                   placeholder="Search data..."
                   class="w-64 border rounded-lg pl-10 pr-3 py-2 text-sm focus:outline-none focus:ring focus:border-[#6b4a36]">

            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                🔍
            </span>
        </div>

        {{-- BUTTON --}}
        <a href="{{ route('university.finance.create') }}"
           class="inline-flex items-center gap-2 text-white text-sm font-medium px-4 py-2 rounded-lg transition"
           style="background-color: #6b4a36;">
            + Add Data
        </a>

    </div>

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

               <tbody id="tableBody" class="bg-white divide-y divide-gray-100">
                    @include('university.university_data.partials.table_body')
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