<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;

class BannerPlacementSettings extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Banner Management';
    protected static ?string $navigationLabel = 'Banner Placement Settings';
    protected static ?int $navigationSort = 3;
    protected string $view = 'filament.pages.banner-placement-settings';
}
