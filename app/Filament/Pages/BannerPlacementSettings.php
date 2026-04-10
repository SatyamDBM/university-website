<?php

namespace App\Filament\Pages;

use App\Models\UniversityBanner;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use UnitEnum;

class BannerPlacementSettings extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|UnitEnum|null $navigationGroup = 'Banner Management';

    protected static ?string $navigationLabel = 'University Banners';

    protected static ?int $navigationSort = 2;

    protected static ?string $title = 'University Banners';

    protected string $view = 'filament.pages.banner-placement-settings';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                UniversityBanner::query()
                    ->with(['university', 'banner'])
                    ->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

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

                Tables\Columns\ImageColumn::make('banner_image')
                    ->label('Banner')
                    ->disk('public')
                    ->height(60)
                    ->width(100)
                    ->extraImgAttributes([
                        'style' => 'object-fit: cover; border-radius: 8px;',
                    ]),

                Tables\Columns\TextColumn::make('campaign_name')
                    ->label('Campaign Name')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('INR')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('payment_status')
                    ->label('Payment')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                        'danger' => 'failed',
                    ])
                    ->formatStateUsing(fn (?string $state) => ucfirst($state ?? '-')),

                Tables\Columns\BadgeColumn::make('approval_status')
                    ->label('Approval')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(fn (?string $state) => ucfirst($state ?? '-')),

                Tables\Columns\BadgeColumn::make('live_status')
                    ->label('Live Status')
                    ->colors([
                        'gray' => 'draft',
                        'warning' => 'scheduled',
                        'success' => 'live',
                        'danger' => 'expired',
                    ])
                    ->formatStateUsing(fn (?string $state) => ucfirst($state ?? '-')),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('End Date')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->actions([
                // ✅ Eye button bahar rahega
                Action::make('view')
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->tooltip('View Banner')
                    ->color('info')
                    ->extraAttributes([
                        'class' => 'view-btn',
                    ])
                    ->modalHeading('Banner Details')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close')
                    ->modalContent(fn ($record) => view(
                        'filament.modals.banner-preview',
                        ['record' => $record]
                    )),

                // ✅ Baki sab three-dot menu mein
                ActionGroup::make([
                    Action::make('approve')
                        ->label('Approve')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn ($record) => $record->approval_status === 'pending')
                        ->requiresConfirmation()
                        ->modalHeading('Approve Banner')
                        ->modalDescription('Are you sure you want to approve this banner? It will be scheduled for display.')
                        ->modalSubmitActionLabel('Yes, Approve')
                        ->action(function ($record) {
                            $record->update([
                                'approval_status' => 'approved',
                                'live_status'     => 'scheduled',
                            ]);

                            Notification::make()
                                ->title('Banner approved successfully')
                                ->success()
                                ->send();
                        }),

                    Action::make('reject')
                        ->label('Reject')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->visible(fn ($record) => $record->approval_status !== 'rejected')
                        ->requiresConfirmation()
                        ->modalHeading('Reject Banner')
                        ->modalDescription('Are you sure you want to reject this banner? Its live status will be reset to draft.')
                        ->modalSubmitActionLabel('Yes, Reject')
                        ->action(function ($record) {
                            $record->update([
                                'approval_status' => 'rejected',
                                'live_status'     => 'draft',
                            ]);

                            Notification::make()
                                ->title('Banner rejected successfully')
                                ->danger()
                                ->send();
                        }),

                    Action::make('mark_live')
                        ->label('Mark Live')
                        ->icon('heroicon-o-bolt')
                        ->color('success')
                        ->visible(fn ($record) => $record->approval_status === 'approved' && $record->live_status !== 'live')
                        ->requiresConfirmation()
                        ->modalHeading('Mark Banner as Live')
                        ->modalDescription('Are you sure you want to mark this banner as live? It will immediately start displaying to users.')
                        ->modalSubmitActionLabel('Yes, Go Live')
                        ->action(function ($record) {
                            $record->update([
                                'live_status' => 'live',
                            ]);

                            Notification::make()
                                ->title('Banner marked as live successfully')
                                ->success()
                                ->send();
                        }),

                    Action::make('expire')
                        ->label('Mark Expire')
                        ->icon('heroicon-o-clock')
                        ->color('warning')
                        ->visible(fn ($record) => $record->live_status === 'live')
                        ->requiresConfirmation()
                        ->modalHeading('Expire Banner')
                        ->modalDescription('Are you sure you want to mark this banner as expired? It will stop displaying immediately.')
                        ->modalSubmitActionLabel('Yes, Expire')
                        ->action(function ($record) {
                            $record->update([
                                'live_status' => 'expired',
                            ]);

                            Notification::make()
                                ->title('Banner marked as expired successfully')
                                ->warning()
                                ->send();
                        }),

                    Action::make('delete')
                        ->label('Delete')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Delete Banner')
                        ->modalDescription('Are you sure you want to permanently delete this banner? This action cannot be undone.')
                        ->modalSubmitActionLabel('Yes, Delete')
                        ->action(function ($record) {
                            $record->delete();

                            Notification::make()
                                ->title('Banner deleted successfully')
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
            ->bulkActions([
                \Filament\Actions\BulkAction::make('delete_selected')
                    ->label('Delete Selected')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Delete Selected Banners')
                    ->modalDescription('Are you sure you want to delete all selected banners? This action cannot be undone.')
                    ->modalSubmitActionLabel('Yes, Delete All')
                    ->deselectRecordsAfterCompletion()
                    ->action(function (Collection $records) {
                        foreach ($records as $record) {
                            $record->delete();
                        }

                        Notification::make()
                            ->title('Selected banners deleted successfully')
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