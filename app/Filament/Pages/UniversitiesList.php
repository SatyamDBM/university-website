<?php

namespace App\Filament\Pages;

use App\Models\User;
use UnitEnum;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Filters\SelectFilter;

class UniversitiesList extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationLabel = 'Universities List';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static string|UnitEnum|null $navigationGroup = 'Universities';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.universities-list';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()
                    ->where('role', 'university')
                    ->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('University Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('mobile')
                    ->label('Mobile')
                    ->default('-'),

                Tables\Columns\BadgeColumn::make('linking_status')
                    ->label('Linking Status')
                    ->colors([
                        'gray' => 'not_linked',
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'not_linked' => 'Not Linked',
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        default => ucfirst(str_replace('_', ' ', $state)),
                    }),

                Tables\Columns\IconColumn::make('is_email_verified')
                    ->label('Email Verified')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Registered At')
                    ->dateTime('d M Y h:i A')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('linking_status')
                    ->label('Linking Status')
                    ->options([
                        'not_linked' => 'Not Linked',
                        'pending'    => 'Pending',
                        'approved'   => 'Approved',
                        'rejected'   => 'Rejected',
                    ])
                    ->placeholder('All Statuses'),
            ])
            ->actions([
                Action::make('view')
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->extraAttributes([
                        'class' => 'view-btn',
                    ])
                    ->url(fn (User $record): string => UniversityRequestView::getUrl([
                        'id' => $record->id,
                    ])),

                Action::make('change_status')
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->color('primary')
                    ->extraAttributes([
                        'class' => 'change-status-btn',
                    ])
                    ->fillForm(fn (User $record): array => [
                        'linking_status' => $record->linking_status,
                    ])
                    ->form([
                        Select::make('linking_status')
                            ->label('Linking Status')
                            ->options([
                                'not_linked' => 'Not Linked',
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                            ])
                            ->required(),
                    ])
                    ->action(function (array $data, User $record): void {
                        $record->linking_status = $data['linking_status'];
                        $record->save();
                    })
                    ->modalHeading('Change Linking Status')
                    ->modalSubmitActionLabel('Update Status')
                    ->successNotificationTitle('Linking status updated successfully'),

                Action::make('delete')
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->extraAttributes([
                        'class' => 'delete-btn',
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Delete University')
                    ->modalDescription('Are you sure you want to delete this university?')
                    ->modalSubmitActionLabel('Yes, Delete')
                    ->action(function (User $record): void {
                        $record->delete();

                        Notification::make()
                            ->title('University deleted successfully')
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