<?php

namespace App\Filament\Pages;

use App\Models\Enquiry;
use UnitEnum;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class AllLeads extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationLabel = 'University Leads';

    protected static string|UnitEnum|null $navigationGroup = 'Leads';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.pages.all-leads';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Enquiry::query()
                    ->whereNotNull('university_id')
                    ->with('university')
                    ->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('mobile')
                    ->label('Mobile')
                    ->default('-'),
                Tables\Columns\TextColumn::make('course')
                ->label('course')
                ->default('-'),

                Tables\Columns\TextColumn::make('university.name')
                    ->label('Assigned University')
                    ->searchable()
                    ->sortable()
                    ->default('-'),

                // Tables\Columns\TextColumn::make('message')
                //     ->label('Message')
                //     ->limit(50)
                //     ->tooltip(fn (Enquiry $record) => $record->message)
                //     ->default('-'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Assigned At')
                    ->dateTime('d M Y h:i A')
                    ->sortable(),
            ])
            ->actions([
                Action::make('remove_assignment')
                    ->label('')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->tooltip('Remove Assignment')
                    ->extraAttributes([
                        'class' => 'remove-assignment-btn',
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Remove University Assignment')
                    ->modalDescription('Are you sure you want to remove the assigned university from this lead?')
                    ->modalSubmitActionLabel('Yes, Remove')
                    ->action(function (Enquiry $record): void {
                        $record->university_id = null;
                        $record->save();

                        Notification::make()
                            ->title('University assignment removed successfully')
                            ->success()
                            ->send();
                    }),

                Action::make('delete')
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->tooltip('Delete Lead')
                    ->extraAttributes([
                        'class' => 'delete-btn',
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Delete Lead')
                    ->modalDescription('Are you sure you want to delete this lead?')
                    ->modalSubmitActionLabel('Yes, Delete')
                    ->action(function (Enquiry $record): void {
                        $record->delete();

                        Notification::make()
                            ->title('Lead deleted successfully')
                            ->success()
                            ->send();
                    }),
            ])
            ->actionsColumnLabel('Actions')
            ->paginated([10, 25, 50]);
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin';
    }
}