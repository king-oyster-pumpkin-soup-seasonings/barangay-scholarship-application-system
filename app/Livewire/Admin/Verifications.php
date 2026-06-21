<?php

namespace App\Livewire\Admin;

use App\Models\ResidenceVerification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Verifications extends Component
{
    public bool $showApprovalModal = false;

    public bool $showRejectionModal = false;

    public string $rejectionReason = '';

    public ?int $pendingApprovalId = null;

    public ?int $selectedVerificationId = null;

    /**
     * Open the approval confirmation modal for a specific verification.
     */
    public function openApprovalModal(int $id): void
    {
        $verification = ResidenceVerification::find($id);

        if (! $verification || $verification->status !== 'pending') {
            session()->flash('info', 'This residence verification has already been processed.');

            return;
        }

        $this->pendingApprovalId = $id;
        $this->showApprovalModal = true;
        $this->showRejectionModal = false;
        $this->selectedVerificationId = null;
        $this->rejectionReason = '';
    }

    /**
     * Close the approval confirmation modal.
     */
    public function closeApprovalModal(): void
    {
        $this->showApprovalModal = false;
        $this->pendingApprovalId = null;
    }

    /**
     * Approve a residence verification request after confirmation.
     */
    public function confirmApprove(): void
    {
        if ($this->pendingApprovalId === null) {
            $this->closeApprovalModal();

            return;
        }

        $wasApproved = false;

        DB::transaction(function () use (&$wasApproved): void {
            $verification = ResidenceVerification::whereKey($this->pendingApprovalId)
                ->lockForUpdate()
                ->first();

            if (! $verification || $verification->status !== 'pending') {
                return;
            }

            $verification->update([
                'status' => 'verified',
                'rejection_reason' => null,
                'reviewed_by' => auth()->id(),
                'reviewed_at' => now(),
            ]);

            $verification->user()->update([
                'verification_status' => 'verified',
                'verification_remarks' => null,
                'verified_by' => auth()->id(),
                'verified_at' => now(),
            ]);

            $wasApproved = true;
        });

        session()->flash(
            $wasApproved ? 'success' : 'info',
            $wasApproved
                ? 'Residence verification approved successfully.'
                : 'This residence verification has already been processed.'
        );

        $this->closeApprovalModal();
    }

    /**
     * Open the rejection modal for a specific verification.
     */
    public function openRejectionModal(int $id): void
    {
        $verification = ResidenceVerification::find($id);

        if (! $verification || $verification->status !== 'pending') {
            session()->flash('info', 'This residence verification has already been processed.');

            return;
        }

        $this->selectedVerificationId = $id;
        $this->rejectionReason = '';
        $this->showRejectionModal = true;
        $this->showApprovalModal = false;
        $this->pendingApprovalId = null;
    }

    /**
     * Close the rejection modal.
     */
    public function closeRejectionModal(): void
    {
        $this->showRejectionModal = false;
        $this->rejectionReason = '';
        $this->selectedVerificationId = null;
    }

    /**
     * Reject the selected residence verification request with a reason.
     */
    public function reject(): void
    {
        $this->validate([
            'rejectionReason' => 'required|string|min:5|max:500',
        ], [
            'rejectionReason.required' => 'Please provide a reason for rejection.',
            'rejectionReason.min' => 'The rejection reason must be at least 5 characters.',
        ]);

        if ($this->selectedVerificationId === null) {
            $this->closeRejectionModal();

            return;
        }

        $wasRejected = false;

        DB::transaction(function () use (&$wasRejected): void {
            $verification = ResidenceVerification::whereKey($this->selectedVerificationId)
                ->lockForUpdate()
                ->first();

            if (! $verification || $verification->status !== 'pending') {
                return;
            }

            $verification->update([
                'status' => 'rejected',
                'rejection_reason' => $this->rejectionReason,
                'reviewed_by' => auth()->id(),
                'reviewed_at' => now(),
            ]);

            $verification->user()->update([
                'verification_status' => 'rejected',
                'verification_remarks' => $this->rejectionReason,
                'verified_by' => auth()->id(),
                'verified_at' => now(),
            ]);

            $wasRejected = true;
        });

        session()->flash(
            'info',
            $wasRejected
                ? 'Residence verification request has been rejected.'
                : 'This residence verification has already been processed.'
        );

        $this->closeRejectionModal();
    }

    public function render(): View
    {
        $pendingVerifications = ResidenceVerification::with('user')
            ->where('status', 'pending')
            ->get();

        $pendingApprovalVerification = null;
        if ($this->pendingApprovalId && $this->showApprovalModal) {
            $pendingApprovalVerification = ResidenceVerification::with('user')
                ->find($this->pendingApprovalId);
        }

        return view('livewire.admin.verifications', [
            'pendingVerifications' => $pendingVerifications,
            'pendingApprovalVerification' => $pendingApprovalVerification,
        ]);
    }
}
