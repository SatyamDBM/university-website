<x-filament-panels::page>
    <div class="space-y-4">
        <div class="rounded">
            <div class="flex items-center justify-between px-6 py-1">
                <div>
                    <h2 class="font-semibold text-[var(--color-text-dark)]">
                        Direct Leads
                    </h2>

                    <p class="text-xs text-[var(--color-text-subtle)]">
                        Manage all direct customer leads, assign universities, and track enquiries.
                    </p>
                </div>
                @php
                    $totalLeads = \App\Models\Enquiry::whereNull('university_id')->count();
                @endphp
                <div class="rounded-md bg-blue-50 px-3 py-1 text-xs font-medium text-blue-700 dark:bg-blue-500/10 dark:text-blue-400">
                    Total Leads: {{ $totalLeads }}
                </div>
            </div>

            <div class="p-2">
                {{ $this->table }}
            </div>
        </div>
    </div>
</x-filament-panels::page>