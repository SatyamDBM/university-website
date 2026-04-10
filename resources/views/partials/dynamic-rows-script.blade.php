<script>
let stepIdx        = {{ count(old('steps',        $record->admissionSteps ?? [['']])) }};
let dateIdx        = {{ count(old('dates',         $record->importantDates ?? [['']])) }};
let cutoffIdx      = {{ count(old('cutoffs',       $record->cutoffs        ?? [['']])) }};
let scholarshipIdx = {{ count(old('scholarships',  $record->scholarships   ?? [['']])) }};
let loanIdx        = {{ count(old('loan_partners', $record->loanPartners   ?? [['']])) }};

function addStep() {
    document.getElementById('steps').insertAdjacentHTML('beforeend', `
        <div class="step-row grid grid-cols-3 gap-3 p-4 bg-gray-50 rounded-xl border border-gray-200 relative">
            <div><label class="block text-xs font-semibold text-gray-600 mb-1">Step Title <span class="text-red-500">*</span></label>
                <input type="text" name="steps[${stepIdx}][title]" placeholder="e.g. Fill Application Form"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition"></div>
            <div class="col-span-2"><label class="block text-xs font-semibold text-gray-600 mb-1">Description</label>
                <textarea name="steps[${stepIdx}][description]" rows="2" placeholder="Brief description..."
                          class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition"></textarea></div>
            <button type="button" onclick="this.closest('.step-row').remove()" class="absolute top-2 right-2 text-red-400 hover:text-red-600 text-xs">✕</button>
        </div>`);
    stepIdx++;
}

function addDate() {
    document.getElementById('dates').insertAdjacentHTML('beforeend', `
        <div class="date-row grid grid-cols-2 gap-3 p-4 bg-gray-50 rounded-xl border border-gray-200 relative">
            <div><label class="block text-xs font-semibold text-gray-600 mb-1">Label <span class="text-red-500">*</span></label>
                <input type="text" name="dates[${dateIdx}][label]" placeholder="e.g. Application Open"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition"></div>
            <div><label class="block text-xs font-semibold text-gray-600 mb-1">Date / Value <span class="text-red-500">*</span></label>
                <input type="text" name="dates[${dateIdx}][value]" placeholder="e.g. Jan 2026"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition"></div>
            <button type="button" onclick="this.closest('.date-row').remove()" class="absolute top-2 right-2 text-red-400 hover:text-red-600 text-xs">✕</button>
        </div>`);
    dateIdx++;
}

function addCutoff() {
    document.getElementById('cutoffs').insertAdjacentHTML('beforeend', `
        <div class="cutoff-row grid grid-cols-3 gap-3 p-4 bg-gray-50 rounded-xl border border-gray-200 relative">
            <div><label class="block text-xs font-semibold text-gray-600 mb-1">Course <span class="text-red-500">*</span></label>
                <input type="text" name="cutoffs[${cutoffIdx}][course]" placeholder="e.g. B.Tech CSE"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition"></div>
            <div><label class="block text-xs font-semibold text-gray-600 mb-1">Exam</label>
                <input type="text" name="cutoffs[${cutoffIdx}][exam]" placeholder="e.g. JEE Main"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition"></div>
            <div><label class="block text-xs font-semibold text-gray-600 mb-1">Cutoff</label>
                <input type="text" name="cutoffs[${cutoffIdx}][cutoff]" placeholder="e.g. 85 percentile"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition"></div>
            <button type="button" onclick="this.closest('.cutoff-row').remove()" class="absolute top-2 right-2 text-red-400 hover:text-red-600 text-xs">✕</button>
        </div>`);
    cutoffIdx++;
}

function addScholarship() {
    document.getElementById('scholarships').insertAdjacentHTML('beforeend', `
        <div class="scholarship-row p-4 bg-gray-50 rounded-xl border border-gray-200 relative">
            <div class="grid grid-cols-3 gap-3 mb-3">
                <div class="col-span-2"><label class="block text-xs font-semibold text-gray-600 mb-1">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="scholarships[${scholarshipIdx}][title]" placeholder="e.g. Merit Scholarship"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition"></div>
                <div><label class="block text-xs font-semibold text-gray-600 mb-1">Badge</label>
                    <input type="text" name="scholarships[${scholarshipIdx}][badge]" placeholder="e.g. 100% Tuition"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition"></div>
            </div>
            <div class="grid grid-cols-3 gap-3">
                <div class="col-span-2"><label class="block text-xs font-semibold text-gray-600 mb-1">Description</label>
                    <textarea name="scholarships[${scholarshipIdx}][description]" rows="2"
                              class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition"></textarea></div>
                <div><label class="block text-xs font-semibold text-gray-600 mb-1">Priority</label>
                    <input type="number" name="scholarships[${scholarshipIdx}][priority]" placeholder="e.g. 1" min="0"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition"></div>
            </div>
            <button type="button" onclick="this.closest('.scholarship-row').remove()" class="absolute top-2 right-2 text-red-400 hover:text-red-600 text-xs">✕</button>
        </div>`);
    scholarshipIdx++;
}

function addLoanPartner() {
    document.getElementById('loan_partners').insertAdjacentHTML('beforeend', `
        <div class="loan-row grid grid-cols-4 gap-3 p-4 bg-gray-50 rounded-xl border border-gray-200 relative">
            <div><label class="block text-xs font-semibold text-gray-600 mb-1">Bank Name <span class="text-red-500">*</span></label>
                <input type="text" name="loan_partners[${loanIdx}][bank_name]" placeholder="e.g. SBI"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition"></div>
            <div><label class="block text-xs font-semibold text-gray-600 mb-1">Interest Rate</label>
                <input type="text" name="loan_partners[${loanIdx}][interest_rate]" placeholder="e.g. 8.5%"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition"></div>
            <div><label class="block text-xs font-semibold text-gray-600 mb-1">Loan Amount</label>
                <input type="text" name="loan_partners[${loanIdx}][amount]" placeholder="e.g. Up to ₹20L"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition"></div>
            <div><label class="block text-xs font-semibold text-gray-600 mb-1">Logo</label>
                <input type="file" name="loan_partners[${loanIdx}][logo]" accept="image/*"
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"></div>
            <button type="button" onclick="this.closest('.loan-row').remove()" class="absolute top-2 right-2 text-red-400 hover:text-red-600 text-xs">✕</button>
        </div>`);
    loanIdx++;
}
</script>