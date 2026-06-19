<?php

namespace App\Livewire\Admin;

use App\Actions\Application\ApproveApplication;
use App\Actions\Application\RejectApplication;
use App\Models\Application;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Applications extends Component
{
    // --- Modal visibility flags ---
    public bool $showDetailsModal = false;
    public bool $showApprovalModal = false;
    public bool $showRejectionModal = false;

    // --- IDs for tracking which application is being acted on ---
    public ?int $selectedApplicationId = null;   // used by details modal
    public ?int $pendingApprovalId = null;        // used by approval confirmation modal
    // (rejection reuses selectedApplicationId)

    // --- Rejection form field ---
    public string $rejectionRemarks = '';

    // --- Alert messages (use public properties, NOT session()->flash()) ---
    public string $successMessage = '';
    public string $infoMessage = '';

    // =========================================================
    // DETAILS MODAL
    // =========================================================

    /**
     * Open the details modal for a specific application.
     */
    public function viewDetails(int $id): void
    {
        $this->selectedApplicationId = $id;
        $this->showDetailsModal = true;

        // Clear old alert messages when opening a fresh modal
        $this->successMessage = '';
        $this->infoMessage = '';
    }

    /**
     * Close the details modal.
     */
    public function closeDetailsModal(): void
    {
        $this->showDetailsModal = false;
        $this->selectedApplicationId = null;
    }

    // =========================================================
    // APPROVAL FLOW (2-step: open modal → confirm)
    // =========================================================

    /**
     * Step 1: Clicking "Approve" opens a confirmation modal first.
     */
    public function openApprovalModal(int $id): void
    {
        $this->pendingApprovalId = $id;
        $this->showApprovalModal = true;

        // Close details modal if it was open (to prevent overlap)
        $this->showDetailsModal = false;
    }

    /**
     * Close the approval confirmation modal without doing anything.
     */
    public function closeApprovalModal(): void
    {
        $this->showApprovalModal = false;
        $this->pendingApprovalId = null;
    }

    /**
     * Step 2: Admin confirmed — now actually approve the application.
     */
    public function confirmApprove(): void
    {
        $application = Application::findOrFail($this->pendingApprovalId);

        if ($application->status === 'pending') {
            app(ApproveApplication::class)
                ->handle($application, auth()->user(), 'Application approved.');

            $this->successMessage = 'Application approved successfully.';
        }

        // Reset ALL modal state cleanly in one place
        $this->showApprovalModal = false;
        $this->showDetailsModal = false;
        $this->pendingApprovalId = null;
        $this->selectedApplicationId = null;
    }

    // =========================================================
    // REJECTION FLOW
    // =========================================================

    /**
     * Open the rejection remarks modal.
     */
    public function openRejectionModal(int $id): void
    {
        $this->selectedApplicationId = $id;
        $this->rejectionRemarks = '';
        $this->showRejectionModal = true;

        // Close other modals to prevent overlap
        $this->showDetailsModal = false;
        $this->showApprovalModal = false;
    }

    /**
     * Close the rejection modal without doing anything.
     */
    public function closeRejectionModal(): void
    {
        $this->showRejectionModal = false;
        $this->rejectionRemarks = '';
        $this->selectedApplicationId = null;
    }

    /**
     * Submit the rejection with remarks.
     */
    public function reject(): void
    {
        $this->validate([
            'rejectionRemarks' => 'required|string|min:5|max:500',
        ], [
            'rejectionRemarks.required' => 'Please provide rejection remarks.',
            'rejectionRemarks.min' => 'Rejection remarks must be at least 5 characters.',
        ]);

        $application = Application::findOrFail($this->selectedApplicationId);

        if ($application->status === 'pending') {
            app(RejectApplication::class)
                ->handle($application, auth()->user(), $this->rejectionRemarks);

            $this->infoMessage = 'Application has been rejected.';
        }

        $this->closeRejectionModal();
    }

    // =========================================================
    // RENDER
    // =========================================================

    public function render(): View
    {
        // Fetch all pending applications for the table
        $pendingApplications = Application::with(['user', 'scholarship'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        // Re-query selected application with eager-loaded relationships.
        // We do this here (not as a public model property) so relationships
        // are always fresh and never lost between Livewire re-renders.
        $selectedApplication = null;
        if ($this->selectedApplicationId && $this->showDetailsModal) {
            $selectedApplication = Application::with([
                'user',
                'scholarship.requirements',
                'answers.requirement',
            ])->find($this->selectedApplicationId);
        }

        // Re-query the application waiting for approval confirmation
        // (so we can show the applicant name and scholarship in the modal)
        $pendingApprovalApplication = null;
        if ($this->pendingApprovalId && $this->showApprovalModal) {
            $pendingApprovalApplication = Application::with(['user', 'scholarship'])
                ->find($this->pendingApprovalId);
        }

        return view('livewire.admin.applications', [
            'pendingApplications'       => $pendingApplications,
            'selectedApplication'       => $selectedApplication,
            'pendingApprovalApplication' => $pendingApprovalApplication,
        ]);
    }
}
