<x-filament-panels::page>
    <div class="space-y-6">
        <div class="rounded">
            <div class="px-6 py-1">
                <div class="flex flex-col gap-2 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="font-semibold text-[var(--color-text-dark)]">
                            Support & Tickets
                        </h2>
                        <p class="text-xs text-[var(--color-text-subtle)]">
                            View all support tickets raised by universities and manage replies.
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="inline-flex items-center gap-2 rounded-[5px] border border-[var(--color-border-section)] bg-[var(--color-bg-subtle)] px-4 py-2 text-sm font-medium text-[var(--color-text-muted)]">
                            <span class="h-2 w-2 rounded-full bg-[var(--color-dot-live)]"></span>
                            All Tickets
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-2 rounded">
                {{ $this->table }}
            </div>
        </div>
    </div>
</x-filament-panels::page>