<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Pages\Page;
use UnitEnum;
use BackedEnum;

class ViewStaff extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'View Staff';

    protected static ?string $slug = 'view-staff/{id}';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-eye';

    protected string $view = 'filament.pages.view-staff';

    public $staff;

    public function mount($id): void
    {
        $this->staff = User::where('role', 'staff')->findOrFail($id);
    }
}