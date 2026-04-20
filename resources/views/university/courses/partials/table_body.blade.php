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
                                    'approved' => 'bg-green-100 text-green-700',
                                    'pending'  => 'bg-amber-100 text-amber-700',
                                    'draft'    => 'bg-gray-100 text-gray-600',
                                    'rejected' => 'bg-red-100 text-red-600',
                                    default    => 'bg-blue-100 text-blue-700',
                                };
                            @endphp
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $statusColor }}">
                                {{ ucfirst($course->status) }}
                            </span>
                        </td>

                        {{-- Active Toggle --}}
                        <td class="px-4 py-4">
                            <button
                                onclick="toggleActive({{ $course->id }}, this)"
                                data-active="{{ $course->is_active ?? 1 }}"
                                class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none
                                       {{ ($course->is_active ?? 1) ? 'bg-purple-600' : 'bg-gray-300' }}"
                            >
                                <span class="inline-block h-4 w-4 transform rounded-full bg-white shadow transition-transform
                                             {{ ($course->is_active ?? 1) ? 'translate-x-6' : 'translate-x-1' }}">
                                </span>
                            </button>
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