<x-app-layout>

@php
    $status = auth()->user()->linking_status ?? 'not_linked';
    $isLocked = in_array($status, ['not_linked', 'pending', 'rejected']);
@endphp

{{-- ✅ If not linked, show the full linking page INSTEAD of dashboard --}}
@if($isLocked)

<div class="bg-gray-50 p-6">

    {{-- Page Title --}}
    <h2 class="text-xl font-semibold text-gray-800 mb-6">🔗 Link Your University</h2>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">

        @if($status === 'pending')
        {{-- Pending State --}}
        <div class="flex flex-col items-center justify-center py-16 text-center">
            <div class="text-6xl mb-4">⏳</div>
            <h3 class="text-xl font-bold text-gray-700 mb-2">Request Under Review</h3>
            <p class="text-gray-500 text-sm max-w-sm">
                Your university linking request has been submitted and is currently under admin review. You'll be notified once approved.
            </p>
        </div>

        @elseif($status === 'rejected')
        {{-- Rejected State --}}
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
            <p class="text-red-700 text-sm font-medium">⚠️ Your previous request was rejected. Please resubmit with correct details.</p>
        </div>
        @include('university.linking')

        @else
        {{-- Not Linked — show form --}}
        @include('university.linking')
        @endif

    </div>
</div>

@else
{{-- ✅ If linked, show the dashboard --}}
<div class="uni-wrap bg-white p-4 rounded">

    <!-- Header -->
    <div class="uni-header">
        <div class="uni-header-left">
            <h1>🏛️ University Dashboard</h1>
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
@endif
@if(session('success'))
    <div id="successModal" style="position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:9999;background:rgba(0,0,0,0.2);display:flex;align-items:center;justify-content:center;">
        <div style="background:#fff;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1);padding:32px 24px;max-width:350px;width:100%;text-align:center;position:relative;">
            <button onclick="document.getElementById('successModal').style.display='none'" style="position:absolute;top:8px;right:12px;background:none;border:none;font-size:22px;line-height:1;cursor:pointer;">&times;</button>
            <div style="margin-bottom:16px;">
                <div style="background:#e6f9ed;border-radius:50%;width:48px;height:48px;display:flex;align-items:center;justify-content:center;margin:0 auto;">
                    <span style="color:#22c55e;font-size:32px;">&#10003;</span>
                </div>
            </div>
            <div style="color:#22c55e;font-weight:600;font-size:18px;margin-bottom:8px;">SUCCESS</div>
            <div style="color:#222;font-size:16px;margin-bottom:8px;">Your university linking has been submitted!</div>
            <div style="color:#666;font-size:14px;margin-bottom:18px;">Once approved by the admin, you can access all the features</div>
            <button onclick="document.getElementById('successModal').style.display='none'" style="background:#6b4a36;color:#fff;padding:8px 32px;border:none;border-radius:6px;font-size:16px;cursor:pointer;">Done</button>
        </div>
    </div>
@endif
</x-app-layout>