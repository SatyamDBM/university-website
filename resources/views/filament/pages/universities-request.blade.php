<x-filament-panels::page>
    <div class="space-y-4">
        <div class="rounded">
            <div class="flex items-center justify-between px-6 py-1">
                <div>
                    <h2 class="font-semibold text-[var(--color-text-dark)]">
                        University Requests
                    </h2>

                    <p class="text-xs text-[var(--color-text-subtle)]">
                        View all pending university linking requests.
                    </p>
                </div>

                <div class="inline-flex items-center gap-2 rounded-[5px] border border-[var(--color-border-light)] bg-[var(--color-bg-subtle)] px-3 py-1.5 text-xs font-medium text-[var(--color-text-muted)]">
                    <span class="h-2 w-2 rounded-full bg-yellow-500"></span>
                    Pending Requests
                </div>
            </div>

            <div class="p-2">
                {{ $this->table }}
            </div>
        </div>
    </div>
</x-filament-panels::page>