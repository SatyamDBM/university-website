<?php

namespace App\Filament\Pages;

use App\Models\Enquiry;
use App\Models\University;
use UnitEnum;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class DirectLeads extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationLabel = 'Direct Leads';

    protected static string|UnitEnum|null $navigationGroup = 'Leads';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.direct-leads';

    public ?string $universitySearch = '';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Enquiry::query()
                    ->whereNull('university_id')
                    ->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('mobile')
                    ->label('Mobile')
                    ->default('-'),

                Tables\Columns\TextColumn::make('message')
                    ->label('Message')
                    ->limit(60)
                    ->tooltip(fn (Enquiry $record) => $record->message)
                    ->default('-'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Submitted At')
                    ->dateTime('d M Y h:i A')
                    ->sortable(),
            ])
            ->actions([
                Action::make('assign_university')
                    ->label('')
                    ->icon('heroicon-o-building-office-2')
                    ->tooltip('Assign University')
                    ->extraAttributes(['class' => 'assign-btn'])
                    ->modalWidth('lg')
                    ->modalHeading('Assign University')
                    ->modalDescription('Search and select a university to assign.')
                    ->modalSubmitActionLabel('Assign University')
                    ->form([
                        TextInput::make('search')
                            ->label('Search University')
                            ->placeholder('Type to filter...')
                            ->live()
                            ->afterStateUpdated(fn () => null),

                        Radio::make('university_id')
                            ->label('Select University')
                            ->options(function (\Filament\Schemas\Components\Utilities\Get $get) {
                                $search = $get('search');

                                return University::query()
                                    ->when(
                                        filled($search),
                                        fn ($q) => $q->where('name', 'like', "%{$search}%"),
                                    )
                                    ->orderBy('name')
                                    ->limit(10)
                                    ->pluck('name', 'id')
                                    ->toArray();
                            })
                            ->required(),
                    ])
                    ->action(function (array $data, Enquiry $record): void {
                        $record->update([
                            'university_id' => (int) $data['university_id'],
                        ]);

                        Notification::make()
                            ->title('University assigned successfully')
                            ->success()
                            ->send();
                    }),

                // Action::make('mark_contacted')
                //     ->label('')
                //     ->icon('heroicon-o-phone')
                //     ->tooltip('Mark as Contacted')
                //     ->extraAttributes(['class' => 'contacted-btn'])
                //     ->action(function (): void {
                //         Notification::make()
                //             ->title('Lead marked as contacted')
                //             ->success()
                //             ->send();
                //     }),

                Action::make('delete')
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->tooltip('Delete Lead')
                    ->extraAttributes(['class' => 'delete-btn'])
                    ->requiresConfirmation()
                    ->modalHeading('Delete Lead')
                    ->modalDescription('Are you sure you want to delete this lead?')
                    ->modalSubmitActionLabel('Yes, Delete')
                    ->action(function (Enquiry $record): void {
                        $record->delete();

                        Notification::make()
                            ->title('Lead deleted successfully')
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