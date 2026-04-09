<?php

namespace App\Filament\Pages;

use App\Models\Enquiry;
use App\Models\User;
use App\Models\UserNotification;
use App\Mail\LeadAssignedMail;
use App\Mail\BulkLeadAssignedMail;
use App\Services\MailConfigurationService;
use UnitEnum;
use BackedEnum;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Collection;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\CheckboxList;
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
                    ->where(function ($query) {
                        $query->whereNull('user_id')
                            ->orWhere('user_id', 0);
                    })
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

                Tables\Columns\TextColumn::make('course')
                    ->label('Course')
                    ->searchable()
                    ->sortable()
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
            ->filters([
                Tables\Filters\Filter::make('course')
                    ->form([
                        TextInput::make('course_search')
                            ->label('Search Course')
                            ->placeholder('Type course name...')
                            ->live(),

                        CheckboxList::make('courses')
                            ->label('Course')
                            ->options(function (\Filament\Schemas\Components\Utilities\Get $get) {
                                $search = $get('course_search');

                                return Enquiry::query()
                                    ->where(function ($query) {
                                        $query->whereNull('user_id')
                                            ->orWhere('user_id', 0);
                                    })
                                    ->whereNotNull('course')
                                    ->when(
                                        filled($search),
                                        fn ($query) => $query->where('course', 'like', '%' . $search . '%')
                                    )
                                    ->distinct()
                                    ->orderBy('course')
                                    ->limit(5)
                                    ->pluck('course', 'course')
                                    ->toArray();
                            })
                            ->columns(1),
                    ])
                    ->query(function ($query, array $data) {
                        if (!empty($data['courses'])) {
                            $query->whereIn('course', $data['courses']);
                        }
                    }),
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

                        Radio::make('user_id')
                            ->label('Select University')
                            ->options(function (\Filament\Schemas\Components\Utilities\Get $get) {
                                $search = $get('search');

                                return User::query()
                                    ->where('role', 'university')
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

                        $assignedUser = User::find((int) $data['user_id']);

                        $record->update([
                            'user_id' => (int) $data['user_id'],
                        ]);

                        UserNotification::create([
                            'user_id'    => $assignedUser->id,
                            'title'      => 'New Lead Assigned',
                            'message'    => 'A new lead has been assigned to you. Lead Name: ' . $record->name,
                            'type'       => 'lead_assign',
                            'action_url' => (string) $assignedUser->id,
                            'is_read'    => 0,
                        ]);

                        try {
                            MailConfigurationService::setMailConfig();

                            if (!empty($assignedUser->email)) {
                                Mail::to($assignedUser->email)
                                    ->send(new LeadAssignedMail($record, $assignedUser));
                            }
                        } catch (\Exception $e) {
                        }

                        Notification::make()
                            ->title('University assigned successfully')
                            ->success()
                            ->send();
                    }),

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
            ->bulkActions([
                BulkAction::make('assign_university')
                    ->label('Assign University')
                    ->icon('')
                    ->extraAttributes(['class' => 'bulk-assign-btn'])
                    ->modalWidth('lg')
                    ->modalHeading('Assign University')
                    ->modalDescription('Select university for selected leads.')
                    ->modalSubmitActionLabel('Assign University')
                    ->deselectRecordsAfterCompletion()
                    ->form([
                        TextInput::make('search')
                            ->label('Search University')
                            ->placeholder('Type to filter...')
                            ->live()
                            ->afterStateUpdated(fn () => null),

                        Radio::make('user_id')
                            ->label('Select University')
                            ->options(function (\Filament\Schemas\Components\Utilities\Get $get) {
                                $search = $get('search');

                                return User::query()
                                    ->where('role', 'university')
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
                    ->action(function (array $data, Collection $records): void {

                        $assignedUser = User::find((int) $data['user_id']);

                        foreach ($records as $record) {
                            $record->update([
                                'user_id' => (int) $data['user_id'],
                            ]);
                        }

                        UserNotification::create([
                            'user_id'    => $assignedUser->id,
                            'title'      => 'Multiple Leads Assigned',
                            'message'    => $records->count() . ' new leads have been assigned to you.',
                            'type'       => 'bulk_lead_assign',
                            'action_url' => (string) $assignedUser->id,
                            'is_read'    => 0,
                        ]);

                        try {
                            MailConfigurationService::setMailConfig();

                            if (!empty($assignedUser->email)) {
                                Mail::to($assignedUser->email)
                                    ->send(new BulkLeadAssignedMail($records, $assignedUser));
                            }
                        } catch (\Exception $e) {
                        }

                        Notification::make()
                            ->title('University assigned successfully')
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