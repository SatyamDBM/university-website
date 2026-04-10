<?php

namespace App\Filament\Pages;

use App\Models\UniversityBanner;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Collection;
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

                // Tables\Columns\ImageColumn::make('banner_image')
                //     ->label('Banner Image')
                //     ->disk('public')
                //     ->height(60)
                //     ->width(100)
                //     ->extraImgAttributes([
                //         'style' => 'object-fit: cover; border-radius: 8px;',
                //     ]),

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
                        'danger' => 'failed',
                    ])
                    ->formatStateUsing(fn (?string $state) => ucfirst($state ?? '-')),

                Tables\Columns\BadgeColumn::make('approval_status')
                    ->label('Approval Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(fn (?string $state) => ucfirst($state ?? '-')),
            ])
            ->actions([
                Action::make('view_banner')
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->tooltip('View Banner')
                    ->color('info')
                    ->extraAttributes([
                        'class' => 'view-btn',
                    ])
                    ->modalHeading('Banner Preview')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close')
                    ->modalContent(fn ($record) => view(
                        'filament.modals.banner-preview',
                        ['record' => $record]
                    )),

                Action::make('approve')
                    ->label('')
                    ->icon('heroicon-o-check-circle')
                    ->tooltip('Approve Banner')
                    ->color('success')
                    ->extraAttributes([
                        'class' => 'approve-btn',
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Approve Banner')
                    ->modalDescription('Are you sure you want to approve this banner request?')
                    ->modalSubmitActionLabel('Yes, Approve')
                    ->action(function (UniversityBanner $record): void {
                        $record->update([
                            'approval_status' => 'approved',
                            'live_status' => 'scheduled',
                        ]);

                        Notification::make()
                            ->title('Banner approved successfully')
                            ->success()
                            ->send();
                    }),

                Action::make('reject')
                    ->label('')
                    ->icon('heroicon-o-x-circle')
                    ->tooltip('Reject Banner')
                    ->color('danger')
                    ->extraAttributes([
                        'class' => 'delete-btn',
                    ])
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
                            'approval_status' => 'rejected',
                            'rejection_reason' => $data['rejection_reason'],
                            'live_status' => 'draft',
                        ]);

                        Notification::make()
                            ->title('Banner rejected successfully')
                            ->danger()
                            ->send();
                    }),

                Action::make('delete')
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->tooltip('Delete Banner')
                    ->color('danger')
                    ->extraAttributes([
                        'class' => 'delete-btn',
                    ])
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
            ->bulkActions([
                \Filament\Actions\BulkAction::make('approve_selected')
                    ->label('Approve All')
                    ->color('success')
                    ->extraAttributes([
                        'class' => 'approve-all-btn',
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Approve Selected Banners')
                    ->modalDescription('Are you sure you want to approve all selected banner requests?')
                    ->modalSubmitActionLabel('Yes, Approve')
                    ->deselectRecordsAfterCompletion()
                    ->action(function (Collection $records): void {
                        foreach ($records as $record) {
                            $record->update([
                                'approval_status' => 'approved',
                                'live_status' => 'scheduled',
                            ]);
                        }

                        Notification::make()
                            ->title('Selected banners approved successfully')
                            ->success()
                            ->send();
                    }),

                \Filament\Actions\BulkAction::make('reject_selected')
                    ->label('Reject All')
                    ->color('danger')
                    ->extraAttributes([
                        'class' => 'reject-all-btn',
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Reject Selected Banners')
                    ->modalDescription('Are you sure you want to reject all selected banner requests?')
                    ->modalSubmitActionLabel('Yes, Reject')
                    ->deselectRecordsAfterCompletion()
                    ->action(function (Collection $records): void {
                        foreach ($records as $record) {
                            $record->update([
                                'approval_status' => 'rejected',
                                'live_status' => 'draft',
                            ]);
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