<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class AdminProfile extends Page
{
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-user';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'admin-profile';

    protected string $view = 'filament.pages.admin-profile';

    public $admin;

    public function mount(): void
    {
        $this->admin = Auth::user();
    }
}