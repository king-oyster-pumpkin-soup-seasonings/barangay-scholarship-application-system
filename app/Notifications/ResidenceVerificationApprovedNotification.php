<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResidenceVerificationApprovedNotification extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Residence Verification Approved',
            'message' => 'Your residence verification has been approved. You may now apply for scholarships.',
            'type' => 'residence_verified',
        ];
    }
}
