<?php

namespace App\Providers;

use App\Services\MailConfigurationService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (!App::runningInConsole()) {
            MailConfigurationService::setMailConfig();
        }
    }
}
