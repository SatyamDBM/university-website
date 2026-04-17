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
{{-- Row 1: Course Name + Category + Course Type --}}
<div class="mb-4 grid grid-cols-3 gap-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Course Name <span class="text-red-500">*</span></label>
        <input type="text" name="course_name"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition"
               required value="{{ old('course_name', $course->course_name ?? '') }}">
        @error('course_name')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Category <span class="text-red-500">*</span></label>
        <select name="category_id"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition bg-white"
                required>
            <option value="">Select Category</option>
            @isset($categories)
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $course->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            @endisset
        </select>
        @error('category_id')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Course Type <span class="text-red-500">*</span></label>
        <select name="course_type"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition bg-white"
                required>
            <option value="">Select Type</option>
            <option value="Full-time" {{ old('course_type', $course->course_type ?? '') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
            <option value="Part-time" {{ old('course_type', $course->course_type ?? '') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
            <option value="Online"    {{ old('course_type', $course->course_type ?? '') == 'Online'    ? 'selected' : '' }}>Online</option>
        </select>
        @error('course_type')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
</div>

{{-- Row 2: Duration + Mode + Admission Status --}}
<div class="mb-4 grid grid-cols-3 gap-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Duration <span class="text-red-500">*</span></label>
        <input type="text" name="duration"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition"
               required value="{{ old('duration', $course->duration ?? '') }}">
        @error('duration')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Mode <span class="text-red-500">*</span></label>
        <select name="mode"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition bg-white"
                required>
            <option value="">Select Mode</option>
            <option value="Offline" {{ old('mode', $course->mode ?? '') == 'Offline' ? 'selected' : '' }}>Offline</option>
            <option value="Hybrid"  {{ old('mode', $course->mode ?? '') == 'Hybrid'  ? 'selected' : '' }}>Hybrid</option>
            <option value="Online"  {{ old('mode', $course->mode ?? '') == 'Online'  ? 'selected' : '' }}>Online</option>
        </select>
        @error('mode')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Admission Status <span class="text-red-500">*</span></label>
        <select name="admission_status"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition bg-white"
                required>
            <option value="">Select Status</option>
            <option value="Open"   {{ old('admission_status', $course->admission_status ?? '') == 'Open'   ? 'selected' : '' }}>Open</option>
            <option value="Closed" {{ old('admission_status', $course->admission_status ?? '') == 'Closed' ? 'selected' : '' }}>Closed</option>
        </select>
        @error('admission_status')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
</div>

{{-- Row 3: Description (full width) --}}
<div class="mb-4">
    <label class="block text-sm font-semibold text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
    <textarea name="description" rows="3" required
              class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition">{{ old('description', $course->description ?? '') }}</textarea>
    @error('description')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Row 4: Tuition + Hostel + Admission Fees --}}
<div class="mb-4 grid grid-cols-3 gap-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Tuition Fees <span class="text-red-500">*</span></label>
        <input type="number" name="tuition_fees" id="tuition_fees" min="0" required
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition"
               value="{{ old('tuition_fees', $course->tuition_fees ?? '') }}">
        @error('tuition_fees')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Hostel Fees</label>
        <input type="number" name="hostel_fees" id="hostel_fees" min="0"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition"
               value="{{ old('hostel_fees', $course->hostel_fees ?? '') }}">
        @error('hostel_fees')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Admission Fees <span class="text-red-500">*</span></label>
        <input type="number" name="admission_fees" id="admission_fees" min="0" required
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition"
               value="{{ old('admission_fees', $course->admission_fees ?? '') }}">
        @error('admission_fees')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
</div>

{{-- Row 5: Total Fees + Seat Availability + Age Limit --}}
<div class="mb-4 grid grid-cols-3 gap-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Total Fees <span class="text-red-500">*</span></label>
        <input type="number" name="total_fees" id="total_fees" min="0" required readonly
               class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm bg-gray-50 text-gray-500 cursor-not-allowed"
               value="{{ old('total_fees', $course->total_fees ?? '') }}">
        @error('total_fees')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Seat Availability</label>
        <input type="number" name="seat_availability" min="0"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition"
               value="{{ old('seat_availability', $course->seat_availability ?? '') }}">
        @error('seat_availability')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Age Limit</label>
        <input type="text" name="age_limit"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition"
               value="{{ old('age_limit', $course->age_limit ?? '') }}">
        @error('age_limit')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
</div>

{{-- Row 6: Seat Distribution (full width — dynamic rows need space) --}}
<div class="mb-4">
    <div class="flex items-center justify-between mb-2">
        <label class="block text-sm font-semibold text-gray-700">Seat Distribution (Category Wise)</label>
        <button type="button" onclick="addSeatRow()"
                class="inline-flex items-center gap-1 text-xs font-medium px-3 py-1.5 rounded-lg border-2 border-dashed border-gray-300 text-gray-500 hover:border-[#6b4a36] hover:text-[#6b4a36] transition">
            + Add Category
        </button>
    </div>

    <div class="rounded-xl border border-gray-200 overflow-hidden">

        {{-- Table Header --}}
        <div class="grid grid-cols-2 gap-0 bg-gray-50 border-b border-gray-200">
            <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</div>
            <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Seats</div>
        </div>

        {{-- Rows --}}
        <div id="seat-wrapper" class="divide-y divide-gray-100">

            {{-- Prefill existing rows on edit --}}
            @if(!empty($course->seat_distribution))
                @foreach($course->seat_distribution as $cat => $count)
                <div class="seat-row grid grid-cols-2 gap-0 items-center relative">
                    <div class="px-4 py-3">
                        <input type="text" name="seat_category[]"
                               value="{{ $cat }}"
                               placeholder="e.g. General, OBC, SC"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition">
                    </div>
                    <div class="px-4 py-3 flex items-center gap-2">
                        <input type="number" name="seat_count[]"
                               value="{{ $count }}"
                               placeholder="e.g. 60"
                               min="0"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition">
                        <button type="button" onclick="removeRow(this)"
                                class="text-red-400 hover:text-red-600 text-lg font-bold flex-shrink-0">✕</button>
                    </div>
                </div>
                @endforeach
            @else
            {{-- Default empty row --}}
            <div class="seat-row grid grid-cols-2 gap-0 items-center relative">
                <div class="px-4 py-3">
                    <input type="text" name="seat_category[]"
                           placeholder="e.g. General"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition">
                </div>
                <div class="px-4 py-3 flex items-center gap-2">
                    <input type="number" name="seat_count[]"
                           placeholder="e.g. 60"
                           min="0"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition">
                    <button type="button" onclick="removeRow(this)"
                            class="text-red-400 hover:text-red-600 text-lg font-bold flex-shrink-0">✕</button>
                </div>
            </div>
            @endif

        </div>
    </div>
    <p class="text-xs text-gray-400 mt-1">Add seats category-wise e.g. General, OBC, SC, ST, EWS</p>
</div>

{{-- Row 7: Min Qualification + Min Percentage + Required Exams --}}
<div class="mb-4 grid grid-cols-3 gap-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Min. Qualification <span class="text-red-500">*</span></label>
        <input type="text" name="min_qualification" required
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition"
               value="{{ old('min_qualification', $course->min_qualification ?? '') }}">
        @error('min_qualification')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Min. Percentage <span class="text-red-500">*</span></label>
        <input type="text" name="min_percentage" required
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition"
               value="{{ old('min_percentage', $course->min_percentage ?? '') }}">
        @error('min_percentage')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Required Exams</label>
        <input type="text" name="required_exams"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-[#6b4a36] transition"
               value="{{ old('required_exams', $course->required_exams ?? '') }}">
        @error('required_exams')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
</div>

{{-- Row 8: Curriculum PDF + Curriculum Text --}}
<div class="mb-4 grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Curriculum PDF</label>
        @if(!empty($course->curriculum_file))
        <div class="flex items-center gap-2 mb-2 p-2 bg-gray-50 rounded-lg border border-gray-200">
            <span class="text-lg">📄</span>
            <a href="{{ asset('storage/'.$course->curriculum_file) }}" target="_blank"
               class="text-xs text-blue-600 hover:underline">View Current PDF</a>
        </div>
        @endif
        <input type="file" name="curriculum_file"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm"
               accept=".pdf">
        @error('curriculum_file')<p class="text-red-600 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Curriculum Highlights
        </label>

        <div id="curriculum-wrapper" class="flex flex-col gap-3"></div>

        <button type="button"
            onclick="addCurriculumRow()"
            class="mt-2 px-3 py-2 bg-gray-100 rounded-lg text-sm font-semibold">
            + Add Subject
        </button>

        <input type="hidden" name="curriculum_text" id="curriculum_text">

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

function addSeatRow() {
    const wrapper = document.getElementById('seat-wrapper');
    const div = document.createElement('div');
    div.className = 'seat-row grid grid-cols-2 gap-0 items-center relative border-t border-gray-100';
    div.innerHTML = `
        <div class="px-4 py-3">
            <input type="text" name="seat_category[]"
                   placeholder="e.g. SC"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition">
        </div>
        <div class="px-4 py-3 flex items-center gap-2">
            <input type="number" name="seat_count[]"
                   placeholder="e.g. 39"
                   min="0"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none transition">
            <button type="button" onclick="removeRow(this)"
                    class="text-red-400 hover:text-red-600 text-lg font-bold flex-shrink-0">✕</button>
        </div>
    `;
    wrapper.appendChild(div);
}

function removeRow(btn) {
    btn.closest('.seat-row').remove();
}

function addCurriculumRow(title = '', type = 'Core') {
    const wrapper = document.getElementById('curriculum-wrapper');

    const row = document.createElement('div');
    row.className = "flex gap-1";

    row.innerHTML = `
        <input type="text" placeholder="Subject Name"
            class="flex-1 border border-gray-300 rounded-lg px-2 py-1 text-sm"
            value="${title}">

        <select class="border border-gray-300 rounded-lg px-2 py-1 text-sm">
            <option value="Core" ${type === 'Core' ? 'selected' : ''}>Core</option>
            <option value="Specialization" ${type === 'Specialization' ? 'selected' : ''}>Specialization</option>
            <option value="Skill Based" ${type === 'Skill Based' ? 'selected' : ''}>Skill Based</option>
            <option value="Elective" ${type === 'Elective' ? 'selected' : ''}>Elective</option>
        </select>

        <button type="button"
            onclick="this.parentElement.remove()"
            class="px-2 text-red-500">
            ✕
        </button>
    `;
    wrapper.appendChild(row);
}

function prepareCurriculum() {
    const rows = document.querySelectorAll("#curriculum-wrapper > div");
    let data = [];

    rows.forEach(row => {
        const inputs = row.querySelectorAll("input, select");

        data.push({
            title: inputs[0].value,
            type: inputs[1].value
        });
    });

    document.getElementById('curriculum_text').value = JSON.stringify(data);
}

// auto run before form submit
document.querySelector("form").addEventListener("submit", prepareCurriculum);
</script>