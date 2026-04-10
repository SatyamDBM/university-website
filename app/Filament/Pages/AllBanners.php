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

    protected static ?string $navigationLabel = 'Banner Packages';

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

                // Tables\Columns\TextColumn::make('name')
                //     ->label('Banner Name')
                //     ->searchable()
                //     ->sortable(),

                Tables\Columns\TextColumn::make('slot_name')
                    ->label('Slot Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('placement_location')
                    ->label('Placement Location')
                    ->formatStateUsing(fn ($state) => str($state)->replace('_', ' ')->title())
                    ->sortable(),

                Tables\Columns\TextColumn::make('device_type')
                    ->label('Device Type')
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->sortable(),

                Tables\Columns\TextColumn::make('width')
                    ->label('Width')
                    ->default('-'),

                Tables\Columns\TextColumn::make('height')
                    ->label('Height')
                    ->default('-'),

                Tables\Columns\TextColumn::make('max_banner_limit')
                    ->label('Max Banner Limit')
                    ->sortable(),

                Tables\Columns\TextColumn::make('rotation_type')
                    ->label('Rotation Type')
                    ->formatStateUsing(fn ($state) => $state ? str($state)->replace('_', ' ')->title() : '-')
                    ->sortable(),

                // Tables\Columns\TextColumn::make('priority')
                //     ->label('Priority')
                //     ->formatStateUsing(fn ($state) => $state ? ucfirst($state) : '-')
                //     ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('INR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Duration')
                    ->formatStateUsing(function ($record) {
                        if (!$record->duration) {
                            return '-';
                        }

                        return $record->duration . ' ' . ucfirst($record->duration_type);
                    })
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                // Tables\Columns\TextColumn::make('description')
                //     ->label('Description')
                //     ->html()
                //     ->limit(30)
                //     ->tooltip(fn ($record) => strip_tags($record->description))
                //     ->default('-'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y h:i A')
                    ->sortable(),
            ])
            ->actions([
                Action::make('edit')
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->color('primary')
                    ->tooltip('Edit Banner')
                    ->extraAttributes([
                        'class' => 'edit-btn',
                    ])
                    ->url(fn (Banner $record) => url('/admin/edit-banner/' . $record->id)),

                Action::make('delete')
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->tooltip('Delete Banner')
                    ->extraAttributes([
                        'class' => 'delete-btn',
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
            ->actionsColumnLabel('Actions')
            ->paginated([10, 25, 50]);
    }
}