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
               class="inline-flex items-center gap-2 text-white text-sm font-medium px-4 py-2 rounded-lg transition"
               style="background-color:#6b4a36;">
                ✏️ Edit Course
            </a>
            <a href="{{ route('university.courses.index') }}"
               class="inline-flex items-center gap-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition">
                ← Back
            </a>
        </div>
    </div>

    {{-- Admin Feedback --}}
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

        {{-- ══ LEFT (col-span-2) ══ --}}
        <div class="col-span-2 space-y-6">

            {{-- Basic Info --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3 flex items-center justify-between" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">📋 Basic Information</h2>
                    @php
                        $statusColor = match($course->status) {
                            'approved' => 'bg-green-400 text-white',
                            'pending'  => 'bg-amber-400 text-white',
                            'draft'    => 'bg-gray-400 text-white',
                            'rejected' => 'bg-red-400 text-white',
                            default    => 'bg-blue-400 text-white',
                        };
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $statusColor }}">
                        {{ ucfirst($course->status) }}
                    </span>
                </div>
                <div class="p-5 grid grid-cols-3 gap-4">
                    <div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-1">Course Name</div>
                        <div class="text-sm font-semibold text-gray-800">{{ $course->course_name }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-1">Category</div>
                        <div class="text-sm text-gray-700">{{ $course->category->name ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-1">Degree Level</div>
                        <div class="text-sm text-gray-700">{{ $course->degree_level ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-1">Course Type</div>
                        <div class="text-sm text-gray-700">{{ $course->course_type ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-1">Mode</div>
                        <div class="text-sm text-gray-700">{{ $course->mode ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-1">Duration</div>
                        <div class="text-sm text-gray-700">{{ $course->duration ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-1">Admission Status</div>
                        @php
                            $admColor = ($course->admission_status === 'Open')
                                ? 'bg-green-100 text-green-700'
                                : 'bg-red-100 text-red-600';
                        @endphp
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $admColor }}">
                            {{ $course->admission_status ?? '—' }}
                        </span>
                    </div>
                    <div class="col-span-3">
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-1">Description</div>
                        <div class="text-sm text-gray-700 leading-relaxed">{{ $course->description ?? '—' }}</div>
                    </div>
                </div>
            </div>

            {{-- Eligibility --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">🎓 Eligibility Criteria</h2>
                </div>
                <div class="p-5 grid grid-cols-3 gap-4">
                    <div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-1">Min. Qualification</div>
                        <div class="text-sm text-gray-700">{{ $course->min_qualification ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-1">Min. Percentage</div>
                        <div class="text-sm text-gray-700">{{ $course->min_percentage ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-1">Age Limit</div>
                        <div class="text-sm text-gray-700">{{ $course->age_limit ?? '—' }}</div>
                    </div>
                    <div class="col-span-3">
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-1">Required Exams</div>
                        <div class="text-sm text-gray-700">{{ $course->required_exams ?? '—' }}</div>
                    </div>
                </div>
            </div>

            {{-- Curriculum --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">📚 Curriculum</h2>
                </div>
                <div class="p-5 space-y-4">

                    {{-- PDF --}}
                    <div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-1">Curriculum PDF</div>
                        @if($course->curriculum_file)
                            <a href="{{ asset('storage/' . $course->curriculum_file) }}" target="_blank"
                               class="inline-flex items-center gap-1.5 text-sm font-medium"
                               style="color:#6b4a36;">
                                📄 Download PDF
                            </a>
                        @else
                            <span class="text-sm text-gray-400">Not uploaded</span>
                        @endif
                    </div>

                    {{-- Curriculum Subjects (JSON) --}}
                    @if($course->curriculum_text)
                    @php
                        // Handle both JSON array and plain text
                        $subjects = null;
                        try {
                            $decoded = json_decode($course->curriculum_text, true);
                            if (is_array($decoded)) $subjects = $decoded;
                        } catch(\Exception $e) {}
                    @endphp

                    @if($subjects)
                    <div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-3">Curriculum Highlights</div>

                        {{-- Group by type --}}
                        @php
                            $grouped = collect($subjects)->groupBy('type');
                        @endphp

                        @foreach($grouped as $type => $items)
                        <div class="mb-3">
                            <div class="text-xs font-semibold text-white px-2 py-1 rounded mb-2 inline-block"
                                 style="background-color:#6b4a36;">
                                {{ $type }}
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach($items as $subject)
                                <div class="flex items-center gap-2 text-sm text-gray-700 bg-gray-50 rounded-lg px-3 py-2">
                                    <span class="text-xs" style="color:#6b4a36;">✓</span>
                                    {{ $subject['title'] }}
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    {{-- Plain text fallback --}}
                    <div>
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-1">Curriculum Text</div>
                        <div class="text-sm text-gray-700 leading-relaxed">{{ $course->curriculum_text }}</div>
                    </div>
                    @endif
                    @endif

                </div>
            </div>

        </div>

        {{-- ══ RIGHT (col-span-1) ══ --}}
        <div class="space-y-6">

            {{-- Fees Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">💰 Fee Structure</h2>
                </div>
                <div class="p-5 space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Tuition Fees</span>
                        <span class="text-sm font-medium text-gray-800">₹{{ number_format($course->tuition_fees ?? 0) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Hostel Fees</span>
                        <span class="text-sm font-medium text-gray-800">₹{{ number_format($course->hostel_fees ?? 0) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Admission Fees</span>
                        <span class="text-sm font-medium text-gray-800">₹{{ number_format($course->admission_fees ?? 0) }}</span>
                    </div>
                    <div class="border-t border-gray-100 pt-3 flex justify-between items-center">
                        <span class="text-sm font-semibold text-gray-700">Total Fees</span>
                        <span class="text-base font-bold" style="color:#6b4a36;">
                            ₹{{ number_format($course->total_fees ?? 0) }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Seat Availability --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">🪑 Seat Availability</h2>
                </div>
                <div class="p-5">
                    <div class="text-center mb-4">
                        <div class="text-4xl font-bold text-gray-800">
                            {{ $course->seat_availability ?? '—' }}
                        </div>
                        <div class="text-sm text-gray-400 mt-1">Total Seats</div>
                    </div>

                    {{-- Category-wise seats --}}
                    @if($course->seats && $course->seats->count())
                    <div class="border-t border-gray-100 pt-4">
                        <div class="text-xs text-gray-400 uppercase tracking-wide mb-3">Category Wise</div>
                        <div class="space-y-2">
                            @foreach($course->seats as $seat)
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-gray-100 text-gray-600">
                                    {{ $seat->category }}
                                </span>
                                <span class="text-sm font-bold text-gray-800">
                                    {{ $seat->seats }}
                                </span>
                            </div>
                            @endforeach
                        </div>

                        {{-- Total bar --}}
                        @php $totalCategorized = $course->seats->sum('seats'); @endphp
                        @if($totalCategorized > 0 && $course->seat_availability)
                        <div class="mt-3 pt-3 border-t border-gray-100">
                            <div class="flex justify-between text-xs text-gray-400 mb-1">
                                <span>Category Distribution</span>
                                <span>{{ $totalCategorized }} / {{ $course->seat_availability }}</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="h-2 rounded-full"
                                     style="width: {{ min(100, ($totalCategorized / $course->seat_availability) * 100) }}%;
                                            background-color:#6b4a36;">
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>

            {{-- Quick Stats --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-5 py-3" style="background-color:#6b4a36;">
                    <h2 class="text-sm font-semibold text-white">📊 Quick Info</h2>
                </div>
                <div class="p-5 space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Degree Level</span>
                        <span class="font-medium text-gray-800">{{ $course->degree_level ?? '—' }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Duration</span>
                        <span class="font-medium text-gray-800">{{ $course->duration ?? '—' }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Mode</span>
                        <span class="font-medium text-gray-800">{{ $course->mode ?? '—' }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Is Active</span>
                        <span class="font-medium">
                            @if($course->is_active)
                                <span class="text-green-600">✅ Active</span>
                            @else
                                <span class="text-red-500">❌ Inactive</span>
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Created</span>
                        <span class="font-medium text-gray-800">
                            {{ $course->created_at->format('d M Y') }}
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection