<?php

namespace App\Filament\Pages;

use App\Models\UniversityBanner;
use App\Models\User;
use App\Models\UserNotification;
use App\Services\MailConfigurationService;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
use UnitEnum;

class BannerApprovalRequest extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|UnitEnum|null $navigationGroup = 'Banner Management';
    protected static ?string $navigationLabel = 'Banner Approval Request';
    protected static ?int $navigationSort = 3;
    protected static ?string $title = 'Banner Approval Request';
    protected string $view = 'filament.pages.banner-approval-request';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                UniversityBanner::query()
                    ->with(['university', 'banner'])
                    ->where('approval_status', 'pending')
                    ->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('university.name')
                    ->label('University')
                    ->searchable()
                    ->sortable()
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('banner.name')
                    ->label('Banner Slot')
                    ->searchable()
                    ->sortable()
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('campaign_name')
                    ->label('Campaign Name')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('redirect_url')
                    ->label('Redirect URL')
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->redirect_url),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('End Date')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('INR')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('payment_status')
                    ->label('Payment Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                        'danger'  => 'failed',
                    ])
                    ->formatStateUsing(fn (?string $state) => ucfirst($state ?? '-')),

                Tables\Columns\BadgeColumn::make('approval_status')
                    ->label('Approval Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger'  => 'rejected',
                    ])
                    ->formatStateUsing(fn (?string $state) => ucfirst($state ?? '-')),
            ])
            ->actions([
                // View — bahar rahega
                Action::make('view_banner')
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->tooltip('View Banner')
                    ->color('info')
                    ->extraAttributes(['class' => 'view-btn'])
                    ->modalHeading('Banner Preview')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close')
                    ->modalContent(fn ($record) => view(
                        'filament.modals.banner-preview',
                        ['record' => $record]
                    )),

                // Approve, Reject, Delete — three dots ke andar
                ActionGroup::make([

                    Action::make('approve')
                        ->label('Approve')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Approve Banner')
                        ->modalDescription('Are you sure you want to approve this banner request?')
                        ->modalSubmitActionLabel('Yes, Approve')
                        ->action(function (UniversityBanner $record): void {
                            $record->update([
                                'approval_status' => 'approved',
                                'live_status'      => 'scheduled',
                            ]);

                            $user = User::where('university_id', $record->university_id)->first();

                            if ($user) {
                                UserNotification::create([
                                    'user_id'    => $user->id,
                                    'title'      => 'Banner Approved',
                                    'message'    => 'Your banner "' . $record->campaign_name . '" has been approved successfully.',
                                    'type'       => 'banner_approved',
                                    'action_url' => (string) $user->id,
                                    'is_read'    => false,
                                ]);

                                if (!empty($user->email)) {
                                    try {
                                        MailConfigurationService::setMailConfig();
                                        Mail::raw(
                                            'Your banner "' . $record->campaign_name . '" has been approved successfully.',
                                            function ($message) use ($user) {
                                                $message->to($user->email)
                                                    ->subject('Banner Approved Successfully');
                                            }
                                        );
                                    } catch (\Exception $e) {
                                        \Log::error('[APPROVE] Mail failed: ' . $e->getMessage());
                                    }
                                }
                            }

                            Notification::make()
                                ->title('Banner approved successfully')
                                ->success()
                                ->send();
                        }),

                    Action::make('reject')
                        ->label('Reject')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->form([
                            Textarea::make('rejection_reason')
                                ->label('Rejection Reason')
                                ->placeholder('Please provide a reason for rejecting this banner request...')
                                ->required()
                                ->rows(4)
                                ->maxLength(1000),
                        ])
                        ->modalHeading('Reject Banner Request')
                        ->modalSubmitActionLabel('Yes, Reject')
                        ->action(function (UniversityBanner $record, array $data): void {
                            $record->update([
                                'approval_status'  => 'rejected',
                                'rejection_reason' => $data['rejection_reason'],
                                'live_status'      => 'draft',
                            ]);

                            $user = User::where('university_id', $record->university_id)->first();

                            if ($user) {
                                UserNotification::create([
                                    'user_id'    => $user->id,
                                    'title'      => 'Banner Rejected',
                                    'message'    => 'Your banner "' . $record->campaign_name . '" has been rejected. Reason: ' . $data['rejection_reason'],
                                    'type'       => 'banner_rejected',
                                    'action_url' => (string) $user->id,
                                    'is_read'    => false,
                                ]);

                                if (!empty($user->email)) {
                                    try {
                                        MailConfigurationService::setMailConfig();
                                        Mail::raw(
                                            'Your banner "' . $record->campaign_name . '" has been rejected.' . "\n\n" .
                                            'Reason: ' . $data['rejection_reason'],
                                            function ($message) use ($user) {
                                                $message->to($user->email)
                                                    ->subject('Banner Rejected');
                                            }
                                        );
                                    } catch (\Exception $e) {
                                        \Log::error('[REJECT] Mail failed: ' . $e->getMessage());
                                    }
                                }
                            }

                            Notification::make()
                                ->title('Banner rejected successfully')
                                ->danger()
                                ->send();
                        }),

                    Action::make('delete')
                        ->label('Delete')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Delete Banner')
                        ->modalDescription('Are you sure you want to delete this banner request?')
                        ->modalSubmitActionLabel('Yes, Delete')
                        ->action(function (UniversityBanner $record): void {
                            $record->delete();

                            Notification::make()
                                ->title('Banner deleted successfully')
                                ->success()
                                ->send();
                        }),

                ])
                    ->label('')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->extraAttributes(['class' => 'more-actions-btn'])
                    ->button(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkAction::make('approve_selected')
                    ->label('Approve All')
                    ->color('success')
                    ->extraAttributes(['class' => 'approve-all-btn'])
                    ->requiresConfirmation()
                    ->modalHeading('Approve Selected Banners')
                    ->modalDescription('Are you sure you want to approve all selected banner requests?')
                    ->modalSubmitActionLabel('Yes, Approve')
                    ->deselectRecordsAfterCompletion()
                    ->action(function (Collection $records): void {
                        foreach ($records as $record) {
                            $record->update([
                                'approval_status' => 'approved',
                                'live_status'      => 'scheduled',
                            ]);

                            $user = User::where('university_id', $record->university_id)->first();

                            if ($user) {
                                UserNotification::create([
                                    'user_id'    => $user->id,
                                    'title'      => 'Banner Approved',
                                    'message'    => 'Your banner "' . $record->campaign_name . '" has been approved successfully.',
                                    'type'       => 'banner_approved',
                                    'action_url' => (string) $user->id,
                                    'is_read'    => false,
                                ]);

                                if (!empty($user->email)) {
                                    try {
                                        MailConfigurationService::setMailConfig();
                                        Mail::raw(
                                            'Your banner "' . $record->campaign_name . '" has been approved successfully.',
                                            function ($message) use ($user) {
                                                $message->to($user->email)
                                                    ->subject('Banner Approved Successfully');
                                            }
                                        );
                                    } catch (\Exception $e) {
                                        \Log::error('[BULK APPROVE] Mail failed for ' . $user->email . ': ' . $e->getMessage());
                                    }
                                }
                            }
                        }

                        Notification::make()
                            ->title('Selected banners approved successfully')
                            ->success()
                            ->send();
                    }),

                \Filament\Actions\BulkAction::make('reject_selected')
                    ->label('Reject All')
                    ->color('danger')
                    ->extraAttributes(['class' => 'reject-all-btn'])
                    ->requiresConfirmation()
                    ->modalHeading('Reject Selected Banners')
                    ->modalDescription('Are you sure you want to reject all selected banner requests?')
                    ->modalSubmitActionLabel('Yes, Reject')
                    ->deselectRecordsAfterCompletion()
                    ->action(function (Collection $records): void {
                        foreach ($records as $record) {
                            $record->update([
                                'approval_status' => 'rejected',
                                'live_status'      => 'draft',
                            ]);

                            $user = User::where('university_id', $record->university_id)->first();

                            if ($user) {
                                UserNotification::create([
                                    'user_id'    => $user->id,
                                    'title'      => 'Banner Rejected',
                                    'message'    => 'Your banner "' . $record->campaign_name . '" has been rejected by admin.',
                                    'type'       => 'banner_rejected',
                                    'action_url' => (string) $user->id,
                                    'is_read'    => false,
                                ]);

                                if (!empty($user->email)) {
                                    try {
                                        MailConfigurationService::setMailConfig();
                                        Mail::raw(
                                            'Your banner "' . $record->campaign_name . '" has been rejected by admin.',
                                            function ($message) use ($user) {
                                                $message->to($user->email)
                                                    ->subject('Banner Rejected');
                                            }
                                        );
                                    } catch (\Exception $e) {
                                        \Log::error('[BULK REJECT] Mail failed for ' . $user->email . ': ' . $e->getMessage());
                                    }
                                }
                            }
                        }

                        Notification::make()
                            ->title('Selected banners rejected successfully')
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