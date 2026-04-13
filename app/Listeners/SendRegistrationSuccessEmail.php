<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
// use App\Mail\RegistrationSuccessMail;
// use Illuminate\Support\Facades\Mail;
use App\Services\MailConfigurationService;
use App\Notifications\RegistrationSuccessNotification;

class SendRegistrationSuccessEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        try {
            $user = $event->user;

            MailConfigurationService::setMailConfig();

            // ✅ Breeze-style email
            $user->notify(new RegistrationSuccessNotification());

            // ✅ Your system notification (DB)
            sendNotification([
                'user_id' => $user->id,
                'title'   => 'Registration Successful',
                'message' => 'Your account has been created successfully.',
                'type'    => 'success',
            ]);
        } catch (\Exception $e) {
            \Log::error('Registration email failed: ' . $e->getMessage());
        }
    }
}
