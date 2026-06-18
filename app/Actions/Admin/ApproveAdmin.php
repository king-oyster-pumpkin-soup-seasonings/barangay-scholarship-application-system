<?php

namespace App\Actions\Admin;

use App\Models\User;
use App\Notifications\AdminAccountApprovedNotification;

class ApproveAdmin
{
    public function handle(
        User $admin,
        User $superadmin,
    ): User {
        $admin->update([
            'verification_status' => 'verified',
            'verified_by' => $superadmin->id,
            'verified_at' => now(),
            'verification_remarks' => null,
        ]);

        $admin->notify(
            new AdminAccountApprovedNotification($admin)
        );

        return $admin->fresh();
    }
}
