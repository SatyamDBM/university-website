<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;

class ActiveSubscriptions extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Subscriptions';
    protected static ?string $navigationLabel = 'All Packages';
    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.pages.active-subscriptions';
}
