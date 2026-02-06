<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;

class AllNotificationSettings extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Notifications';
    protected static ?string $navigationLabel = 'All Notifications Settings';
    protected static ?int $navigationSort = 1;
    protected string $view = 'filament.pages.all-notification-settings';
}
