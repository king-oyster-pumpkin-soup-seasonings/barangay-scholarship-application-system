<?php

namespace App\Actions\ResidenceVerification;

use App\Models\ResidenceVerification;
use App\Models\User;
use App\Notifications\ResidenceVerificationApprovedNotification;

class ApproveResidenceVerification
{
    public function handle(
        ResidenceVerification $verification,
        User $admin,
    ): ResidenceVerification {
        $verification->update([
            'status' => 'approved',
            'reviewed_by' => $admin->id,
            'reviewed_at' => now(),
            'rejection_reason' => null,
        ]);
        $verification->user->notify(
            new ResidenceVerificationApprovedNotification()
        );

        $verification->user->update([
            'verification_status' => 'verified',
            'verified_by' => $admin->id,
            'verified_at' => now(),
            'verification_remarks' => null,
        ]);

        return $verification->fresh();
    }
}
