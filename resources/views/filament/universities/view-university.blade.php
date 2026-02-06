<x-filament::page>
    <div>

        {{-- ================= UNIVERSITY INFO ================= --}}
        <div style="margin-bottom: 60px;"> {{-- 🔥 GAP HERE --}}
            <x-filament::section heading="University Information">
                <div>

                    <div style="display:flex; justify-content:space-between; border-bottom:1px solid #e5e7eb; padding-bottom:8px; margin-bottom:12px;">
                        <strong>University Name</strong>
                        <span>{{ $record->name }}</span>
                    </div>

                    <div style="display:flex; justify-content:space-between; border-bottom:1px solid #e5e7eb; padding-bottom:8px; margin-bottom:12px;">
                        <strong>Email</strong>
                        <span>{{ $record->email }}</span>
                    </div>

                    <div style="display:flex; justify-content:space-between; border-bottom:1px solid #e5e7eb; padding-bottom:8px; margin-bottom:12px;">
                        <strong>Mobile</strong>
                        <span>{{ $record->mobile }}</span>
                    </div>

                    <div style="display:flex; justify-content:space-between; border-bottom:1px solid #e5e7eb; padding-bottom:8px; margin-bottom:12px;">
                        <strong>Slug</strong>
                        <span>{{ $record->slug ?? '-' }}</span>
                    </div>

                    <div style="display:flex; justify-content:space-between; border-bottom:1px solid #e5e7eb; padding-bottom:8px; margin-bottom:12px;">
                        <strong>Status</strong>
                        <span style="color: {{ $record->is_verified ? '#16a34a' : '#ca8a04' }};">
                            {{ $record->is_verified ? 'Verified' : 'Pending' }}
                        </span>
                    </div>

                    <div style="display:flex; justify-content:space-between;">
                        <strong>Created At</strong>
                        <span>{{ $record->created_at->format('d M Y') }}</span>
                    </div>

                </div>
            </x-filament::section>
        </div>

        {{-- ================= USER INFO ================= --}}
        <div style="margin-top: 60px;"> {{-- 🔥 GAP HERE --}}
            <x-filament::section heading="Linked User Account">
                @if ($record->user)

                    <div style="display:flex; justify-content:space-between; border-bottom:1px solid #e5e7eb; padding-bottom:8px; margin-bottom:12px;">
                        <strong>User Name</strong>
                        <span>{{ $record->user->name }}</span>
                    </div>

                    <div style="display:flex; justify-content:space-between; border-bottom:1px solid #e5e7eb; padding-bottom:8px; margin-bottom:12px;">
                        <strong>User Email</strong>
                        <span>{{ $record->user->email }}</span>
                    </div>

                    <div style="display:flex; justify-content:space-between; border-bottom:1px solid #e5e7eb; padding-bottom:8px; margin-bottom:12px;">
                        <strong>Role</strong>
                        <span>{{ ucfirst($record->user->role ?? '-') }}</span>
                    </div>

                    <div style="display:flex; justify-content:space-between;">
                        <strong>User Created</strong>
                        <span>{{ $record->user->created_at->format('d M Y') }}</span>
                    </div>

                @else
                    <p>No user linked with this university.</p>
                @endif
            </x-filament::section>
        </div>

    </div>
</x-filament::page>
