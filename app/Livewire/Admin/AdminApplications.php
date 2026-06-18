<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AdminApplications extends Component
{
    public bool $showRejectionModal = false;

    public string $rejectionRemarks = '';

    public ?int $selectedAdminId = null;

    /**
     * Approve a pending admin application
     */
    public function approve(int $id): void
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            $user->update([
                'verification_status' => 'verified',
                'verified_by' => auth()->id(),
                'verified_at' => now(),
            ]);

            session()->flash('success', "Admin application for {$user->name} has been approved.");
        }
    }

    /**
     * Open the rejection modal for a specific admin application
     */
    public function openRejectionModal(int $id): void
    {
        $this->selectedAdminId = $id;
        $this->rejectionRemarks = '';
        $this->showRejectionModal = true;
    }

    /**
     * Close the rejection modal
     */
    public function closeRejectionModal(): void
    {
        $this->showRejectionModal = false;
        $this->rejectionRemarks = '';
        $this->selectedAdminId = null;
    }

    /**
     * Reject a pending admin application with remarks
     */
    public function reject(): void
    {
        $this->validate([
            'rejectionRemarks' => 'required|string|min:5|max:500',
        ], [
            'rejectionRemarks.required' => 'Please enter rejection remarks.',
            'rejectionRemarks.min' => 'Rejection remarks must be at least 5 characters.',
        ]);

        $user = User::findOrFail($this->selectedAdminId);

        if ($user->role === 'admin') {
            $user->update([
                'verification_status' => 'rejected',
                'verification_remarks' => $this->rejectionRemarks,
                'verified_by' => auth()->id(),
                'verified_at' => now(),
            ]);

            session()->flash('info', "Admin application for {$user->name} has been rejected.");
        }

        $this->closeRejectionModal();
    }

    public function render(): View
    {
        // Fetch all users with 'admin' role to list on the superadmin management view
        $adminApplications = User::where('role', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.admin.admin-applications', [
            'adminApplications' => $adminApplications,
        ]);
    }
}
