<?php

namespace App\Filament\Pages;

use App\Models\Ticket;
use App\Models\User;
use Filament\Pages\Page;
use Filament\Panel;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use App\Services\MailConfigurationService;

class SupportTicketView extends Page
{
    public ?Ticket $ticket = null;

    public ?string $admin_reply = null;

    protected static bool $shouldRegisterNavigation = false;

    protected string $view = 'filament.pages.support-ticket-view';

    public function mount($id): void
    {
        $this->ticket = Ticket::findOrFail($id);
        $this->admin_reply = $this->ticket->admin_reply;
    }

    public static function getSlug(?Panel $panel = null): string
    {
        return 'support-ticket-view/{id}';
    }

    public function submitReply(): void
    {
        $this->validate([
            'admin_reply' => ['required', 'string'],
        ]);

        $this->ticket->update([
            'admin_reply' => $this->admin_reply,
            'status' => 'replied',
            'replied_by' => auth()->id(),
            'replied_at' => now(),
        ]);

        $user = User::find($this->ticket->university_id);

        if ($user && $user->email) {
            MailConfigurationService::setMailConfig();

            try {
                Mail::raw(
                    "Hello {$user->name},\n\n" .
                    "Your support ticket has received a reply.\n\n" .
                    "Subject: {$this->ticket->subject}\n\n" .
                    "Admin Reply:\n{$this->admin_reply}\n\n" .
                    "Thank you.",
                    function ($message) use ($user) {
                        $message->to($user->email)
                            ->subject('Reply on Your Support Ticket');
                    }
                );
            } catch (\Throwable $e) {
            }
        }

        $this->ticket->refresh();

        Notification::make()
            ->title('Reply submitted successfully and email sent')
            ->success()
            ->send();
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->role === 'admin';
    }
}