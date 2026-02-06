<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;

class EmailSettings extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Notifications';
    protected static ?string $navigationLabel = 'Email Settings';
    protected static ?int $navigationSort = 2;
    protected string $view = 'filament.pages.email-settings';
}
