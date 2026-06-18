<?php

namespace App\Actions\Application;

use App\Models\Application;
use App\Models\Scholarship;
use App\Models\User;
use Carbon\Carbon;

class CreateApplication
{
    public function handle(User $user, Scholarship $scholarship): Application
    {
        // 1. Prevent duplicate application
        $existing = Application::where('user_id', $user->id)
            ->where('scholarship_id', $scholarship->id)
            ->first();

        if ($existing) {
            throw new \Exception('You already applied to this scholarship.');
        }

        // 2. Check scholarship status
        if ($scholarship->status !== 'available') {
            throw new \Exception('This scholarship is not open for applications.');
        }

        // 3. Check deadline
        if ($scholarship->deadline && Carbon::now()->gt($scholarship->deadline)) {
            throw new \Exception('Application deadline has passed.');
        }

        // 4. Check slots
        $approvedCount = Application::where('scholarship_id', $scholarship->id)
            ->where('status', 'approved')
            ->count();

        if ($approvedCount >= $scholarship->slots) {
            throw new \Exception('No slots remaining for this scholarship.');
        }

        // 5. Create application
        return Application::create([
            'user_id' => $user->id,
            'scholarship_id' => $scholarship->id,
            'status' => 'pending',
            'submitted_at' => now(),
        ]);
    }
}
