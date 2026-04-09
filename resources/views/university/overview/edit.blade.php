<div class="max-w-2xl mx-auto px-4 py-8">
    <form method="POST" action="{{ route('universities.overview.update') }}">
        @csrf
        @method('PUT')
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Edit University Overview</h2>
        <div class="space-y-5">
            <div>
                <label class="block text-sm font-semibold mb-1">About the University</label>
                <textarea name="about" class="w-full border rounded-lg px-3 py-2" rows="3">{{ old('about', $overview->about) }}</textarea>
                @error('about') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Why Choose</label>
                <textarea name="why_choose" class="w-full border rounded-lg px-3 py-2" rows="3">{{ old('why_choose', $overview->why_choose) }}</textarea>
                @error('why_choose') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold mb-1">Established Date</label>
                    <input type="text" name="established_date" class="w-full border rounded-lg px-3 py-2" value="{{ old('established_date', $overview->established_date) }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">University Type</label>
                    <input type="text" name="university_type" class="w-full border rounded-lg px-3 py-2" value="{{ old('university_type', $overview->university_type) }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Location</label>
                    <input type="text" name="location" class="w-full border rounded-lg px-3 py-2" value="{{ old('location', $overview->location) }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Chancellor</label>
                    <input type="text" name="chancellor" class="w-full border rounded-lg px-3 py-2" value="{{ old('chancellor', $overview->chancellor) }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Campus Area</label>
                    <input type="text" name="campus_area" class="w-full border rounded-lg px-3 py-2" value="{{ old('campus_area', $overview->campus_area) }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Total Students</label>
                    <input type="number" name="total_students" class="w-full border rounded-lg px-3 py-2" value="{{ old('total_students', $overview->total_students) }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Faculty</label>
                    <input type="text" name="faculty" class="w-full border rounded-lg px-3 py-2" value="{{ old('faculty', $overview->faculty) }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Exams</label>
                    <input type="text" name="exams" class="w-full border rounded-lg px-3 py-2" value="{{ old('exams', $overview->exams) }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Application Fee</label>
                    <input type="text" name="application_fee" class="w-full border rounded-lg px-3 py-2" value="{{ old('application_fee', $overview->application_fee) }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Website</label>
                    <input type="url" name="website" class="w-full border rounded-lg px-3 py-2" value="{{ old('website', $overview->website) }}">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">NAAC Score</label>
                    <input type="text" name="naac_score" class="w-full border rounded-lg px-3 py-2" value="{{ old('naac_score', $overview->naac_score) }}">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Accreditations (comma separated)</label>
                <input type="text" name="accreditations[]" class="w-full border rounded-lg px-3 py-2" value="{{ old('accreditations.0', $overview->accreditations[0] ?? '') }}">
                @error('accreditations.*') <div class="text-red-500 text-xs">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="mt-8">
            <button type="submit" class="bg-[#6b4a36] text-white px-6 py-2 rounded-lg">Update Overview</button>
        </div>
    </form>
</div>
