<?php

namespace App\Providers;

use App\Services\MailConfigurationService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendRegistrationSuccessEmail;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useTailwind();

        if (!App::runningInConsole()) {
            MailConfigurationService::setMailConfig();
        }

        View::composer('*', function ($view) {

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
