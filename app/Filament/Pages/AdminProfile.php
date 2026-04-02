<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class AdminProfile extends Page
{
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-user';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'admin-profile';

    protected string $view = 'filament.pages.admin-profile';

    public $admin;

    public $name;

    public $email;

    public function mount(): void
    {
        $this->admin = Auth::user();

        $this->name = $this->admin->name;
        $this->email = $this->admin->email;

        if (! $this->admin->email_verified_at) {
            $this->admin->email_verified_at = now();
        }
    }

    public function updateProfile(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        $this->admin->update([
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->admin->email_verified_at ?? now(),
        ]);

        $this->admin->refresh();

        Notification::make()
            ->title('Profile updated successfully.')
            ->success()
            ->seconds(4)
            ->send();
    }
}