<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistrationSuccessNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('🎉 Welcome to University Portal - Registration Successful')
            ->greeting('Hello ' . $notifiable->name . ' 👋')
            ->line('We are happy to inform you that your account has been successfully created in the University Portal.')
            ->line('You can now access all features including:')
            ->line('📌 Browse university brochures')
            ->line('📌 View latest notices and updates')
            ->line('📌 Manage your profile and preferences')
            ->line('📌 Stay updated with academic notifications')
            ->action('🚀 Login to Your Dashboard', url('/login'))
            ->line('If you face any issues while logging in, please contact our support team.')
            ->line('We are excited to have you on board and wish you a great experience ahead!')
            ->salutation("Regards,\nUniversity Portal Team");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
