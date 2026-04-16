<?php

namespace App\Filament\Pages;

use App\Models\AdminFaq;
use UnitEnum;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Filters\SelectFilter;

class AllAdminFaqs extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationLabel = 'All Admin FAQs';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 5;

    protected static ?string $title = 'All Admin FAQs';

    protected string $view = 'filament.pages.all-admin-faqs';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                AdminFaq::query()->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('question')
                    ->label('Question')
                    ->searchable()
                    ->sortable()
                    ->limit(60),

                Tables\Columns\TextColumn::make('answer')
                    ->label('Answer')
                    ->html()
                    ->limit(80),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Sort Order')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('is_active')
                    ->label('Status')
                    ->colors([
                        'success' => fn ($state) => $state == 1,
                        'danger' => fn ($state) => $state == 0,
                    ])
                    ->formatStateUsing(fn ($state) => $state ? 'Active' : 'Inactive'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y h:i A')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        1 => 'Active',
                        0 => 'Inactive',
                    ])
                    ->placeholder('All Statuses'),
            ])
            ->headerActions([
                Action::make('create')
                    ->label('Create Admin FAQ')
                    ->icon('heroicon-o-plus')
                    ->color('primary')
                    ->url(url('/admin/create-admin-faq')),
            ])
            ->actions([
                Action::make('edit')
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Edit FAQ')
                    ->extraAttributes([
                        'class' => 'edit-btn',
                    ])
                    ->url(fn (AdminFaq $record): string => url('/admin/edit-admin-faq?id=' . $record->id)),

                Action::make('toggle_status')
                    ->label('')
                    ->icon(fn (AdminFaq $record): string => $record->is_active ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->tooltip(fn (AdminFaq $record): string => $record->is_active ? 'Deactivate FAQ' : 'Activate FAQ')
                    ->extraAttributes(fn (AdminFaq $record): array => [
                        'class' => $record->is_active ? 'inactive-btn' : 'active-btn',
                    ])
                    ->requiresConfirmation()
                    ->modalHeading(fn (AdminFaq $record): string => $record->is_active ? 'Deactivate FAQ' : 'Activate FAQ')
                    ->modalDescription(fn (AdminFaq $record): string => $record->is_active
                        ? 'Are you sure you want to deactivate this FAQ?'
                        : 'Are you sure you want to activate this FAQ?')
                    ->modalSubmitActionLabel(fn (AdminFaq $record): string => $record->is_active ? 'Yes, Deactivate' : 'Yes, Activate')
                    ->action(function (AdminFaq $record): void {
                        $newStatus = ! $record->is_active;

                        $record->update([
                            'is_active' => $newStatus,
                        ]);

                        Notification::make()
                            ->title($newStatus ? 'FAQ activated successfully' : 'FAQ deactivated successfully')
                            ->success()
                            ->send();
                    }),

                Action::make('delete')
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->tooltip('Delete FAQ')
                    ->extraAttributes([
                        'class' => 'delete-btn',
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Delete FAQ')
                    ->modalDescription('Are you sure you want to delete this FAQ?')
                    ->modalSubmitActionLabel('Yes, Delete')
                    ->action(function (AdminFaq $record): void {
                        $record->delete();

                        Notification::make()
                            ->title('FAQ deleted successfully')
                            ->success()
                            ->send();
                    }),
            ])
            ->actionsColumnLabel('Actions')
            ->emptyStateHeading('No FAQs Found')
            ->emptyStateDescription('Create your first FAQ to get started.')
            ->paginated([10, 25, 50]);
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin';
    }
}