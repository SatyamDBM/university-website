{{-- resources/views/university/finance/partials/form.blade.php --}}

{{-- ═══════════════════════════════════════════
     SECTION 1: ADMISSION PROCESS
════════════════════════════════════════════ --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-5 py-3 border-b border-gray-100" style="background-color:#6b4a36;">
        <h2 class="text-sm font-semibold text-white">📋 Admission Process</h2>
    </div>
    <div class="p-5 space-y-6">

        {{-- Steps --}}
        <div>
            <div class="flex items-center justify-between mb-3">
                <label class="text-sm font-semibold text-gray-700">Admission Steps</label>
                <button type="button" onclick="addStep()"
                        class="text-xs font-medium px-3 py-1.5 rounded-lg border-2 border-dashed border-gray-300 text-gray-500 hover:border-amber-800 hover:text-amber-800 transition">
                    + Add Step
                </button>
            </div>
            <div id="steps" class="space-y-3">
                @php $steps = old('steps', $record->admissionSteps ?? [['title'=>'','description'=>'']]) @endphp
                @foreach($steps as $i => $step)
                <div class="step-row grid grid-cols-3 gap-3 p-4 bg-gray-50 rounded-xl border border-gray-200 relative">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Step Title <span class="text-red-500">*</span></label>
                        <input type="text" name="steps[{{ $i }}][title]"
                               value="{{ $step['title'] ?? '' }}"
                               placeholder="e.g. Fill Application Form"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Description</label>
                        <textarea name="steps[{{ $i }}][description]" rows="2"
                                  placeholder="Brief description of this step..."
                                  class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">{{ $step['description'] ?? '' }}</textarea>
                    </div>
                    @if($loop->index > 0)
                    <button type="button" onclick="this.closest('.step-row').remove()"
                            class="absolute top-2 right-2 text-red-400 hover:text-red-600 text-xs">✕</button>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        <hr class="border-gray-100">

        {{-- Important Dates --}}
        <div>
            <div class="flex items-center justify-between mb-3">
                <label class="text-sm font-semibold text-gray-700">Important Dates</label>
                <button type="button" onclick="addDate()"
                        class="text-xs font-medium px-3 py-1.5 rounded-lg border-2 border-dashed border-gray-300 text-gray-500 hover:border-amber-800 hover:text-amber-800 transition">
                    + Add Date
                </button>
            </div>
            <div id="dates" class="space-y-3">
                @php $dates = old('dates', $record->importantDates ?? [['label'=>'','value'=>'']]) @endphp
                @foreach($dates as $i => $date)
                <div class="date-row grid grid-cols-2 gap-3 p-4 bg-gray-50 rounded-xl border border-gray-200 relative">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Label <span class="text-red-500">*</span></label>
                        <input type="text" name="dates[{{ $i }}][label]"
                               value="{{ $date['label'] ?? '' }}"
                               placeholder="e.g. Application Open"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Date / Value <span class="text-red-500">*</span></label>
                        <input type="text" name="dates[{{ $i }}][value]"
                               value="{{ $date['value'] ?? '' }}"
                               placeholder="e.g. Jan 2026"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                    </div>
                    @if($loop->index > 0)
                    <button type="button" onclick="this.closest('.date-row').remove()"
                            class="absolute top-2 right-2 text-red-400 hover:text-red-600 text-xs">✕</button>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        <hr class="border-gray-100">

        {{-- Cutoffs --}}
        <div>
            <div class="flex items-center justify-between mb-3">
                <label class="text-sm font-semibold text-gray-700">Cutoffs</label>
                <button type="button" onclick="addCutoff()"
                        class="text-xs font-medium px-3 py-1.5 rounded-lg border-2 border-dashed border-gray-300 text-gray-500 hover:border-amber-800 hover:text-amber-800 transition">
                    + Add Cutoff
                </button>
            </div>
            <div id="cutoffs" class="space-y-3">
                @php $cutoffs = old('cutoffs', $record->cutoffs ?? [['course'=>'','exam'=>'','cutoff'=>'']]) @endphp
                @foreach($cutoffs as $i => $cutoff)
                <div class="cutoff-row grid grid-cols-3 gap-3 p-4 bg-gray-50 rounded-xl border border-gray-200 relative">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Course <span class="text-red-500">*</span></label>
                        <input type="text" name="cutoffs[{{ $i }}][course]"
                               value="{{ $cutoff['course'] ?? '' }}"
                               placeholder="e.g. B.Tech CSE"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Exam</label>
                        <input type="text" name="cutoffs[{{ $i }}][exam]"
                               value="{{ $cutoff['exam'] ?? '' }}"
                               placeholder="e.g. JEE Main"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Cutoff</label>
                        <input type="text" name="cutoffs[{{ $i }}][cutoff]"
                               value="{{ $cutoff['cutoff'] ?? '' }}"
                               placeholder="e.g. 85 percentile"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                    </div>
                    @if($loop->index > 0)
                    <button type="button" onclick="this.closest('.cutoff-row').remove()"
                            class="absolute top-2 right-2 text-red-400 hover:text-red-600 text-xs">✕</button>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

{{-- ═══════════════════════════════════════════
     SECTION 2: SCHOLARSHIPS
════════════════════════════════════════════ --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-5 py-3 border-b border-gray-100" style="background-color:#6b4a36;">
        <h2 class="text-sm font-semibold text-white">🎓 Scholarships</h2>
    </div>
    <div class="p-5">
        <div class="flex items-center justify-between mb-3">
            <label class="text-sm font-semibold text-gray-700">Scholarship List</label>
            <button type="button" onclick="addScholarship()"
                    class="text-xs font-medium px-3 py-1.5 rounded-lg border-2 border-dashed border-gray-300 text-gray-500 hover:border-amber-800 hover:text-amber-800 transition">
                + Add Scholarship
            </button>
        </div>
        <div id="scholarships" class="space-y-3">
            @php $scholarships = old('scholarships', $record->scholarships ?? [['title'=>'','description'=>'','badge'=>'','priority'=>'']]) @endphp
            @foreach($scholarships as $i => $sch)
            <div class="scholarship-row p-4 bg-gray-50 rounded-xl border border-gray-200 relative">
                <div class="grid grid-cols-3 gap-3 mb-3">
                    <div class="col-span-2">
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Scholarship Title <span class="text-red-500">*</span></label>
                        <input type="text" name="scholarships[{{ $i }}][title]"
                               value="{{ $sch['title'] ?? '' }}"
                               placeholder="e.g. Merit Scholarship"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Badge</label>
                        <input type="text" name="scholarships[{{ $i }}][badge]"
                               value="{{ $sch['badge'] ?? '' }}"
                               placeholder="e.g. 100% Tuition"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div class="col-span-2">
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Description</label>
                        <textarea name="scholarships[{{ $i }}][description]" rows="2"
                                  placeholder="Brief description..."
                                  class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">{{ $sch['description'] ?? '' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Priority</label>
                        <input type="number" name="scholarships[{{ $i }}][priority]"
                               value="{{ $sch['priority'] ?? '' }}"
                               placeholder="e.g. 1"
                               min="0"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                    </div>
                </div>
                @if($loop->index > 0)
                <button type="button" onclick="this.closest('.scholarship-row').remove()"
                        class="absolute top-2 right-2 text-red-400 hover:text-red-600 text-xs">✕</button>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════
     SECTION 3: LOAN PARTNERS
════════════════════════════════════════════ --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-5 py-3 border-b border-gray-100" style="background-color:#6b4a36;">
        <h2 class="text-sm font-semibold text-white">🏦 Loan Partners</h2>
    </div>
    <div class="p-5">
        <div class="flex items-center justify-between mb-3">
            <label class="text-sm font-semibold text-gray-700">Bank / NBFC Partners</label>
            <button type="button" onclick="addLoanPartner()"
                    class="text-xs font-medium px-3 py-1.5 rounded-lg border-2 border-dashed border-gray-300 text-gray-500 hover:border-amber-800 hover:text-amber-800 transition">
                + Add Partner
            </button>
        </div>
        <div id="loan_partners" class="space-y-3">
            @php $loanPartners = old('loan_partners', $record->loanPartners ?? [['bank_name'=>'','interest_rate'=>'','amount'=>'']]) @endphp
            @foreach($loanPartners as $i => $lp)
            <div class="loan-row grid grid-cols-4 gap-3 p-4 bg-gray-50 rounded-xl border border-gray-200 relative">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Bank Name <span class="text-red-500">*</span></label>
                    <input type="text" name="loan_partners[{{ $i }}][bank_name]"
                           value="{{ $lp['bank_name'] ?? '' }}"
                           placeholder="e.g. SBI, HDFC"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Interest Rate</label>
                    <input type="text" name="loan_partners[{{ $i }}][interest_rate]"
                           value="{{ $lp['interest_rate'] ?? '' }}"
                           placeholder="e.g. 8.5%"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Loan Amount</label>
                    <input type="text" name="loan_partners[{{ $i }}][amount]"
                           value="{{ $lp['amount'] ?? '' }}"
                           placeholder="e.g. Up to ₹20L"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Logo</label>
                    @if(!empty($lp['logo']))
                    <div class="flex items-center gap-2 mb-1">
                        <img src="{{ asset('storage/'.$lp['logo']) }}" class="h-7 w-7 rounded object-contain border border-gray-200">
                        <span class="text-xs text-gray-400">Current</span>
                    </div>
                    <input type="hidden" name="loan_partners[{{ $i }}][existing_logo]" value="{{ $lp['logo'] }}">
                    @endif
                    <input type="file" name="loan_partners[{{ $i }}][logo]" accept="image/*"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                </div>
                @if($loop->index > 0)
                <button type="button" onclick="this.closest('.loan-row').remove()"
                        class="absolute top-2 right-2 text-red-400 hover:text-red-600 text-xs">✕</button>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>