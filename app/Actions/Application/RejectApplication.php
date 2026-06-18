<?php

namespace App\Actions\Application;

use App\Models\Application;
use App\Models\ApplicationLog;
use App\Models\User;
use App\Notifications\ApplicationStatusUpdatedNotification;

class RejectApplication
{
    public function handle(
        Application $application,
        User $admin,
        string $reason,
    ): Application {
        $oldStatus = $application->status;

        $application->update([
            'status' => 'rejected',
            'reviewed_by' => $admin->id,
            'reviewed_at' => now(),
            'remarks' => $reason,
        ]);

        ApplicationLog::create([
            'application_id' => $application->id,
            'old_status' => $oldStatus,
            'new_status' => 'rejected',
            'changed_by' => $admin->id,
            'notes' => $reason,
        ]);

        $application->user->notify(
            new ApplicationStatusUpdatedNotification($application)
        );

        return $application->fresh();
    }
}
