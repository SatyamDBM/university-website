@forelse($enquiries as $index => $lead)
<tr class="hover:bg-gray-50 transition">

    <td class="px-4 py-4 text-sm text-gray-400">
        {{ $enquiries->firstItem() + $index }}
    </td>

    <td class="px-4 py-4">
        <div class="text-sm font-semibold text-gray-800">
            {{ $lead->name }}
        </div>
        <div class="text-xs text-gray-400">
            {{ $lead->email }}
        </div>
    </td>

    <td class="px-4 py-4 text-sm">
        {{ $lead->mobile }}
    </td>

    <td class="px-4 py-4 text-sm">
        {{ Str::limit($lead->course, 30) }}
    </td>

    <td class="px-4 py-4 text-xs text-gray-500">
        {{ Str::limit($lead->message, 50) }}
    </td>

    <td class="px-4 py-4">
        @if($lead->assigned_by)
            <span class="text-green-600 text-xs font-semibold">Assigned</span>
        @else
            <span class="text-amber-600 text-xs font-semibold">Direct</span>
        @endif
    </td>

    <td class="px-4 py-4 text-xs text-gray-400">
        {{ $lead->created_at->format('d M Y') }}
    </td>

</tr>
@empty
<tr>
    <td colspan="7" class="text-center py-10 text-gray-400">
        No leads found
    </td>
</tr>
@endforelse