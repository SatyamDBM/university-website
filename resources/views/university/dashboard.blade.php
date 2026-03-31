<x-app-layout>
<div class="uni-wrap bg-white p-4 rounded">

    <!-- Header -->
    <div class="uni-header">
        <div class="uni-header-left">
            <h1>🏫 University Dashboard</h1>
            <p>Welcome back! Here's your university overview for today.</p>
        </div>
        <div class="uni-header-right">
            <div class="uni-badge">
                <span class="live-dot"></span>
                Portal Live
            </div>
            <div class="uni-badge">
                📅 {{ now()->format('d M Y') }}
            </div>
            <div class="uni-badge">
                🏛️ My University
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

    <!-- KPI Cards -->
    <div class="uni-kpi-grid">

        <div class="uni-kpi-card c-purple">
            <div class="uni-kpi-icon">📈</div>
            <div class="uni-kpi-body">
                <div class="uni-kpi-label">Total Leads</div>
                <div class="uni-kpi-value">248</div>
                <div class="uni-kpi-sub up">↑ +18% this month</div>
            </div>
        </div>

        <div class="uni-kpi-card c-green">
            <div class="uni-kpi-icon">✅</div>
            <div class="uni-kpi-body">
                <div class="uni-kpi-label">Converted Leads</div>
                <div class="uni-kpi-value">61</div>
                <div class="uni-kpi-sub up">↑ 24.6% conv. rate</div>
            </div>
        </div>

        <div class="uni-kpi-card c-amber">
            <div class="uni-kpi-icon">⏳</div>
            <div class="uni-kpi-body">
                <div class="uni-kpi-label">Pending Leads</div>
                <div class="uni-kpi-value">32</div>
                <div class="uni-kpi-sub warn">⚠ Needs follow-up</div>
            </div>
        </div>

        <div class="uni-kpi-card c-blue">
            <div class="uni-kpi-icon">💰</div>
            <div class="uni-kpi-body">
                <div class="uni-kpi-label">Revenue</div>
                <div class="uni-kpi-value">₹1.2L</div>
                <div class="uni-kpi-sub up">↑ +9% from last month</div>
            </div>
        </div>

        <div class="uni-kpi-card c-indigo">
            <div class="uni-kpi-icon">📚</div>
            <div class="uni-kpi-body">
                <div class="uni-kpi-label">Total Courses</div>
                <div class="uni-kpi-value">34</div>
                <div class="uni-kpi-sub info">ℹ 4 added this month</div>
            </div>
        </div>

        <div class="uni-kpi-card c-teal">
            <div class="uni-kpi-icon">💳</div>
            <div class="uni-kpi-body">
                <div class="uni-kpi-label">Active Plan</div>
                <div class="uni-kpi-value">Premium</div>
                <div class="uni-kpi-sub info">ℹ Expires in 42 days</div>
            </div>
        </div>

        <div class="uni-kpi-card c-pink">
            <div class="uni-kpi-icon">🖼️</div>
            <div class="uni-kpi-body">
                <div class="uni-kpi-label">Active Banners</div>
                <div class="uni-kpi-value">5</div>
                <div class="uni-kpi-sub warn">⚠ 2 pending approval</div>
            </div>
        </div>

        <div class="uni-kpi-card c-red">
            <div class="uni-kpi-icon">💸</div>
            <div class="uni-kpi-body">
                <div class="uni-kpi-label">Transactions</div>
                <div class="uni-kpi-value">18</div>
                <div class="uni-kpi-sub up">↑ ₹28K this week</div>
            </div>
        </div>

    </div>

    <!-- Bottom Grid -->
    <div class="uni-bottom-grid">

        <!-- Recent Activity -->
        <div class="uni-card">
            <div class="uni-card-header">
                <h3 class="uni-card-title">
                    <span class="uni-card-icon" style="background:#eef2ff;">🕐</span>
                    Recent Activity
                </h3>
                <a href="#" class="uni-btn-sm">View All →</a>
            </div>
            <div class="uni-activity-list">
                <div class="uni-activity-item">
                    <div class="uni-activity-dot" style="background:#ede9fe;">📈</div>
                    <div class="uni-activity-body">
                        <strong>New Lead Received</strong>
                        <span>A student enquired about B.Tech CSE admission.</span>
                    </div>
                    <div class="uni-activity-time">3m ago</div>
                </div>
                <div class="uni-activity-item">
                    <div class="uni-activity-dot" style="background:#d1fae5;">✅</div>
                    <div class="uni-activity-body">
                        <strong>Lead Converted</strong>
                        <span>Rahul Sharma confirmed admission for MBA 2025.</span>
                    </div>
                    <div class="uni-activity-time">15m ago</div>
                </div>
                <div class="uni-activity-item">
                    <div class="uni-activity-dot" style="background:#fce7f3;">🖼️</div>
                    <div class="uni-activity-body">
                        <strong>Banner Submitted</strong>
                        <span>2 banners submitted for admin approval.</span>
                    </div>
                    <div class="uni-activity-time">1h ago</div>
                </div>
                <div class="uni-activity-item">
                    <div class="uni-activity-dot" style="background:#e0f2fe;">💰</div>
                    <div class="uni-activity-body">
                        <strong>Payment Received</strong>
                        <span>₹15,000 subscription payment confirmed.</span>
                    </div>
                    <div class="uni-activity-time">2h ago</div>
                </div>
                <div class="uni-activity-item">
                    <div class="uni-activity-dot" style="background:#fef3c7;">📚</div>
                    <div class="uni-activity-body">
                        <strong>New Course Added</strong>
                        <span>B.Sc Data Science added to course listing.</span>
                    </div>
                    <div class="uni-activity-time">3h ago</div>
                </div>
                <div class="uni-activity-item">
                    <div class="uni-activity-dot" style="background:#ccfbf1;">📋</div>
                    <div class="uni-activity-body">
                        <strong>Lead Status Updated</strong>
                        <span>8 leads moved to "Follow-up" stage.</span>
                    </div>
                    <div class="uni-activity-time">5h ago</div>
                </div>
            </div>
        </div>

        <!-- Revenue + Lead Funnel -->
        <div style="display:flex; flex-direction:column; gap:.85rem;">

            <!-- Revenue Summary -->
            <div class="uni-card">
                <div class="uni-card-header">
                    <h3 class="uni-card-title">
                        <span class="uni-card-icon" style="background:#d1fae5;">💹</span>
                        Revenue Overview
                    </h3>
                    <a href="#" class="uni-btn-sm">Reports →</a>
                </div>
                <div class="uni-mini-chart">
                    <div class="uni-mini-bar" style="height:35%"></div>
                    <div class="uni-mini-bar" style="height:52%"></div>
                    <div class="uni-mini-bar" style="height:42%"></div>
                    <div class="uni-mini-bar" style="height:68%"></div>
                    <div class="uni-mini-bar" style="height:58%"></div>
                    <div class="uni-mini-bar" style="height:82%"></div>
                    <div class="uni-mini-bar" style="height:70%"></div>
                    <div class="uni-mini-bar" style="height:91%"></div>
                    <div class="uni-mini-bar" style="height:78%"></div>
                    <div class="uni-mini-bar" style="height:100%"></div>
                </div>
                <div class="uni-rev-list">
                    <div class="uni-rev-row">
                        <div class="uni-rev-left">
                            <span class="uni-rev-icon">💳</span>
                            <div>
                                <div class="uni-rev-label">This Month</div>
                                <div class="uni-rev-sub">Successful payments</div>
                            </div>
                        </div>
                        <div>
                            <span class="uni-rev-val">₹1,25,000</span>
                            <span class="uni-rev-badge up">+9%</span>
                        </div>
                    </div>
                    <div class="uni-rev-row">
                        <div class="uni-rev-left">
                            <span class="uni-rev-icon">📆</span>
                            <div>
                                <div class="uni-rev-label">This Week</div>
                                <div class="uni-rev-sub">Current week revenue</div>
                            </div>
                        </div>
                        <div>
                            <span class="uni-rev-val">₹28,000</span>
                            <span class="uni-rev-badge up">+14%</span>
                        </div>
                    </div>
                    <div class="uni-rev-row">
                        <div class="uni-rev-left">
                            <span class="uni-rev-icon">⚠️</span>
                            <div>
                                <div class="uni-rev-label">Pending</div>
                                <div class="uni-rev-sub">Awaiting clearance</div>
                            </div>
                        </div>
                        <div>
                            <span class="uni-rev-val">₹8,500</span>
                            <span class="uni-rev-badge down">3 pending</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lead Funnel -->
            <div class="uni-card">
                <div class="uni-card-header">
                    <h3 class="uni-card-title">
                        <span class="uni-card-icon" style="background:#ffedd5;">🎯</span>
                        Lead Funnel
                    </h3>
                </div>
                <div class="uni-funnel-list">
                    <div class="uni-funnel-row">
                        <span class="uni-funnel-label">New</span>
                        <div class="uni-funnel-bar-wrap"><div class="uni-funnel-bar" style="width:100%;background:linear-gradient(90deg,#6366f1,#818cf8);"></div></div>
                        <span class="uni-funnel-count">248</span>
                    </div>
                    <div class="uni-funnel-row">
                        <span class="uni-funnel-label">Contacted</span>
                        <div class="uni-funnel-bar-wrap"><div class="uni-funnel-bar" style="width:74%;background:linear-gradient(90deg,#0ea5e9,#38bdf8);"></div></div>
                        <span class="uni-funnel-count">184</span>
                    </div>
                    <div class="uni-funnel-row">
                        <span class="uni-funnel-label">Interested</span>
                        <div class="uni-funnel-bar-wrap"><div class="uni-funnel-bar" style="width:54%;background:linear-gradient(90deg,#10b981,#34d399);"></div></div>
                        <span class="uni-funnel-count">134</span>
                    </div>
                    <div class="uni-funnel-row">
                        <span class="uni-funnel-label">Follow-up</span>
                        <div class="uni-funnel-bar-wrap"><div class="uni-funnel-bar" style="width:36%;background:linear-gradient(90deg,#f59e0b,#fbbf24);"></div></div>
                        <span class="uni-funnel-count">89</span>
                    </div>
                    <div class="uni-funnel-row">
                        <span class="uni-funnel-label">Converted</span>
                        <div class="uni-funnel-bar-wrap"><div class="uni-funnel-bar" style="width:25%;background:linear-gradient(90deg,#ec4899,#f472b6);"></div></div>
                        <span class="uni-funnel-count">61</span>
                    </div>
                    <div class="uni-funnel-row">
                        <span class="uni-funnel-label">Pending</span>
                        <div class="uni-funnel-bar-wrap"><div class="uni-funnel-bar" style="width:13%;background:linear-gradient(90deg,#ef4444,#f87171);"></div></div>
                        <span class="uni-funnel-count">32</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Quick Actions + Top Courses -->
        <div style="display:flex; flex-direction:column; gap:.85rem;">

            <!-- Quick Actions -->
            <div class="uni-card">
                <div class="uni-card-header">
                    <h3 class="uni-card-title">
                        <span class="uni-card-icon" style="background:#eef2ff;">⚡</span>
                        Quick Actions
                    </h3>
                </div>
                <div class="uni-qa-grid">
                    <button class="uni-qa-btn qa-purple" onclick="window.location.href='#'">
                        <span class="qa-icon">📈</span>
                        View Leads
                    </button>
                    <button class="uni-qa-btn qa-blue" onclick="window.location.href='#'">
                        <span class="qa-icon">📚</span>
                        Manage Courses
                    </button>
                    <button class="uni-qa-btn qa-green" onclick="window.location.href='#'">
                        <span class="qa-icon">💳</span>
                        Subscription
                    </button>
                    <button class="uni-qa-btn qa-amber" onclick="window.location.href='#'">
                        <span class="qa-icon">🖼️</span>
                        Banners
                    </button>
                    <button class="uni-qa-btn qa-teal" onclick="window.location.href='#'">
                        <span class="qa-icon">📊</span>
                        Reports
                    </button>
                    <button class="uni-qa-btn qa-slate" onclick="window.location.href='#'">
                        <span class="qa-icon">⚙️</span>
                        Settings
                    </button>
                </div>
            </div>

            <!-- Top Courses Table -->
            <div class="uni-card" style="flex:1;">
                <div class="uni-card-header">
                    <h3 class="uni-card-title">
                        <span class="uni-card-icon" style="background:#d1fae5;">🏆</span>
                        Top Courses
                    </h3>
                    <a href="#" class="uni-btn-sm">View All →</a>
                </div>
                <table class="uni-course-table">
                    <thead>
                        <tr>
                            <th>Course</th>
                            <th>Leads</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>B.Tech CSE</td>
                            <td>68</td>
                            <td><span class="uni-pill pill-green">Active</span></td>
                        </tr>
                        <tr>
                            <td>MBA</td>
                            <td>54</td>
                            <td><span class="uni-pill pill-green">Active</span></td>
                        </tr>
                        <tr>
                            <td>BCA</td>
                            <td>41</td>
                            <td><span class="uni-pill pill-blue">Popular</span></td>
                        </tr>
                        <tr>
                            <td>B.Sc Data Sci.</td>
                            <td>29</td>
                            <td><span class="uni-pill pill-purple">New</span></td>
                        </tr>
                        <tr>
                            <td>B.Com</td>
                            <td>22</td>
                            <td><span class="uni-pill pill-green">Active</span></td>
                        </tr>
                        <tr>
                            <td>LLB</td>
                            <td>11</td>
                            <td><span class="uni-pill pill-amber">Low Traffic</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
</x-app-layout>