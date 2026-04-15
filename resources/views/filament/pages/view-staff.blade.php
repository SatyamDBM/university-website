<x-filament-panels::page>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-[var(--color-text-dark)]">
                    View Staff
                </h2>

                <p class="text-sm text-[var(--color-text-subtle)]">
                    View complete details of the selected staff member.
                </p>
            </div>

            <a
                href="{{ url('/admin/all-staff') }}"
                class="inline-flex items-center rounded border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition hover:bg-gray-50"
            >
                ⬅ Back to Staff
            </a>
        </div>

        <div class="rounded border border-gray-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col items-center border-b border-gray-200 pb-6 md:flex-row md:items-center md:justify-between">
                <div class="flex items-center gap-4">
                    <div class="flex h-20 w-20 items-center justify-center rounded-full bg-[#775042] text-2xl font-bold text-white">
                        {{ strtoupper(substr($staff->name, 0, 1)) }}
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">
                            {{ $staff->name ?? '-' }}
                        </h3>

                        <p class="text-sm text-gray-500">
                            {{ $staff->email ?? '-' }}
                        </p>

                        <div class="mt-2 flex items-center gap-2">
                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">
                                {{ ucfirst($staff->role) }}
                            </span>

                            <span class="
                                rounded-full px-3 py-1 text-xs font-medium
                                @if($staff->status === 'active')
                                    bg-green-100 text-green-700
                                @elseif($staff->status === 'inactive')
                                    bg-red-100 text-red-700
                                @elseif($staff->status === 'suspended')
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-gray-100 text-gray-700
                                @endif
                            ">
                                {{ ucfirst($staff->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 md:mt-0">
                    <a
                        href="{{ url('/admin/edit-staff/' . $staff->id) }}"
                        class="inline-flex items-center rounded bg-[#775042] px-4 py-2 text-sm font-medium text-white transition hover:bg-[#5f4035]"
                    >
                        Edit Staff
                    </a>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div class="rounded border border-gray-200 bg-gray-50 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                        Staff Name
                    </p>

                    <h4 class="mt-2 text-sm font-semibold text-gray-800">
                        {{ $staff->name ?? '-' }}
                    </h4>
                </div>

                <div class="rounded border border-gray-200 bg-gray-50 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                        Email Address
                    </p>

                    <h4 class="mt-2 break-all text-sm font-semibold text-gray-800">
                        {{ $staff->email ?? '-' }}
                    </h4>
                </div>

                <div class="rounded border border-gray-200 bg-gray-50 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                        Mobile Number
                    </p>

                    <h4 class="mt-2 text-sm font-semibold text-gray-800">
                        {{ $staff->mobile ?? '-' }}
                    </h4>
                </div>

                <div class="rounded border border-gray-200 bg-gray-50 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                        Email Verified
                    </p>

                    <h4 class="mt-2 text-sm font-semibold text-gray-800">
                        {{ $staff->is_email_verified ? 'Yes' : 'No' }}
                    </h4>
                </div>

                <div class="rounded border border-gray-200 bg-gray-50 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                        Role
                    </p>

                    <h4 class="mt-2 text-sm font-semibold text-gray-800">
                        {{ ucfirst($staff->role) ?? '-' }}
                    </h4>
                </div>

                <div class="rounded border border-gray-200 bg-gray-50 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                        Status
                    </p>

                    <h4 class="mt-2 text-sm font-semibold text-gray-800">
                        {{ ucfirst($staff->status) ?? '-' }}
                    </h4>
                </div>

                <div class="rounded border border-gray-200 bg-gray-50 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                        Created At
                    </p>

                    <h4 class="mt-2 text-sm font-semibold text-gray-800">
                        {{ $staff->created_at ? $staff->created_at->format('d M Y h:i A') : '-' }}
                    </h4>
                </div>

                <div class="rounded border border-gray-200 bg-gray-50 p-4">
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                        Updated At
                    </p>

                    <h4 class="mt-2 text-sm font-semibold text-gray-800">
                        {{ $staff->updated_at ? $staff->updated_at->format('d M Y h:i A') : '-' }}
                    </h4>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>