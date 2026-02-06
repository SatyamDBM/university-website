<?php

namespace App\Filament\Resources\DirectEnquiries\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DirectEnquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('source'),
            ]);
    }
}
