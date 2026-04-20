<x-filament-panels::page>
    <div class="space-y-4">

        {{-- Header --}}
        <div class="mb-4 flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                    All Notifications
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    View and manage all your recent notifications here.
                </p>
            </div>
        </div>

        @forelse($this->notifications as $notification)
            <div
                wire:key="notification-{{ $notification->id }}"
                style="
                    background: #ffffff;
                    border: 1px solid #eef2f7;
                    border-radius: 5px;
                    padding: 1.1rem 1.25rem;
                    box-shadow: 0 1px 4px rgba(15,23,42,0.04);
                    transition: box-shadow 0.2s, border-color 0.2s;
                "
                onmouseenter="this.style.boxShadow='0 4px 16px rgba(119,80,66,0.10)'; this.style.borderColor='#d4b8ae';"
                onmouseleave="this.style.boxShadow='0 1px 4px rgba(15,23,42,0.04)'; this.style.borderColor='#eef2f7';"
            >
                <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:1rem;">

                    {{-- Left: Icon + Content --}}
                    <div
                        style="display:flex; align-items:flex-start; gap:1rem; flex:1; cursor:pointer;"
                        wire:click="openNotification({{ $notification->id }})"
                    >
                        {{-- Bell Icon --}}
                        <div style="
                            width: 42px; height: 42px; border-radius: 10px; flex-shrink:0;
                            display:flex; align-items:center; justify-content:center;
                            background: {{ $notification->is_read ? '#f8fafc' : '#f5eeeb' }};
                            border: 1px solid {{ $notification->is_read ? '#e5e7eb' : '#d4b8ae' }};
                        ">
                            @if (! $notification->is_read)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width:18px; height:18px; color:#775042;">
                                    <path d="M5.85 3.5a.75.75 0 0 0-1.117-1 9.719 9.719 0 0 0-2.348 4.876.75.75 0 0 0 1.479.248A8.219 8.219 0 0 1 5.85 3.5ZM19.267 2.5a.75.75 0 1 0-1.118 1 8.22 8.22 0 0 1 1.987 4.124.75.75 0 0 0 1.48-.248A9.72 9.72 0 0 0 19.266 2.5Z" />
                                    <path fill-rule="evenodd" d="M12 2.25A6.75 6.75 0 0 0 5.25 9v.75a8.217 8.217 0 0 1-2.119 5.52.75.75 0 0 0 .298 1.206c1.544.57 3.16.99 4.831 1.243a3.75 3.75 0 1 0 7.48 0 24.583 24.583 0 0 0 4.83-1.244.75.75 0 0 0 .298-1.205 8.217 8.217 0 0 1-2.118-5.52V9A6.75 6.75 0 0 0 12 2.25ZM9.75 18c0-.034 0-.067.002-.1a25.05 25.05 0 0 0 4.496 0l.002.1a2.25 2.25 0 1 1-4.5 0Z" clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width:18px; height:18px; color:#9ca3af;">
                                    <path d="M17.25 9.75A5.25 5.25 0 0 0 6.75 9v.75a8.217 8.217 0 0 1-2.119 5.52.75.75 0 0 0 .298 1.206c1.544.57 3.16.99 4.831 1.243a3.75 3.75 0 1 0 7.48 0 24.583 24.583 0 0 0 4.83-1.244.75.75 0 0 0 .298-1.205 8.217 8.217 0 0 1-2.118-5.52V9Z" />
                                </svg>
                            @endif
                        </div>

                        {{-- Text Content --}}
                        <div style="flex:1; min-width:0;">
                            <div style="display:flex; flex-wrap:wrap; align-items:center; gap:8px; margin-bottom:4px;">
                                <span style="font-size:0.9rem; font-weight:700; color:#111827;">
                                    {{ $notification->title }}
                                </span>

                                @if (! $notification->is_read)
                                    <span style="
                                        display:inline-flex; align-items:center;
                                        background:#f5eeeb; color:#775042;
                                        border: 1px solid #d4b8ae;
                                        border-radius:20px;
                                        padding:2px 10px;
                                        font-size:0.68rem; font-weight:700;
                                        letter-spacing:0.03em;
                                    ">New</span>
                                @endif
                            </div>

                            <p style="font-size:0.83rem; color:#475569; line-height:1.6; margin:0 0 8px;">
                                {{ $notification->message }}
                            </p>

                            <div style="display:flex; flex-wrap:wrap; align-items:center; gap:8px;">

                                {{-- Date --}}
                                <span style="font-size:0.72rem; color:#9ca3af; font-family:'JetBrains Mono',monospace;">
                                    {{ $notification->created_at?->format('d M Y, h:i A') }}
                                </span>

                                {{-- Read/Unread Badge --}}
                                @if ($notification->is_read)
                                    <span style="
                                        display:inline-flex; align-items:center;
                                        background:#f1f5f9; color:#64748b;
                                        border:1px solid #e2e8f0;
                                        border-radius:20px;
                                        padding:2px 10px;
                                        font-size:0.68rem; font-weight:600;
                                    ">Read</span>
                                @else
                                    <span style="
                                        display:inline-flex; align-items:center;
                                        background:#fffbeb; color:#92400e;
                                        border:1px solid #fde68a;
                                        border-radius:20px;
                                        padding:2px 10px;
                                        font-size:0.68rem; font-weight:700;
                                    ">Unread</span>
                                @endif

                                {{-- Open Link --}}
                                @if (! empty($notification->action_url))
                                    <span style="
                                        display:inline-flex; align-items:center; gap:4px;
                                        font-size:0.72rem; font-weight:600; color:#775042;
                                    ">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            style="width:13px; height:13px;">
                                            <path fill-rule="evenodd" d="M4.25 5.5a.75.75 0 0 0-.75.75v8.5c0 .414.336.75.75.75h8.5a.75.75 0 0 0 .75-.75v-4a.75.75 0 0 1 1.5 0v4A2.25 2.25 0 0 1 12.75 17h-8.5A2.25 2.25 0 0 1 2 14.75v-8.5A2.25 2.25 0 0 1 4.25 4h5a.75.75 0 0 1 0 1.5h-5Z" clip-rule="evenodd" />
                                            <path fill-rule="evenodd" d="M6.194 12.753a.75.75 0 0 0 1.06.053L16.5 4.44v2.81a.75.75 0 0 0 1.5 0v-4.5a.75.75 0 0 0-.75-.75h-4.5a.75.75 0 0 0 0 1.5h2.553l-9.056 8.194a.75.75 0 0 0-.053 1.06Z" clip-rule="evenodd" />
                                        </svg>
                                        Open
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Right: Button --}}
                    <div style="flex-shrink:0; align-self:center;">
                        @if (! $notification->is_read)
                            <button
                                type="button"
                                wire:click.stop="markAsRead({{ $notification->id }})"
                                style="
                                    display:inline-flex; align-items:center; justify-content:center;
                                    background:#775042; color:#ffffff;
                                    border:none; border-radius:5px;
                                    padding:8px 16px;
                                    font-size:0.78rem; font-weight:600;
                                    cursor:pointer;
                                    box-shadow:0 2px 8px rgba(119,80,66,0.18);
                                    transition:all 0.2s ease;
                                    white-space:nowrap;
                                "
                                onmouseenter="this.style.background='#5e3d31'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(119,80,66,0.28)';"
                                onmouseleave="this.style.background='#775042'; this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(119,80,66,0.18)';"
                            >
                                Mark as Read
                            </button>
                        @else
                            <button
                                type="button"
                                disabled
                                style="
                                    display:inline-flex; align-items:center; justify-content:center;
                                    background:#f1f5f9; color:#94a3b8;
                                    border:1px solid #e2e8f0; border-radius:5px;
                                    padding:8px 16px;
                                    font-size:0.78rem; font-weight:600;
                                    cursor:not-allowed;
                                    white-space:nowrap;
                                "
                            >
                                Already Read
                            </button>
                        @endif
                    </div>

                </div>
            </div>
        @empty
            <div style="
                border: 1.5px dashed #d4b8ae;
                border-radius: 5px;
                background: #ffffff;
                padding: 3rem 1.5rem;
                text-align: center;
                box-shadow: 0 1px 4px rgba(15,23,42,0.04);
            ">
                <div style="display:flex; flex-direction:column; align-items:center; gap:12px;">
                    <div style="
                        width:56px; height:56px; border-radius:14px;
                        background:#f5eeeb; border:1px solid #d4b8ae;
                        display:flex; align-items:center; justify-content:center;
                    ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" style="width:26px; height:26px; color:#775042;">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                    </div>
                    <div>
                        <h3 style="font-size:1rem; font-weight:700; color:#111827; margin:0 0 6px;">
                            No Notifications Found
                        </h3>
                        <p style="font-size:0.82rem; color:#6b7280; margin:0;">
                            You currently do not have any notifications.
                        </p>
                    </div>
                </div>
            </div>
        @endforelse

    </div>
</x-filament-panels::page>