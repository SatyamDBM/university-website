<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class BulkLeadAssignedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Collection $records;
    public User $assignedUser;

    public function __construct(Collection $records, User $assignedUser)
    {
        $this->records = $records;
        $this->assignedUser = $assignedUser;
    }

    public function build()
    {
        return $this->subject('Multiple Leads Assigned')
            ->view('emails.university.bulk-lead-assigned');
    }
}