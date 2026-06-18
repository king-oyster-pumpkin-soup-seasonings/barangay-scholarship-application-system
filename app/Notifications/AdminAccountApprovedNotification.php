<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class AdminAccountApprovedNotification extends Notification
{
    private User $approvedAdmin;

    public function __construct(User $approvedAdmin)
    {
        $this->approvedAdmin = $approvedAdmin;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Admin Account Approved',
            'message' => 'Your admin account has been approved. You may now access the admin panel.',
            'type' => 'admin_approved',
        ];
    }
}
