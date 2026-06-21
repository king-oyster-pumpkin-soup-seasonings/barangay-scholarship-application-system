<?php

namespace App\Actions\Application;

use App\Models\Application;
use App\Models\ApplicationLog;
use App\Models\User;
use App\Notifications\ApplicationStatusUpdatedNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RejectApplication
{
    public function handle(
        Application $application,
        User $admin,
        string $reason,
    ): Application {
        if (! $application->canTransitionTo(Application::STATUS_REJECTED)) {
            throw ValidationException::withMessages([
                'application' => 'Only pending applications can be rejected.',
            ]);
        }

        $oldStatus = $application->status;

        $application->update([
            'status' => Application::STATUS_REJECTED,
            'reviewed_by' => $admin->id,
            'reviewed_at' => now(),
            'remarks' => $reason,
        ]);

        ApplicationLog::create([
            'application_id' => $application->id,
            'old_status' => $oldStatus,
            'new_status' => Application::STATUS_REJECTED,
            'changed_by' => $admin->id,
            'notes' => $reason,
        ]);

        try {
            $application->user->notify(
                new ApplicationStatusUpdatedNotification($application)
            );
        } catch (\Throwable $e) {
            Log::warning('Could not send rejection email notification: '.$e->getMessage());
        }

        return $application->fresh();
    }
}
