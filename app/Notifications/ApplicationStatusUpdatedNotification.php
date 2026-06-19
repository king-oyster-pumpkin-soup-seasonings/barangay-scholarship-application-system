<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationStatusUpdatedNotification extends Notification
{
    /**
     * Create a new notification instance.
     */
    public function __construct(public Application $application) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $status = ucfirst($this->application->status);
        $scholarshipTitle = $this->application->scholarship->title;
        $remarks = $this->application->remarks;

        $message = (new MailMessage)
            ->subject("Scholarship Application {$status} - {$scholarshipTitle}")
            ->greeting("Hello {$notifiable->name},")
            ->line("Your application for the scholarship program \"{$scholarshipTitle}\" has been {$this->application->status}.");

        if ($remarks) {
            $message->line("Remarks: {$remarks}");
        }

        return $message
            ->action('View My Dashboard', route('dashboard'))
            ->line('Thank you for using the Barangay Scholarship System!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Application Status Updated',
            'message' => "Your scholarship application is now {$this->application->status}.",
            'type' => 'application_status_updated',
            'status' => $this->application->status,
        ];
    }
}
