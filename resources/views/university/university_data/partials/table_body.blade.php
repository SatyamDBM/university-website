  {{-- ONE ROW = ONE UNIVERSITY FINANCE RECORD --}}
                    @if($process)

                    <tr class="hover:bg-gray-50">

                        {{-- STEPS --}}
                        <td class="px-4 py-4 text-sm text-gray-700">
                            @forelse($steps as $step)
                                <div>• {{ $step->title }}</div>
                            @empty
                                <span class="text-gray-400">No steps</span>
                            @endforelse
                        </td>

                        {{-- DATES --}}
                        <td class="px-4 py-4 text-sm text-gray-700">
                            @forelse($dates as $date)
                                <div>{{ $date->label }}: {{ $date->value }}</div>
                            @empty
                                <span class="text-gray-400">No dates</span>
                            @endforelse
                        </td>

                        {{-- CUTOFFS --}}
                        <td class="px-4 py-4 text-sm text-gray-700">
                            @forelse($cutoffs as $cutoff)
                                <div>{{ $cutoff->course }} - {{ $cutoff->cutoff }}</div>
                            @empty
                                <span class="text-gray-400">No cutoffs</span>
                            @endforelse
                        </td>

                        {{-- SCHOLARSHIPS --}}
                        <td class="px-4 py-4 text-sm text-gray-700">
                            {{ $scholarships->count() }} Items
                        </td>

                        {{-- LOANS --}}
                        <td class="px-4 py-4 text-sm text-gray-700">
                            {{ $loanPartners->count() }} Banks
                        </td>

                        {{-- ACTIONS --}}
                        <td class="px-4 py-4">
                            <div class="flex gap-2">

                                <a href="{{ route('university.finance.edit', $process->id) }}"
                                   class="text-xs bg-amber-100 text-amber-700 px-3 py-1 rounded">
                                    Edit
                                </a>

                               <a href="{{ route('university.finance.show', $process->id) }}"
                                    class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded">
                                        View
                                    </a>

                                    <button onclick="deleteRecord({{ $process->id }})"
                                    class="text-xs bg-red-100 text-red-700 px-3 py-1 rounded">
                                Delete
                            </button>

                            </div>
                        </td>

                    </tr>

                    @else
                    <tr>
                        <td colspan="6" class="text-center py-10 text-gray-400">
                            No Finance Data Found
                        </td>
                    </tr>
                    @endif
