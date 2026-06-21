<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewDeviceLoginNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public string $device,
        public string $location,
        public string $loginTime,
    ) {}

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
        return (new MailMessage)
            ->subject('New login to your scholarship account')
            ->greeting('New device login detected')
            ->line('Your account was accessed from a device we have not seen in this browser session.')
            ->line("Device: {$this->device}")
            ->line("Location: {$this->location}")
            ->line("Time: {$this->loginTime}")
            ->line('If this was you, no action is needed. If not, please change your password immediately.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'device' => $this->device,
            'location' => $this->location,
            'login_time' => $this->loginTime,
        ];
    }
}
