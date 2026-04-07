@extends('layouts.app')
@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Facility</h1>
        <p class="text-sm text-gray-500 mt-1">Update facility details</p>
    </div>

    <form method="POST" action="{{ route('facilities.update', $facility) }}" enctype="multipart/form-data"
          class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Facility Name --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Facility Name</label>
                <input type="text" name="facility_name"
                       value="{{ old('facility_name', $facility->facility_name) }}"
                       class="w-full rounded-lg border-gray-300 focus:ring-purple-500 focus:border-purple-500"
                       required>
            </div>

            {{-- Facility Type --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Facility Type</label>
                <select name="facility_type"
                        class="w-full rounded-lg border-gray-300 focus:ring-purple-500"
                        required onchange="toggleHostelFields(this.value)">
                    <option value="">Select Type</option>
                    @foreach(['Library','Hostel','Sports Complex','Lab','Cafeteria','Medical Facility','Auditorium','Other'] as $type)
                        <option value="{{ $type }}" {{ $facility->facility_type == $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Gender Field --}}
            <div id="genderFields"
                 class="md:col-span-2 {{ $facility->facility_type == 'Hostel' ? '' : 'hidden' }}">
                <label class="block text-sm font-medium text-gray-700 mb-1">Gender Specific</label>
                <select name="gender_specific"
                        class="w-full rounded-lg border-gray-300 focus:ring-purple-500">
                    <option value="">Select</option>
                    <option value="boys" {{ $facility->gender_specific == 'boys' ? 'selected' : '' }}>Boys</option>
                    <option value="girls" {{ $facility->gender_specific == 'girls' ? 'selected' : '' }}>Girls</option>
                    <option value="both" {{ $facility->gender_specific == 'both' ? 'selected' : '' }}>Both</option>
                </select>
            </div>

            {{-- Capacity --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Capacity</label>
                <input type="number" name="capacity"
                       value="{{ old('capacity', $facility->capacity) }}"
                       class="w-full rounded-lg border-gray-300 focus:ring-purple-500">
            </div>

            {{-- Availability --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Availability</label>
                <select name="availability"
                        class="w-full rounded-lg border-gray-300 focus:ring-purple-500"
                        required>
                    <option value="1" {{ $facility->availability ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$facility->availability ? 'selected' : '' }}>No</option>
                </select>
            </div>

            {{-- Description --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description"
                          rows="4"
                          class="w-full rounded-lg border-gray-300 focus:ring-purple-500"
                          required>{{ old('description', $facility->description) }}</textarea>
            </div>

            {{-- Checkboxes --}}
            <div class="md:col-span-2 flex items-center gap-8">
                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" name="is_top" value="1"
                           class="rounded border-gray-300 text-purple-600"
                           {{ old('is_top', $facility->is_top ?? false) ? 'checked' : '' }}>
                    Mark as Top Facility
                </label>

                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" name="is_highlight" value="1"
                           class="rounded border-gray-300 text-purple-600"
                           {{ old('is_highlight', $facility->is_highlight ?? false) ? 'checked' : '' }}>
                    Highlight
                </label>
            </div>

            {{-- Image Upload --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Images</label>
                <input type="file" name="images[]" multiple
                       class="w-full border border-gray-300 rounded-lg p-2"
                       accept="image/*">
                <p class="text-xs text-gray-400 mt-1">JPG, PNG, JPEG. Max 5MB each.</p>
            </div>

        </div>

        {{-- Submit --}}
        <div class="mt-6 flex justify-end">
                            <a href="{{ route('facilities.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg text-sm font-medium transition mr-3">← Back</a>

            <button type="submit"
                    class="bg-[#6b4a36] hover:bg-[#5a3d2e] text-white px-6 py-2 rounded-lg text-sm font-medium transition">
                Update Facility
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
</script>

@endsection