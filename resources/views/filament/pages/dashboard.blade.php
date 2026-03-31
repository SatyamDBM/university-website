<x-filament-panels::page>
<div class="dash-wrap">

    <!-- Header -->
    <div class="dash-header">
        <div class="dash-header-left">
            <h1>Admin Dashboard</h1>
            <p>Welcome back! Here's what's happening today.</p>
        </div>
        <div class="dash-header-right">
            <div class="dash-badge">
                <span class="dot"></span>
                System Live
            </div>
            <div class="dash-badge">
                📅 {{ now()->format('d M Y') }}
            </div>
        </div>
    </div>

    <!-- KPI Cards — Row 1 -->
    <div class="kpi-grid" style="margin-bottom:1rem;">

        <div class="kpi-card c-blue">
            <div class="kpi-icon">🎓</div>
            <div class="kpi-body">
                <div class="kpi-label">Total Universities</div>
                <div class="kpi-value">{{ $totalUniversities }}</div>
                <div class="kpi-sub up">↑ +12% this month</div>
            </div>
        </div>

        <div class="kpi-card c-green">
            <div class="kpi-icon">📈</div>
            <div class="kpi-body">
                <div class="kpi-label">Total Leads</div>
                <div class="kpi-value">0</div>
                <div class="kpi-sub up">↑ +0% this week</div>
            </div>
        </div>

        <div class="kpi-card c-amber">
            <div class="kpi-icon">💳</div>
            <div class="kpi-body">
                <div class="kpi-label">Subscriptions</div>
                <div class="kpi-value">0</div>
                <div class="kpi-sub warn">⚠ 0 pending renewals</div>
            </div>
        </div>

        <div class="kpi-card c-red">
            <div class="kpi-icon">💰</div>
            <div class="kpi-body">
                <div class="kpi-label">Revenue</div>
                <div class="kpi-value">₹ 0</div>
                <div class="kpi-sub up">↑ +0% from last month</div>
            </div>
        </div>

        <div class="kpi-card c-orange">
            <div class="kpi-icon">📩</div>
            <div class="kpi-body">
                <div class="kpi-label">Pending Leads</div>
                <div class="kpi-value">0</div>
                <div class="kpi-sub down">⚡ Needs attention</div>
            </div>
        </div>

        <div class="kpi-card c-cyan">
            <div class="kpi-icon">👥</div>
            <div class="kpi-body">
                <div class="kpi-label">Active Users</div>
                <div class="kpi-value">{{$activeUsers}}</div>
                <div class="kpi-sub up">↑ +{{$todayUsers}} new today</div>
            </div>
        </div>

        <div class="kpi-card c-purple">
            <div class="kpi-icon">🖼️</div>
            <div class="kpi-body">
                <div class="kpi-label">Banners Live</div>
                <div class="kpi-value">0</div>
                <div class="kpi-sub info">ℹ 0 approval pending</div>
            </div>
        </div>

        <div class="kpi-card c-pink">
            <div class="kpi-icon">💸</div>
            <div class="kpi-body">
                <div class="kpi-label">Transactions</div>
                <div class="kpi-value">0</div>
                <div class="kpi-sub up">↑ ₹ 0 this week</div>
            </div>
        </div>

        <div class="kpi-card c-indigo">
            <div class="kpi-icon">🏫</div>
            <div class="kpi-body">
                <div class="kpi-label">Total Courses</div>
                <div class="kpi-value">0</div>
                <div class="kpi-sub up">↑ +0 added this week</div>
            </div>
        </div>

        <div class="kpi-card c-teal">
            <div class="kpi-icon">✅</div>
            <div class="kpi-body">
                <div class="kpi-label">Converted Leads</div>
                <div class="kpi-value">0</div>
                <div class="kpi-sub up">↑ 0% conv. rate</div>
            </div>
        </div>

        <div class="kpi-card c-green">
            <div class="kpi-icon">📋</div>
            <div class="kpi-body">
                <div class="kpi-label">Active Plans</div>
                <div class="kpi-value">0</div>
                <div class="kpi-sub info">ℹ 0 expire this week</div>
            </div>
        </div>

        <div class="kpi-card c-blue">
            <div class="kpi-icon">🌐</div>
            <div class="kpi-body">
                <div class="kpi-label">Page Views</div>
                <div class="kpi-value">0</div>
                <div class="kpi-sub up">↑ +0 % vs last week</div>
            </div>
        </div>

    </div>

    <!-- Bottom Section -->
    <div class="bottom-grid">

        <!-- Recent Activity -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <span class="card-title-icon" style="background:#eef2ff; font-size:.9rem;">🕐</span>
                    Recent Activity
                </h3>
                <button class="btn-sm">View All →</button>
            </div>
            <div class="activity-list">
                <div class="activity-item">
                    <div class="activity-dot" style="background:#eff6ff;">🎓</div>
                    <div class="activity-body">
                        <strong>New University Added</strong>
                        <span>ABC University has been added to the platform.</span>
                    </div>
                    <div class="activity-time">2m ago</div>
                </div>
                <div class="activity-item">
                    <div class="activity-dot" style="background:#f0fdf4;">📈</div>
                    <div class="activity-body">
                        <strong>New Lead Received</strong>
                        <span>A student submitted an enquiry for B.Tech.</span>
                    </div>
                    <div class="activity-time">10m ago</div>
                </div>
                <div class="activity-item">
                    <div class="activity-dot" style="background:#faf5ff;">💳</div>
                    <div class="activity-body">
                        <strong>Subscription Activated</strong>
                        <span>Premium package activated for DIT University.</span>
                    </div>
                    <div class="activity-time">30m ago</div>
                </div>
                <div class="activity-item">
                    <div class="activity-dot" style="background:#fef2f2;">💰</div>
                    <div class="activity-body">
                        <strong>Payment Received</strong>
                        <span>Payment of ₹15,000 received successfully.</span>
                    </div>
                    <div class="activity-time">1h ago</div>
                </div>
                <div class="activity-item">
                    <div class="activity-dot" style="background:#ecfeff;">🖼️</div>
                    <div class="activity-body">
                        <strong>Banner Submitted for Review</strong>
                        <span>Amity University submitted 2 banners for approval.</span>
                    </div>
                    <div class="activity-time">2h ago</div>
                </div>
                <div class="activity-item">
                    <div class="activity-dot" style="background:#fff7ed;">📩</div>
                    <div class="activity-body">
                        <strong>Lead Status Updated</strong>
                        <span>5 leads moved to "Follow-up" stage.</span>
                    </div>
                    <div class="activity-time">3h ago</div>
                </div>
            </div>
        </div>

        <!-- Revenue + Lead Funnel -->
        <div style="display:flex; flex-direction:column; gap:1rem;">

            <!-- Revenue Summary -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <span class="card-title-icon" style="background:#f0fdf4;">💹</span>
                        Revenue & Monetization
                    </h3>
                    <button class="btn-sm">Reports →</button>
                </div>
                <!-- Mini sparkline -->
                <div class="mini-chart">
                    <div class="mini-bar" style="height:30%"></div>
                    <div class="mini-bar" style="height:50%"></div>
                    <div class="mini-bar" style="height:40%"></div>
                    <div class="mini-bar" style="height:70%"></div>
                    <div class="mini-bar" style="height:55%"></div>
                    <div class="mini-bar" style="height:80%"></div>
                    <div class="mini-bar" style="height:65%"></div>
                    <div class="mini-bar" style="height:90%"></div>
                    <div class="mini-bar" style="height:75%"></div>
                    <div class="mini-bar" style="height:100%"></div>
                </div>
                <div class="revenue-summary">
                    <div class="rev-row">
                        <div class="rev-row-left">
                            <span class="rev-icon">💳</span>
                            <div>
                                <div class="rev-label">Successful Payments</div>
                                <div class="rev-sub">This month</div>
                            </div>
                        </div>
                        <div>
                            <span class="rev-val">₹1,25,000</span>
                            <span class="rev-badge up">+9%</span>
                        </div>
                    </div>
                    <div class="rev-row">
                        <div class="rev-row-left">
                            <span class="rev-icon">📆</span>
                            <div>
                                <div class="rev-label">Weekly Revenue</div>
                                <div class="rev-sub">Current week</div>
                            </div>
                        </div>
                        <div>
                            <span class="rev-val">₹28,000</span>
                            <span class="rev-badge up">+14%</span>
                        </div>
                    </div>
                    <div class="rev-row">
                        <div class="rev-row-left">
                            <span class="rev-icon">⚠️</span>
                            <div>
                                <div class="rev-label">Pending Payments</div>
                                <div class="rev-sub">Awaiting clearance</div>
                            </div>
                        </div>
                        <div>
                            <span class="rev-val">₹8,500</span>
                            <span class="rev-badge down">4 pending</span>
                        </div>
                    </div>
                    <div class="rev-row">
                        <div class="rev-row-left">
                            <span class="rev-icon">✅</span>
                            <div>
                                <div class="rev-label">Active Subscriptions</div>
                                <div class="rev-sub">Across all plans</div>
                            </div>
                        </div>
                        <div>
                            <span class="rev-val">44</span>
                            <span class="rev-badge up">+3 new</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lead Funnel -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <span class="card-title-icon" style="background:#fff7ed;">🎯</span>
                        Lead Funnel
                    </h3>
                </div>
                <div class="funnel-list">
                    <div class="funnel-row">
                        <span class="funnel-label">New</span>
                        <div class="funnel-bar-wrap"><div class="funnel-bar" style="width:100%;background:linear-gradient(90deg,#6366f1,#818cf8);"></div></div>
                        <span class="funnel-count">860</span>
                    </div>
                    <div class="funnel-row">
                        <span class="funnel-label">Contacted</span>
                        <div class="funnel-bar-wrap"><div class="funnel-bar" style="width:72%;background:linear-gradient(90deg,#06b6d4,#22d3ee);"></div></div>
                        <span class="funnel-count">621</span>
                    </div>
                    <div class="funnel-row">
                        <span class="funnel-label">Interested</span>
                        <div class="funnel-bar-wrap"><div class="funnel-bar" style="width:52%;background:linear-gradient(90deg,#22c55e,#4ade80);"></div></div>
                        <span class="funnel-count">448</span>
                    </div>
                    <div class="funnel-row">
                        <span class="funnel-label">Follow-up</span>
                        <div class="funnel-bar-wrap"><div class="funnel-bar" style="width:38%;background:linear-gradient(90deg,#f59e0b,#fbbf24);"></div></div>
                        <span class="funnel-count">327</span>
                    </div>
                    <div class="funnel-row">
                        <span class="funnel-label">Converted</span>
                        <div class="funnel-bar-wrap"><div class="funnel-bar" style="width:23%;background:linear-gradient(90deg,#ec4899,#f472b6);"></div></div>
                        <span class="funnel-count">198</span>
                    </div>
                    <div class="funnel-row">
                        <span class="funnel-label">Pending</span>
                        <div class="funnel-bar-wrap"><div class="funnel-bar" style="width:4%;background:linear-gradient(90deg,#ef4444,#f87171);"></div></div>
                        <span class="funnel-count">32</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Quick Actions + Top Universities -->
        <div style="display:flex; flex-direction:column; gap:1rem;">

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <span class="card-title-icon" style="background:#eef2ff;">⚡</span>
                        Quick Actions
                    </h3>
                </div>
                <div class="qa-grid">
                    <button class="qa-btn qa-indigo" onclick="window.location.href='#'">
                        <span class="qa-icon">🎓</span>
                        Add University
                    </button>
                    <button class="qa-btn qa-green" onclick="window.location.href='#'">
                        <span class="qa-icon">📈</span>
                        Add Lead
                    </button>
                    <button class="qa-btn qa-amber" onclick="window.location.href='#'">
                        <span class="qa-icon">💳</span>
                        Subscriptions
                    </button>
                    <button class="qa-btn qa-rose" onclick="window.location.href='#'">
                        <span class="qa-icon">🖼️</span>
                        Manage Banners
                    </button>
                    <button class="qa-btn qa-teal" onclick="window.location.href='#'">
                        <span class="qa-icon">📊</span>
                        View Reports
                    </button>
                    <button class="qa-btn qa-slate" onclick="window.location.href='#'">
                        <span class="qa-icon">⚙️</span>
                        Settings
                    </button>
                </div>
            </div>

            <!-- Top Universities Table -->
            <div class="card" style="flex:1;">
                <div class="card-header">
                    <h3 class="card-title">
                        <span class="card-title-icon" style="background:#f0fdf4;">🏆</span>
                        Top Universities
                    </h3>
                    <button class="btn-sm">View All →</button>
                </div>
                <table class="uni-table">
                    <thead>
                        <tr>
                            <th>University</th>
                            <th>Leads</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Amity University</td>
                            <td>142</td>
                            <td><span class="status-pill pill-green">Active</span></td>
                        </tr>
                        <tr>
                            <td>LPU</td>
                            <td>118</td>
                            <td><span class="status-pill pill-green">Active</span></td>
                        </tr>
                        <tr>
                            <td>Sharda University</td>
                            <td>97</td>
                            <td><span class="status-pill pill-blue">Premium</span></td>
                        </tr>
                        <tr>
                            <td>Manipal University</td>
                            <td>85</td>
                            <td><span class="status-pill pill-green">Active</span></td>
                        </tr>
                        <tr>
                            <td>DIT University</td>
                            <td>61</td>
                            <td><span class="status-pill pill-amber">Trial</span></td>
                        </tr>
                        <tr>
                            <td>ABC University</td>
                            <td>14</td>
                            <td><span class="status-pill pill-red">Pending</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

</x-filament-panels::page>