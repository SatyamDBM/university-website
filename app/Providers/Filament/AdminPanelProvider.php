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
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\NavigationGroup;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\Css;
use Illuminate\Support\Facades\Vite;
use Filament\Navigation\MenuItem;
class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(\App\Filament\Pages\Auth\Login::class)
            ->passwordReset(\App\Filament\Pages\Auth\ForgotPassword::class)
            ->sidebarCollapsibleOnDesktop()
            ->topNavigation(false)
            ->darkMode(false)
            ->brandName(null)
            ->brandLogo(asset('storage/logo/logo.jpeg'))
            ->brandLogoHeight('2.5rem')
            ->favicon(asset('storage/favicon/favicon.png'))
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
            
    }
}
