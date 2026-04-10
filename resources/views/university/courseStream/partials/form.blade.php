{{-- Row 1: Stream Name + Course --}}
<div class="grid grid-cols-2 gap-4 mb-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">
            Stream Name <span class="text-red-500">*</span>
        </label>
         <input type="text" name="name"
             value="{{ old('name', $stream->name ?? '') }}"
             placeholder="e.g. Computer Science, Finance"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition"
             required>
         @error('name')
             <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
         @enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">
            Course <span class="text-red-500">*</span>
        </label>
        <select name="course_id"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition bg-white"
            required>
                    @error('course_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
            <option value="">Select Course</option>
            @foreach($courses as $course)
                <option value="{{ $course->id }}"
                    {{ old('course_id', $stream->course_id ?? '') == $course->id ? 'selected' : '' }}>
                    {{ $course->course_name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

{{-- Row 2: Min Fee + Max Fee + Duration --}}
<div class="grid grid-cols-3 gap-4 mb-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">
            Min Fee (₹) <span class="text-red-500">*</span>
        </label>
         <input type="number" name="min_fee" id="min_fee"
             value="{{ old('min_fee', $stream->min_fee ?? '') }}"
             placeholder="e.g. 50000" min="0"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition"
             required>
         @error('min_fee')
             <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
         @enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">
            Max Fee (₹) <span class="text-red-500">*</span>
        </label>
         <input type="number" name="max_fee" id="max_fee"
             value="{{ old('max_fee', $stream->max_fee ?? '') }}"
             placeholder="e.g. 150000" min="0"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition"
             required>
         @error('max_fee')
             <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
         @enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Duration</label>
         <input type="text" name="duration"
             value="{{ old('duration', $stream->duration ?? '') }}"
             placeholder="e.g. 2 Years, 6 Months"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
         @error('duration')
             <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
         @enderror
    </div>
</div>

{{-- Row 3: Seats + Mode --}}
<div class="grid grid-cols-2 gap-4 mb-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Total Seats</label>
         <input type="number" name="seats"
             value="{{ old('seats', $stream->seats ?? '') }}"
             placeholder="e.g. 60" min="0"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
         @error('seats')
             <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
         @enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Mode</label>
        <select name="mode" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition bg-white">
                    @error('mode')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
            <option value="">Select Mode</option>
            @foreach(['Full-time','Part-time','Online'] as $mode)
                <option value="{{ $mode }}" {{ old('mode', $stream->mode ?? '') == $mode ? 'selected' : '' }}>{{ $mode }}</option>
            @endforeach
        </select>
    </div>
</div>

{{-- Row 4: Eligibility + Min Percentage --}}
<div class="grid grid-cols-2 gap-4 mb-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Min Qualification</label>
         <input type="text" name="min_qualification"
             value="{{ old('min_qualification', $stream->min_qualification ?? '') }}"
             placeholder="e.g. 10+2" 
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
         @error('min_qualification')
             <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
         @enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Min Percentage</label>
         <input type="text" name="min_percentage"
             value="{{ old('min_percentage', $stream->min_percentage ?? '') }}"
             placeholder="e.g. 50%" 
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
         @error('min_percentage')
             <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
         @enderror
    </div>
</div>

{{-- Row 5: Entrance Exams + Intake --}}
<div class="grid grid-cols-2 gap-4 mb-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Entrance Exams</label>
         <input type="text" name="entrance_exams"
             value="{{ old('entrance_exams', $stream->entrance_exams ?? '') }}"
             placeholder="e.g. JEE, NEET" 
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
         @error('entrance_exams')
             <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
         @enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Intake</label>
         <input type="text" name="intake"
             value="{{ old('intake', $stream->intake ?? '') }}"
             placeholder="e.g. 60 students/year" 
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
         @error('intake')
             <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
         @enderror
    </div>
</div>

{{-- Row 6: Avg Package + Description --}}
<div class="grid grid-cols-2 gap-4 mb-4">
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Avg Package (₹)</label>
        <input type="number" name="avg_package"
               value="{{ old('avg_package', $stream->avg_package ?? '') }}"
               placeholder="e.g. 600000" min="0"
               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">
    </div>
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
        <textarea name="description" rows="3"
                  placeholder="Brief description of this stream..."
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:border-amber-800 transition">{{ old('description', $stream->description ?? '') }}</textarea>
    </div>
</div>