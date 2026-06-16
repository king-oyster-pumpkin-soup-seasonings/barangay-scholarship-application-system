<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ResidenceVerification;

class Verifications extends Component
{
    // This function runs automatically when the Admin clicks the "Approve" button
    public function approve($id)
    {
        // 1. Find the verification record in the database
        $verification = ResidenceVerification::find($id);

        // 2. Change the status to 'verified'
        $verification->update(['status' => 'verified', 'reviewed_at' => now()]);

        // 3. Also update the user's main profile status!
        $verification->user->update(['verification_status' => 'verified']);
    }

    // This function runs when the Admin clicks the "Reject" button
    public function reject($id)
    {
        $verification = ResidenceVerification::find($id);
        $verification->update(['status' => 'rejected', 'reviewed_at' => now()]);

        $verification->user->update(['verification_status' => 'rejected']);
    }

    public function render()
    {
        // Fetch all verifications where the status is 'pending', and include the user's details
        $pendingVerifications = ResidenceVerification::with('user')->where('status', 'pending')->get();

        // Pass the data to the HTML view
        return view('livewire.admin.verifications', [
            'pendingVerifications' => $pendingVerifications
        ]);
    }
}
