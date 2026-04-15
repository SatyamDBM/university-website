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
        $facilities = Facility::where('university_id', auth()->user()->id)
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

            // 'is_featured' => 'boolean',
            'is_top' => 'nullable|boolean',
            'is_highlight' => 'nullable|boolean',

            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'caption.*' => 'nullable|string|max:255',
            'alt_text.*' => 'nullable|string|max:255',

            // ✅ Hostel fields
            'boys_fee_min' => 'nullable|integer',
            'boys_fee_max' => 'nullable|integer',
            'girls_fee_min' => 'nullable|integer',
            'girls_fee_max' => 'nullable|integer',

            'boys_features' => 'nullable|array',
            'boys_features.*' => 'string',

            'girls_features' => 'nullable|array',
            'girls_features.*' => 'string',

            'boys_rooms_ac' => 'nullable|array',
            'boys_rooms_non_ac' => 'nullable|array',

            'girls_rooms_ac' => 'nullable|array',
            'girls_rooms_non_ac' => 'nullable|array',
        ]);

        // ✅ Prepare hostel data
        $hostelDetails = null;

        if ($request->facility_type === 'Hostel') {
            $hostelDetails = [
                'boys' => [
                    'fee_min' => $request->boys_fee_min,
                    'fee_max' => $request->boys_fee_max,
                    'features' => $request->boys_features ?? [],
                    'rooms' => [
                        'ac' => $request->boys_rooms_ac ?? [],
                        'non_ac' => $request->boys_rooms_non_ac ?? [],
                    ],
                ],
                'girls' => [
                    'fee_min' => $request->girls_fee_min,
                    'fee_max' => $request->girls_fee_max,
                    'features' => $request->girls_features ?? [],
                    'rooms' => [
                        'ac' => $request->girls_rooms_ac ?? [],
                        'non_ac' => $request->girls_rooms_non_ac ?? [],
                    ],
                ],
            ];
        }

        // ✅ Create facility
        $facility = Facility::create([
            'university_id' => auth()->user()->id,
            'facility_name' => $request->facility_name,
            'facility_type' => $request->facility_type,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'availability' => $request->availability,
            'gender_specific' => $request->facility_type === 'Hostel' ? $request->gender_specific : null,
            'hostel_details' => $hostelDetails,
            // 'is_featured' => $request->is_featured ?? false,
            'is_top' => $request->has('is_top'),
            'is_highlight' => $request->has('is_highlight'),
            'status' => 'approved',
        ]);

        // ✅ Upload images
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

        return redirect()->route('university.facilities.index')
            ->with('success', 'Facility submitted for approval!');
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

            // ✅ Hostel fields
            'boys_fee_min' => 'nullable|integer',
            'boys_fee_max' => 'nullable|integer',
            'girls_fee_min' => 'nullable|integer',
            'girls_fee_max' => 'nullable|integer',

            'boys_features' => 'nullable|array',
            'boys_features.*' => 'string',

            'girls_features' => 'nullable|array',
            'girls_features.*' => 'string',

            'boys_rooms_ac' => 'nullable|array',
            'boys_rooms_non_ac' => 'nullable|array',

            'girls_rooms_ac' => 'nullable|array',
            'girls_rooms_non_ac' => 'nullable|array',
        ]);

        // ✅ Prepare hostel data
        $hostelDetails = null;

        if ($request->facility_type === 'Hostel') {
            $hostelDetails = [
                'boys' => [
                    'fee_min' => $request->boys_fee_min,
                    'fee_max' => $request->boys_fee_max,
                    'features' => $request->boys_features ?? [],
                    'rooms' => [
                        'ac' => $request->boys_rooms_ac ?? [],
                        'non_ac' => $request->boys_rooms_non_ac ?? [],
                    ],
                ],
                'girls' => [
                    'fee_min' => $request->girls_fee_min,
                    'fee_max' => $request->girls_fee_max,
                    'features' => $request->girls_features ?? [],
                    'rooms' => [
                        'ac' => $request->girls_rooms_ac ?? [],
                        'non_ac' => $request->girls_rooms_non_ac ?? [],
                    ],
                ],
            ];
        }

        // ✅ Update facility
        $facility->update([
            'facility_name' => $request->facility_name,
            'facility_type' => $request->facility_type,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'availability' => $request->availability,
            'gender_specific' => $request->facility_type === 'Hostel' ? $request->gender_specific : null,
            'hostel_details' => $hostelDetails,
            // 'is_featured' => $request->is_featured ?? false,
            'is_top' => $request->has('is_top'),
            'is_highlight' => $request->has('is_highlight'),
            'status' => 'pending',
        ]);

        // ✅ Upload new images (does NOT delete old ones)
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

        return redirect()->route('university.facilities.index')
            ->with('success', 'Facility updated and sent for approval!');
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
        return redirect()->route('university.facilities.index')->with('success', 'Facility deleted!');
    }

    private function authorizeFacility(Facility $facility)
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'Not authenticated');
        }

        if ($facility->university_id != $user->id) {
            abort(403, 'Unauthorized access');
        }
    }
}
