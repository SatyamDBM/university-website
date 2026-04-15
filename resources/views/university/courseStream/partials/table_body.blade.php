 @forelse($streams as $index => $sp)
    <tr class="hover:bg-gray-50 transition" id="stream-row-{{ $sp->id }}">

        {{-- # --}}
        <td class="px-4 py-4 text-sm text-gray-400">
            {{ $streams->firstItem() + $index }}
        </td>

        {{-- Stream Name --}}
        <td class="px-4 py-4">
            <div class="text-sm font-semibold text-gray-800">{{ $sp->name }}</div>
        </td>

        {{-- Course --}}
        <td class="px-4 py-4">
            <div class="text-sm text-gray-700">{{ $sp->course->course_name ?? '—' }}</div>
        </td>

        {{-- Fees Range --}}
        <td class="px-4 py-4">
            <div class="text-sm font-medium text-gray-800">
                ₹{{ number_format($sp->min_fee ?? 0) }}
                <span class="text-gray-400 mx-1">—</span>
                ₹{{ number_format($sp->max_fee ?? 0) }}
            </div>
        </td>

        {{-- Actions --}}
        <td class="px-4 py-4">
            <div class="flex items-center gap-1.5">
                <a href="{{ route('university.streams.edit', $sp->id) }}"
                    class="text-xs font-medium text-amber-600 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-2.5 py-1.5 rounded-lg transition">
                    Edit
                </a>
                <button onclick="deleteStream({{ $sp->id }})"
                        class="text-xs font-medium text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-2.5 py-1.5 rounded-lg transition">
                    Delete
                </button>
            </div>
        </td>

    </tr>
    @empty
    <tr>
        <td colspan="5" class="px-5 py-16 text-center">
            <div class="text-gray-400 text-sm">No streams found.</div>
            <a href="{{ route('university.streams.create') }}"
                class="inline-flex items-center gap-1 mt-3 text-sm font-medium"
                style="color:#6b4a36;">
                + Add your first stream
            </a>
        </td>
    </tr>
@endforelse