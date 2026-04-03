<?php

namespace App\Filament\Pages;

use App\Models\Package;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use UnitEnum;
use BackedEnum;

class AllPackages extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|UnitEnum|null $navigationGroup = 'Subscriptions';

    protected static ?string $navigationLabel = 'All Packages';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cube';

    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.pages.all-packages';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Package::query()->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Package Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('INR')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('coverage_type')
                        ->label('Coverage Type')
                        ->colors([
                            'primary' => 'city_level',
                            'warning' => 'state_level',
                            'success' => 'multi_city',
                            'danger' => 'national',
                        ])
                        ->formatStateUsing(fn ($state) => match ($state) {
                            'city_level' => 'City Level',
                            'state_level' => 'State Level',
                            'multi_city' => 'Multi-City',
                            'national' => 'National',
                            default => '-',
                        }),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Duration')
                    ->formatStateUsing(fn ($record) => $record->duration . ' ' . ucfirst($record->duration_type))
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
                ->url(fn (Package $record) => url('/admin/edit-package/' . $record->id)),

               Action::make('delete')
                    ->label('Delete')
                    ->icon('heroicon-o-trash')
                    ->color('primary')
                    ->link()
                    ->extraAttributes([
                        'style' => 'color:#111827 !important; font-weight:700 !important; text-decoration:none !important;',
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Delete Package')
                    ->modalDescription('Are you sure you want to delete this package?')
                    ->modalSubmitActionLabel('Yes, Delete')
                    ->action(function (Package $record) {
                        $record->delete();

                        \Filament\Notifications\Notification::make()
                            ->title('Package deleted successfully')
                            ->success()
                            ->send();
                    }),
            ])
            ->paginated([10, 25, 50]);
    }
}