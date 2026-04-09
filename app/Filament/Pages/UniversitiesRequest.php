<?php

namespace App\Filament\Pages;

use App\Models\User;
use App\Models\UniversityProfile;
use Filament\Notifications\Notification;
use App\Services\MailConfigurationService;
use Illuminate\Support\Facades\Mail;
use App\Mail\UniversityApprovedMail;
use App\Mail\UniversityRejectedMail;
// use Filament\Tables\Actions\BulkAction; // Not needed, use fully qualified name
use Illuminate\Database\Eloquent\Collection;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use UnitEnum;
use BackedEnum;
use App\Filament\Pages\UniversityRequestView;

class UniversitiesRequest extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationLabel = 'Universities Request';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static string|UnitEnum|null $navigationGroup = 'Universities';

    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.pages.universities-request';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()
                    ->where('role', 'university')
                    ->where('linking_status', 'pending')
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
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(fn (?string $state) => ucfirst($state ?? '-')),

                Tables\Columns\IconColumn::make('is_email_verified')
                    ->label('Email Verified')
                    ->boolean(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Requested At')
                    ->dateTime('d M Y h:i A')
                    ->sortable(),
            ])
            ->actions([
                Action::make('view')
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->tooltip('View University')
                    ->extraAttributes([
                        'class' => 'view-btn',
                    ])
                    ->color('info')
                    ->url(fn (User $record): string => UniversityRequestView::getUrl([
                        'id' => $record->id,
                    ])),

                Action::make('approve')
                    ->label('')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->tooltip('Approve University')
                    ->extraAttributes([
                        'class' => 'approve-btn',
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Approve University')
                    ->modalDescription('Are you sure you want to approve this university request?')
                    ->modalSubmitActionLabel('Yes, Approve')
                    ->action(function (User $record): void {
                        $record->update([
                            'linking_status' => 'approved',
                        ]);

                        MailConfigurationService::setMailConfig();
                        try {
                            Mail::to($record->email)->send(new UniversityApprovedMail($record));
                        } catch (\Throwable $e) {
                        }

                        Notification::make()
                            ->title('University approved successfully')
                            ->success()
                            ->send();
                    }),

                Action::make('reject')
                    ->label('')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->tooltip('Reject University')
                    ->extraAttributes([
                        'class' => 'delete-btn',
                    ])
                    ->form([
                        Textarea::make('rejection_reason')
                            ->label('Rejection Reason')
                            ->placeholder('Please provide a reason for rejecting this university request...')
                            ->required()
                            ->rows(4)
                            ->maxLength(1000),
                    ])
                    ->modalHeading('Reject University Request')
                    ->modalSubmitActionLabel('Yes, Reject')
                    ->action(function (User $record, array $data): void {
                        $record->update([
                            'linking_status' => 'rejected',
                        ]);

                        // Save rejection reason to university_profiles table
                        UniversityProfile::updateOrCreate(
                            ['university_id' => $record->university_id],
                            ['rejection_reason' => $data['rejection_reason']]
                        );

                        MailConfigurationService::setMailConfig();
                        try {
                            Mail::to($record->email)->send(
                                new UniversityRejectedMail($record, $data['rejection_reason'])
                            );
                        } catch (\Throwable $e) {
                        }

                        Notification::make()
                            ->title('University request rejected')
                            ->danger()
                            ->send();
                    }),
            ])
            ->bulkActions([
                \Filament\Actions\BulkAction::make('approve_selected')
                    ->label('Approve All')
                    ->icon('')
                    ->color('success')
                    ->extraAttributes([
                        'class' => 'approve-all-btn',
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Approve Selected Universities')
                    ->modalDescription('Are you sure you want to approve all selected university requests?')
                    ->modalSubmitActionLabel('Yes, Approve')
                    ->deselectRecordsAfterCompletion()
                    ->action(function (Collection $records): void {
                        foreach ($records as $record) {
                            $record->update([
                                'linking_status' => 'approved',
                            ]);

                            MailConfigurationService::setMailConfig();

                            try {
                                Mail::to($record->email)->send(new UniversityApprovedMail($record));
                            } catch (\Throwable $e) {
                            }
                        }

                        Notification::make()
                            ->title('Selected universities approved successfully')
                            ->success()
                            ->send();
                    }),

                \Filament\Actions\BulkAction::make('reject_selected')
                    ->label('Reject All')
                    ->icon('')
                    ->color('danger')
                    ->extraAttributes([
                        'class' => 'reject-all-btn',
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Reject Selected Universities')
                    ->modalDescription('Are you sure you want to reject all selected university requests?')
                    ->modalSubmitActionLabel('Yes, Reject')
                    ->deselectRecordsAfterCompletion()
                    ->action(function (Collection $records): void {
                        foreach ($records as $record) {
                            $record->update([
                                'linking_status' => 'rejected',
                            ]);
                        }

                        Notification::make()
                            ->title('Selected universities rejected successfully')
                            ->danger()
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