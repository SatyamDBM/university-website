<x-app-layout>
    <div class="p-6" style="background:#f8fafc; min-height:100vh;">

        {{-- Header --}}
        <div style="margin-bottom:24px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;">
            <div>
                <h1 style="font-size:22px; font-weight:700; color:#1e293b; margin:0;">University Dashboard</h1>
                <p style="font-size:13px; color:#94a3b8; margin:4px 0 0;">Welcome back! Here's what's happening today.</p>
            </div>
            <div style="display:flex; gap:8px; flex-wrap:wrap;">
                <span style="display:inline-flex; align-items:center; gap:6px; font-size:13px; color:#475569; border:1px solid #e2e8f0; border-radius:8px; padding:6px 12px; background:#fff;">
                    <span style="width:8px; height:8px; border-radius:50%; background:#22c55e; display:inline-block;"></span> System Live
                </span>
                <span style="display:inline-flex; align-items:center; gap:6px; font-size:13px; color:#475569; border:1px solid #e2e8f0; border-radius:8px; padding:6px 12px; background:#fff;">
                    📅 {{ now()->format('d M Y') }}
                </span>
            </div>
        </div>

        {{-- Row 1: 4 Cards --}}
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:16px;">

            <div style="background:#fff; border-radius:12px; border:1px solid #e2e8f0; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                <div style="height:4px; background:#3b82f6;"></div>
                <div style="padding:16px; display:flex; align-items:center; gap:12px;">
                    <div style="width:44px; height:44px; border-radius:50%; background:#eff6ff; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0;">🏫</div>
                    <div>
                        <p style="font-size:10px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 2px;">Total Courses</p>
                        <p style="font-size:26px; font-weight:700; color:#1e293b; margin:0; line-height:1;">{{ $totalCourses ?? 0 }}</p>
                        <p style="font-size:11px; color:#22c55e; margin:3px 0 0;">↑ +0 added this week</p>
                    </div>
                </div>
            </div>

            <div style="background:#fff; border-radius:12px; border:1px solid #e2e8f0; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                <div style="height:4px; background:#22c55e;"></div>
                <div style="padding:16px; display:flex; align-items:center; gap:12px;">
                    <div style="width:44px; height:44px; border-radius:50%; background:#f0fdf4; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0;">👨‍🎓</div>
                    <div>
                        <p style="font-size:10px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 2px;">Total Students</p>
                        <p style="font-size:26px; font-weight:700; color:#1e293b; margin:0; line-height:1;">{{ $totalStudents ?? 0 }}</p>
                        <p style="font-size:11px; color:#22c55e; margin:3px 0 0;">↑ +0% this week</p>
                    </div>
                </div>
            </div>

            <div style="background:#fff; border-radius:12px; border:1px solid #e2e8f0; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                <div style="height:4px; background:#facc15;"></div>
                <div style="padding:16px; display:flex; align-items:center; gap:12px;">
                    <div style="width:44px; height:44px; border-radius:50%; background:#fefce8; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0;">📄</div>
                    <div>
                        <p style="font-size:10px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 2px;">Applications</p>
                        <p style="font-size:26px; font-weight:700; color:#1e293b; margin:0; line-height:1;">{{ $totalApplications ?? 0 }}</p>
                        <p style="font-size:11px; color:#eab308; margin:3px 0 0;">⚠ 0 pending renewals</p>
                    </div>
                </div>
            </div>

            <div style="background:#fff; border-radius:12px; border:1px solid #e2e8f0; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                <div style="height:4px; background:#ef4444;"></div>
                <div style="padding:16px; display:flex; align-items:center; gap:12px;">
                    <div style="width:44px; height:44px; border-radius:50%; background:#fef2f2; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0;">⏳</div>
                    <div>
                        <p style="font-size:10px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 2px;">Pending Requests</p>
                        <p style="font-size:26px; font-weight:700; color:#1e293b; margin:0; line-height:1;">{{ $pendingApplications ?? 0 }}</p>
                        <p style="font-size:11px; color:#ef4444; margin:3px 0 0;">⚡ Needs attention</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Row 2: 4 Cards --}}
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:16px;">

            <div style="background:#fff; border-radius:12px; border:1px solid #e2e8f0; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                <div style="height:4px; background:#06b6d4;"></div>
                <div style="padding:16px; display:flex; align-items:center; gap:12px;">
                    <div style="width:44px; height:44px; border-radius:50%; background:#ecfeff; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0;">👥</div>
                    <div>
                        <p style="font-size:10px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 2px;">Active Users</p>
                        <p style="font-size:26px; font-weight:700; color:#1e293b; margin:0; line-height:1;">{{ $activeUsers ?? 0 }}</p>
                        <p style="font-size:11px; color:#22c55e; margin:3px 0 0;">↑ +2 new today</p>
                    </div>
                </div>
            </div>

            <div style="background:#fff; border-radius:12px; border:1px solid #e2e8f0; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                <div style="height:4px; background:#10b981;"></div>
                <div style="padding:16px; display:flex; align-items:center; gap:12px;">
                    <div style="width:44px; height:44px; border-radius:50%; background:#ecfdf5; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0;">✅</div>
                    <div>
                        <p style="font-size:10px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 2px;">Converted Leads</p>
                        <p style="font-size:26px; font-weight:700; color:#1e293b; margin:0; line-height:1;">{{ $convertedLeads ?? 0 }}</p>
                        <p style="font-size:11px; color:#22c55e; margin:3px 0 0;">↑ 0% conv. rate</p>
                    </div>
                </div>
            </div>

            <div style="background:#fff; border-radius:12px; border:1px solid #e2e8f0; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                <div style="height:4px; background:#a855f7;"></div>
                <div style="padding:16px; display:flex; align-items:center; gap:12px;">
                    <div style="width:44px; height:44px; border-radius:50%; background:#faf5ff; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0;">📋</div>
                    <div>
                        <p style="font-size:10px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 2px;">Active Plans</p>
                        <p style="font-size:26px; font-weight:700; color:#1e293b; margin:0; line-height:1;">{{ $activePlans ?? 0 }}</p>
                        <p style="font-size:11px; color:#94a3b8; margin:3px 0 0;">ℹ 0 expire this week</p>
                    </div>
                </div>
            </div>

            <div style="background:#fff; border-radius:12px; border:1px solid #e2e8f0; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                <div style="height:4px; background:#60a5fa;"></div>
                <div style="padding:16px; display:flex; align-items:center; gap:12px;">
                    <div style="width:44px; height:44px; border-radius:50%; background:#eff6ff; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0;">🌐</div>
                    <div>
                        <p style="font-size:10px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 2px;">Page Views</p>
                        <p style="font-size:26px; font-weight:700; color:#1e293b; margin:0; line-height:1;">{{ $pageViews ?? 0 }}</p>
                        <p style="font-size:11px; color:#22c55e; margin:3px 0 0;">↑ +0% vs last week</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Row 3: 4 Cards --}}
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px;">

            <div style="background:#fff; border-radius:12px; border:1px solid #e2e8f0; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                <div style="height:4px; background:#ec4899;"></div>
                <div style="padding:16px; display:flex; align-items:center; gap:12px;">
                    <div style="width:44px; height:44px; border-radius:50%; background:#fdf2f8; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0;">💰</div>
                    <div>
                        <p style="font-size:10px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 2px;">Revenue</p>
                        <p style="font-size:26px; font-weight:700; color:#1e293b; margin:0; line-height:1;">₹ {{ $revenue ?? 0 }}</p>
                        <p style="font-size:11px; color:#22c55e; margin:3px 0 0;">↑ +0% from last month</p>
                    </div>
                </div>
            </div>

            <div style="background:#fff; border-radius:12px; border:1px solid #e2e8f0; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                <div style="height:4px; background:#f97316;"></div>
                <div style="padding:16px; display:flex; align-items:center; gap:12px;">
                    <div style="width:44px; height:44px; border-radius:50%; background:#fff7ed; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0;">💳</div>
                    <div>
                        <p style="font-size:10px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 2px;">Subscriptions</p>
                        <p style="font-size:26px; font-weight:700; color:#1e293b; margin:0; line-height:1;">{{ $subscriptions ?? 0 }}</p>
                        <p style="font-size:11px; color:#eab308; margin:3px 0 0;">⚠ 0 pending renewals</p>
                    </div>
                </div>
            </div>

            <div style="background:#fff; border-radius:12px; border:1px solid #e2e8f0; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                <div style="height:4px; background:#d946ef;"></div>
                <div style="padding:16px; display:flex; align-items:center; gap:12px;">
                    <div style="width:44px; height:44px; border-radius:50%; background:#fdf4ff; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0;">💸</div>
                    <div>
                        <p style="font-size:10px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 2px;">Transactions</p>
                        <p style="font-size:26px; font-weight:700; color:#1e293b; margin:0; line-height:1;">{{ $transactions ?? 0 }}</p>
                        <p style="font-size:11px; color:#22c55e; margin:3px 0 0;">↑ ₹0 this week</p>
                    </div>
                </div>
            </div>

            <div style="background:#fff; border-radius:12px; border:1px solid #e2e8f0; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.06);">
                <div style="height:4px; background:#14b8a6;"></div>
                <div style="padding:16px; display:flex; align-items:center; gap:12px;">
                    <div style="width:44px; height:44px; border-radius:50%; background:#f0fdfa; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0;">🖼️</div>
                    <div>
                        <p style="font-size:10px; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 2px;">Banners Live</p>
                        <p style="font-size:26px; font-weight:700; color:#1e293b; margin:0; line-height:1;">{{ $bannersLive ?? 0 }}</p>
                        <p style="font-size:11px; color:#94a3b8; margin:3px 0 0;">ℹ 0 approval pending</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>