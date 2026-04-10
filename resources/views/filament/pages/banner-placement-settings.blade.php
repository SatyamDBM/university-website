<x-filament-panels::page>
    <div class="space-y-4">
        <div class="rounded">
            <div class="flex items-center justify-between px-6 py-1">
                <div>
                    <h2 class="font-semibold text-[var(--color-text-dark)]">
                        University Banners
                    </h2>

                    <p class="text-xs text-[var(--color-text-subtle)]">
                        View and manage all banners purchased by universities.
                    </p>
                </div>
            </div>

            <div class="p-2">
                {{ $this->table }}
            </div>
        </div>
    </div>
</x-filament-panels::page>