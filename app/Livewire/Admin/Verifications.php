<?php

namespace App\Livewire\Admin;

use App\Models\ResidenceVerification;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Verifications extends Component
{
    public bool $showRejectionModal = false;

    public string $rejectionReason = '';

    public ?int $selectedVerificationId = null;

    /**
     * Approve a residence verification request
     */
    public function approve(int $id): void
    {
        $verification = ResidenceVerification::find($id);

        if ($verification) {
            $verification->update([
                'status' => 'verified',
                'reviewed_by' => auth()->id(),
                'reviewed_at' => now(),
            ]);

            $verification->user->update([
                'verification_status' => 'verified',
                'verified_by' => auth()->id(),
                'verified_at' => now(),
            ]);

            session()->flash('success', 'Residence verification approved successfully.');
        }
    }

    /**
     * Open the rejection modal for a specific verification
     */
    public function openRejectionModal(int $id): void
    {
        $this->selectedVerificationId = $id;
        $this->rejectionReason = '';
        $this->showRejectionModal = true;
    }

    /**
     * Close the rejection modal
     */
    public function closeRejectionModal(): void
    {
        $this->showRejectionModal = false;
        $this->rejectionReason = '';
        $this->selectedVerificationId = null;
    }

    /**
     * Reject the selected residence verification request with a reason
     */
    public function reject(): void
    {
        $this->validate([
            'rejectionReason' => 'required|string|min:5|max:500',
        ], [
            'rejectionReason.required' => 'Please provide a reason for rejection.',
            'rejectionReason.min' => 'The rejection reason must be at least 5 characters.',
        ]);

        $verification = ResidenceVerification::find($this->selectedVerificationId);

        if ($verification) {
            $verification->update([
                'status' => 'rejected',
                'rejection_reason' => $this->rejectionReason,
                'reviewed_by' => auth()->id(),
                'reviewed_at' => now(),
            ]);

            $verification->user->update([
                'verification_status' => 'rejected',
                'verification_remarks' => $this->rejectionReason,
            ]);

            session()->flash('info', 'Residence verification request has been rejected.');
        }

        $this->closeRejectionModal();
    }

    public function render(): View
    {
        // Fetch all verifications where the status is 'pending', and include the user's details
        $pendingVerifications = ResidenceVerification::with('user')
            ->where('status', 'pending')
            ->get();

        // Pass the data to the HTML view
        return view('livewire.admin.verifications', [
            'pendingVerifications' => $pendingVerifications,
        ]);
    }
}
