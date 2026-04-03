@extends('layouts.app')
@section('content')
<div class="container max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Course Details</h1>
    <div class="bg-white rounded shadow p-6">
        <div class="mb-2"><strong>Name:</strong> {{ $course->course_name }}</div>
        <div class="mb-2"><strong>Category:</strong> {{ $course->category->name ?? '' }}</div>
        <div class="mb-2"><strong>Status:</strong> <span class="badge bg-info">{{ $course->status }}</span></div>
        <div class="mb-2"><strong>Description:</strong> {{ $course->description }}</div>
        <div class="mb-2"><strong>Duration:</strong> {{ $course->duration }}</div>
        <div class="mb-2"><strong>Type:</strong> {{ $course->course_type }}</div>
        <div class="mb-2"><strong>Mode:</strong> {{ $course->mode }}</div>
        <div class="mb-2"><strong>Tuition Fees:</strong> {{ $course->tuition_fees }}</div>
        <div class="mb-2"><strong>Hostel Fees:</strong> {{ $course->hostel_fees }}</div>
        <div class="mb-2"><strong>Admission Fees:</strong> {{ $course->admission_fees }}</div>
        <div class="mb-2"><strong>Total Fees:</strong> {{ $course->total_fees }}</div>
        <div class="mb-2"><strong>Minimum Qualification:</strong> {{ $course->min_qualification }}</div>
        <div class="mb-2"><strong>Minimum Percentage:</strong> {{ $course->min_percentage }}</div>
        <div class="mb-2"><strong>Required Exams:</strong> {{ $course->required_exams }}</div>
        <div class="mb-2"><strong>Age Limit:</strong> {{ $course->age_limit }}</div>
        <div class="mb-2"><strong>Seat Availability:</strong> {{ $course->seat_availability }}</div>
        <div class="mb-2"><strong>Admission Status:</strong> {{ $course->admission_status }}</div>
        <div class="mb-2"><strong>Curriculum File:</strong>
            @if($course->curriculum_file)
                <a href="{{ asset('storage/' . $course->curriculum_file) }}" target="_blank">Download PDF</a>
            @else
                N/A
            @endif
        </div>
        <div class="mb-2"><strong>Curriculum Text:</strong> {{ $course->curriculum_text }}</div>
        @if($course->admin_feedback)
        <div class="mb-2"><strong>Admin Feedback:</strong> {{ $course->admin_feedback }}</div>
        @endif
    </div>
</div>
@endsection
