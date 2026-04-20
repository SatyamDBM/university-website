<?php

namespace App\Filament\Pages;

use App\Models\Ticket;
use App\Models\User;
use BackedEnum;
use UnitEnum;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Mail;
use App\Services\MailConfigurationService;

class SupportTickets extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationLabel = 'Support & Tickets';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-lifebuoy';

    protected static string | UnitEnum | null $navigationGroup = 'Support & Tickets';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.support-tickets';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Ticket::query()->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Ticket ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('user_id')
                    ->label('University ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('subject')
                    ->label('Subject')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                Tables\Columns\BadgeColumn::make('priority')
                    ->label('Priority')
                    ->colors([
                        'success' => 'low',
                        'warning' => 'medium',
                        'danger' => 'high',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'open',
                        'primary' => 'replied',
                        'success' => 'closed',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y h:i A')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'open' => 'Open',
                        'replied' => 'Replied',
                        'closed' => 'Closed',
                    ])
                    ->placeholder('All Statuses'),
            ])
            ->actions([
                Action::make('view')
                    ->label('')
                    ->icon('heroicon-o-eye')
                    ->tooltip('View Ticket')
                    ->color('gray')
                    ->extraAttributes([
                        'class' => 'view-btn',
                    ])
                    ->url(fn (Ticket $record): string => SupportTicketView::getUrl([
                        'id' => $record->id,
                    ])),

                ActionGroup::make([
                    Action::make('reply')
                        ->label('Reply Ticket')
                        ->icon('heroicon-o-chat-bubble-left-right')
                        ->fillForm(fn (Ticket $record): array => [
                            'admin_reply' => $record->admin_reply,
                            'status' => $record->status,
                        ])
                        ->form([
                            Textarea::make('admin_reply')
                                ->label('Admin Reply')
                                ->rows(5)
                                ->required(),

                            Select::make('status')
                                ->label('Status')
                                ->options([
                                    'open' => 'Open',
                                    'replied' => 'Replied',
                                    'closed' => 'Closed',
                                ])
                                ->required(),
                        ])
                        ->action(function (array $data, Ticket $record): void {
                            $record->admin_reply = $data['admin_reply'];
                            $record->status = $data['status'];
                            $record->replied_by = auth()->id();
                            $record->replied_at = now();
                            $record->save();

                            $user = User::find($record->university_id);

                            if ($user && $user->email) {
                                MailConfigurationService::setMailConfig();

                                try {
                                    Mail::raw(
                                        "Hello {$user->name},\n\n" .
                                        "Your support ticket has received a reply.\n\n" .
                                        "Subject: {$record->subject}\n\n" .
                                        "Admin Reply:\n{$data['admin_reply']}\n\n" .
                                        "Thank you.",
                                        function ($message) use ($user, $record) {
                                            $message->to($user->email)
                                                ->subject('Reply on Your Support Ticket - ' . $record->subject);
                                        }
                                    );
                                } catch (\Throwable $e) {
                                }
                            }

                            Notification::make()
                                ->title('Ticket replied successfully and email sent')
                                ->success()
                                ->send();
                        }),

                    Action::make('close_ticket')
                        ->label('Close Ticket')
                        ->icon('heroicon-o-lock-closed')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Close Ticket')
                        ->modalDescription('Are you sure you want to close this ticket?')
                        ->modalSubmitActionLabel('Yes, Close')
                        ->visible(fn (Ticket $record): bool => $record->status !== 'closed')
                        ->action(function (Ticket $record): void {
                            $record->status = 'closed';
                            $record->save();

                            Notification::make()
                                ->title('Ticket closed successfully')
                                ->success()
                                ->send();
                        }),

                    Action::make('reopen_ticket')
                        ->label('Reopen Ticket')
                        ->icon('heroicon-o-arrow-path')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->modalHeading('Reopen Ticket')
                        ->modalDescription('Are you sure you want to reopen this ticket?')
                        ->modalSubmitActionLabel('Yes, Reopen')
                        ->visible(fn (Ticket $record): bool => $record->status === 'closed')
                        ->action(function (Ticket $record): void {
                            $record->status = 'open';
                            $record->save();

                            Notification::make()
                                ->title('Ticket reopened successfully')
                                ->warning()
                                ->send();
                        }),
                ])
                    ->label('')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->button(),
            ])
            ->actionsColumnLabel('Actions')
            ->paginated([10, 25, 50]);
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin';
    }
}