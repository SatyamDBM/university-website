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
                // Css::make('admin-theme', resource_path('css/filament/admin.css')),
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

                NavigationGroup::make('Blogs')
                    ->icon('heroicon-o-document-text'),

                NavigationGroup::make('Universities Account')
                    ->icon('heroicon-o-building-library'),

                NavigationGroup::make('University Staff')
                    ->icon('heroicon-o-user-group'),

                NavigationGroup::make('Leads')
                    ->icon('heroicon-o-chart-bar'),

                NavigationGroup::make('Support & Tickets')
                    ->icon('heroicon-o-lifebuoy'),

                NavigationGroup::make('Subscriptions')
                    ->icon('heroicon-o-credit-card'),

                NavigationGroup::make('Banner Management')
                    ->icon('heroicon-o-photo'),

                NavigationGroup::make('Payments')
                    ->icon('heroicon-o-banknotes'),

                NavigationGroup::make('Notifications')
                    ->icon('heroicon-o-bell'),
                NavigationGroup::make('Staff Management')
                    ->icon('heroicon-o-users'),

                NavigationGroup::make('Settings')
                    ->icon('heroicon-o-cog-6-tooth'),
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
