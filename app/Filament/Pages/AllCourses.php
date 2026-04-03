<?php

namespace App\Filament\Pages;

use App\Models\Course;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
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
                Course::query()
                    ->with(['category', 'subcategory', 'university'])
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
                    ->limit(25),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('course_name')
                    ->label('Course Name')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('course_type')
                    ->label('Course Type')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('mode')
                    ->label('Mode')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Online' => 'success',
                        'Offline' => 'warning',
                        'Hybrid' => 'info',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('total_fees')
                    ->label('Total Fees')
                    ->money('INR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('admission_status')
                    ->label('Admission')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Open' => 'success',
                        'Closed' => 'danger',
                        default => 'gray',
                    }),

              Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Draft' => 'gray',
                        'Pending' => 'warning',
                        'Live' => 'success',
                        'Rejected' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y h:i A')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Draft' => 'Draft',
                        'Pending' => 'Pending',
                        'Live' => 'Live',
                        'Rejected' => 'Rejected',
                    ]),

                Tables\Filters\SelectFilter::make('admission_status')
                    ->options([
                        'Open' => 'Open',
                        'Closed' => 'Closed',
                    ]),

                Tables\Filters\SelectFilter::make('mode')
                    ->options([
                        'Online' => 'Online',
                        'Offline' => 'Offline',
                        'Hybrid' => 'Hybrid',
                    ]),
            ])
            ->actions([
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Course $record) => $record->status === 'Pending')
                    ->requiresConfirmation()
                    ->modalHeading('Approve Course')
                    ->modalDescription('Are you sure you want to approve this course?')
                    ->modalSubmitActionLabel('Yes, Approve')
                    ->action(function (Course $record) {
                        $record->update([
                            'status' => 'Live',
                            'admin_feedback' => null,
                        ]);

                        Notification::make()
                            ->title('Course approved successfully')
                            ->success()
                            ->send();
                    }),

                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (Course $record) => in_array($record->status, ['Pending', 'Live']))
                    ->form([
                        Textarea::make('admin_feedback')
                            ->label('Reason for Rejection')
                            ->placeholder('Enter rejection reason')
                            ->required()
                            ->rows(4),
                    ])
                    ->modalHeading('Reject Course')
                    ->modalDescription('Please provide a reason before rejecting this course.')
                    ->modalSubmitActionLabel('Reject Course')
                    ->action(function (array $data, Course $record) {
                        $record->update([
                            'status' => 'Rejected',
                            'admin_feedback' => $data['admin_feedback'],
                        ]);

                        Notification::make()
                            ->title('Course rejected successfully')
                            ->success()
                            ->send();
                    }),

                Action::make('delete')
                    ->label('Delete')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Delete Course')
                    ->modalDescription('Are you sure you want to delete this course?')
                    ->modalSubmitActionLabel('Yes, Delete')
                    ->action(function (Course $record) {
                        $record->delete();

                        Notification::make()
                            ->title('Course deleted successfully')
                            ->success()
                            ->send();
                    }),
            ])
            ->defaultSort('id', 'desc')
            ->striped()
            ->paginated([10, 25, 50]);
    }
}