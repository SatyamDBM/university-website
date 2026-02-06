<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;

class GeneralSettings extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'General Settings';
    protected static ?int $navigationSort = 1;
    protected string $view = 'filament.pages.general-settings';
}
