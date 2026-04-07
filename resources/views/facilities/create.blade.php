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
                <input type="text" name="custom_facility_type" id="custom_facility_type" class="form-input w-full mt-2" placeholder="Enter custom facility type" style="display:none;">
            </div>

            {{-- Gender Field --}}
            <div id="genderFields" class="md:col-span-2 hidden">
                <label class="block text-sm font-medium text-gray-700 mb-1">Gender Specific</label>
                <select name="gender_specific"
                        class="w-full rounded-lg border-gray-300 focus:ring-purple-500">
                    <option value="">Select</option>
                    <option value="boys">Boys</option>
                    <option value="girls">Girls</option>
                    <option value="both">Both</option>
                </select>
            </div>

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
    const field = document.getElementById('genderFields');
    if (val === 'Hostel') {
        field.classList.remove('hidden');
    } else {
        field.classList.add('hidden');
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
// On page load, show custom input if needed (for validation errors)
document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('facility_type');
    if (select.value === 'custom') {
        toggleCustomType('custom');
    }
});
</script>
</script

@endsection