@extends('layouts.app')
@section('content')

<div class="p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Facility</h1>
        <p class="text-sm text-gray-500 mt-1">Update campus facility details</p>
    </div>

    @php
        $hostel = $facility->hostel_details ?? [];
        $boys   = $hostel['boys']  ?? [];
        $girls  = $hostel['girls'] ?? [];
    @endphp

    <form method="POST" action="{{ route('university.facilities.update', $facility->id) }}"
          enctype="multipart/form-data"
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
                <select name="facility_type" id="facility_type"
                        class="w-full rounded-lg border-gray-300 focus:ring-purple-500"
                        required onchange="toggleHostelFields(this.value); toggleCustomType(this.value)">
                    <option value="">Select Type</option>
                    @foreach(['Library','Hostel','Sports Complex','Lab','Cafeteria','Medical Facility','Auditorium'] as $type)
                        <option value="{{ $type }}"
                            {{ old('facility_type', $facility->facility_type) == $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                    <option value="custom"
                        {{ old('facility_type', $facility->facility_type) == 'custom' ? 'selected' : '' }}>
                        Other (please specify)
                    </option>
                </select>

                <input type="text" name="custom_facility_type" id="custom_facility_type"
                       value="{{ old('custom_facility_type', $facility->custom_facility_type) }}"
                       class="form-input w-full mt-2"
                       placeholder="Enter custom facility type"
                       style="{{ old('facility_type', $facility->facility_type) == 'custom' ? '' : 'display:none;' }}">
            </div>

            {{-- Gender Field --}}
            <div id="genderFields"
                 class="md:col-span-2 {{ old('facility_type', $facility->facility_type) == 'Hostel' ? '' : 'hidden' }}">
                <label class="block text-sm font-medium text-gray-700 mb-1">Gender Specific</label>
                <select name="gender_specific" id="gender_select"
                        class="w-full rounded-lg border-gray-300 focus:ring-purple-500"
                        onchange="toggleGenderBlocks(this.value)">
                    <option value="">Select</option>
                    <option value="boys"  {{ old('gender_specific', $facility->gender_specific) == 'boys'  ? 'selected' : '' }}>Boys</option>
                    <option value="girls" {{ old('gender_specific', $facility->gender_specific) == 'girls' ? 'selected' : '' }}>Girls</option>
                    <option value="both"  {{ old('gender_specific', $facility->gender_specific) == 'both'  ? 'selected' : '' }}>Both</option>
                </select>
            </div>

            {{-- HOSTEL FIELDS --}}
            <div id="hostelFields"
                 class="md:col-span-2 {{ old('facility_type', $facility->facility_type) == 'Hostel' ? '' : 'hidden' }}">

                <h3 class="text-lg font-semibold text-gray-800 mb-4">Hostel Details</h3>

                {{-- BOYS HOSTEL --}}
                <div id="boysHostelBlock"
                     class="border p-4 rounded-lg mb-6 {{ in_array(old('gender_specific', $facility->gender_specific), ['boys','both']) ? '' : 'hidden' }}">
                    <h4 class="text-blue-700 font-semibold mb-3">Boys Hostel</h4>

                    {{-- Fee --}}
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <input type="number" name="boys_fee_min"
                               placeholder="Min Fee"
                               value="{{ old('boys_fee_min', $boys['fee_min'] ?? '') }}"
                               class="border-gray-300 rounded-lg">
                        <input type="number" name="boys_fee_max"
                               placeholder="Max Fee"
                               value="{{ old('boys_fee_max', $boys['fee_max'] ?? '') }}"
                               class="border-gray-300 rounded-lg">
                    </div>

                    {{-- Key Facts --}}
                    <label class="text-sm font-medium block mb-2">Key Facts</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 text-sm">
                        @foreach([
                            'ac_nonac' => 'AC & Non-AC Rooms',
                            'wifi'     => '1 Gbps WiFi',
                            'cctv'     => 'CCTV Surveillance',
                            'mess'     => 'Mess + Canteen',
                            'laundry'  => 'Laundry Facility',
                            'games'    => 'Indoor Games',
                        ] as $val => $label)
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="boys_features[]" value="{{ $val }}"
                                {{ in_array($val, old('boys_features', $boys['features'] ?? [])) ? 'checked' : '' }}>
                            <span>{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>

                    {{-- Room Types --}}
                    <label class="text-sm font-medium block mt-4 mb-2">Room Type Available</label>
                    <div class="space-y-3">

                        {{-- AC --}}
                        <div>
                            <p class="text-xs font-semibold text-gray-500 mb-1">AC Rooms</p>
                            <div class="flex flex-wrap gap-4 text-sm">
                                @foreach(['single','double','triple'] as $room)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="boys_rooms_ac[]" value="{{ $room }}"
                                        {{ in_array($room, old('boys_rooms_ac', $boys['rooms_ac'] ?? [])) ? 'checked' : '' }}>
                                    {{ ucfirst($room) }}
                                </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Non-AC --}}
                        <div>
                            <p class="text-xs font-semibold text-gray-500 mb-1">Non-AC Rooms</p>
                            <div class="flex flex-wrap gap-4 text-sm">
                                @foreach(['single','double','triple'] as $room)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="boys_rooms_non_ac[]" value="{{ $room }}"
                                        {{ in_array($room, old('boys_rooms_non_ac', $boys['rooms_non_ac'] ?? [])) ? 'checked' : '' }}>
                                    {{ ucfirst($room) }}
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- GIRLS HOSTEL --}}
                <div id="girlsHostelBlock"
                     class="border p-4 rounded-lg {{ in_array(old('gender_specific', $facility->gender_specific), ['girls','both']) ? '' : 'hidden' }}">
                    <h4 class="text-pink-700 font-semibold mb-3">Girls Hostel</h4>

                    {{-- Fee --}}
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <input type="number" name="girls_fee_min"
                               placeholder="Min Fee"
                               value="{{ old('girls_fee_min', $girls['fee_min'] ?? '') }}"
                               class="border-gray-300 rounded-lg">
                        <input type="number" name="girls_fee_max"
                               placeholder="Max Fee"
                               value="{{ old('girls_fee_max', $girls['fee_max'] ?? '') }}"
                               class="border-gray-300 rounded-lg">
                    </div>

                    {{-- Key Facts --}}
                    <label class="text-sm font-medium block mb-2">Key Facts</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 text-sm">
                        @foreach([
                            'ac'             => 'Fully AC Rooms',
                            'lady_security'  => 'Lady Security Guards',
                            'warden'         => 'Warden on Every Floor',
                            'helpline'       => 'Emergency Helpline',
                            'gate'           => 'Secured Access Gate',
                            'laundry'        => 'Laundry Facility',
                        ] as $val => $label)
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="girls_features[]" value="{{ $val }}"
                                {{ in_array($val, old('girls_features', $girls['features'] ?? [])) ? 'checked' : '' }}>
                            <span>{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>

                    {{-- Room Types --}}
                    <label class="text-sm font-medium block mt-4 mb-2">Room Type Available</label>
                    <div class="space-y-3">

                        {{-- AC --}}
                        <div>
                            <p class="text-xs font-semibold text-gray-500 mb-1">AC Rooms</p>
                            <div class="flex flex-wrap gap-4 text-sm">
                                @foreach(['single','double'] as $room)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="girls_rooms_ac[]" value="{{ $room }}"
                                        {{ in_array($room, old('girls_rooms_ac', $girls['rooms_ac'] ?? [])) ? 'checked' : '' }}>
                                    {{ ucfirst($room) }}
                                </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Non-AC --}}
                        <div>
                            <p class="text-xs font-semibold text-gray-500 mb-1">Non-AC Rooms</p>
                            <div class="flex flex-wrap gap-4 text-sm">
                                @foreach(['single','double'] as $room)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="girls_rooms_non_ac[]" value="{{ $room }}"
                                        {{ in_array($room, old('girls_rooms_non_ac', $girls['rooms_non_ac'] ?? [])) ? 'checked' : '' }}>
                                    {{ ucfirst($room) }}
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- END HOSTEL FIELDS --}}

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
                    <option value="1" {{ old('availability', $facility->availability) ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !old('availability', $facility->availability) ? 'selected' : '' }}>No</option>
                </select>
            </div>

            {{-- Description --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="4"
                          class="w-full rounded-lg border-gray-300 focus:ring-purple-500"
                          required>{{ old('description', $facility->description) }}</textarea>
            </div>

            {{-- Checkboxes --}}
            <div class="md:col-span-2 flex items-center gap-8">
                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" name="is_top" value="1"
                           {{ old('is_top', $facility->is_top) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-purple-600">
                    Mark as Top Facility
                </label>
                <label class="flex items-center gap-2 text-sm text-gray-700">
                    <input type="checkbox" name="is_highlight" value="1"
                           {{ old('is_highlight', $facility->is_highlight) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-purple-600">
                    Highlight
                </label>
            </div>

            {{-- Existing Images --}}
            @if($facility->images->count())
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Images</label>
                <div class="flex flex-wrap gap-3">
                    @foreach($facility->images as $img)
                    <div class="relative">
                        <img src="{{ asset('storage/'.$img->image_url) }}"
                             class="h-20 w-20 object-cover rounded-lg border border-gray-200"
                             onerror="this.src='{{ asset('images/default.png') }}'">
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Image Upload --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    {{ $facility->images->count() ? 'Upload New Images' : 'Upload Images' }}
                </label>
                <input type="file" name="images[]" multiple
                       class="w-full border border-gray-300 rounded-lg p-2"
                       accept="image/*">
                <p class="text-xs text-gray-400 mt-1">
                    JPG, PNG, JPEG. Max 5MB each.
                    {{ $facility->images->count() ? 'New images will be added to existing.' : '' }}
                </p>
            </div>

        </div>

        {{-- Submit --}}
        <div class="mt-6 flex justify-end">
            <a href="{{ route('university.facilities.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-2 rounded-lg text-sm font-medium transition mr-3">
                ← Back
            </a>
            <button type="submit"
                    class="bg-[#6b4a36] hover:bg-[#5a3d2e] text-white px-6 py-2 rounded-lg text-sm font-medium transition">
                Update Facility
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

function toggleGenderBlocks(val) {
    const boys  = document.getElementById('boysHostelBlock');
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

document.addEventListener('DOMContentLoaded', function () {
    const facility = document.getElementById('facility_type');
    const gender   = document.getElementById('gender_select');
    toggleHostelFields(facility.value);
    toggleCustomType(facility.value);
    if (gender) toggleGenderBlocks(gender.value);
});
</script>

@endsection