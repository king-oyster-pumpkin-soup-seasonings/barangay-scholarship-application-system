<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class ApplicationStatusUpdatedNotification extends Notification
{
    private string $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Application Status Updated',
            'message' => "Your scholarship application is now {$this->status}.",
            'type' => 'application_status_updated',
            'status' => $this->status,
        ];
    }
}
