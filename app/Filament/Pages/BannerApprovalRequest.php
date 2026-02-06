<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;

class BannerApprovalRequest extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Banner Management';
    protected static ?string $navigationLabel = 'Banner Approval Request';
    protected static ?int $navigationSort = 2;
    protected string $view = 'filament.pages.banner-approval-request';
}
