@extends('layouts.app')
@section('content')
@include('components.swal')
<div class="container max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Add New Course</h1>
    <form id="courseForm" method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold mb-1">Course Name <span class="text-red-500">*</span></label>
            <input type="text" name="course_name" class="form-input w-full" required value="{{ old('course_name') }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Category <span class="text-red-500">*</span></label>
            <select name="category_id" class="form-select w-full" required>
                <option value="">Select Category</option>
                {{-- Populate categories dynamically --}}
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Sub-Category</label>
            <select name="subcategory_id" class="form-select w-full">
                <option value="">Select Sub-Category</option>
                {{-- Populate subcategories dynamically --}}
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Description <span class="text-red-500">*</span></label>
            <textarea name="description" class="form-textarea w-full" required>{{ old('description') }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Duration <span class="text-red-500">*</span></label>
            <input type="text" name="duration" class="form-input w-full" required value="{{ old('duration') }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Course Type <span class="text-red-500">*</span></label>
            <select name="course_type" class="form-select w-full" required>
                <option value="">Select Type</option>
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
                <option value="Online">Online</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Mode <span class="text-red-500">*</span></label>
            <select name="mode" class="form-select w-full" required>
                <option value="">Select Mode</option>
                <option value="Offline">Offline</option>
                <option value="Hybrid">Hybrid</option>
                <option value="Online">Online</option>
            </select>
        </div>
        <div class="mb-4 grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Tuition Fees <span class="text-red-500">*</span></label>
                <input type="number" name="tuition_fees" class="form-input w-full" required min="0" value="{{ old('tuition_fees') }}">
            </div>
            <div>
                <label class="block font-semibold mb-1">Hostel Fees</label>
                <input type="number" name="hostel_fees" class="form-input w-full" min="0" value="{{ old('hostel_fees') }}">
            </div>
        </div>
        <div class="mb-4 grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Admission Fees <span class="text-red-500">*</span></label>
                <input type="number" name="admission_fees" class="form-input w-full" required min="0" value="{{ old('admission_fees') }}">
            </div>
            <div>
                <label class="block font-semibold mb-1">Total Fees <span class="text-red-500">*</span></label>
                <input type="number" name="total_fees" class="form-input w-full" required min="0" value="{{ old('total_fees') }}">
            </div>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Minimum Qualification <span class="text-red-500">*</span></label>
            <input type="text" name="min_qualification" class="form-input w-full" required value="{{ old('min_qualification') }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Minimum Percentage <span class="text-red-500">*</span></label>
            <input type="text" name="min_percentage" class="form-input w-full" required value="{{ old('min_percentage') }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Required Exams</label>
            <input type="text" name="required_exams" class="form-input w-full" value="{{ old('required_exams') }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Age Limit</label>
            <input type="text" name="age_limit" class="form-input w-full" value="{{ old('age_limit') }}">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Curriculum PDF</label>
            <input type="file" name="curriculum_file" class="form-input w-full">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Curriculum Text</label>
            <textarea name="curriculum_text" class="form-textarea w-full">{{ old('curriculum_text') }}</textarea>
        </div>
        <div class="mb-4 grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Seat Availability</label>
                <input type="number" name="seat_availability" class="form-input w-full" min="0" value="{{ old('seat_availability') }}">
            </div>
            <div>
                <label class="block font-semibold mb-1">Admission Status <span class="text-red-500">*</span></label>
                <select name="admission_status" class="form-select w-full" required>
                    <option value="">Select Status</option>
                    <option value="Open">Open</option>
                    <option value="Closed">Closed</option>
                </select>
            </div>
        </div>
        <div class="flex gap-3 mt-6">
            <button type="submit" name="save_as_draft" value="1" class="btn btn-secondary">Save as Draft</button>
            <button type="submit" class="btn btn-primary">Submit for Approval</button>
        </div>
    </form>
</div>
<script>
document.getElementById('courseForm').onsubmit = function(e) {
    e.preventDefault();
    let form = this;
    let formData = new FormData(form);
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            showSwal('success', data.message, data.redirect);
        } else {
            showSwal('error', data.message || 'Error occurred');
        }
    })
    .catch(() => showSwal('error', 'Error occurred'));
};
</script>
@endsection
