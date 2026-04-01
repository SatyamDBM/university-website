<?php

namespace App\Filament\Pages\Auth;

use App\Models\User;
use Filament\Auth\Pages\PasswordReset\RequestPasswordReset;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends RequestPasswordReset
{
    public function getHeading(): string
    {
        return 'Forgot Password';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required()
                    ->autofocus(),
            ]);
    }

    public function request(): void
    {
        $email = $this->data['email'];

        $admin = User::where('email', $email)
            ->where('role', 'admin')
            ->first();

        if (! $admin) {
            Notification::make()
                ->title('Admin email not found.')
                ->danger()
                ->send();

            return;
        }

        $status = Password::broker()->sendResetLink([
            'email' => $email,
        ]);

        if ($status === Password::RESET_LINK_SENT) {
            Notification::make()
                ->title('Password reset link sent successfully.')
                ->success()
                ->send();

            return;
        }

        Notification::make()
            ->title('Unable to send reset link.')
            ->danger()
            ->send();
    }
}