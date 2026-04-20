@extends('layouts.app')
@section('content')
@include('partials.swal')

<div class="p-6">

    {{-- HEADER --}}
    <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-4 mb-6">

        {{-- LEFT --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Manage Leads</h1>
            <p class="text-sm text-gray-500 mt-1">
                Review and assign student enquiries
            </p>
        </div>

        {{-- SEARCH --}}
        <div class="flex justify-center">
            <div class="w-full md:w-80 relative">
                <input type="text"
                       id="searchBox"
                       placeholder="Search by name, email, mobile..."
                       class="w-full border rounded-lg pl-10 pr-3 py-2 text-sm focus:outline-none focus:ring focus:border-amber-500">

                <span class="absolute left-3 top-2.5 text-gray-400">🔍</span>
            </div>
        </div>

        {{-- STATS --}}
        <div class="flex justify-end gap-3">

            <div class="text-center px-4 py-2 bg-white rounded-xl border shadow-sm">
                <div class="text-lg font-bold text-gray-800">
                    {{ $enquiries->total() }}
                </div>
                <div class="text-xs text-gray-400">Total</div>
            </div>

            <div class="text-center px-4 py-2 bg-white rounded-xl border shadow-sm">
                <div class="text-lg font-bold text-amber-600">
                    {{ $enquiries->getCollection()->whereNull('assigned_by')->count() }}
                </div>
                <div class="text-xs text-gray-400">Unassigned</div>
            </div>

            <div class="text-center px-4 py-2 bg-white rounded-xl border shadow-sm">
                <div class="text-lg font-bold text-green-600">
                    {{ $enquiries->getCollection()->whereNotNull('assigned_by')->count() }}
                </div>
                <div class="text-xs text-gray-400">Assigned</div>
            </div>

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
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">University</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase">Date</th>
                    </tr>
                </thead>

                {{-- IMPORTANT --}}
                <tbody id="tableBody" class="bg-white divide-y divide-gray-100">
                    @include('university.lead.partials.table_body')
                </tbody>

            </table>

        </div>

    </div>
</div>

{{-- ASSIGN MODAL --}}
<div id="assignModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">

    <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4">

        {{-- HEADER --}}
        <div class="flex items-center justify-between px-5 py-4 border-b"
             style="background-color:#6b4a36;">
            <h3 class="text-sm font-semibold text-white">
                🏛️ Assign Lead
            </h3>
            <button onclick="closeAssignModal()" class="text-white text-xl">×</button>
        </div>

        {{-- BODY --}}
        <div class="p-5">

            <p class="text-sm text-gray-600 mb-3">
                Lead: <span id="leadStudentName" class="font-semibold text-gray-800"></span>
            </p>

            <label class="text-sm font-semibold">Select University</label>

            <select id="universitySelect"
                    class="w-full border rounded-lg px-3 py-2 mt-1 text-sm">
                <option value="">Select University</option>
                @foreach($universities ?? [] as $uni)
                    <option value="{{ $uni->id }}">{{ $uni->name }}</option>
                @endforeach
            </select>

        </div>

        {{-- FOOTER --}}
        <div class="flex justify-end gap-3 p-4 bg-gray-50">

            <button onclick="closeAssignModal()"
                    class="px-4 py-2 text-sm border rounded-lg">
                Cancel
            </button>

            <button onclick="submitAssign()"
                    class="px-4 py-2 text-sm text-white rounded-lg"
                    style="background:#6b4a36;">
                Assign
            </button>

        </div>

    </div>
</div>

@endsection

{{-- JS --}}
@push('scripts')
<script>

let currentLeadId = null;

function openAssignModal(id, name, uniId = null) {
    currentLeadId = id;

    document.getElementById('leadStudentName').innerText = name;

    document.getElementById('assignModal').classList.remove('hidden');
    document.getElementById('assignModal').classList.add('flex');
}

function closeAssignModal() {
    document.getElementById('assignModal').classList.add('hidden');
    document.getElementById('assignModal').classList.remove('flex');
}

function submitAssign() {

    let universityId = document.getElementById('universitySelect').value;

    fetch(`/admin/leads/${currentLeadId}/assign`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            university_id: universityId
        })
    })
    .then(res => res.json())
    .then(data => {

        if (data.success) {
            closeAssignModal();
            showSwal('success', data.message);
            setTimeout(() => location.reload(), 1000);
        } else {
            showSwal('error', data.message);
        }

    })
    .catch(() => showSwal('error', 'Something went wrong'));
}


/* GLOBAL SEARCH INIT */
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