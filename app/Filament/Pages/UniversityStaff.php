<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class UniversityStaff extends Page
{
    protected static ?string $navigationLabel = 'All Staff';

    protected static ?string $title = 'University Staff';

    protected static string|\UnitEnum|null $navigationGroup = 'University Staff';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.university-staff';
}