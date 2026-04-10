<?php

namespace App\Filament\Pages;

use App\Models\UserNotification;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class AdminNotifications extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationLabel = 'All Notifications';

    protected static ?string $title = 'All Notifications';

    protected static string|\UnitEnum|null $navigationGroup = 'Notifications';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-bell';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.admin-notifications';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                UserNotification::query()
                    ->where('user_id', auth()->id())
                    ->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('message')
                    ->label('Message')
                    ->limit(80)
                    ->tooltip(fn ($record) => $record->message),

                Tables\Columns\IconColumn::make('is_read')
                    ->label('Read')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y h:i A')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated([10, 25, 50, 100]);
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin';
    }
}