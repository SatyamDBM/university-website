<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAccountSettings extends Page
{
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $slug = 'admin-account-settings';

    protected string $view = 'filament.pages.admin-account-settings';

    public ?string $current_password = null;

    public ?string $new_password = null;

    public ?string $confirm_password = null;

    public function updatePassword(): void
    {
        $this->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8'],
            'confirm_password' => ['required', 'same:new_password'],
        ]);

        $user = Auth::user();

        if (! Hash::check($this->current_password, $user->password)) {
            Notification::make()
                ->title('Current password is incorrect.')
                ->danger()
                ->send();

            return;
        }

        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset([
            'current_password',
            'new_password',
            'confirm_password',
        ]);

        Notification::make()
            ->title('Password updated successfully.')
            ->success()
            ->seconds(4)
            ->send();
    }
}