<?php

namespace App\Livewire\Admin;

use App\Actions\Application\ApproveApplication;
use App\Actions\Application\RejectApplication;
use App\Models\Application;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Applications extends Component
{
    public bool $showRejectionModal = false;

    public bool $showDetailsModal = false;

    public string $rejectionRemarks = '';

    public ?int $selectedApplicationId = null;

    public ?Application $selectedApplication = null;

    /**
     * View the details and answers of a specific application
     */
    public function viewDetails(int $id): void
    {
        $this->selectedApplication = Application::with([
            'user',
            'scholarship.requirements',
            'answers.requirement',
        ])->findOrFail($id);

        $this->showDetailsModal = true;
    }

    /**
     * Close the application details modal
     */
    public function closeDetailsModal(): void
    {
        $this->showDetailsModal = false;
        $this->selectedApplication = null;
    }

    /**
     * Approve a pending scholarship application
     */
    public function approve(int $id): void
    {
        $application = Application::findOrFail($id);

        if ($application->status === 'pending') {

            app(ApproveApplication::class)
                ->handle($application, auth()->user(), 'Application approved.');

            session()->flash('success', 'Application approved successfully.');
        }

        $this->closeDetailsModal();
    }

    /**
     * Open the rejection modal for a specific application
     */
    public function openRejectionModal(int $id): void
    {
        $this->selectedApplicationId = $id;
        $this->rejectionRemarks = '';
        $this->showRejectionModal = true;

        // Close details modal if open to prevent stack overlap
        $this->showDetailsModal = false;
    }

    /**
     * Close the rejection modal
     */
    public function closeRejectionModal(): void
    {
        $this->showRejectionModal = false;
        $this->rejectionRemarks = '';
        $this->selectedApplicationId = null;
    }

    /**
     * Reject the selected application with remarks
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

            session()->flash('info', 'Application has been rejected.');
        }

        $this->closeRejectionModal();
        $this->selectedApplication = null;
    }

    public function render(): View
    {
        // Fetch pending applications to review
        $pendingApplications = Application::with(['user', 'scholarship'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.admin.applications', [
            'pendingApplications' => $pendingApplications,
        ]);
    }
}
