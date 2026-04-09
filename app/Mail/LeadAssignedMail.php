<?php

namespace App\Mail;

use App\Models\Enquiry;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeadAssignedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Enquiry $record;
    public User $assignedUser;

    public function __construct(Enquiry $record, User $assignedUser)
    {
        $this->record = $record;
        $this->assignedUser = $assignedUser;
    }

    public function build()
    {
        return $this->subject('New Lead Assigned')
            ->view('emails.lead-assigned');
    }
}