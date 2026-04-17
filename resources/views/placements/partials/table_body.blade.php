@forelse($placements as $placement)
    <tr class="hover:bg-gray-50 transition">

        {{-- Year --}}
        <td class="px-4 py-4 text-sm text-gray-700">
            {{ $placement->academic_year }}
        </td>

        {{-- Highest --}}
        <td class="px-4 py-4 text-sm font-semibold text-gray-800">
            ₹{{ number_format($placement->highest_package, 2) }}
        </td>

        {{-- Average --}}
        <td class="px-4 py-4 text-sm text-gray-700">
            ₹{{ number_format($placement->average_package, 2) }}
        </td>

        {{-- Rate --}}
        <td class="px-4 py-4 text-sm text-gray-700">
            {{ $placement->placement_rate }}
        </td>

        {{-- Recruiters --}}
        <td class="px-4 py-4">
            @foreach($placement->recruiters as $recruiter)
                <div class="flex items-center gap-2 mb-1">
                    @if($recruiter->logo)
                        <img src="{{ asset('storage/' . $recruiter->logo) }}"
                             class="w-8 h-8 rounded-full object-cover border">
                    @endif
                    <span class="text-sm text-gray-700">
                        {{ $recruiter->company_name }}
                    </span>
                </div>
            @endforeach
        </td>

        {{-- Status --}}
        <td class="px-4 py-4">
            @php
                $statusColor = match($placement->status) {
                    'approved' => 'bg-green-100 text-green-700',
                    'pending'  => 'bg-amber-100 text-amber-700',
                    'draft'    => 'bg-gray-100 text-gray-600',
                    'rejected' => 'bg-red-100 text-red-600',
                    default    => 'bg-blue-100 text-blue-700',
                };
            @endphp
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold {{ $statusColor }}">
                {{ ucfirst($placement->status) }}
            </span>
        </td>
        {{-- Actions --}}
        <td class="px-4 py-4">
            <div class="flex items-center gap-2">

                <a href="{{ route('university.placements.edit', $placement) }}"
                   class="text-xs font-medium text-amber-600 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-2.5 py-1.5 rounded-lg transition">
                    Edit
                </a>

                <form action="{{ route('university.placements.destroy', $placement) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                            class="text-xs font-medium text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-2.5 py-1.5 rounded-lg transition delete-btn">
                        Delete
                    </button>
                </form>

            </div>
        </td>

    </tr>

@empty
<tr>
    <td colspan="10" class="text-center py-10 text-gray-400">
        No placements found
    </td>
</tr>
@endforelse