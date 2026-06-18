<?php

namespace App\Actions\ResidenceVerification;

use App\Models\ResidenceVerification;
use App\Models\User;

class RejectResidenceVerification
{
    public function handle(
        ResidenceVerification $verification,
        User $admin,
        string $reason,
    ): ResidenceVerification {
        $verification->update([
            'status' => 'rejected',
            'reviewed_by' => $admin->id,
            'reviewed_at' => now(),
            'rejection_reason' => $reason,
        ]);

        $verification->user->update([
            'verification_status' => 'rejected',
            'verified_by' => $admin->id,
            'verified_at' => now(),
            'verification_remarks' => $reason,
        ]);

        return $verification->fresh();
    }
}
