<?php

namespace App\Actions\Application;

use App\Models\Application;
use App\Models\ApplicationLog;
use App\Models\User;
use App\Notifications\ApplicationStatusUpdatedNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ApproveApplication
{
    public function handle(
        Application $application,
        User $admin,
        ?string $notes = null,
    ): Application {
        if (! $application->canTransitionTo(Application::STATUS_APPROVED)) {
            throw ValidationException::withMessages([
                'application' => 'Only pending applications can be approved.',
            ]);
        }

        $oldStatus = $application->status;

        $application->update([
            'status' => Application::STATUS_APPROVED,
            'reviewed_by' => $admin->id,
            'reviewed_at' => now(),
            'remarks' => $notes,
        ]);

        $scholarship = $application->scholarship;
        $scholarship->decrement('slots');
        if ($scholarship->slots <= 0) {
            $scholarship->update(['status' => 'full']);
        }

        ApplicationLog::create([
            'application_id' => $application->id,
            'old_status' => $oldStatus,
            'new_status' => Application::STATUS_APPROVED,
            'changed_by' => $admin->id,
            'notes' => $notes,
        ]);

        try {
            $application->user->notify(
                new ApplicationStatusUpdatedNotification($application)
            );
        } catch (\Throwable $e) {
            // Log the error so you can check it later, but don't crash.
            Log::warning('Could not send approval email notification: '.$e->getMessage());
        }

        return $application->fresh();
    }
}
