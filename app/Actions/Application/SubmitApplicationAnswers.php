<?php

namespace App\Actions\Application;

use App\Models\Application;
use App\Models\ApplicationAnswer;
use App\Models\ScholarshipRequirement;
use App\Models\User;

class SubmitApplicationAnswers
{
    public function handle(
        User $user,
        Application $application,
        array $answers
    ): void {
        // 1. Ensure application belongs to user
        if ($application->user_id !== $user->id) {
            throw new \Exception('Unauthorized application access.');
        }

        // 2. Ensure application is still pending
        if ($application->status !== 'pending') {
            throw new \Exception('Cannot modify submitted application.');
        }

        foreach ($answers as $answer) {

            // 3. Validate structure
            if (! isset($answer['requirement_id'], $answer['value'])) {
                throw new \Exception('Invalid answer format.');
            }

            // 4. Ensure requirement exists
            $requirement = ScholarshipRequirement::find($answer['requirement_id']);

            if (! $requirement) {
                throw new \Exception('Requirement not found.');
            }

            // 5. Ensure requirement belongs to same scholarship
            if ($requirement->scholarship_id !== $application->scholarship_id) {
                throw new \Exception('Invalid requirement for this application.');
            }

            // 6. Upsert answer (create or update)
            ApplicationAnswer::updateOrCreate(
                [
                    'application_id' => $application->id,
                    'requirement_id' => $requirement->id,
                ],
                [
                    'value' => $answer['value'],
                ]
            );
        }
    }
}
