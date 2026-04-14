<?php

namespace App\Filament\Pages;

use App\Models\Blog as BlogModel;
use UnitEnum;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class Blog extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationLabel = 'All Blog';

    protected static string|UnitEnum|null $navigationGroup = 'Blogs';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 2;

    protected static ?string $title = 'All Blog';

    protected string $view = 'filament.pages.blog';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                BlogModel::query()
                    ->with('detail')
                    ->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Image')
                    ->square()
                    ->defaultImageUrl(asset('images/no-image.png')),

                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('category_name')
                    ->label('Category')
                    ->default('-')
                    ->searchable(),

                Tables\Columns\TextColumn::make('short_description')
                    ->label('Short Description')
                    ->limit(50)
                    ->tooltip(fn (BlogModel $record) => $record->short_description)
                    ->default('-'),

                Tables\Columns\TextColumn::make('detail.meta_title')
                    ->label('Meta Title')
                    ->limit(30)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('detail.tags')
                    ->label('Tags')
                    ->limit(30)
                    ->toggleable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'published',
                    ])
                    ->formatStateUsing(fn (?string $state): string => ucfirst($state ?? '-')),

                Tables\Columns\TextColumn::make('publish_type')
                    ->label('Publish Type')
                    ->formatStateUsing(fn (?string $state): string => ucfirst($state ?? '-'))
                    ->default('-'),

                Tables\Columns\TextColumn::make('publish_date')
                    ->label('Publish Date')
                    ->dateTime('d M Y h:i A')
                    ->sortable()
                    ->default('-'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y h:i A')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ]),

                Tables\Filters\SelectFilter::make('publish_type')
                    ->options([
                        'instant' => 'Instant',
                        'scheduled' => 'Scheduled',
                    ]),
            ])
            ->actions([
                Action::make('view')
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->tooltip('View Blog')
                    ->url(fn (BlogModel $record): string => url('/admin/view-blog?id=' . $record->id)),

                Action::make('edit')
                    ->label('')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Edit Blog')
                    ->url(fn (BlogModel $record): string => url('/admin/edit-blog?id=' . $record->id)),

                Action::make('publish')
                    ->label('')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->tooltip('Publish Blog')
                    ->visible(fn (BlogModel $record): bool => $record->status !== 'published')
                    ->requiresConfirmation()
                    ->modalHeading('Publish Blog')
                    ->modalDescription('Are you sure you want to publish this blog?')
                    ->modalSubmitActionLabel('Yes, Publish')
                    ->action(function (BlogModel $record): void {
                        $record->update([
                            'status' => 'published',
                        ]);

                        Notification::make()
                            ->title('Blog published successfully')
                            ->success()
                            ->send();
                    }),

                Action::make('draft')
                    ->label('')
                    ->icon('heroicon-o-x-circle')
                    ->color('warning')
                    ->tooltip('Move to Draft')
                    ->visible(fn (BlogModel $record): bool => $record->status === 'published')
                    ->requiresConfirmation()
                    ->modalHeading('Move Blog to Draft')
                    ->modalDescription('Are you sure you want to move this blog to draft?')
                    ->modalSubmitActionLabel('Yes, Move')
                    ->action(function (BlogModel $record): void {
                        $record->update([
                            'status' => 'draft',
                        ]);

                        Notification::make()
                            ->title('Blog moved to draft successfully')
                            ->success()
                            ->send();
                    }),

                Action::make('delete')
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->tooltip('Delete Blog')
                    ->requiresConfirmation()
                    ->modalHeading('Delete Blog')
                    ->modalDescription('Are you sure you want to delete this blog?')
                    ->modalSubmitActionLabel('Yes, Delete')
                    ->action(function (BlogModel $record): void {
                        $record->delete();

                        Notification::make()
                            ->title('Blog deleted successfully')
                            ->success()
                            ->send();
                    }),
            ])
            ->actionsColumnLabel('Actions')
            ->defaultSort('id', 'desc')
            ->paginated([10, 25, 50]);
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin';
    }
}