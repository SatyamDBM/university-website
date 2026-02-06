<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;

class AllBanners extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Banner Management';
    protected static ?string $navigationLabel = 'All Banners';
    protected static ?int $navigationSort = 1;
    protected string $view = 'filament.pages.all-banners';
}
