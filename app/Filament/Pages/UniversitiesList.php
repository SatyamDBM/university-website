<?php

namespace App\Filament\Pages;

use App\Models\User;
use UnitEnum;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Mail;
use App\Services\MailConfigurationService;
use App\Mail\UniversityApprovedMail;
use App\Mail\UniversitySuspendedMail;
use App\Mail\UniversityActivatedMail;
use App\Mail\UniversityBlockedMail;
use App\Mail\UniversityDeletedMail;

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

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'active',
                        'gray' => 'inactive',
                        'warning' => 'suspended',
                        'danger' => 'blocked',
                    ])
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'suspended' => 'Suspended',
                        'blocked' => 'Blocked',
                        default => ucfirst($state),
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
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->placeholder('All Statuses'),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'suspended' => 'Suspended',
                        'blocked' => 'Blocked',
                    ])
                    ->placeholder('All Statuses'),
            ])
            ->actions([
                Action::make('view')
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->tooltip('View University')
                    ->extraAttributes([
                        'class' => 'view-btn',
                    ])
                    ->url(fn (User $record): string => UniversityRequestView::getUrl([
                        'id' => $record->id,
                    ])),


                ActionGroup::make([
                    Action::make('change_status')
                        ->label('Change Linking Status')
                        ->icon('heroicon-o-arrow-path')
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

                            if ($data['linking_status'] === 'approved') {
                                MailConfigurationService::setMailConfig();
                                try {
                                    Mail::to($record->email)->send(new UniversityApprovedMail($record));
                                } catch (\Throwable $e) {
                                }
                            }

                            Notification::make()
                                ->title('Linking status updated successfully')
                                ->success()
                                ->send();
                        }),

                    Action::make('suspended')
                        ->label('Suspend University')
                        ->icon('heroicon-o-pause-circle')
                        ->extraAttributes([
                            'class' => 'suspended-btn',
                        ])
                        ->requiresConfirmation()
                        ->modalHeading('Suspend University')
                        ->modalDescription('Are you sure you want to suspend this university?')
                        ->modalSubmitActionLabel('Yes, Suspend')
                        ->visible(fn (User $record): bool => $record->status !== 'suspended')
                        ->action(function (User $record): void {
                            $record->status = 'suspended';
                            $record->save();

                            MailConfigurationService::setMailConfig();
                            try {
                                Mail::to($record->email)->send(new UniversitySuspendedMail($record));
                            } catch (\Throwable $e) {
                            }

                            Notification::make()
                                ->title('University suspended successfully')
                                ->warning()
                                ->send();
                        }),

                    Action::make('activate')
                        ->label('Activate University')
                        ->icon('heroicon-o-check-circle')
                        ->extraAttributes([
                            'class' => 'activate-btn',
                        ])
                        ->requiresConfirmation()
                        ->modalHeading('Activate University')
                        ->modalDescription('Are you sure you want to activate this university?')
                        ->modalSubmitActionLabel('Yes, Activate')
                        ->visible(fn (User $record): bool => $record->status !== 'active')
                        ->action(function (User $record): void {
                            $record->status = 'active';
                            $record->save();

                            MailConfigurationService::setMailConfig();
                            try {
                                Mail::to($record->email)->send(new UniversityActivatedMail($record));
                            } catch (\Throwable $e) {
                            }

                            Notification::make()
                                ->title('University activated successfully')
                                ->success()
                                ->send();
                        }),

                    Action::make('permanent_block')
                        ->label('Permanent Block')
                        ->icon('heroicon-o-no-symbol')
                        ->extraAttributes([
                            'class' => 'permanent-block-btn',
                        ])
                        ->requiresConfirmation()
                        ->modalHeading('Permanent Block University')
                        ->modalDescription('Are you sure you want to permanently block this university?')
                        ->modalSubmitActionLabel('Yes, Block')
                        ->visible(fn (User $record): bool => $record->status !== 'blocked')
                        ->action(function (User $record): void {
                            $record->status = 'blocked';
                            $record->save();

                            MailConfigurationService::setMailConfig();
                            try {
                                Mail::to($record->email)->send(new UniversityBlockedMail($record));
                            } catch (\Throwable $e) {
                            }

                            Notification::make()
                                ->title('University permanently blocked successfully')
                                ->danger()
                                ->send();
                        }),

                    Action::make('soft_delete')
                        ->label('Delete')
                        ->icon('heroicon-o-trash')
                        ->extraAttributes([
                            'class' => 'soft-delete-btn',
                        ])
                        ->requiresConfirmation()
                        ->modalHeading('Soft Delete University')
                        ->modalDescription('Are you sure you want to soft delete this university?')
                        ->modalSubmitActionLabel('Yes, Delete')
                        ->action(function (User $record): void {
                            MailConfigurationService::setMailConfig();
                            try {
                                Mail::to($record->email)->send(new UniversityDeletedMail($record));
                            } catch (\Throwable $e) {
                            }

                            $record->delete();

                            Notification::make()
                                ->title('University soft deleted successfully')
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

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin';
    }
}