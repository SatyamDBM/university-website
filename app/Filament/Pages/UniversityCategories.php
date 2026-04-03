<?php

namespace App\Filament\Pages;

use App\Models\Category;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use UnitEnum;
use BackedEnum;

class UniversityCategories extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-tag';

    protected static string|UnitEnum|null $navigationGroup = 'Categories';

    protected static ?string $navigationLabel = 'All Categories';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.university-categories';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Category::query()->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Category Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->html(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y h:i A')
                    ->sortable(),
            ])
            ->actions([
                Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-o-pencil-square')
                    ->color('primary')
                    ->url(fn (Category $record) => url('/admin/edit-university-category/' . $record->id)),

                Action::make('delete')
                    ->label('Delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->extraAttributes([
                        'style' => 'color:#111827 !important; font-weight:700 !important; text-decoration:none !important;',
                    ])
                    ->requiresConfirmation()
                    ->modalHeading('Delete Category')
                    ->modalDescription('Are you sure you want to delete this category?')
                    ->modalSubmitActionLabel('Yes, Delete')
                    ->action(function (Category $record) {
                        $record->delete();

                        Notification::make()
                            ->title('Category deleted successfully')
                            ->success()
                            ->send();
                    }),
            ])
            ->paginated([10, 25, 50]);
    }
}