<x-app-layout>
<div class="prof-wrap bg-white p-4 rounded">

    {{-- Page Header --}}
    <div class="prof-header">
        <h1>👤 My Profile</h1>
        <p>Manage your account information and security settings.</p>
    </div>

    <div class="prof-grid">

        {{-- Left: Avatar Card --}}
        <div>
            <div class="prof-card prof-avatar-card">
                <div class="prof-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                </div>
                <div>
                    <div class="prof-avatar-name">{{ Auth::user()->name }}</div>
                    <div class="prof-avatar-email">{{ Auth::user()->email }}</div>
                </div>
                <div class="prof-avatar-badge">
                    <svg style="width:12px;height:12px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/>
                    </svg>
                    University Admin
                </div>

                <div class="prof-divider"></div>

                <div style="width:100%">
                    <div class="prof-meta-row">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                        </svg>
                        {{ Auth::user()->email }}
                    </div>
                    <div class="prof-meta-row">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                        </svg>
                        Joined {{ Auth::user()->created_at?->format('M Y') ?? 'N/A' }}
                    </div>
                    <div class="prof-meta-row">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span style="color: #16a34a; font-weight: 600;">Account Active</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: Forms --}}
        <div class="prof-right">

            {{-- Update Profile Info --}}
            <div class="prof-card">
                <div class="prof-section-header">
                    <div class="prof-section-icon" style="background:#ede9fe;">✏️</div>
                    <div>
                        <div class="prof-section-title">Profile Information</div>
                        <div class="prof-section-desc">Update your name and email address.</div>
                    </div>
                </div>
                <div class="prof-section-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Update Password --}}
            <div class="prof-card">
                <div class="prof-section-header">
                    <div class="prof-section-icon" style="background:#d1fae5;">🔒</div>
                    <div>
                        <div class="prof-section-title">Update Password</div>
                        <div class="prof-section-desc">Use a strong password to keep your account secure.</div>
                    </div>
                </div>
                <div class="prof-section-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete Account --}}
            <div class="prof-card prof-danger-zone">
                <div class="prof-section-header">
                    <div class="prof-section-icon" style="background:#fee2e2;">⚠️</div>
                    <div>
                        <div class="prof-section-title" style="color:#dc2626;">Danger Zone</div>
                        <div class="prof-section-desc">Permanently delete your account. This cannot be undone.</div>
                    </div>
                </div>
                <div class="prof-section-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</div>

</x-app-layout>