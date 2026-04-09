<?php

namespace App\Http\Controllers;

use App\Models\Recruiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecruiterController extends Controller
{
    public function index()
    {
        $recruiters = Recruiter::where('university_id', Auth::user()->university_id)->latest()->get();
        return view('recruiters.index', compact('recruiters'));
    }

    public function create()
    {
        return view('recruiters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'industry_type' => 'nullable|string|max:255',
        ]);
        $logo = null;
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('recruiters', 'public');
        }
        Recruiter::create([
            'university_id' => Auth::user()->university_id,
            'company_name' => $request->company_name,
            'logo' => $logo,
            'industry_type' => $request->industry_type,
        ]);
        return redirect()->route('recruiters.index')->with('success', 'Recruiter added!');
    }

    public function edit(Recruiter $recruiter)
    {
        $this->authorizeRecruiter($recruiter);
        return view('recruiters.edit', compact('recruiter'));
    }

    public function update(Request $request, Recruiter $recruiter)
    {
        $this->authorizeRecruiter($recruiter);
        $request->validate([
            'company_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'industry_type' => 'nullable|string|max:255',
        ]);
        $logo = $recruiter->logo;
        if ($request->hasFile('logo')) {
            if ($logo) Storage::disk('public')->delete($logo);
            $logo = $request->file('logo')->store('recruiters', 'public');
        }
        $recruiter->update([
            'company_name' => $request->company_name,
            'logo' => $logo,
            'industry_type' => $request->industry_type,
        ]);
        return redirect()->route('recruiters.index')->with('success', 'Recruiter updated!');
    }

    public function destroy(Recruiter $recruiter)
    {
        $this->authorizeRecruiter($recruiter);
        if ($recruiter->logo) Storage::disk('public')->delete($recruiter->logo);
        $recruiter->delete();
        return redirect()->route('recruiters.index')->with('success', 'Recruiter deleted!');
    }

    private function authorizeRecruiter(Recruiter $recruiter)
    {
        if ($recruiter->university_id !== Auth::user()->university_id) {
            abort(403);
        }
    }
}
