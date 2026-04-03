<?php

namespace App\Filament\Pages;

use App\Models\Course;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use UnitEnum;
use BackedEnum;

class AllCourses extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-book-open';

    protected static string|UnitEnum|null $navigationGroup = 'Categories';

    protected static ?string $navigationLabel = 'All Courses';

    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.pages.all-courses';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Course::query()->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Course Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->toggleable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y h:i A')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' =>'active',
                        'inactive'=>'inactive',
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                    ]),
            ])
            ->actions([
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Course $record) => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->modalHeading('Approve Course')
                    ->modalDescription('Are you sure you want to approve this course?')
                    ->modalSubmitActionLabel('Yes, Approve')
                    ->action(function (Course $record) {
                        $record->update([
                            'status' => 'approved',
                        ]);

                        Notification::make()
                            ->title('Course approved successfully')
                            ->success()
                            ->send();
                    }),
            ])
            ->paginated([10, 25, 50]);
    }
}