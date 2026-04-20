@forelse($facilities as $index => $facility)
    <tr class="hover:bg-gray-50 transition" id="row-{{ $facility->id }}">

        {{-- Index --}}
        <td class="px-4 py-4 text-sm text-gray-400">
            {{ $facilities->firstItem() + $index }}
        </td>

        {{-- Facility Name --}}
        <td class="px-4 py-4">
            <div class="text-sm font-semibold text-gray-800">
                {{ $facility->facility_name }}
            </div>
        </td>

        {{-- Type --}}
        <td class="px-4 py-4 text-sm text-gray-600">
            {{ $facility->facility_type ?? '—' }}
        </td>
        {{-- Status --}}
        <td class="px-4 py-4">
            @php
                $statusColor = match($facility->status) {
                    'active' => 'bg-green-100 text-green-700',
                    'inactive' => 'bg-gray-100 text-gray-600',
                    'maintenance' => 'bg-amber-100 text-amber-700',
                        default => 'bg-blue-100 text-blue-700',
                };
            @endphp
            <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold {{ $statusColor }}">
                {{ ucfirst($facility->status) }}
            </span>
        </td>

        {{-- Featured --}}
        <td class="px-4 py-4 text-sm">
            <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold 
                {{ $facility->is_featured ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-500' }}">
                {{ $facility->is_featured ? 'Yes' : 'No' }}
            </span>
        </td>

        {{-- Active Toggle --}}
        <td class="px-4 py-4">
            <button
                onclick="toggleFacility({{ $facility->id }}, this)"
                data-active="{{ $facility->is_active ?? 1 }}"
                class="relative inline-flex h-6 w-11 items-center rounded-full transition
                {{ ($facility->is_active ?? 1) ? 'bg-purple-600' : 'bg-gray-300' }}">
                
                <span class="inline-block h-4 w-4 transform bg-white rounded-full shadow transition
                {{ ($facility->is_active ?? 1) ? 'translate-x-6' : 'translate-x-1' }}">
                </span>
            </button>
        </td>

        {{-- Actions --}}
        <td class="px-4 py-4">
            <div class="flex items-center gap-1.5">
                <a href="{{ route('university.facilities.show', $facility) }}"
                    class="text-xs text-blue-600 bg-blue-50 px-2.5 py-1.5 rounded-lg hover:bg-blue-100">
                    View
                </a>

                <a href="{{ route('university.facilities.edit', $facility) }}"
                    class="text-xs text-amber-600 bg-amber-50 px-2.5 py-1.5 rounded-lg hover:bg-amber-100">
                    Edit
                </a>

                <button onclick="deleteFacility({{ $facility->id }})"
                        class="text-xs text-red-600 bg-red-50 px-2.5 py-1.5 rounded-lg hover:bg-red-100">
                    Delete
                </button>
            </div>
        </td>

    </tr>
    @empty
    <tr>
        <td colspan="7" class="px-5 py-16 text-center text-gray-400">
            No facilities found.
        </td>
    </tr>
    @endforelse