<?php

namespace App\Actions\Admin;

use App\Models\User;
use App\Notifications\AdminAccountRejectedNotification;

class RejectAdmin
{
    public function handle(
        User $admin,
        User $superadmin,
        string $reason,
    ): User {
        $admin->update([
            'verification_status' => 'rejected',
            'verified_by' => $superadmin->id,
            'verified_at' => now(),
            'verification_remarks' => $reason,
        ]);

        $admin->notify(
            new AdminAccountRejectedNotification($reason)
        );

        return $admin->fresh();
    }
}
