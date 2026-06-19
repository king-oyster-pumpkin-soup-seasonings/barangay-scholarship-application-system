<?php

namespace App\Livewire\Pages\Applications;

use App\Models\Application;
use App\Models\ApplicationAnswer;
use App\Models\Scholarship;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
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
    /** @var array<int|string, string|array<int, string>> */
    public array $answers = [];

    // Stores uploaded files: ['requirement_id' => UploadedFile]
    /** @var array<int|string, mixed> */
    public array $files = [];

    // Requirements grouped by category, loaded once in mount()
    /** @var array<int, array<string, mixed>> */
    public array $eligibilityRequirements = [];

    /** @var array<int, array<string, mixed>> */
    public array $generalRequirements = [];

    /** @var array<int, array<string, mixed>> */
    public array $specificRequirements = [];

    /** @var array<int, array<string, mixed>> */
    public array $additionalRequirements = [];

    // Total number of steps (only count categories that have requirements)
    public int $totalSteps = 0;

    /** @var array<string, array<int, string>> */
    protected array $rules = [];

    // Map of step number → category name (built dynamically)
    /** @var array<int, string> */
    public array $stepMap = [];

    /**
     * mount() runs once when the component is first loaded.
     * $scholarship is automatically resolved from the route model binding.
     */
    public function mount(Scholarship $scholarship): void
    {
        $this->scholarship = $scholarship;

        $alreadyApplied = Application::where('user_id', Auth::id())
            ->where('scholarship_id', $scholarship->id)
            ->exists();

        if ($alreadyApplied) {
            $this->redirectWithToast($scholarship, 'You already applied to this scholarship.');
            return;
        }

        if ($scholarship->status !== 'available') {
            $this->redirectWithToast($scholarship, 'This scholarship is not currently open for applications.');
            return;
        }

        if ($scholarship->deadline && now()->startOfDay()->gt($scholarship->deadline)) {
            $this->redirectWithToast($scholarship, 'The application deadline for this scholarship has passed.');
            return;
        }

        // Load and group all requirements for this scholarship by category
        $requirements = $scholarship->requirements()
            ->orderBy('order')
            ->orderBy('id')
            ->get();

        foreach ($requirements as $req) {
            $id = $req->id;

            // Pre-fill answers array with empty strings so wire:model works on first render
            $this->answers[$id] = $req->field_type === 'checkbox' ? [] : '';

            // Sort into the correct group by category
            match ($req->category) {
                'eligibility' => $this->eligibilityRequirements[] = $req->toArray(),
                'general_document' => $this->generalRequirements[] = $req->toArray(),
                'specific_document' => $this->specificRequirements[] = $req->toArray(),
                'additional_field' => $this->additionalRequirements[] = $req->toArray(),
                default => null,
            };
        }

        // Build a dynamic step map so steps with no requirements are skipped
        $stepNumber = 1;
        if (! empty($this->eligibilityRequirements)) {
            $this->stepMap[$stepNumber++] = 'eligibility';
        }
        if (! empty($this->generalRequirements)) {
            $this->stepMap[$stepNumber++] = 'general_document';
        }
        if (! empty($this->specificRequirements)) {
            $this->stepMap[$stepNumber++] = 'specific_document';
        }
        if (! empty($this->additionalRequirements)) {
            $this->stepMap[$stepNumber++] = 'additional_field';
        }

        $this->totalSteps = count($this->stepMap);

        // If there are no requirements at all, default to 1 step
        if ($this->totalSteps === 0) {
            $this->totalSteps = 1;
        }
    }

    private function redirectWithToast(Scholarship $scholarship, string $message): void
    {
        session()->flash('toast', $message);
        $this->redirect(route('scholarships.show', $scholarship), navigate: true);
    }

    /**
     * Returns the requirements for the current step.
     * Used in the blade to know what to render.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getCurrentRequirements(): array
    {
        $category = $this->stepMap[$this->step] ?? null;

        return match ($category) {
            'eligibility' => $this->eligibilityRequirements,
            'general_document' => $this->generalRequirements,
            'specific_document' => $this->specificRequirements,
            'additional_field' => $this->additionalRequirements,
            default => [],
        };
    }

    /**
     * Returns a human-readable label for the current step.
     */
    public function getStepLabel(): string
    {
        $category = $this->stepMap[$this->step] ?? null;

        return match ($category) {
            'eligibility' => 'Eligibility Questions',
            'general_document' => 'General Documents',
            'specific_document' => 'Specific Documents',
            'additional_field' => 'Additional Information',
            default => 'Review',
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
        $customAttributes = [];

        foreach ($requirements as $req) {
            $id = $req['id'];

            // Clean up labels for validation messages (e.g., "Current GPA" -> "current gpa")
            $cleanLabel = strtolower($req['label']);

            if ($req['field_type'] === 'file') {
                // File fields: only required if is_required is true
                if ($req['is_required']) {
                    $rules["files.{$id}"] = ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'];
                } else {
                    $rules["files.{$id}"] = ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'];
                }
                $customAttributes["files.{$id}"] = $cleanLabel;
            } else {
                $rules["answers.{$id}"] = $this->rulesForRequirement($req);
                $customAttributes["answers.{$id}"] = $cleanLabel;

                if ($req['field_type'] === 'checkbox') {
                    $customAttributes["answers.{$id}.*"] = $cleanLabel;
                    $rules["answers.{$id}.*"] = [Rule::in($this->requirementOptions($req))];
                }
            }
        }

        // Pass rules, an empty messages array, and our custom field labels
        $this->validate($rules, [], $customAttributes);
    }

    /**
     * Final submission: save Application + all ApplicationAnswers to the database.
     */
    public function submit(): void
    {
        // Validate the last step before submitting
        $this->validateCurrentStep();
        $this->ensureApplicationCanBeSubmitted();

        // Create the Application record
        $application = Application::create([
            'user_id' => Auth::id(),
            'scholarship_id' => $this->scholarship->id,
            'status' => 'pending',
            'submitted_at' => now(),
        ]);

        // Save all non-file answers
        foreach ($this->answers as $requirementId => $value) {
            // Skip empty optional answers
            if ($value === null || $value === '') {
                continue;
            }

            ApplicationAnswer::create([
                'application_id' => $application->id,
                'requirement_id' => $requirementId,
                'value' => is_array($value) ? implode(',', $value) : $value,
                'file_path' => null,
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
                'application_id' => $application->id,
                'requirement_id' => $requirementId,
                'value' => null,
                'file_path' => $path,
            ]);
        }

        // Redirect to dashboard with a success message
        session()->flash('success', 'Your application has been submitted successfully!');
        $this->redirect(route('dashboard'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.pages.applications.create', [
            'currentRequirements' => $this->getCurrentRequirements(),
            'stepLabel' => $this->getStepLabel(),
        ]);
    }

    protected function ensureApplicationCanBeSubmitted(): void
    {
        $this->scholarship->refresh();

        if ($this->scholarship->status !== 'available') {
            throw ValidationException::withMessages([
                'scholarship' => 'This scholarship is not open for applications.',
            ]);
        }

        if ($this->scholarship->deadline && now()->startOfDay()->gt($this->scholarship->deadline)) {
            throw ValidationException::withMessages([
                'scholarship' => 'The application deadline has passed.',
            ]);
        }

        if ($this->scholarship->slots <= 0) {
            throw ValidationException::withMessages([
                'scholarship' => 'No slots remain for this scholarship.',
            ]);
        }

        $alreadyApplied = Application::where('user_id', Auth::id())
            ->where('scholarship_id', $this->scholarship->id)
            ->exists();

        if ($alreadyApplied) {
            throw ValidationException::withMessages([
                'scholarship' => 'You already applied to this scholarship.',
            ]);
        }
    }

    /**
     * @param  array{id: int, field_type: string, is_required: bool, options?: array<int, string>|string|null}  $requirement
     * @return array<int, string>
     */
    protected function rulesForRequirement(array $requirement): array
    {
        $requiredRule = $requirement['is_required'] ? 'required' : 'nullable';

        return match ($requirement['field_type']) {
            'number' => [$requiredRule, 'numeric'],
            'date' => [$requiredRule, 'date'],
            'select' => [$requiredRule, Rule::in($this->requirementOptions($requirement))],
            'checkbox' => $requirement['is_required'] ? ['required', 'array', 'min:1'] : ['nullable', 'array'],
            'textarea' => [$requiredRule, 'string', 'max:5000'],
            default => [$requiredRule, 'string', 'max:255'],
        };
    }

    /**
     * @param  array{options?: array<int, string>|string|null}  $requirement
     * @return array<int, string>
     */
    protected function requirementOptions(array $requirement): array
    {
        $options = $requirement['options'] ?? null;

        if (is_array($options)) {
            return array_values($options);
        }

        $decoded = json_decode($options ?? '[]', true);
        return is_array($decoded) ? $decoded : [];
    }
}
