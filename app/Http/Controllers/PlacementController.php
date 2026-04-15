<?php

namespace App\Http\Controllers;

use App\Models\Placement;
use App\Models\Recruiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlacementController extends Controller
{
    public function index()
    {
        $placements = Placement::where('university_id', Auth::user()->university_id)->latest()->get();
        return view('placements.index', compact('placements'));
    }
    public function create()
    {
        $recruiters = Recruiter::where('university_id', Auth::user()->university_id)->get();
        return view('placements.create', compact('recruiters'));
    }
    public function store(Request $request)
    {
        $isDraft = $request->has('save_as_draft');

        // Base validation
        $rules = [
            'academic_year'   => 'required|string|max:9',
            'highest_package' => 'required|numeric|min:1|max:100000000',
            'average_package' => 'required|numeric|min:1|max:100000000',
            'median_package'  => 'nullable|numeric|min:1|max:100000000',
            'total_students_placed' => 'nullable|integer|min:1|max:1000000',
            'total_students_eligible' => 'nullable|integer|min:1|max:1000000',
            'placement_rate' => 'nullable|numeric|min:1|max:100',
        ];

        // Only validate recruiters if NOT draft
        if (!$isDraft) {
            $rules['recruiters.*.company_name'] = 'required|string|max:255|min:1';
        }

        $request->validate($rules);

        // Logical validations (only when submitting)
        if (!$isDraft) {

            if ($request->highest_package < $request->average_package) {
                return back()
                    ->withErrors(['highest_package' => 'Highest package must be greater than or equal to average package.'])
                    ->withInput();
            }

            if (
                $request->total_students_placed &&
                $request->total_students_eligible &&
                $request->total_students_placed > $request->total_students_eligible
            ) {
                return back()
                    ->withErrors(['total_students_placed' => 'Placed students cannot exceed eligible students.'])
                    ->withInput();
            }
        }

        // Save placement
        $placement = Placement::create([
            'university_id'           => auth()->user()->university_id,
            'academic_year'           => $request->academic_year,
            'highest_package'         => $request->highest_package,
            'average_package'         => $request->average_package,
            'median_package'          => $request->median_package,
            'total_students_placed'   => $request->total_students_placed,
            'total_students_eligible' => $request->total_students_eligible,
            'placement_rate'          => $request->placement_rate,
            'status'                  => $isDraft ? 'draft' : 'approved',
        ]);

        // Save recruiters
        if ($request->has('recruiters')) {
            foreach ($request->recruiters as $rec) {

                if (empty($rec['company_name'])) continue;

                $logoPath = null;

                if (isset($rec['logo']) && $rec['logo']) {
                    $logoPath = $rec['logo']->store('recruiters', 'public');
                }

                $placement->recruiters()->create([
                    'university_id' => auth()->user()->university_id,
                    'company_name'  => $rec['company_name'],
                    'industry_type' => $rec['industry_type'] ?? null,
                    'logo'          => $logoPath,
                ]);
            }
        }
        $msg = $isDraft
            ? 'Placement data saved as draft!'
            : 'Placement data submitted for approval!';

        return redirect()
            ->route('placements.index')
            ->with('success', $msg);
    }

    public function edit(Placement $placement)
    {
        $this->authorizePlacement($placement);
        $recruiters = Recruiter::where('university_id', Auth::user()->university_id)->get();
        return view('placements.edit', compact('placement', 'recruiters'));
    }

    public function update(Request $request, Placement $placement)
    {
        $this->authorizePlacement($placement);
        $isDraft = $request->has('save_as_draft');
        $rules = [
            'academic_year'                     => $isDraft ? 'nullable|string|max:9' : 'required|string|max:9',
            'highest_package'                   => $isDraft ? 'nullable|numeric|min:1|max:100000000' : 'required|numeric|min:1|max:100000000',
            'average_package'                   => $isDraft ? 'nullable|numeric|min:1|max:100000000' : 'required|numeric|min:1|max:100000000',
            'median_package'                    => 'nullable|numeric|min:1|max:100000000',
            'placement_rate'                    => $isDraft ? 'nullable|numeric|min:1|max:100' : 'required|numeric|min:1|max:100',
            'total_students_placed'             => 'nullable|integer|min:1|max:1000000',
            'total_students_eligible'           => 'nullable|integer|min:1|max:1000000',
            'recruiters'                        => $isDraft ? 'nullable|array' : 'required|array|min:1',
            'recruiters.*.company_name'         => $isDraft ? 'nullable|string|max:255' : 'required|string|max:255',
            'recruiters.*.industry_type'        => 'nullable|string|max:255',
            'recruiters.*.logo'                 => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
        $request->validate($rules);
        // Business logic validation
        if (!$isDraft) {
            if ($request->highest_package < $request->average_package) {
                return back()
                    ->withErrors(['highest_package' => 'Highest package must be >= average package.'])
                    ->withInput();
            }
            if (
                $request->total_students_placed && $request->total_students_eligible
                && $request->total_students_placed > $request->total_students_eligible
            ) {
                return back()
                    ->withErrors(['total_students_placed' => 'Placed students cannot exceed eligible students.'])
                    ->withInput();
            }
        }
        // Update placement
        $placement->update([
            'academic_year'           => $request->academic_year,
            'highest_package'         => $request->highest_package,
            'average_package'         => $request->average_package,
            'median_package'          => $request->median_package,
            'placement_rate'          => $request->placement_rate,
            'total_students_placed'   => $request->total_students_placed,
            'total_students_eligible' => $request->total_students_eligible,
            'status'                  => $isDraft ? 'draft' : 'pending',
        ]);
        // Handle recruiters — update existing, create new
        $submittedIds = [];
        foreach ($request->recruiters ?? [] as $rec) {
            if (empty($rec['company_name'])) continue;

            // Handle logo upload
            $logoPath = null;
            if (!empty($rec['logo']) && $rec['logo'] instanceof \Illuminate\Http\UploadedFile) {
                $logoPath = $rec['logo']->store('recruiters', 'public');
            }

            if (!empty($rec['id'])) {
                // ✅ Existing recruiter — update it
                $recruiter = $placement->recruiters()->find($rec['id']);
                if ($recruiter) {
                    $recruiter->update([
                        'company_name'  => $rec['company_name'],
                        'industry_type' => $rec['industry_type'] ?? null,
                        // Keep old logo if no new one uploaded
                        'logo'          => $logoPath ?? $recruiter->logo,
                    ]);
                    $submittedIds[] = $recruiter->id;
                }
            } else {
                // ✅ New recruiter — create and attach
                $newRecruiter = $placement->recruiters()->create([
                    'company_name'  => $rec['company_name'],
                    'industry_type' => $rec['industry_type'] ?? null,
                    'logo'          => $logoPath,
                ]);
                $submittedIds[] = $newRecruiter->id;
            }
        }

        // ✅ Delete recruiters that were removed from the form
        $placement->recruiters()
            ->whereNotIn('recruiters.id', $submittedIds)
            ->delete();

        $msg = $isDraft
            ? 'Placement data saved as draft!'
            : 'Placement data updated and sent for approval!';

        return redirect()->route('university.placements.index')->with('success', $msg);
    }

    public function destroy(Placement $placement)
    {
        $this->authorizePlacement($placement);
        $placement->recruiters()->detach();
        $placement->delete();
        return redirect()->route('university.placements.index')->with('success', 'Placement data deleted!');
    }

    private function authorizePlacement(Placement $placement)
    {
        if ($placement->university_id !== Auth::user()->university_id) {
            abort(403);
        }
    }
}
