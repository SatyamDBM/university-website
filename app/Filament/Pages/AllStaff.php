<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use UnitEnum;
use BackedEnum;

class AllStaff extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|UnitEnum|null $navigationGroup = 'Staff Management';

    protected static ?string $navigationLabel = 'All Staff';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-users';

    protected string $view = 'filament.pages.all-staff';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()
                    ->where('role', 'staff')
                    ->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Staff Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('mobile')
                    ->label('Mobile Number')
                    ->default('-')
                    ->searchable(),

                Tables\Columns\TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'staff' => 'primary',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                        'warning' => 'suspended',
                        'gray' => 'blocked',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y h:i A')
                    ->sortable(),
            ])
            ->actions([
                // View bahar rakha hai — same as UniversitiesList
                Action::make('view')
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->tooltip('View Staff')
                    ->extraAttributes([
                        'class' => 'view-btn',
                    ])
                    ->url(fn (User $record): string => url('/admin/view-staff/' . $record->id)),

                // Baaki sab three dots mein
                ActionGroup::make([
                    Action::make('edit')
                        ->label('Edit Staff')
                        ->icon('heroicon-o-pencil-square')
                        ->color('info')
                        ->url(fn (User $record): string => url('/admin/edit-staff/' . $record->id)),

                    Action::make('activate')
                        ->label('Activate Staff')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->extraAttributes([
                            'class' => 'activate-btn',
                        ])
                        ->requiresConfirmation()
                        ->modalHeading('Activate Staff')
                        ->modalDescription('Are you sure you want to activate this staff member?')
                        ->modalSubmitActionLabel('Yes, Activate')
                        ->visible(fn (User $record): bool => $record->status !== 'active')
                        ->action(function (User $record): void {
                            $record->status = 'active';
                            $record->save();

                            Notification::make()
                                ->title('Staff activated successfully')
                                ->success()
                                ->send();
                        }),

                    Action::make('deactivate')
                        ->label('Deactivate Staff')
                        ->icon('heroicon-o-x-circle')
                        ->color('warning')
                        ->extraAttributes([
                            'class' => 'deactivate-btn',
                        ])
                        ->requiresConfirmation()
                        ->modalHeading('Deactivate Staff')
                        ->modalDescription('Are you sure you want to deactivate this staff member?')
                        ->modalSubmitActionLabel('Yes, Deactivate')
                        ->visible(fn (User $record): bool => $record->status !== 'inactive')
                        ->action(function (User $record): void {
                            $record->status = 'inactive';
                            $record->save();

                            Notification::make()
                                ->title('Staff deactivated successfully')
                                ->warning()
                                ->send();
                        }),

                    Action::make('delete')
                        ->label('Delete Staff')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->extraAttributes([
                            'class' => 'delete-btn',
                        ])
                        ->requiresConfirmation()
                        ->modalHeading('Delete Staff')
                        ->modalDescription('Are you sure you want to delete this staff member?')
                        ->modalSubmitActionLabel('Yes, Delete')
                        ->action(function (User $record): void {
                            $record->delete();

                            Notification::make()
                                ->title('Staff deleted successfully')
                                ->success()
                                ->send();
                        }),
                ])
                    ->label('')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->extraAttributes([
                        'class' => 'more-actions-btn',
                    ])
                    ->button(),
            ])
            ->actionsColumnLabel('Actions')
            ->paginated([10, 25, 50]);
    }
}