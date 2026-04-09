<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\NavigationGroup;
use Filament\Support\Assets\Css;
use Illuminate\Support\Facades\Vite;
use Filament\Navigation\MenuItem;
use Illuminate\Support\Facades\DB;
use App\Models\UserNotification;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\HtmlString;

class AdminPanelProvider extends PanelProvider
{
    protected function getBranding(string $key): ?string
    {
        try {
            $value = DB::table('general_settings')
                ->where('group', 'branding')
                ->where('key', $key)
                ->value('value');

            return $value ?: null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    public function panel(Panel $panel): Panel
    {
        $brandLogo = $this->getBranding('admin_logo');
        $favicon = $this->getBranding('favicon');
        $brandName = $this->getBranding('brand_name');

        $panel = $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(\App\Filament\Pages\Auth\Login::class)
            ->passwordReset(\App\Filament\Pages\Auth\ForgotPassword::class)
            ->sidebarCollapsibleOnDesktop()
            ->topNavigation(false)
            ->darkMode(false)
            ->brandName($brandName ?? config('app.name'))
            ->brandLogoHeight('2.5rem')
            ->assets([
                Css::make('admin-theme', resource_path('css/filament/admin.css')),
                Css::make('app-css', Vite::asset('resources/css/app.css')),
            ])
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([])
            ->navigationGroups([
                NavigationGroup::make('Dashboard')
                    ->icon('heroicon-o-home'),

                NavigationGroup::make('Universities')
                    ->icon('heroicon-o-academic-cap'),

                NavigationGroup::make('Categories')
                    ->icon('heroicon-o-tag'),

                NavigationGroup::make('Universities Account')
                    ->icon('heroicon-o-building-library'),

                NavigationGroup::make('Leads')
                    ->icon('heroicon-o-chart-bar'),

                NavigationGroup::make('Subscriptions')
                    ->icon('heroicon-o-credit-card'),

                NavigationGroup::make('Banner Management')
                    ->icon('heroicon-o-photo'),

                NavigationGroup::make('Payments')
                    ->icon('heroicon-o-banknotes'),

                NavigationGroup::make('Notifications')
                    ->icon('heroicon-o-bell'),

                NavigationGroup::make('Settings')
                    ->icon('heroicon-o-cog-6-tooth'),
            ])
            ->renderHook(
                PanelsRenderHook::USER_MENU_BEFORE,
                function (): string {

                    $notifications = UserNotification::where('user_id', auth()->id())
                        ->latest()
                        ->take(5)
                        ->get();

                    $unreadCount = UserNotification::where('user_id', auth()->id())
                        ->where('is_read', 0)
                        ->count();

                    $html = '
                    <div class="relative" x-data="{ open: false }">

                        <button
                                type="button"
                                @click="open = !open"
                                class="relative flex items-center justify-center w-8 h-8 rounded-full border border-gray-300 bg-white hover:bg-gray-100 transition"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0m6 0H9" />
                                </svg>';

                    if ($unreadCount > 0) {
                        $html .= '
                            <span class="absolute -top-1 -right-5 min-w-[18px] h-[18px] px-1 rounded-full bg-danger-600 text-white text-[10px] font-semibold flex items-center justify-center">
                                ' . $unreadCount . '
                            </span>';
                    }

                    $html .= '
                        </button>

                        <div
                            x-show="open"
                            x-transition
                            @click.away="open = false"
                            class="notification-dropdown absolute right-0 mt-3 bg-white border border-gray-200 shadow-2xl z-[999]"
                            style="display: none;"
                        >
                            <div class="notification-dropdown-header">
                                <h3>Notifications</h3>
                                <span>Latest ' . $notifications->count() . '</span>
                            </div>

                            <div class="notification-dropdown-body">';

                    if ($notifications->count()) {
                        foreach ($notifications as $notification) {
                            $html .= '
                                <div class="notification-item">
                                    <div class="notification-dot"></div>

                                    <div class="notification-content">
                                        <div class="notification-title-row">
                                            <h4 class="notification-title">
                                                ' . e($notification->title) . '
                                            </h4>

                                            <span class="notification-date">
                                                ' . $notification->created_at->format('d M') . '
                                            </span>
                                        </div>

                                        <p class="notification-message">
                                            ' . e($notification->message) . '
                                        </p>

                                        <div class="notification-time">
                                            ' . $notification->created_at->format('h:i A') . '
                                        </div>
                                    </div>
                                </div>';
                        }
                    } else {
                        $html .= '
                            <div class="notification-empty">
                                No notifications found
                            </div>';
                    }

                    $html .= '
                            </div>

                            <div class="notification-footer">
                                <a href="' . \App\Filament\Pages\AdminNotifications::getUrl() . '">
                                    View More
                                </a>
                            </div>
                        </div>
                    </div>';

                    return new HtmlString($html);
                }
            )
            ->userMenuItems([
                'profile' => MenuItem::make()
                    ->label('Profile')
                    ->icon('heroicon-o-user')
                    ->url(fn (): string => \App\Filament\Pages\AdminProfile::getUrl()),

                'settings' => MenuItem::make()
                    ->label('Account Settings')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->url(fn (): string => \App\Filament\Pages\AdminAccountSettings::getUrl()),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                'admin.only',
            ]);

        if ($brandLogo) {
            $panel->brandLogo(asset($brandLogo));
        } else {
            $panel->brandLogo(asset('storage/logo/logo.jpeg'));
        }

        if ($favicon) {
            $panel->favicon(asset($favicon));
        } else {
            $panel->favicon(asset('storage/favicon/favicon.png'));
        }

        return $panel;
    }
}