<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UniversityRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public string $rejectionReason,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your University Request Has Been Rejected',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.university-rejected',
            with: [
                'user'            => $this->user,
                'rejectionReason' => $this->rejectionReason,
            ],
        );
    }
}