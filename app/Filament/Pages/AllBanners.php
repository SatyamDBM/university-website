<?php

namespace App\Filament\Pages;

use App\Models\Banner;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use UnitEnum;
use BackedEnum;

class AllBanners extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|UnitEnum|null $navigationGroup = 'Banner Management';

    protected static ?string $navigationLabel = 'All Banners';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    protected string $view = 'filament.pages.all-banners';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Banner::query()->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Banner Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slot_name')
                    ->label('Slot Name')
                    ->formatStateUsing(fn ($state) => str($state)->replace('_', ' ')->title()),

                Tables\Columns\TextColumn::make('placement_location')
                    ->label('Placement')
                    ->formatStateUsing(fn ($state) => str($state)->replace('_', ' ')->title()),

                Tables\Columns\TextColumn::make('device_type')
                    ->label('Device Type')
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                Tables\Columns\TextColumn::make('monthly_price')
                    ->label('Monthly Price')
                    ->money('INR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('yearly_price')
                    ->label('Yearly Price')
                    ->money('INR')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y h:i A')
                    ->sortable(),
            ])
            ->actions([
                Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-o-pencil-square')
                    ->color('primary')
                    ->url(fn (Banner $record) => url('/admin/edit-banner/' . $record->id)),

                Action::make('delete')
                    ->label('Delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->extraAttributes([
                        'style' => 'color:#111827 !important; font-weight:700 !important; text-decoration:none !important;',
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Delete Banner')
                    ->modalDescription('Are you sure you want to delete this banner?')
                    ->modalSubmitActionLabel('Yes, Delete')
                    ->action(function (Banner $record) {
                        $record->delete();

                        Notification::make()
                            ->title('Banner deleted successfully')
                            ->success()
                            ->send();
                    }),
            ])
            ->paginated([10, 25, 50]);
    }
}