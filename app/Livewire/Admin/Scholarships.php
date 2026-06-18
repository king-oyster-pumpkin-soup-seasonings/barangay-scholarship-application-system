<?php

namespace App\Livewire\Admin;

use App\Models\Scholarship;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Scholarships extends Component
{
    public bool $showFormModal = false;

    public bool $isEditing = false;

    public ?int $selectedScholarshipId = null;

    public string $title = '';

    public string $description = '';

    public string $allowance = '';

    public string $slotsCount = '';

    public string $deadline = '';

    public string $status = 'available';

    /** @var array<string, string> */
    protected array $rules = [
        'title' => 'required|string|min:3|max:255',
        'description' => 'required|string|min:10|max:5000',
        'allowance' => 'required|numeric|min:0',
        'slotsCount' => 'required|integer|min:0',
        'deadline' => 'required|date',
        'status' => 'required|in:available,unavailable,full',
    ];

    /** @var array<string, string> */
    protected array $messages = [
        'title.required' => 'Please enter the scholarship title.',
        'title.min' => 'The title must be at least 3 characters.',
        'description.required' => 'Please enter the scholarship description.',
        'description.min' => 'The description must be at least 10 characters.',
        'allowance.required' => 'Please enter the allowance amount.',
        'allowance.numeric' => 'Allowance must be a valid number.',
        'slotsCount.required' => 'Please specify the number of available slots.',
        'slotsCount.integer' => 'Slots must be a whole number.',
        'deadline.required' => 'Please specify a deadline date.',
        'deadline.date' => 'Please provide a valid deadline date.',
        'status.required' => 'Please select a status.',
        'status.in' => 'Selected status is invalid.',
    ];

    /**
     * Open the modal for creating a new scholarship program.
     */
    public function openCreateModal(): void
    {
        $this->reset(['title', 'description', 'allowance', 'slotsCount', 'deadline', 'selectedScholarshipId', 'isEditing']);
        $this->status = 'available';
        $this->showFormModal = true;
    }

    /**
     * Open the modal for editing an existing scholarship program.
     */
    public function openEditModal(int $id): void
    {
        $scholarship = Scholarship::findOrFail($id);
        $this->selectedScholarshipId = $id;
        $this->title = $scholarship->title;
        $this->description = $scholarship->description;
        $this->allowance = (string) $scholarship->allowance;
        $this->slotsCount = (string) $scholarship->slots;
        $this->deadline = $scholarship->deadline ? $scholarship->deadline->format('Y-m-d') : '';
        $this->status = $scholarship->status;
        $this->isEditing = true;
        $this->showFormModal = true;
    }

    /**
     * Close the modal and reset form inputs.
     */
    public function closeModal(): void
    {
        $this->showFormModal = false;
        $this->reset(['title', 'description', 'allowance', 'slotsCount', 'deadline', 'selectedScholarshipId', 'isEditing']);
        $this->status = 'available';
    }

    /**
     * Save the scholarship program (Create or Update).
     */
    public function save(): void
    {
        $this->validate();

        $resolvedSlots = (int) $this->slotsCount;
        $resolvedStatus = $this->status;

        // Auto-manage status based on slots
        if ($resolvedSlots === 0) {
            $resolvedStatus = 'full';
        } elseif ($resolvedStatus === 'full' && $resolvedSlots > 0) {
            $resolvedStatus = 'available';
        }

        if ($this->isEditing) {
            $scholarship = Scholarship::findOrFail($this->selectedScholarshipId);
            $scholarship->update([
                'title' => $this->title,
                'description' => $this->description,
                'allowance' => $this->allowance,
                'slots' => $resolvedSlots,
                'deadline' => $this->deadline,
                'status' => $resolvedStatus,
            ]);

            session()->flash('success', 'Scholarship program updated successfully.');
        } else {
            $scholarship = Scholarship::create([
                'title' => $this->title,
                'description' => $this->description,
                'allowance' => $this->allowance,
                'slots' => $resolvedSlots,
                'deadline' => $this->deadline,
                'status' => $resolvedStatus,
                'created_by' => auth()->id(),
            ]);

            // Auto-create standard requirements for the new scholarship
            $this->createDefaultRequirements($scholarship);

            session()->flash('success', 'Scholarship program created successfully.');
        }

        $this->closeModal();
    }

    /**
     * Create the default set of requirements for a scholarship.
     */
    protected function createDefaultRequirements(Scholarship $scholarship): void
    {
        $requirements = [
            [
                'category' => 'eligibility',
                'field_type' => 'number',
                'label' => 'Current GPA',
                'is_required' => true,
                'order' => 1,
            ],
            [
                'category' => 'eligibility',
                'field_type' => 'select',
                'label' => 'Year Level',
                'options' => ['Grade 11', 'Grade 12', 'College'],
                'is_required' => true,
                'order' => 2,
            ],
            [
                'category' => 'general_document',
                'field_type' => 'file',
                'label' => 'Valid ID',
                'is_required' => true,
                'order' => 1,
            ],
            [
                'category' => 'general_document',
                'field_type' => 'file',
                'label' => 'Certificate of Indigency',
                'is_required' => true,
                'order' => 2,
            ],
            [
                'category' => 'specific_document',
                'field_type' => 'file',
                'label' => 'Report Card / Transcript',
                'is_required' => true,
                'order' => 1,
            ],
            [
                'category' => 'additional_field',
                'field_type' => 'textarea',
                'label' => 'Why do you deserve this scholarship?',
                'is_required' => false,
                'order' => 1,
            ],
        ];

        foreach ($requirements as $requirement) {
            $scholarship->requirements()->create($requirement);
        }
    }

    /**
     * Delete a scholarship program.
     */
    public function delete(int $id): void
    {
        $scholarship = Scholarship::findOrFail($id);
        $scholarship->delete();

        session()->flash('info', 'Scholarship program has been deleted.');
    }

    /**
     * Render the component view.
     */
    public function render(): View
    {
        $scholarships = Scholarship::with('creator')
            ->withCount('applications')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.admin.scholarships', [
            'scholarships' => $scholarships,
        ]);
    }
}
