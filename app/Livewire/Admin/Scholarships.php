<?php

namespace App\Livewire\Admin;

use App\Models\Scholarship;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
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

    public bool $showDeleteModal = false;

    public ?int $deleteScholarshipId = null;

    public ?Scholarship $scholarshipToDelete = null;

    /** @var list<array{id: int|null, category: string, field_type: string, label: string, optionsText: string, is_required: bool}> */
    public array $requirements = [];

    /** @var array<string, string> */
    protected array $rules = [
        'title' => 'required|string|min:3|max:255',
        'description' => 'required|string|min:10|max:5000',
        'allowance' => 'required|numeric|min:0',
        'slotsCount' => 'required|integer|min:0',
        'deadline' => 'required|date',
        'status' => 'required|in:available,unavailable,full',
        'requirements' => 'required|array|min:1',
        'requirements.*.id' => 'nullable|integer',
        'requirements.*.category' => 'required|in:eligibility,general_document,specific_document,additional_field',
        'requirements.*.field_type' => 'required|in:file,text,textarea,number,select,checkbox,date',
        'requirements.*.label' => 'required|string|min:2|max:255',
        'requirements.*.optionsText' => 'nullable|string|max:2000',
        'requirements.*.is_required' => 'boolean',
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
        'requirements.required' => 'Please add at least one application requirement.',
        'requirements.*.label.required' => 'Each requirement needs a label.',
        'requirements.*.label.min' => 'Requirement labels must be at least 2 characters.',
    ];

    /**
     * Open the modal for creating a new scholarship program.
     */
    public function openCreateModal(): void
    {
        $this->reset(['title', 'description', 'allowance', 'slotsCount', 'deadline', 'selectedScholarshipId', 'isEditing']);
        $this->status = 'available';
        $this->requirements = $this->defaultRequirements();
        $this->showFormModal = true;
    }

    /**
     * Open the modal for editing an existing scholarship program.
     */
    public function openEditModal(int $id): void
    {
        $scholarship = Scholarship::with('requirements')->findOrFail($id);
        $this->selectedScholarshipId = $id;
        $this->title = $scholarship->title;
        $this->description = $scholarship->description;
        $this->allowance = (string) $scholarship->allowance;
        $this->slotsCount = (string) $scholarship->slots;
        $this->deadline = $scholarship->deadline ? $scholarship->deadline->format('Y-m-d') : '';
        $this->status = $scholarship->status;
        $this->requirements = $scholarship->requirements
            ->sortBy([['category', 'asc'], ['order', 'asc'], ['id', 'asc']])
            ->map(fn ($requirement): array => [
                'id' => $requirement->id,
                'category' => $requirement->category,
                'field_type' => $requirement->field_type,
                'label' => $requirement->label,
                'optionsText' => implode(PHP_EOL, $requirement->options ?? []),
                'is_required' => $requirement->is_required,
            ])
            ->values()
            ->all();

        if ($this->requirements === []) {
            $this->requirements = $this->defaultRequirements();
        }

        $this->isEditing = true;
        $this->showFormModal = true;
    }

    /**
     * Close the modal and reset form inputs.
     */
    public function closeModal(): void
    {
        $this->showFormModal = false;
        $this->reset(['title', 'description', 'allowance', 'slotsCount', 'deadline', 'selectedScholarshipId', 'isEditing', 'requirements']);
        $this->status = 'available';
    }

    public function openDeleteModal(int $id): void
    {
        $this->scholarshipToDelete = Scholarship::withCount('applications')->findOrFail($id);
        $this->deleteScholarshipId = $id;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal(): void
    {
        $this->showDeleteModal = false;
        $this->reset(['deleteScholarshipId', 'scholarshipToDelete']);
    }

    public function addRequirement(): void
    {
        $this->requirements[] = [
            'id' => null,
            'category' => 'additional_field',
            'field_type' => 'text',
            'label' => '',
            'optionsText' => '',
            'is_required' => true,
        ];
    }

    public function removeRequirement(int $index): void
    {
        if (count($this->requirements) <= 1) {
            return;
        }

        unset($this->requirements[$index]);
        $this->requirements = array_values($this->requirements);
    }

    public function moveRequirementUp(int $index): void
    {
        if ($index <= 0 || ! isset($this->requirements[$index])) {
            return;
        }

        $previous = $this->requirements[$index - 1];
        $this->requirements[$index - 1] = $this->requirements[$index];
        $this->requirements[$index] = $previous;
    }

    public function moveRequirementDown(int $index): void
    {
        if (! isset($this->requirements[$index], $this->requirements[$index + 1])) {
            return;
        }

        $next = $this->requirements[$index + 1];
        $this->requirements[$index + 1] = $this->requirements[$index];
        $this->requirements[$index] = $next;
    }

    /**
     * Save the scholarship program (Create or Update).
     */
    public function save(): void
    {
        $this->validate();
        $this->validateRequirementOptions();

        $resolvedSlots = (int) $this->slotsCount;
        $resolvedStatus = $this->status;

        // Auto-manage status based on slots
        if ($resolvedSlots === 0) {
            $resolvedStatus = 'full';
        } elseif ($resolvedStatus === 'full' && $resolvedSlots > 0) {
            $resolvedStatus = 'available';
        }

        DB::transaction(function () use ($resolvedSlots, $resolvedStatus): void {
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

                $this->syncRequirements($scholarship);

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

                $this->syncRequirements($scholarship);

                session()->flash('success', 'Scholarship program created successfully.');
            }
        });

        $this->closeModal();
    }

    /** @return list<array{id: int|null, category: string, field_type: string, label: string, optionsText: string, is_required: bool}> */
    protected function defaultRequirements(): array
    {
        return [
            [
                'id' => null,
                'category' => 'eligibility',
                'field_type' => 'number',
                'label' => 'Current GPA',
                'optionsText' => '',
                'is_required' => true,
            ],
            [
                'id' => null,
                'category' => 'eligibility',
                'field_type' => 'select',
                'label' => 'Year Level',
                'optionsText' => "Grade 11\nGrade 12\nCollege",
                'is_required' => true,
            ],
            [
                'id' => null,
                'category' => 'general_document',
                'field_type' => 'file',
                'label' => 'Valid ID',
                'optionsText' => '',
                'is_required' => true,
            ],
            [
                'id' => null,
                'category' => 'general_document',
                'field_type' => 'file',
                'label' => 'Certificate of Indigency',
                'optionsText' => '',
                'is_required' => true,
            ],
            [
                'id' => null,
                'category' => 'specific_document',
                'field_type' => 'file',
                'label' => 'Report Card / Transcript',
                'optionsText' => '',
                'is_required' => true,
            ],
            [
                'id' => null,
                'category' => 'additional_field',
                'field_type' => 'textarea',
                'label' => 'Why do you deserve this scholarship?',
                'optionsText' => '',
                'is_required' => false,
            ],
        ];
    }

    protected function validateRequirementOptions(): void
    {
        $messages = [];

        foreach ($this->requirements as $index => $requirement) {
            if (! in_array($requirement['field_type'], ['select', 'checkbox'], true)) {
                continue;
            }

            if ($this->parseOptions($requirement['optionsText']) === []) {
                $messages["requirements.{$index}.optionsText"] = 'Add at least one option for select and checkbox requirements.';
            }
        }

        if ($messages !== []) {
            throw ValidationException::withMessages($messages);
        }
    }

    protected function syncRequirements(Scholarship $scholarship): void
    {
        $keptRequirementIds = [];

        foreach (array_values($this->requirements) as $index => $requirement) {
            $payload = [
                'category' => $requirement['category'],
                'field_type' => $requirement['field_type'],
                'label' => $requirement['label'],
                'options' => in_array($requirement['field_type'], ['select', 'checkbox'], true)
                    ? $this->parseOptions($requirement['optionsText'])
                    : null,
                'is_required' => (bool) $requirement['is_required'],
                'order' => $index + 1,
            ];

            if ($requirement['id']) {
                $scholarshipRequirement = $scholarship->requirements()
                    ->whereKey($requirement['id'])
                    ->firstOrFail();

                $scholarshipRequirement->update($payload);
            } else {
                $scholarshipRequirement = $scholarship->requirements()->create($payload);
            }

            $keptRequirementIds[] = $scholarshipRequirement->id;
        }

        $scholarship->requirements()
            ->whereNotIn('id', $keptRequirementIds)
            ->delete();
    }

    /** @return list<string> */
    protected function parseOptions(string $optionsText): array
    {
        return collect(preg_split('/[\r\n,]+/', $optionsText) ?: [])
            ->map(fn (string $option): string => trim($option))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    /**
     * Delete a scholarship program.
     */
    public function delete(): void
    {
        $scholarship = Scholarship::findOrFail($this->deleteScholarshipId);
        $scholarship->delete();

        session()->flash('info', 'Scholarship program has been deleted.');
        $this->closeDeleteModal();
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
