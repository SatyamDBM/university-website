@extends('layouts.app')
@section('content')
@include('partials.swal')

<div class="p-6">

    {{-- Header --}}
<div class="flex items-center justify-between mb-6 gap-4">

    {{-- LEFT --}}
    <div class="flex-1">
        <h1 class="text-2xl font-bold text-gray-800">Student Leads</h1>
        <p class="text-sm text-gray-500 mt-1">
            All enquiries received for your university
        </p>
    </div>

    {{-- CENTER SEARCH --}}
    <div class="w-80">
        <input type="text"
               id="searchBox"
               placeholder="Search by name, email, mobile..."
               class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring focus:border-amber-500">
    </div>

    {{-- RIGHT STATS --}}
    <div class="flex gap-3">

        <div class="text-center px-4 py-2 bg-white rounded-xl border shadow-sm">
            <div class="text-lg font-bold text-gray-800">{{ $enquiries->total() }}</div>
            <div class="text-xs text-gray-400">Total Leads</div>
        </div>

        {{-- <div class="text-center px-4 py-2 bg-white rounded-xl border shadow-sm">
            <div class="text-lg font-bold text-amber-600">
                {{ $enquiries->where('assigned_by', null)->count() }}
            </div>
            <div class="text-xs text-gray-400">Unassigned</div>
        </div> --}}

    </div>

</div>

    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead>
                    <tr style="background-color:#6b4a36;">
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">#</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Student</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Contact</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Course</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Message</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Date</th>
                    </tr>
                </thead>

                {{-- IMPORTANT 👇 --}}
                <tbody id="tableBody" class="bg-white divide-y divide-gray-100">

                    @include('university.lead.partials.table_body')

                </tbody>

            </table>

        </div>

    </div>
</div>

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
