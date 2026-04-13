@extends('layouts.app')
@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Add Facility</h1>
        <p class="text-sm text-gray-500 mt-1">Create a new campus facility</p>
    </div>

    <form method="POST" action="{{ route('facilities.store') }}" enctype="multipart/form-data"
          class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Facility Name --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Facility Name</label>
                <input type="text" name="facility_name"
                       value="{{ old('facility_name') }}"
                       class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                       required>
            </div>

            {{-- Facility Type --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Facility Type</label>
                <select name="facility_type" id="facility_type"
                        class="w-full rounded-lg border-gray-300 focus:ring-purple-500"
                        required onchange="toggleHostelFields(this.value); toggleCustomType(this.value)">
                    <option value="">Select Type</option>
                    <option value="Library">Library</option>
                    <option value="Hostel">Hostel</option>
                    <option value="Sports Complex">Sports Complex</option>
                    <option value="Lab">Lab</option>
                    <option value="Cafeteria">Cafeteria</option>
                    <option value="Medical Facility">Medical Facility</option>
                    <option value="Auditorium">Auditorium</option>
                    <option value="custom">Other (please specify)</option>
                </select>

                <input type="text" name="custom_facility_type" id="custom_facility_type"
                       class="form-input w-full mt-2"
                       placeholder="Enter custom facility type"
                       style="display:none;">
            </div>

            {{-- Gender Field --}}
            <div id="genderFields" class="md:col-span-2 hidden">
                <label class="block text-sm font-medium text-gray-700 mb-1">Gender Specific</label>
         <select name="gender_specific" id="gender_select"
        class="w-full rounded-lg border-gray-300 focus:ring-purple-500"
        onchange="toggleGenderBlocks(this.value)">
                    <option value="">Select</option>
                    <option value="boys">Boys</option>
                    <option value="girls">Girls</option>
                    <option value="both">Both</option>
                </select>
            </div>

            {{-- ✅ NEW: HOSTEL FIELDS (ADDED ONLY) --}}
            <div id="hostelFields" class="md:col-span-2 hidden">

    <h3 class="text-lg font-semibold text-gray-800 mb-4">Hostel Details</h3>

    {{-- ================= BOYS HOSTEL ================= --}}
<div id="boysHostelBlock" class="border p-4 rounded-lg mb-6 hidden">
            <h4 class="text-blue-700 font-semibold mb-3">Boys Hostel</h4>

        {{-- Fee --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <input type="number" name="boys_fee_min" placeholder="Min Fee"
                   class="border-gray-300 rounded-lg">
            <input type="number" name="boys_fee_max" placeholder="Max Fee"
                   class="border-gray-300 rounded-lg">
        </div>

        {{-- Key Facts --}}
        <label class="text-sm font-medium">Key Facts</label>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-2 mt-2 mb-4">
            <label><input type="checkbox" name="boys_features[]" value="ac_nonac"> AC & Non-AC Rooms</label>
            <label><input type="checkbox" name="boys_features[]" value="wifi"> 1 Gbps WiFi</label>
            <label><input type="checkbox" name="boys_features[]" value="cctv"> CCTV Surveillance</label>
            <label><input type="checkbox" name="boys_features[]" value="mess"> Mess + Canteen</label>
            <label><input type="checkbox" name="boys_features[]" value="laundry"> Laundry Facility</label>
            <label><input type="checkbox" name="boys_features[]" value="games"> Indoor Games</label>
        </div>

        {{-- Room Types --}}
        <label class="text-sm font-medium">Room Type Available</label>
        <div class="flex flex-wrap gap-4 mt-2">
            <label><input type="checkbox" name="boys_rooms[]" value="single"> Single (AC)</label>
            <label><input type="checkbox" name="boys_rooms[]" value="double"> Double (AC & Non-AC)</label>
            <label><input type="checkbox" name="boys_rooms[]" value="triple"> Triple (Non-AC)</label>
        </div>
    </div>


    {{-- ================= GIRLS HOSTEL ================= --}}
    <div id="girlsHostelBlock" class="border p-4 rounded-lg hidden">
        <h4 class="text-pink-700 font-semibold mb-3">Girls Hostel</h4>

        {{-- Fee --}}
        <div class="grid grid-cols-2 gap-4 mb-4">
            <input type="number" name="girls_fee_min" placeholder="Min Fee"
                   class="border-gray-300 rounded-lg">
            <input type="number" name="girls_fee_max" placeholder="Max Fee"
                   class="border-gray-300 rounded-lg">
        </div>

        {{-- Key Facts --}}
        <label class="text-sm font-medium">Key Facts</label>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-2 mt-2 mb-4">
            <label><input type="checkbox" name="girls_features[]" value="ac"> Fully AC Rooms</label>
            <label><input type="checkbox" name="girls_features[]" value="lady_security"> Lady Security Guards</label>
            <label><input type="checkbox" name="girls_features[]" value="warden"> Warden on Every Floor</label>
            <label><input type="checkbox" name="girls_features[]" value="helpline"> Emergency Helpline</label>
            <label><input type="checkbox" name="girls_features[]" value="gate"> Secured Access Gate</label>
            <label><input type="checkbox" name="girls_features[]" value="laundry"> Laundry Facility</label>
        </div>

        {{-- Room Types --}}
        <label class="text-sm font-medium">Room Type Available</label>
        <div class="flex flex-wrap gap-4 mt-2">
            <label><input type="checkbox" name="girls_rooms[]" value="single"> Single (AC)</label>
            <label><input type="checkbox" name="girls_rooms[]" value="double"> Double (AC & Non-AC)</label>
        </div>
    </div>

</div>
            
            
            {{-- ✅ END HOSTEL FIELDS --}}

            {{-- Capacity --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Capacity</label>
                <input type="number" name="capacity"
                       value="{{ old('capacity') }}"
                       class="w-full rounded-lg border-gray-300 focus:ring-purple-500">
            </div>

            {{-- Availability --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Availability</label>
                <select name="availability"
                        class="w-full rounded-lg border-gray-300 focus:ring-purple-500"
                        required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            {{-- Description --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description"
                          rows="4"
                          class="w-full rounded-lg border-gray-300 focus:ring-purple-500"
                          required>{{ old('description') }}</textarea>
            </div>

            {{-- Checkboxes --}}
            <div class="md:col-span-2 flex items-center gap-8">
                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" name="is_top" value="1"
                           class="rounded border-gray-300 text-purple-600">
                    Mark as Top Facility
                </label>

                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" name="is_highlight" value="1"
                           class="rounded border-gray-300 text-purple-600">
                    Highlight
                </label>
            </div>

            {{-- Image Upload --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Images</label>
                <input type="file" name="images[]" multiple
                       class="w-full border border-gray-300 rounded-lg p-2"
                       accept="image/*">
                <p class="text-xs text-gray-400 mt-1">
                    JPG, PNG, JPEG. Max 5MB each.
                </p>
            </div>

        </div>

        {{-- Submit --}}
        <div class="mt-6 flex justify-end">
            <a href="{{ route('facilities.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg text-sm font-medium transition mr-3">← Back</a>
            <button type="submit"
                    class="bg-[#6b4a36] hover:bg-[#5a3d2e] text-white px-6 py-2 rounded-lg text-sm font-medium transition">
                Save Facility
            </button>
        </div>

    </form>
</div>

<script>
function toggleHostelFields(val) {
    const genderField = document.getElementById('genderFields');
    const hostelField = document.getElementById('hostelFields');

    if (val === 'Hostel') {
        genderField.classList.remove('hidden');
        hostelField.classList.remove('hidden');
    } else {
        genderField.classList.add('hidden');
        hostelField.classList.add('hidden');
    }
}

function toggleCustomType(val) {
    const customInput = document.getElementById('custom_facility_type');
    if (val === 'custom') {
        customInput.style.display = 'block';
        customInput.required = true;
    } else {
        customInput.style.display = 'none';
        customInput.required = false;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const facility = document.getElementById('facility_type');
    const gender = document.getElementById('gender_select');

    toggleHostelFields(facility.value);
    toggleCustomType(facility.value);

    if (gender) {
        toggleGenderBlocks(gender.value);
    }
});
</script>
<script>
function toggleGenderBlocks(val) {
    const boys = document.getElementById('boysHostelBlock');
    const girls = document.getElementById('girlsHostelBlock');

    if (val === 'boys') {
        boys.classList.remove('hidden');
        girls.classList.add('hidden');
    } else if (val === 'girls') {
        girls.classList.remove('hidden');
        boys.classList.add('hidden');
    } else if (val === 'both') {
        boys.classList.remove('hidden');
        girls.classList.remove('hidden');
    } else {
        boys.classList.add('hidden');
        girls.classList.add('hidden');
    }
}
</script>

@endsection