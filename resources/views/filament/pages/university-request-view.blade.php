<x-filament::page>
    <div class="w-full space-y-6">

        {{-- University User Details Card --}}
        <div class="rounded bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        University User Details
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Complete information about university account request.
                    </p>
                </div>

                <div class="self-start sm:self-center">
                    @php
                        $statusColor = match($record->linking_status) {
                            'approved' => 'bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-400',
                            'pending'  => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-500/20 dark:text-yellow-400',
                            'rejected' => 'bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400',
                            default    => 'bg-gray-100 text-gray-700 dark:bg-gray-500/20 dark:text-gray-400',
                        };
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">
                        {{ ucfirst($record->linking_status ?? 'not linked') }}
                    </span>
                </div>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">User ID</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">#{{ $record->id }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">University ID</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">
                        {{ $record->university_id ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Contact Person Name</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $record->name }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Email Address</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white break-all">{{ $record->email }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Mobile Number</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $record->mobile ?? '-' }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Role</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{ ucfirst($record->role) }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Account Status</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{ ucfirst($record->status ?? '-') }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Email Verified</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">
                        {{ $record->is_email_verified ? 'Yes' : 'No' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Registered At</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">
                        {{ $record->created_at?->format('d M Y h:i A') }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Updated At</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">
                        {{ $record->updated_at?->format('d M Y h:i A') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- University Details Card --}}
        <div class="rounded bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                    University Details
                </h2>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">University Name</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">
                        {{ $this->university?->name ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Slug</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">
                        {{ $this->university?->slug ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">University Email</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white break-all">
                        {{ $this->university?->email ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">University Mobile</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">
                        {{ $this->university?->mobile ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Country</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">
                        {{ $this->university?->country ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">State</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">
                        {{ $this->university?->state ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">City</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">
                        {{ $this->university?->city ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Verification Status</p>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">
                        {{ $this->university?->is_verified ? 'Verified' : 'Not Verified' }}
                    </p>
                </div>
            </div>

            <div class="px-6 pb-6">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Description</p>
                <div class="rounded bg-gray-50 dark:bg-gray-800 p-4 text-sm text-gray-700 dark:text-gray-300 min-h-[100px]">
                    {{ $this->university?->description ?? 'No description available.' }}
                </div>
            </div>
        </div>

    </div>
</x-filament::page>