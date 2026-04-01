<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Forms\Components\Checkbox;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class Login extends BaseLogin
{
    public function getHeading(): string
    {
        return 'Admin Login';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required()
                    ->autocomplete('email')
                    ->autofocus(),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->revealable()
                    ->required()
                    ->autocomplete('current-password'),

                Grid::make(2)
                    ->schema([
                        Placeholder::make('remember_checkbox')
                            ->hiddenLabel()
                            ->content(new HtmlString('
                                <label style="display:flex;align-items:center;gap:8px;font-size:14px;color:#111827;margin-top:2px;">
                                    <input type="checkbox" wire:model="data.remember" style="width:16px;height:16px;">
                                    <span>Remember Me</span>
                                </label>
                            ')),

                        Placeholder::make('forgot_password')
                            ->hiddenLabel()
                            ->content(new HtmlString('
                                <div style="text-align:right;">
                                    <a href="/admin/password-reset/request" 
                                    style="color:#7c3aed;font-size:14px;text-decoration:none;font-weight:500;">
                                        Forgot Password?
                                    </a>
                                </div>
                            ')),
                    ]),
            ]);
    }
}