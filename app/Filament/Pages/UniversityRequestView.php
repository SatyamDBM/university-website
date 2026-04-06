<?php

namespace App\Filament\Pages;

use App\Models\User;
use App\Models\University;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use App\Services\MailConfigurationService;
use Illuminate\Support\Facades\Mail;
use App\Mail\UniversityApprovedMail;
use Filament\Pages\Page;

class UniversityRequestView extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'University Request Details';

    protected string $view = 'filament.pages.university-request-view';

    public User $record;

    public ?University $university = null;

    public function mount(): void
    {
        $id = request()->query('id');

        $this->record = User::where('role', 'university')
            ->findOrFail($id);

        $this->university = University::find($this->record->university_id);
    }

    protected function getHeaderActions(): array
    {
        $actions = [];

        if ($this->record->linking_status !== 'approved') {
            $actions[] = Action::make('approve')
                ->label('Approve')
                ->icon('')
                ->color('success')
                ->extraAttributes([
                    'class' => 'approve-btn',
                ])
                ->requiresConfirmation()
                ->modalHeading('Approve University')
                ->modalDescription('Are you sure you want to approve this university request?')
                ->modalSubmitActionLabel('Yes, Approve')
                ->action(function (): void {
                    $this->record->update([
                        'linking_status' => 'approved',
                    ]);

                    // Set SMTP config from DB
                    MailConfigurationService::setMailConfig();

                    // Send approval email
                    try {
                        Mail::to($this->record->email)->send(new UniversityApprovedMail($this->record));
                    } catch (\Throwable $e) {
                        // Optionally log error or notify admin
                    }

                    Notification::make()
                        ->title('University approved successfully')
                        ->success()
                        ->send();

                    $this->redirect(UniversitiesRequest::getUrl());
                });
        }

        return $actions;
    }
}