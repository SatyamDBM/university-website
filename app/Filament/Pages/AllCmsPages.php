<?php

namespace App\Filament\Pages;

use App\Models\CmsPage;
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

class AllCmsPages extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationLabel = 'All CMS Pages';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 2;

    protected static ?string $title = 'All CMS Pages';

    protected string $view = 'filament.pages.all-cms-pages';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                CmsPage::query()->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Page Title')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('seo_title')
                    ->label('SEO Title')
                    ->searchable()
                    ->limit(40)
                    ->default('-'),

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
                    ->label('Create CMS Page')
                    ->icon('heroicon-o-plus')
                    ->color('primary')
                    ->url(url('/admin/create-cms-page')),
            ])
            ->actions([
                Action::make('edit')
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Edit CMS Page')
                    ->extraAttributes([
                        'class' => 'edit-btn',
                    ])
                    ->url(fn (CmsPage $record): string => url('/admin/edit-cms-page?id=' . $record->id)),

                Action::make('toggle_status')
                    ->label('')
                    ->icon(fn (CmsPage $record): string => $record->is_active ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->tooltip(fn (CmsPage $record): string => $record->is_active ? 'Deactivate CMS Page' : 'Activate CMS Page')
                    ->extraAttributes(fn (CmsPage $record): array => [
                            'class' => $record->is_active ? 'inactive-btn' : 'active-btn',
                        ])
                    ->requiresConfirmation()
                    ->modalHeading(fn (CmsPage $record): string => $record->is_active ? 'Deactivate CMS Page' : 'Activate CMS Page')
                    ->modalDescription(fn (CmsPage $record): string => $record->is_active
                        ? 'Are you sure you want to deactivate this CMS page?'
                        : 'Are you sure you want to activate this CMS page?')
                    ->modalSubmitActionLabel(fn (CmsPage $record): string => $record->is_active ? 'Yes, Deactivate' : 'Yes, Activate')
                    ->action(function (CmsPage $record): void {
                        $newStatus = ! $record->is_active;

                        $record->update([
                            'is_active' => $newStatus,
                        ]);

                        Notification::make()
                            ->title($newStatus ? 'CMS page activated successfully' : 'CMS page deactivated successfully')
                            ->success()
                            ->send();
                    }),

                // Action::make('delete')
                //     ->label('')
                //     ->icon('heroicon-o-trash')
                //     ->tooltip('Delete CMS Page')
                //     ->extraAttributes([
                //         'class' => 'delete-btn',
                //     ])
                //     ->requiresConfirmation()
                //     ->modalHeading('Delete CMS Page')
                //     ->modalDescription('Are you sure you want to delete this CMS page?')
                //     ->modalSubmitActionLabel('Yes, Delete')
                //     ->action(function (CmsPage $record): void {
                //         $record->delete();

                //         Notification::make()
                //             ->title('CMS page deleted successfully')
                //             ->success()
                //             ->send();
                //     }),
            ])
            ->actionsColumnLabel('Actions')
            ->emptyStateHeading('No CMS Pages Found')
            ->emptyStateDescription('Create your first CMS page to get started.')
            ->paginated([10, 25, 50]);
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin';
    }
}