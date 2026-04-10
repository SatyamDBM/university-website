{{-- Course Basic Info --}}
{{-- <div class="mb-4">
    <label class="block font-semibold mb-1">Course Name <span class="text-red-500">*</span></label>
           value="{{ old('course_name', $course->course_name ?? '') }}">
    <input type="text" name="course_name" class="form-input w-full border border-gray-300 " required
           value="{{ old('course_name', $course->course_name ?? '') }}">
    @error('course_name')
        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
    @enderror
</div> --}}

{{-- Category + Sub-Category + Course Type in 1 row --}}
<div class="mb-4 grid grid-cols-3 gap-4">
      <div>
        <label class="block font-semibold mb-1">Course Name <span class="text-red-500">*</span></label>
     <input type="text" name="course_name" class="form-input w-full border border-gray-300 " required
           value="{{ old('course_name', $course->course_name ?? '') }}">
    @error('course_name')
        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
    @enderror
    </div>
    <div>
        <label class="block font-semibold mb-1">Category <span class="text-red-500">*</span></label>
        <select name="category_id" class="form-select w-full border border-gray-300 " required>
            <option value="">Select Category</option>
            @isset($categories)
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $course->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            @endisset
        </select>
        @error('category_id')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    {{-- <div> --}}
        {{-- <label class="block font-semibold mb-1">Sub-Category</label>
        <select name="subcategory_id" class="form-select w-full border border-gray-300 ">
            <option value="">Select Sub-Category</option>
            @isset($subcategories)
                @foreach($subcategories as $subcat)
                    <option value="{{ $subcat->id }}" {{ old('subcategory_id', $course->subcategory_id ?? '') == $subcat->id ? 'selected' : '' }}>
                        {{ $subcat->name }}
                    </option>
                @endforeach
            @endisset
        </select> --}}
      
    {{-- </div> --}}
    <div>
        <label class="block font-semibold mb-1">Course Type <span class="text-red-500">*</span></label>
        <select name="course_type" class="form-select w-full border border-gray-300 " required>
            <option value="">Select Type</option>
            <option value="Full-time" {{ old('course_type', $course->course_type ?? '') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
            <option value="Part-time" {{ old('course_type', $course->course_type ?? '') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
            <option value="Online"    {{ old('course_type', $course->course_type ?? '') == 'Online'    ? 'selected' : '' }}>Online</option>
        </select>
        @error('course_type')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

{{-- Duration + Mode + Admission Status in 1 row --}}
<div class="mb-4 grid grid-cols-3 gap-4">
    <div>
        <label class="block font-semibold mb-1">Duration <span class="text-red-500">*</span></label>
        <input type="text" name="duration" class="form-input w-full border border-gray-300 " required
               value="{{ old('duration', $course->duration ?? '') }}">
        @error('duration')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block font-semibold mb-1">Mode <span class="text-red-500">*</span></label>
        <select name="mode" class="form-select w-full border border-gray-300 " required>
            <option value="">Select Mode</option>
            <option value="Offline" {{ old('mode', $course->mode ?? '') == 'Offline' ? 'selected' : '' }}>Offline</option>
            <option value="Hybrid"  {{ old('mode', $course->mode ?? '') == 'Hybrid'  ? 'selected' : '' }}>Hybrid</option>
            <option value="Online"  {{ old('mode', $course->mode ?? '') == 'Online'  ? 'selected' : '' }}>Online</option>
        </select>
        @error('mode')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block font-semibold mb-1">Admission Status <span class="text-red-500">*</span></label>
        <select name="admission_status" class="form-select w-full border border-gray-300 " required>
            <option value="">Select Status</option>
            <option value="Open"   {{ old('admission_status', $course->admission_status ?? '') == 'Open'   ? 'selected' : '' }}>Open</option>
            <option value="Closed" {{ old('admission_status', $course->admission_status ?? '') == 'Closed' ? 'selected' : '' }}>Closed</option>
        </select>
        @error('admission_status')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

{{-- Description --}}
<div class="mb-4">
    <label class="block font-semibold mb-1">Description <span class="text-red-500">*</span></label>
    <textarea name="description" class="form-textarea w-full border border-gray-300 " rows="3" required>{{ old('description', $course->description ?? '') }}</textarea>
    @error('description')
        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Fees: Tuition + Hostel + Admission in 1 row --}}
<div class="mb-4 grid grid-cols-3 gap-4">
    <div>
        <label class="block font-semibold mb-1">Tuition Fees <span class="text-red-500">*</span></label>
        <input type="number" name="tuition_fees" id="tuition_fees" class="form-input w-full border border-gray-300 " required min="1"
               value="{{ old('tuition_fees', $course->tuition_fees ?? '') }}">
        @error('tuition_fees')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block font-semibold mb-1">Hostel Fees</label>
        <input type="number" name="hostel_fees" id="hostel_fees" class="form-input w-full border border-gray-300 " min="1"
               value="{{ old('hostel_fees', $course->hostel_fees ?? '') }}">
        @error('hostel_fees')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block font-semibold mb-1">Admission Fees <span class="text-red-500">*</span></label>
        <input type="number" name="admission_fees" id="admission_fees" class="form-input w-full border border-gray-300 " required min="1"
               value="{{ old('admission_fees', $course->admission_fees ?? '') }}">
        @error('admission_fees')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

{{-- Total Fees + Seat Availability in 1 row --}}
<div class="mb-4 grid grid-cols-3 gap-4">
    <div>
        <label class="block font-semibold mb-1">Total Fees <span class="text-red-500">*</span></label>
        <input type="number" name="total_fees" id="total_fees" class="form-input w-full border border-gray-300 " required min="1"
               value="{{ old('total_fees', $course->total_fees ?? '') }}" readonly>
        @error('total_fees')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block font-semibold mb-1">Seat Availability</label>
        <input type="number" name="seat_availability" class="form-input w-full border border-gray-300 " min="1"
               value="{{ old('seat_availability', $course->seat_availability ?? '') }}">
        @error('seat_availability')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block font-semibold mb-1">Age Limit</label>
        <input type="text" name="age_limit" class="form-input w-full border border-gray-300 "
               value="{{ old('age_limit', $course->age_limit ?? '') }}">
        @error('age_limit')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

{{-- Eligibility: Qualification + Percentage + Exams in 1 row --}}
<div class="mb-4 grid grid-cols-3 gap-4">
    <div>
        <label class="block font-semibold mb-1">Min. Qualification <span class="text-red-500">*</span></label>
        <input type="text" name="min_qualification" class="form-input w-full border border-gray-300 " required
               value="{{ old('min_qualification', $course->min_qualification ?? '') }}">
        @error('min_qualification')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block font-semibold mb-1">Min. Percentage <span class="text-red-500">*</span></label>
        <input type="text" name="min_percentage" class="form-input w-full border border-gray-300 " required
               value="{{ old('min_percentage', $course->min_percentage ?? '') }}">
        @error('min_percentage')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block font-semibold mb-1">Required Exams</label>
        <input type="text" name="required_exams" class="form-input w-full border border-gray-300 "
               value="{{ old('required_exams', $course->required_exams ?? '') }}">
        @error('required_exams')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

{{-- Curriculum --}}
<div class="mb-4 grid grid-cols-2 gap-4">
    <div>
        <label class="block font-semibold mb-1">Curriculum PDF</label>
        <input type="file" name="curriculum_file" class="form-input w-full border border-gray-300 ">
        @error('curriculum_file')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label class="block font-semibold mb-1">Curriculum Text</label>
        <textarea name="curriculum_text" class="form-textarea w-full border border-gray-300 " rows="2">{{ old('curriculum_text', $course->curriculum_text ?? '') }}</textarea>
        @error('curriculum_text')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
<script>
function calcTotalFees() {
    const tuition   = parseFloat(document.getElementById('tuition_fees').value)   || 0;
    const hostel    = parseFloat(document.getElementById('hostel_fees').value)     || 0;
    const admission = parseFloat(document.getElementById('admission_fees').value)  || 0;
    document.getElementById('total_fees').value = tuition + hostel + admission;
}
document.getElementById('tuition_fees').addEventListener('input', calcTotalFees);
document.getElementById('hostel_fees').addEventListener('input', calcTotalFees);
document.getElementById('admission_fees').addEventListener('input', calcTotalFees);
window.addEventListener('DOMContentLoaded', calcTotalFees);
</script>