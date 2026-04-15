@extends('layouts.app')
@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Course Details</h1>
            <p class="text-sm text-gray-500 mt-1">Full information about this course</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('university.courses.edit', $course) }}"
               class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                Edit Course
            </a>
            <a href="{{ route('university.courses.index') }}"
               class="inline-flex items-center gap-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition">
                ← Back
            </a>
        </div>
    </div>

    {{-- Admin Feedback Banner --}}
    @if($course->admin_feedback)
    <div class="mb-6 p-4 bg-amber-50 border border-amber-200 rounded-xl flex items-start gap-3">
        <span class="text-amber-500 text-lg">⚠️</span>
        <div>
            <div class="text-sm font-semibold text-amber-700">Admin Feedback</div>
            <div class="text-sm text-amber-600 mt-0.5">{{ $course->admin_feedback }}</div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-3 gap-6">

        {{-- Left: Main Info --}}
        <div class="col-span-2 space-y-6">

            {{-- Basic Info Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                    <h2 class="text-sm font-semibold text-gray-700">Basic Information</h2>
                    @php
                        $statusColor = match($course->status) {
                            'approved' => 'bg-green-100 text-green-700',
                            'pending'  => 'bg-amber-100 text-amber-700',
                            'draft'    => 'bg-gray-100 text-gray-600',
                            'rejected' => 'bg-red-100 text-red-600',
                            default    => 'bg-blue-100 text-blue-700',
                        };
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $statusColor }}">
                        {{ ucfirst($course->status) }}
                    </span>
                </div>
                <div class="p-5 grid grid-cols-2 gap-4">
                    <div>
                        <div class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">Course Name</div>
                        <div class="text-sm font-semibold text-gray-800">{{ $course->course_name }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">Category</div>
                        <div class="text-sm text-gray-700">{{ $course->category->name ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">Course Type</div>
                        <div class="text-sm text-gray-700">{{ $course->course_type ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">Mode</div>
                        <div class="text-sm text-gray-700">{{ $course->mode ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">Duration</div>
                        <div class="text-sm text-gray-700">{{ $course->duration ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">Admission Status</div>
                        <div class="text-sm text-gray-700">{{ $course->admission_status ?? '—' }}</div>
                    </div>
                    <div class="col-span-2">
                        <div class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">Description</div>
                        <div class="text-sm text-gray-700 leading-relaxed">{{ $course->description ?? '—' }}</div>
                    </div>
                </div>
            </div>

            {{-- Eligibility Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
                    <h2 class="text-sm font-semibold text-gray-700">Eligibility Criteria</h2>
                </div>
                <div class="p-5 grid grid-cols-3 gap-4">
                    <div>
                        <div class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">Min. Qualification</div>
                        <div class="text-sm text-gray-700">{{ $course->min_qualification ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">Min. Percentage</div>
                        <div class="text-sm text-gray-700">{{ $course->min_percentage ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">Age Limit</div>
                        <div class="text-sm text-gray-700">{{ $course->age_limit ?? '—' }}</div>
                    </div>
                    <div class="col-span-3">
                        <div class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">Required Exams</div>
                        <div class="text-sm text-gray-700">{{ $course->required_exams ?? '—' }}</div>
                    </div>
                </div>
            </div>

            {{-- Curriculum Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
                    <h2 class="text-sm font-semibold text-gray-700">Curriculum</h2>
                </div>
                <div class="p-5 space-y-4">
                    <div>
                        <div class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">Curriculum PDF</div>
                        @if($course->curriculum_file)
                            <a href="{{ asset('storage/' . $course->curriculum_file) }}" target="_blank"
                               class="inline-flex items-center gap-1.5 text-sm text-purple-600 hover:text-purple-800 font-medium">
                                📄 Download PDF
                            </a>
                        @else
                            <span class="text-sm text-gray-400">Not uploaded</span>
                        @endif
                    </div>
                    @if($course->curriculum_text)
                    <div>
                        <div class="text-xs text-gray-400 font-medium uppercase tracking-wide mb-1">Curriculum Text</div>
                        <div class="text-sm text-gray-700 leading-relaxed">{{ $course->curriculum_text }}</div>
                    </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- Right: Fees + Seats --}}
        <div class="space-y-6">

            {{-- Fees Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
                    <h2 class="text-sm font-semibold text-gray-700">Fee Structure</h2>
                </div>
                <div class="p-5 space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Tuition Fees</span>
                        <span class="text-sm font-medium text-gray-800">₹{{ number_format($course->tuition_fees) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Hostel Fees</span>
                        <span class="text-sm font-medium text-gray-800">₹{{ number_format($course->hostel_fees ?? 0) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Admission Fees</span>
                        <span class="text-sm font-medium text-gray-800">₹{{ number_format($course->admission_fees) }}</span>
                    </div>
                    <div class="border-t border-gray-100 pt-3 flex justify-between items-center">
                        <span class="text-sm font-semibold text-gray-700">Total Fees</span>
                        <span class="text-base font-bold text-purple-700">₹{{ number_format($course->total_fees) }}</span>
                    </div>
                </div>
            </div>

            {{-- Seats Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
                    <h2 class="text-sm font-semibold text-gray-700">Seat Availability</h2>
                </div>
                <div class="p-5 text-center">
                    <div class="text-4xl font-bold text-gray-800">{{ $course->seat_availability ?? '—' }}</div>
                    <div class="text-sm text-gray-400 mt-1">Seats available</div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection