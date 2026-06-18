<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminAccountRejectedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $reason
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Admin Account Rejected',
            'message' => $this->reason,
            'type' => 'admin_rejected',
        ];
    }
}
