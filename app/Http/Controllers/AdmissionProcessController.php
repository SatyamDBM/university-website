<?php

namespace App\Http\Controllers;

use App\Models\AdmissionProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Scholarship;
use App\Models\LoanPartner;

class AdmissionProcessController extends Controller
{

    public function index(Request $request)
    {
        $universityId = auth()->id();
        $search = $request->search;

        // 📌 PROCESS (only ONE record, no need to re-filter by search unless required)
        $process = AdmissionProcess::with(['steps', 'dates', 'cutoffs'])
            ->where('university_id', $universityId)
            ->latest()
            ->first();

        $steps = $process?->steps ?? collect();
        $dates = $process?->dates ?? collect();
        $cutoffs = $process?->cutoffs ?? collect();

        // 📌 SCHOLARSHIPS (OPTIMIZED)
        $scholarships = Scholarship::query()
            ->where('university_id', $universityId)
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        // 📌 LOAN PARTNERS (OPTIMIZED)
        $loanPartners = LoanPartner::query()
            ->where('university_id', $universityId)
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('bank_name', 'like', "%{$search}%")
                        ->orWhere('amount', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        // ⚡ AJAX RESPONSE (LIGHTWEIGHT)
        if ($request->ajax()) {
            return view('university.university_data.partials.table_body', compact(
                'process',
                'steps',
                'dates',
                'cutoffs',
                'scholarships',
                'loanPartners'
            ))->render();
        }

        return view('university.university_data.index', compact(
            'process',
            'steps',
            'dates',
            'cutoffs',
            'scholarships',
            'loanPartners'
        ));
    }
    public function create()
    {
        return view('university.university_data.create');
    }
    public function edit($id)
    {
        $process = AdmissionProcess::with([
            'steps',
            'dates',
            'cutoffs'
        ])->findOrFail($id);

        $universityId = auth()->id();

        // Separate models (NOT part of AdmissionProcess)
        $scholarships = Scholarship::where('university_id', $universityId)->get();
        $loanPartners = LoanPartner::where('university_id', $universityId)->get();

        $record = (object) [
            'id' => $process->id,

            'admissionSteps' => $process->steps->map(function ($s) {
                return [
                    'title' => $s->title,
                    'description' => $s->description
                ];
            })->toArray(),

            'importantDates' => $process->dates->map(function ($d) {
                return [
                    'label' => $d->label,
                    'value' => $d->value
                ];
            })->toArray(),

            'cutoffs' => $process->cutoffs->map(function ($c) {
                return [
                    'course' => $c->course,
                    'exam' => $c->exam,
                    'cutoff' => $c->cutoff
                ];
            })->toArray(),

            'scholarships' => $scholarships->map(function ($s) {
                return [
                    'title' => $s->title,
                    'description' => $s->description,
                    'badge' => $s->badge,
                    'priority' => $s->priority
                ];
            })->toArray(),

            'loanPartners' => $loanPartners->map(function ($l) {
                return [
                    'bank_name' => $l->bank_name,
                    'interest_rate' => $l->interest_rate,
                    'amount' => $l->amount,
                    'logo' => $l->logo
                ];
            })->toArray(),
        ];

        return view('university.university_data.edit', compact('record'));
    }


    public function destroy($id)
    {
        try {
            $process = AdmissionProcess::findOrFail($id);

            // delete related data (IMPORTANT)
            $process->steps()->delete();
            $process->dates()->delete();
            $process->cutoffs()->delete();

            $process->delete();

            return response()->json([
                'success' => true,
                'message' => 'Deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function storeAll(Request $request)
    {
        $validated = $request->validate([
            'steps' => 'required|array|min:1',
            'steps.*.title' => 'required|string|max:255',
            'steps.*.description' => 'required|string',

            'dates' => 'nullable|array',
            'dates.*.label' => 'required_with:dates|string|max:255',
            'dates.*.value' => 'required_with:dates|string|max:255',

            'cutoffs' => 'nullable|array',
            'cutoffs.*.course' => 'required_with:cutoffs|string|max:255',
            'cutoffs.*.exam' => 'nullable|string|max:255',
            'cutoffs.*.cutoff' => 'nullable|string|max:255',

            'scholarships' => 'nullable|array',
            'scholarships.*.title' => 'required_with:scholarships|string|max:255',
            'scholarships.*.description' => 'nullable|string',
            'scholarships.*.badge' => 'nullable|string|max:255',
            'scholarships.*.priority' => 'nullable|integer|min:1',

            // IMPORTANT FIX: remove logo validation from nested array
            'loan_partners' => 'nullable|array',
            'loan_partners.*.bank_name' => 'required_with:loan_partners|string|max:255',
            'loan_partners.*.interest_rate' => 'nullable|string|max:50',
            'loan_partners.*.amount' => 'nullable|string|max:50',
        ]);

        DB::beginTransaction();

        try {

            $universityId = auth()->id();

            $process = AdmissionProcess::create([
                'university_id' => $universityId
            ]);

            foreach ($validated['steps'] as $i => $step) {
                $process->steps()->create([
                    'step_no' => $i + 1,
                    'title' => $step['title'],
                    'description' => $step['description']
                ]);
            }

            foreach ($validated['dates'] ?? [] as $date) {
                $process->dates()->create($date);
            }

            foreach ($validated['cutoffs'] ?? [] as $cutoff) {
                $process->cutoffs()->create($cutoff);
            }

            foreach ($validated['scholarships'] ?? [] as $sch) {
                Scholarship::create([
                    'university_id' => $universityId,
                    'title' => $sch['title'],
                    'description' => $sch['description'] ?? null,
                    'badge' => $sch['badge'] ?? null,
                    'priority' => $sch['priority'] ?? null,
                    'is_active' => 1
                ]);
            }

            // FIXED FILE HANDLING
            foreach ($request->loan_partners ?? [] as $loan) {

                $logoPath = null;

                if (isset($loan['logo']) && $loan['logo'] instanceof \Illuminate\Http\UploadedFile) {
                    $logoPath = $loan['logo']->store('loan_logos', 'public');
                }

                LoanPartner::create([
                    'university_id' => $universityId,
                    'bank_name' => $loan['bank_name'],
                    'interest_rate' => $loan['interest_rate'] ?? null,
                    'amount' => $loan['amount'] ?? null,
                    'logo' => $logoPath
                ]);
            }

            DB::commit();

            return redirect()
                ->route('university.finance.index')
                ->with('success', 'Saved Successfully');
        } catch (\Exception $e) {
            DB::rollback();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function show()
    {
        $universityId = auth()->id();

        $process = AdmissionProcess::with(['steps', 'dates', 'cutoffs'])
            ->where('university_id', $universityId)
            ->latest()
            ->first();

        return view('university.university_data.show', [
            'process' => $process,
            'scholarships' => Scholarship::where('university_id', $universityId)->get(),
            'loanPartners' => LoanPartner::where('university_id', $universityId)->get(),
        ]);
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'steps' => 'required|array|min:1',
            'steps.*.title' => 'required|string|max:255',
            'steps.*.description' => 'required|string',

            'dates' => 'nullable|array',
            'dates.*.label' => 'required_with:dates|string|max:255',
            'dates.*.value' => 'required_with:dates|string|max:255',

            'cutoffs' => 'nullable|array',
            'cutoffs.*.course' => 'required_with:cutoffs|string|max:255',
            'cutoffs.*.exam' => 'nullable|string|max:255',
            'cutoffs.*.cutoff' => 'nullable|string|max:255',

            'scholarships' => 'nullable|array',
            'scholarships.*.title' => 'required_with:scholarships|string|max:255',
            'scholarships.*.description' => 'nullable|string',
            'scholarships.*.badge' => 'nullable|string|max:255',
            'scholarships.*.priority' => 'nullable|integer|min:1',

            'loan_partners' => 'nullable|array',
            'loan_partners.*.bank_name' => 'required_with:loan_partners|string|max:255',
            'loan_partners.*.interest_rate' => 'nullable|string|max:50',
            'loan_partners.*.amount' => 'nullable|string|max:50',
        ]);

        DB::beginTransaction();

        try {

            $process = AdmissionProcess::findOrFail($id);

            // ================= RESET CHILD DATA =================
            $process->steps()->delete();
            $process->dates()->delete();
            $process->cutoffs()->delete();

            Scholarship::where('university_id', auth()->id())->delete();
            LoanPartner::where('university_id', auth()->id())->delete();

            // ================= ADMISSION STEPS =================
            foreach ($validated['steps'] as $i => $step) {
                $process->steps()->create([
                    'step_no' => $i + 1,
                    'title' => $step['title'],
                    'description' => $step['description']
                ]);
            }

            // ================= DATES =================
            foreach ($validated['dates'] ?? [] as $date) {
                $process->dates()->create($date);
            }

            // ================= CUTOFFS =================
            foreach ($validated['cutoffs'] ?? [] as $cutoff) {
                $process->cutoffs()->create($cutoff);
            }

            // ================= SCHOLARSHIPS =================
            foreach ($validated['scholarships'] ?? [] as $sch) {
                Scholarship::create([
                    'university_id' => auth()->id(),
                    'title' => $sch['title'],
                    'description' => $sch['description'] ?? null,
                    'badge' => $sch['badge'] ?? null,
                    'priority' => $sch['priority'] ?? null,
                    'is_active' => 1
                ]);
            }

            // ================= LOAN PARTNERS =================
            foreach ($request->loan_partners ?? [] as $loan) {

                $logoPath = null;

                if (isset($loan['logo']) && $loan['logo'] instanceof \Illuminate\Http\UploadedFile) {
                    $logoPath = $loan['logo']->store('loan_logos', 'public');
                }

                LoanPartner::create([
                    'university_id' => auth()->id(),
                    'bank_name' => $loan['bank_name'],
                    'interest_rate' => $loan['interest_rate'] ?? null,
                    'amount' => $loan['amount'] ?? null,
                    'logo' => $logoPath
                ]);
            }

            DB::commit();

            return redirect()
                ->route('university.finance.index')
                ->with('success', 'Updated Successfully');
        } catch (\Exception $e) {
            DB::rollback();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}
