<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;

class Logs extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Notifications';
    protected static ?string $navigationLabel = 'Logs';
    protected static ?int $navigationSort = 3;
    protected string $view = 'filament.pages.logs';
}
