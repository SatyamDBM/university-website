<x-filament-panels::page>
    <div class="space-y-4">
        <div class="rounded">
            <div class="flex items-center justify-between px-6 py-1">
                <div>
                    <h2 class="font-semibold text-[var(--color-text-dark)]">
                        All Staff
                    </h2>

                    <p class="text-xs text-[var(--color-text-subtle)]">
                        View and manage all admin staff members.
                    </p>
                </div>

                <a
                    href="{{ url('/admin/create-staff') }}"
                    class="rounded-[5px] bg-[#775042] px-4 py-2 text-sm font-medium text-white"
                >
                    + Create Staff
                </a>
            </div>

            <div class="p-2">
                {{ $this->table }}
            </div>
        </div>
    </div>
</x-filament-panels::page>