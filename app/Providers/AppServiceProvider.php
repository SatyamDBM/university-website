<?php

namespace App\Providers;

use App\Services\MailConfigurationService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useTailwind();  // ✅ add this

        if (!App::runningInConsole()) {
            MailConfigurationService::setMailConfig();
        }
    }
}
