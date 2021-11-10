<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class ForgotPasswordNotification extends Notification
{
    use Queueable;

    public string $randomString;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($randomString)
    {
        $this->randomString = $randomString;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Reset password link for MyApp account.')
                    ->action(
                        'Click here to generate a new',
                        route('reset-password', [
                            'random_string' => $this->randomString,
                            'id' => $notifiable->id
                        ])
                    )
                    ->line('Thank you for using MyApp services!');
    }
}
