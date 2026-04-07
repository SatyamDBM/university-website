<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\FacilityImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::where('university_id', auth()->user()->university_id)
            ->latest()->paginate(10);
        return view('facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('facilities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'facility_name' => 'required|string|max:255',
            'facility_type' => 'required|string|max:255',
            'description' => 'required|string',
            'capacity' => 'nullable|integer|min:1|max:1000',
            'availability' => 'required|boolean',
            'gender_specific' => 'nullable|in:boys,girls,both',
            'is_featured' => 'boolean',
            'is_top' => 'nullable|boolean',
            'is_highlight' => 'nullable|boolean',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'caption.*' => 'nullable|string|max:255',
            'alt_text.*' => 'nullable|string|max:255',
        ]);

        $facility = Facility::create([
            'university_id' => auth()->user()->university_id,
            'facility_name' => $request->facility_name,
            'facility_type' => $request->facility_type,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'availability' => $request->availability,
            'gender_specific' => $request->facility_type === 'Hostel' ? $request->gender_specific : null,
            'is_featured' => $request->is_featured ?? false,
            'is_top' => $request->has('is_top'),
            'is_highlight' => $request->has('is_highlight'),
            'status' => 'pending',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $idx => $file) {
                $path = $file->store('facilities', 'public');
                FacilityImage::create([
                    'facility_id' => $facility->id,
                    'image_url' => $path,
                    'caption' => $request->caption[$idx] ?? null,
                    'alt_text' => $request->alt_text[$idx] ?? null,
                ]);
            }
        }

        return redirect()->route('facilities.index')->with('success', 'Facility submitted for approval!');
    }

    public function show(Facility $facility)
    {
        $this->authorizeFacility($facility);
        $facility->load('images');
        return view('facilities.show', compact('facility'));
    }

    public function edit(Facility $facility)
    {
        $this->authorizeFacility($facility);
        return view('facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $this->authorizeFacility($facility);

        $request->validate([
            'facility_name' => 'required|string|max:255',
            'facility_type' => 'required|string|max:255',
            'description' => 'required|string',
            'capacity' => 'nullable|integer',
            'availability' => 'required|boolean',
            'gender_specific' => 'nullable|in:boys,girls,both',
            'is_featured' => 'boolean',
            'is_top' => 'nullable|boolean',
            'is_highlight' => 'nullable|boolean',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'caption.*' => 'nullable|string|max:255',
            'alt_text.*' => 'nullable|string|max:255',
        ]);

        $facility->update([
            'facility_name' => $request->facility_name,
            'facility_type' => $request->facility_type,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'availability' => $request->availability,
            'gender_specific' => $request->facility_type === 'Hostel' ? $request->gender_specific : null,
            'is_featured' => $request->is_featured ?? false,
            'is_top' => $request->has('is_top'),
            'is_highlight' => $request->has('is_highlight'),
            'status' => 'pending', // Reset to pending on update
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $idx => $file) {
                $path = $file->store('facilities', 'public');
                FacilityImage::create([
                    'facility_id' => $facility->id,
                    'image_url' => $path,
                    'caption' => $request->caption[$idx] ?? null,
                    'alt_text' => $request->alt_text[$idx] ?? null,
                ]);
            }
        }

        return redirect()->route('facilities.index')->with('success', 'Facility updated and sent for approval!');
    }

    public function destroy(Facility $facility)
    {
        $this->authorizeFacility($facility);

        foreach ($facility->images as $image) {
            Storage::disk('public')->delete($image->image_url);
            $image->delete();
        }
        $facility->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Facility deleted!']);
        }
        return redirect()->route('facilities.index')->with('success', 'Facility deleted!');
    }

    private function authorizeFacility(Facility $facility)
    {
        if ($facility->university_id !== auth()->user()->university_id) {
            abort(403);
        }
    }
}
