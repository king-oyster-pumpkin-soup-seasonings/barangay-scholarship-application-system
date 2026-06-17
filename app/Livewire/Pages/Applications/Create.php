<?php

namespace App\Livewire\Pages\Applications;

use App\Models\Application;
use App\Models\ApplicationAnswer;
use App\Models\Scholarship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;


class Create extends Component
{
    use WithFileUploads;

    // The scholarship the user is applying for
    public Scholarship $scholarship;

    // Current step: 1 = eligibility, 2 = general_document, 3 = specific_document
    public int $step = 1;

    // Stores answers for non-file fields: ['requirement_id' => 'value']
    public array $answers = [];

    // Stores uploaded files: ['requirement_id' => UploadedFile]
    public array $files = [];

    // Requirements grouped by category, loaded once in mount()
    public array $eligibilityRequirements = [];
    public array $generalRequirements = [];
    public array $specificRequirements = [];

    // Total number of steps (only count categories that have requirements)
    public int $totalSteps = 0;

    protected $rules = [];

    // Map of step number → category name (built dynamically)
    public array $stepMap = [];

    /**
     * mount() runs once when the component is first loaded.
     * $scholarship is automatically resolved from the route model binding.
     */
    public function mount(Scholarship $scholarship): void
    {
        $this->scholarship = $scholarship;

        // Load and group all requirements for this scholarship by category
        $requirements = $scholarship->requirements()->orderBy('id')->get();

        foreach ($requirements as $req) {
            $id = $req->id;

            // Pre-fill answers array with empty strings so wire:model works on first render
            $this->answers[$id] = '';

            // Sort into the correct group by category
            match ($req->category) {
                'eligibility'       => $this->eligibilityRequirements[] = $req->toArray(),
                'general_document'  => $this->generalRequirements[]     = $req->toArray(),
                'specific_document' => $this->specificRequirements[]    = $req->toArray(),
                default             => null,
            };
        }

        // Build a dynamic step map so steps with no requirements are skipped
        $stepNumber = 1;
        if (!empty($this->eligibilityRequirements)) {
            $this->stepMap[$stepNumber++] = 'eligibility';
        }
        if (!empty($this->generalRequirements)) {
            $this->stepMap[$stepNumber++] = 'general_document';
        }
        if (!empty($this->specificRequirements)) {
            $this->stepMap[$stepNumber++] = 'specific_document';
        }

        $this->totalSteps = count($this->stepMap);

        // If there are no requirements at all, default to 1 step
        if ($this->totalSteps === 0) {
            $this->totalSteps = 1;
        }
    }

    /**
     * Returns the requirements for the current step.
     * Used in the blade to know what to render.
     */
    public function getCurrentRequirements(): array
    {
        $category = $this->stepMap[$this->step] ?? null;

        return match ($category) {
            'eligibility'       => $this->eligibilityRequirements,
            'general_document'  => $this->generalRequirements,
            'specific_document' => $this->specificRequirements,
            default             => [],
        };
    }

    /**
     * Returns a human-readable label for the current step.
     */
    public function getStepLabel(): string
    {
        $category = $this->stepMap[$this->step] ?? null;

        return match ($category) {
            'eligibility'       => 'Eligibility Questions',
            'general_document'  => 'General Documents',
            'specific_document' => 'Specific Documents',
            default             => 'Review',
        };
    }

    /**
     * Validate the current step's fields and move forward.
     */
    public function nextStep(): void
    {
        $this->validateCurrentStep();
        $this->step++;
    }

    /**
     * Go back one step (no validation needed going back).
     */
    public function previousStep(): void
    {
        $this->step--;
    }

    /**
     * Validate only the fields that belong to the current step.
     * This prevents Livewire from complaining about future steps' empty values.
     */
    protected function validateCurrentStep(): void
    {
        $requirements = $this->getCurrentRequirements();
        $rules = [];

        foreach ($requirements as $req) {
            $id = $req['id'];

            if ($req['field_type'] === 'file') {
                // File fields: only required if is_required is true
                if ($req['is_required']) {
                    $rules["files.{$id}"] = ['required', 'file', 'max:10240']; // max 10MB
                } else {
                    $rules["files.{$id}"] = ['nullable', 'file', 'max:10240'];
                }
            } else {
                // Text/number/select/textarea/checkbox fields
                if ($req['is_required']) {
                    $rules["answers.{$id}"] = ['required'];
                } else {
                    $rules["answers.{$id}"] = ['nullable'];
                }
            }
        }

        $this->validate($rules);
    }

    /**
     * Final submission: save Application + all ApplicationAnswers to the database.
     */
    public function submit(): void
    {
        // Validate the last step before submitting
        $this->validateCurrentStep();

        // Create the Application record
        $application = Application::create([
            'user_id'       => Auth::id(),
            'scholarship_id'=> $this->scholarship->id,
            'status'        => 'pending',
            'submitted_at'  => now(),
        ]);

        // Save all non-file answers
        foreach ($this->answers as $requirementId => $value) {
            // Skip empty optional answers
            if ($value === null || $value === '') {
                continue;
            }

            ApplicationAnswer::create([
                'application_id'  => $application->id,
                'requirement_id'  => $requirementId,
                'value'           => is_array($value) ? implode(',', $value) : $value,
                'file_path'       => null,
            ]);
        }

        // Save all file uploads
        foreach ($this->files as $requirementId => $file) {
            if ($file === null) {
                continue;
            }

            // Store file in storage/app/public/applications/{application_id}/
            $path = $file->store("applications/{$application->id}", 'public');

            ApplicationAnswer::create([
                'application_id'  => $application->id,
                'requirement_id'  => $requirementId,
                'value'           => null,
                'file_path'       => $path,
            ]);
        }

        // Redirect to dashboard with a success message
        session()->flash('success', 'Your application has been submitted successfully!');
        $this->redirect(route('dashboard'), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.applications.create', [
            'currentRequirements' => $this->getCurrentRequirements(),
            'stepLabel'           => $this->getStepLabel(),
        ]);
    }
}
