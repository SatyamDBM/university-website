<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;

class PaymentHistory extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Payments';
    protected static ?string $navigationLabel = 'Payment History';
    protected static ?int $navigationSort = 2;
    protected string $view = 'filament.pages.payment-history';
}
