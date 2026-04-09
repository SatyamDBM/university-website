@extends('layouts.app')
@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Placement Data</h1>
            <p class="text-sm text-gray-500 mt-1">Update placement data and recruiter details</p>
        </div>
        <a href="{{ route('placements.index') }}"
           class="inline-flex items-center gap-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition">
            ← Back to Placements
        </a>
    </div>

    {{-- Errors --}}
    @if ($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
        <span class="text-red-500 text-lg mt-0.5">⚠️</span>
        <ul class="text-sm text-red-600 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form id="placementForm" method="POST" action="{{ route('placements.update', $placement) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-6">

            {{-- Placement Summary Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">📊 Placement Summary</h2>
                </div>
                <div class="p-5">

                    {{-- Row 1: Year + Placement Rate --}}
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Academic Year <span class="text-red-500">*</span></label>
                            <input type="text" name="academic_year" id="year"
                                   value="{{ old('academic_year', $placement->academic_year) }}"
                                   placeholder="e.g. 2023-2024"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Placement Rate (%)</label>
                            <input type="number" id="rate" name="placement_rate"
                                   value="{{ old('placement_rate', $placement->placement_rate) }}"
                                   class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm bg-gray-50 text-gray-500 cursor-not-allowed"
                                   readonly>
                        </div>
                    </div>

                    {{-- Row 2: Highest + Average + Median --}}
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Highest Package (₹) <span class="text-red-500">*</span></label>
                            <input type="number" id="highest" name="highest_package"
                                   value="{{ old('highest_package', $placement->highest_package) }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Average Package (₹) <span class="text-red-500">*</span></label>
                            <input type="number" id="average" name="average_package"
                                   value="{{ old('average_package', $placement->average_package) }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Median Package (₹)</label>
                            <input type="number" id="median" name="median_package"
                                   value="{{ old('median_package', $placement->median_package) }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                        </div>
                    </div>

                    {{-- Row 3: Placed + Eligible --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Students Placed</label>
                            <input type="number" id="placed" name="total_students_placed"
                                   value="{{ old('total_students_placed', $placement->total_students_placed) }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Students Eligible</label>
                            <input type="number" id="eligible" name="total_students_eligible"
                                   value="{{ old('total_students_eligible', $placement->total_students_eligible) }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                        </div>
                    </div>

                </div>
            </div>

            {{-- Recruiters Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">🏢 Recruiters</h2>
                </div>
                <div class="p-5">

                    <div id="recruiterList" class="space-y-4">

                        {{-- Existing Recruiters --}}
                        @forelse($placement->recruiters ?? [] as $i => $recruiter)
                        <div class="recruiter-row grid grid-cols-3 gap-4 p-4 bg-gray-50 rounded-xl border border-gray-200 relative">

                            {{-- Hidden ID to track existing record --}}
                            <input type="hidden" name="recruiters[{{ $i }}][id]" value="{{ $recruiter->id }}">

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Company Name <span class="text-red-500">*</span></label>
                                <input type="text" name="recruiters[{{ $i }}][company_name]"
                                       value="{{ old('recruiters.'.$i.'.company_name', $recruiter->company_name) }}"
                                       placeholder="e.g. Google, TCS"
                                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Industry</label>
                                <input type="text" name="recruiters[{{ $i }}][industry_type]"
                                       value="{{ old('recruiters.'.$i.'.industry_type', $recruiter->industry_type) }}"
                                       placeholder="e.g. IT, Finance, Core"
                                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Logo</label>
                               
                                <input type="file" name="recruiters[{{ $i }}][logo]" accept="image/*"
                                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                                        {{-- Show existing logo --}}
                                @if($recruiter->logo)
                                <div class="flex items-center gap-2 mt-2">
                                    <img src="{{ asset('storage/'.$recruiter->logo) }}"
                                         class="h-8 w-8 rounded object-contain border border-gray-200">
                                    <span class="text-xs text-gray-400">Current logo</span>
                                </div>
                                @endif
                                @if($recruiter->logo)
                                <p class="text-xs text-gray-400 mt-1">Leave empty to keep current logo</p>
                                @endif
                            </div>

                            {{-- Remove button (only if more than 1) --}}
                            @if($loop->index > 0)
                            <button type="button" onclick="this.closest('.recruiter-row').remove()"
                                    class="absolute top-3 right-3 text-red-400 hover:text-red-600 text-xs font-medium">
                                ✕ Remove
                            </button>
                            @endif

                        </div>
                        @empty
                        {{-- Default empty row if no recruiters exist --}}
                        <div class="recruiter-row grid grid-cols-3 gap-4 p-4 bg-gray-50 rounded-xl border border-gray-200 relative">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Company Name <span class="text-red-500">*</span></label>
                                <input type="text" name="recruiters[0][company_name]"
                                       placeholder="e.g. Google, TCS"
                                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Industry</label>
                                <input type="text" name="recruiters[0][industry_type]"
                                       placeholder="e.g. IT, Finance, Core"
                                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Logo</label>
                                <input type="file" name="recruiters[0][logo]" accept="image/*"
                                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                            </div>
                        </div>
                        @endforelse

                    </div>

                    {{-- Add More Button --}}
                    <button type="button" id="addRecruiterBtn"
                            class="mt-4 inline-flex items-center gap-2 text-sm font-medium px-4 py-2 rounded-lg border-2 border-dashed border-gray-300 text-gray-500 hover:border-amber-800 hover:text-amber-800 transition w-full justify-center">
                        + Add Another Recruiter
                    </button>

                </div>
            </div>

            {{-- Warning Box --}}
            <div id="warningBox" class="hidden p-4 bg-amber-50 border border-amber-200 rounded-xl flex items-start gap-3">
                <span class="text-amber-500 text-lg">⚠️</span>
                <div id="warningText" class="text-sm text-amber-700"></div>
            </div>

            {{-- Action Buttons --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center justify-between">
                <button type="submit" name="save_as_draft" value="1"
                        class="inline-flex items-center gap-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-5 py-2.5 rounded-lg transition">
                    💾 Save as Draft
                </button>
                <button id="submitBtn" type="submit"
                        class="inline-flex items-center gap-2 text-white text-sm font-medium px-6 py-2.5 rounded-lg transition"
                        style="background-color:#6b4a36;">
                    Update Placement →
                </button>
            </div>

        </div>
    </form>
</div>

<script>
const highest     = document.getElementById('highest');
const average     = document.getElementById('average');
const placed      = document.getElementById('placed');
const eligible    = document.getElementById('eligible');
const rate        = document.getElementById('rate');
const submitBtn   = document.getElementById('submitBtn');
const warningBox  = document.getElementById('warningBox');
const warningText = document.getElementById('warningText');

function validate() {
    let valid = true;
    let warnings = [];

    if (highest.value && average.value && +highest.value < +average.value) {
        valid = false;
        warnings.push("Highest package must be ≥ average package.");
    }

    if (placed.value && eligible.value && +eligible.value > 0) {
        let calc = ((+placed.value / +eligible.value) * 100).toFixed(2);
        rate.value = calc;
        if (+calc > 100) {
            valid = false;
            warnings.push("Placement rate cannot exceed 100%.");
        }
    } else {
        rate.value = '';
    }

    if (+rate.value === 100 && +highest.value > 5000000) {
        warnings.push("High-risk data: 100% placement + very high package.");
    }

    submitBtn.disabled = !valid;

    if (warnings.length) {
        warningText.innerHTML = warnings.join("<br>");
        warningBox.classList.remove('hidden');
    } else {
        warningBox.classList.add('hidden');
    }
}

[highest, average, placed, eligible].forEach(el => el.addEventListener('input', validate));
document.addEventListener('DOMContentLoaded', validate);

// Dynamic index starts after existing recruiters count
let recruiterIndex = {{ ($placement->recruiters ?? collect())->count() ?: 1 }};

document.getElementById('addRecruiterBtn').addEventListener('click', () => {
    const list = document.getElementById('recruiterList');
    const div  = document.createElement('div');
    div.className = 'recruiter-row grid grid-cols-3 gap-4 p-4 bg-gray-50 rounded-xl border border-gray-200 relative';
    div.innerHTML = `
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Company Name <span class="text-red-500">*</span></label>
            <input type="text" name="recruiters[${recruiterIndex}][company_name]"
                   placeholder="e.g. Google, TCS"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Industry</label>
            <input type="text" name="recruiters[${recruiterIndex}][industry_type]"
                   placeholder="e.g. IT, Finance"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Logo</label>
            <input type="file" name="recruiters[${recruiterIndex}][logo]" accept="image/*"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
        </div>
        <button type="button" onclick="this.closest('.recruiter-row').remove()"
                class="absolute top-3 right-3 text-red-400 hover:text-red-600 text-xs font-medium">
            ✕ Remove
        </button>
    `;
    list.appendChild(div);
    recruiterIndex++;
});
</script>

@endsection