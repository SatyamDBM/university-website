<?php

namespace App\Providers;

use App\Services\MailConfigurationService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Notification;
use App\Models\GeneralSetting;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Enable Tailwind pagination
        Paginator::useTailwind();

        /**
         * Mail configuration (only in web requests)
         */
        if (!App::runningInConsole()) {
            MailConfigurationService::setMailConfig();
        }

        /**
         * SAFE: Load branding settings only if table exists
         */
        $brandingSettings = [];

        if (!App::runningInConsole() && Schema::hasTable('general_settings')) {
            $brandingSettings = GeneralSetting::where('group', 'branding')
                ->pluck('value', 'key')
                ->toArray();
        }

        View::share('brandingSettings', $brandingSettings);

        /**
         * Global notifications (safe)
         */
        View::composer('*', function ($view) {

            if (App::runningInConsole()) {
                return;
            }

            if (auth()->check()) {

                $notifications = Notification::where('user_id', auth()->id())
                    ->latest()
                    ->take(10)
                    ->get();

                $unreadCount = Notification::where('user_id', auth()->id())
                    ->where('is_read', 0)
                    ->count();

                $view->with([
                    'globalNotifications' => $notifications,
                    'unreadCount' => $unreadCount,
                ]);
            }
        });
    }
}
