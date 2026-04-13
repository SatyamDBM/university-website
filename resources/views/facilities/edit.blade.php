@extends('layouts.app')
@section('content')

<div class="p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Facility</h1>
        <p class="text-sm text-gray-500 mt-1">Update campus facility</p>
    </div>

    @php
        $hostel = $facility->hostel_details ?? [];
        $boys = $hostel['boys'] ?? [];
        $girls = $hostel['girls'] ?? [];
    @endphp

    <form method="POST" action="{{ route('facilities.update', $facility->id) }}" enctype="multipart/form-data"
          class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Facility Name --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Facility Name</label>
                <input type="text" name="facility_name"
                       value="{{ old('facility_name', $facility->facility_name) }}"
                       class="w-full rounded-lg border-gray-300" required>
            </div>

            {{-- Facility Type --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Facility Type</label>
                <select name="facility_type" id="facility_type"
                        class="w-full rounded-lg border-gray-300"
                        onchange="toggleHostelFields(this.value); toggleCustomType(this.value)">

                    @foreach(['Library','Hostel','Sports Complex','Lab','Cafeteria','Medical Facility','Auditorium'] as $type)
                        <option value="{{ $type }}" {{ $facility->facility_type == $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach

                    <option value="custom" {{ $facility->facility_type == 'custom' ? 'selected' : '' }}>
                        Other
                    </option>
                </select>

                <input type="text" name="custom_facility_type" id="custom_facility_type"
                       value="{{ old('custom_facility_type') }}"
                       style="{{ $facility->facility_type == 'custom' ? '' : 'display:none;' }}"
                       class="form-input w-full mt-2">
            </div>

            {{-- Gender --}}
            <div id="genderFields"
                 class="md:col-span-2 {{ $facility->facility_type == 'Hostel' ? '' : 'hidden' }}">

                <select name="gender_specific" id="gender_select"
                        class="w-full rounded-lg border-gray-300"
                        onchange="toggleGenderBlocks(this.value)">

                    <option value="">Select</option>
                    <option value="boys" {{ $facility->gender_specific=='boys'?'selected':'' }}>Boys</option>
                    <option value="girls" {{ $facility->gender_specific=='girls'?'selected':'' }}>Girls</option>
                    <option value="both" {{ $facility->gender_specific=='both'?'selected':'' }}>Both</option>
                </select>
            </div>

            {{-- HOSTEL --}}
            <div id="hostelFields"
                 class="md:col-span-2 {{ $facility->facility_type == 'Hostel' ? '' : 'hidden' }}">

                {{-- BOYS --}}
                <div id="boysHostelBlock"
                     class="{{ in_array($facility->gender_specific,['boys','both'])?'':'hidden' }}">

                    <input type="number" name="boys_fee_min"
                           value="{{ $boys['fee_min'] ?? '' }}">

                    <input type="number" name="boys_fee_max"
                           value="{{ $boys['fee_max'] ?? '' }}">

                    @foreach(['ac_nonac','wifi','cctv','mess','laundry','games'] as $f)
                        <label>
                            <input type="checkbox" name="boys_features[]" value="{{ $f }}"
                            {{ in_array($f, $boys['features'] ?? []) ? 'checked' : '' }}>
                            {{ $f }}
                        </label>
                    @endforeach

                </div>

                {{-- GIRLS --}}
                <div id="girlsHostelBlock"
                     class="{{ in_array($facility->gender_specific,['girls','both'])?'':'hidden' }}">

                    <input type="number" name="girls_fee_min"
                           value="{{ $girls['fee_min'] ?? '' }}">

                    <input type="number" name="girls_fee_max"
                           value="{{ $girls['fee_max'] ?? '' }}">

                    @foreach(['ac','lady_security','warden','helpline','gate','laundry'] as $f)
                        <label>
                            <input type="checkbox" name="girls_features[]" value="{{ $f }}"
                            {{ in_array($f, $girls['features'] ?? []) ? 'checked' : '' }}>
                            {{ $f }}
                        </label>
                    @endforeach

                </div>

            </div>

            {{-- Capacity --}}
            <input type="number" name="capacity"
                   value="{{ old('capacity', $facility->capacity) }}">

            {{-- Availability --}}
            <select name="availability">
                <option value="1" {{ $facility->availability ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$facility->availability ? 'selected' : '' }}>No</option>
            </select>

            {{-- Description --}}
            <textarea name="description">{{ old('description', $facility->description) }}</textarea>

        </div>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('facilities.index') }}" class="bg-gray-200 px-4 py-2 rounded">Back</a>

            <button class="bg-[#6b4a36] text-white px-6 py-2 rounded">
                Update Facility
            </button>
        </div>

    </form>
</div>

<script>
function toggleHostelFields(val){
    document.getElementById('genderFields').classList.toggle('hidden', val!=='Hostel');
    document.getElementById('hostelFields').classList.toggle('hidden', val!=='Hostel');
}

function toggleCustomType(val){
    document.getElementById('custom_facility_type').style.display =
        val==='custom' ? 'block' : 'none';
}

function toggleGenderBlocks(val){
    document.getElementById('boysHostelBlock')
        .classList.toggle('hidden', !(val=='boys'||val=='both'));

    document.getElementById('girlsHostelBlock')
        .classList.toggle('hidden', !(val=='girls'||val=='both'));
}
</script>

@endsection