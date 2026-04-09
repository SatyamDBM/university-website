<?php

namespace App\Http\Controllers;

use App\Models\UniversityOverview;
use App\Models\University;
use Illuminate\Http\Request;

class UniversityOverviewController extends Controller
{
    public function show()
    {
        $university_id = auth()->user()->university_id;
        $overview = UniversityOverview::firstOrNew([
            'university_id' => $university_id
        ]);
        $university = University::findOrFail($university_id);
        return view('university.overview.index', compact('overview', 'university'));
    }

    public function create()
    {
        $university_id = auth()->user()->university_id;
        $university = University::findOrFail($university_id);
        return view('university.overview.create', compact('university'));
    }
    public function store(Request $request)
    {
        $university_id = auth()->user()->university_id;

        $validated = $request->validate([
            'about' => 'nullable|string',
            'why_choose' => 'nullable|string',
            'established_date' => 'nullable|string|max:32',
            'university_type' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'chancellor' => 'nullable|string|max:255',
            'campus_area' => 'nullable|string|max:100',
            'total_students' => 'nullable|integer|min:0',
            'faculty' => 'nullable|string|max:255',
            'exams' => 'nullable|string|max:255',
            'application_fee' => 'nullable|string|max:50',
            'website' => 'nullable|url|max:255',
            'naac_score' => 'nullable|string|max:50',
            'accreditations' => 'nullable|array',
            'accreditations.*' => 'string|max:50',
        ]);
        dd($validated);

        $validated['accreditations'] = $request->accreditations
            ? array_filter($request->accreditations)
            : [];

        // 🔥 MAIN MAGIC (Single line CMS logic)
        UniversityOverview::updateOrCreate(
            ['university_id' => $university_id],
            array_merge($validated, ['university_id' => $university_id])
        );

        return back()->with('success', 'Overview saved successfully!');
    }

    public function edit()
    {
        $university_id = auth()->user()->university_id;
        $overview = UniversityOverview::where('university_id', $university_id)->firstOrFail();
        $university = University::findOrFail($university_id);
        return view('university.overview.edit', compact('overview', 'university'));
    }

    public function update(Request $request)
    {
        $university_id = auth()->user()->university_id;
        $overview = UniversityOverview::where('university_id', $university_id)->firstOrFail();
        $validated = $request->validate([
            'about' => 'nullable|string',
            'why_choose' => 'nullable|string',
            'established_date' => 'nullable|string|max:32',
            'university_type' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'chancellor' => 'nullable|string|max:255',
            'campus_area' => 'nullable|string|max:100',
            'total_students' => 'nullable|integer|min:0',
            'faculty' => 'nullable|string|max:255',
            'exams' => 'nullable|string|max:255',
            'application_fee' => 'nullable|string|max:50',
            'website' => 'nullable|url|max:255',
            'naac_score' => 'nullable|string|max:50',
            'accreditations' => 'nullable|array',
            'accreditations.*' => 'string|max:50',
        ]);
        $validated['accreditations'] = $request->accreditations ? array_filter($request->accreditations) : [];
        $overview->update($validated);
        return redirect()->route('universities.overview.show')->with('success', 'Overview updated!');
    }

    public function destroy()
    {
        $university_id = auth()->user()->university_id;
        $overview = UniversityOverview::where('university_id', $university_id)->firstOrFail();
        $overview->delete();
        return redirect()->route('universities.overview.show')->with('success', 'Overview deleted!');
    }
}
