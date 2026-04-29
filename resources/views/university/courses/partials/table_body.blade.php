  @forelse($courses as $index => $course)
                    <tr class="hover:bg-gray-50 transition" id="row-{{ $course->id }}">

                        {{-- # --}}
                        <td class="px-4 py-4 text-sm text-gray-400">
                            {{ $courses->firstItem() + $index }}
                        </td>

                        {{-- Course Name --}}
                        <td class="px-4 py-4">
                            <div class="text-sm font-semibold text-gray-800">{{ $course->course_name }}</div>
                            @if($course->admin_feedback)
                            <div class="text-xs text-red-500 mt-0.5">⚠ {{ Str::limit($course->admin_feedback, 40) }}</div>
                            @endif
                        </td>

                        {{-- Category --}}
                        <td class="px-4 py-4 text-sm text-gray-600">
                            <div>{{ $course->category->name ?? '—' }}</div>
                            @if($course->subcategory)
                            <div class="text-xs text-gray-400">{{ $course->subcategory->name }}</div>
                            @endif
                        </td>

                        {{-- Type / Mode --}}
                        <td class="px-4 py-4">
                            <div class="text-sm text-gray-700">{{ $course->course_type ?? '—' }}</div>
                            <div class="text-xs text-gray-400">{{ $course->mode ?? '' }}</div>
                        </td>

                        {{-- Duration --}}
                        <td class="px-4 py-4 text-sm text-gray-600">
                            {{ $course->duration ?? '—' }}
                        </td>

                        {{-- Fees --}}
                        <td class="px-4 py-4">
                            <div class="text-sm font-semibold text-gray-800">₹{{ number_format($course->total_fees ?? 0) }}</div>
                            <div class="text-xs text-gray-400">Tuition: ₹{{ number_format($course->tuition_fees ?? 0) }}</div>
                        </td>

                        {{-- Seats --}}
                        <td class="px-4 py-4 text-sm text-gray-600">
                            {{ $course->seat_availability ?? '—' }}
                        </td>

                        {{-- Admission Status --}}
                        <td class="px-4 py-4">
                            @php
                                $admColor = $course->admission_status === 'Open'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-red-100 text-red-600';
                            @endphp
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $admColor }}">
                                {{ $course->admission_status ?? '—' }}
                            </span>
                        </td>

                        {{-- Approval Status --}}
                       <td class="px-4 py-4">
                        @php
                            $statusColor = match($course->status) {
                                'Live'     => 'bg-green-100 text-green-700',
                                'Pending'  => 'bg-yellow-100 text-yellow-700',
                                'Draft'    => 'bg-gray-100 text-gray-600',
                                'Rejected' => 'bg-red-100 text-red-600',
                                default    => 'bg-gray-100 text-gray-500',
                            };
                        @endphp

                        <span class="px-2 py-1 text-xs font-semibold rounded {{ $statusColor }}">
                            {{ $course->status }}
                        </span>
                    </td>
                                            {{-- Active Toggle --}}
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-2">

                            {{-- Live → Draft --}}
                            @if($course->status === 'Live')
                                <button
                                    onclick="changeStatus({{ $course->id }}, 'draft', this)"
                                    data-url="{{ route('university.courses.toggleStatus', $course) }}"
                                    class="text-xs bg-gray-200 px-2 py-1 rounded">
                                    Move to Draft
                                </button>
                            @endif

                            {{-- Draft → Pending --}}
                            @if($course->status === 'Draft')
                                <button
                                    onclick="changeStatus({{ $course->id }}, 'pending', this)"
                                    data-url="{{ route('university.courses.toggleStatus', $course) }}"
                                    class="text-xs bg-yellow-200 px-2 py-1 rounded">
                                    Submit
                                </button>
                            @endif

                            {{-- Pending → Show label --}}
                            @if($course->status === 'Pending')
                                <span class="text-xs text-blue-600 bg-blue-100 px-2 py-1 rounded">
                                    Waiting for approval
                                </span>
                            @endif

                            {{-- Rejected (optional improvement) --}}
                            @if($course->status === 'Rejected')
                                <button
                                    onclick="changeStatus({{ $course->id }}, 'pending', this)"
                                    data-url="{{ route('university.courses.toggleStatus', $course) }}"
                                    class="text-xs bg-red-100 px-2 py-1 rounded">
                                    Resubmit
                                </button>
                            @endif

                        </div>
                    </td>

                       
                        {{-- Actions --}}
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-1.5">
                                <a href="{{ route('university.courses.show', $course) }}"
                                   class="text-xs font-medium text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-2.5 py-1.5 rounded-lg transition">
                                    View
                                </a>
                                <a href="{{ route('university.courses.edit', $course) }}"
                                   class="text-xs font-medium text-amber-600 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-2.5 py-1.5 rounded-lg transition">
                                    Edit
                                </a>
                                <button onclick="deleteCourse({{ $course->id }})"
                                        class="text-xs font-medium text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-2.5 py-1.5 rounded-lg transition">
                                    Delete
                                </button>
                            </div>
                        </td>

                    </tr>
@empty
<tr>
    <td colspan="10" class="text-center py-10 text-gray-400">
        No courses found
    </td>
</tr>
@endforelse
