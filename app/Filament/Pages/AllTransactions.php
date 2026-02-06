<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;

class AllTransactions extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Payments';
    protected static ?string $navigationLabel = 'All Transactions';
    protected static ?int $navigationSort = 1;
    protected string $view = 'filament.pages.all-transactions';
}
