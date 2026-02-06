<?php

namespace App\Filament\Pages;

use App\Models\University;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use UnitEnum;
use BackedEnum;

class UniversityAccounts extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationLabel = 'University Accounts';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-library';

    protected static string|UnitEnum|null $navigationGroup = 'Universities';

    protected static ?int $navigationSort = 2;

    /**
     * ✅ MUST be PUBLIC in Filament v3
     */
    public function getView(): string
    {
        return 'filament.pages.university-accounts';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                University::query()->with('user')
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User Name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('University'),

                Tables\Columns\TextColumn::make('mobile')
                    ->label('Mobile'),

                Tables\Columns\IconColumn::make('is_verified')
                    ->label('Verified')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Registered At')
                    ->dateTime(),
            ])
            ->actions([])       
            ->bulkActions([]);  
    }

    // 🔐 Admin only
    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin';
    }
}
