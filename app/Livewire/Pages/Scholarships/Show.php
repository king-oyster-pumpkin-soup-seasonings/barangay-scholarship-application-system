<?php

namespace App\Livewire\Pages\Scholarships;

use App\Models\Application;
use App\Models\ResidenceVerification;
use App\Models\Scholarship;
use Livewire\Component;

class Show extends Component
{
    // Store the ID (integer), NOT the model. Integers persist across Livewire updates.
    public $scholarshipId;

    // Store the model as a private/protected variable so it's not sent to the browser
    protected $scholarship;

    // Accept the model from the route (Route Model Binding)
    public function mount(Scholarship $scholarship)
    {
        $this->scholarship = $scholarship;
        $this->scholarshipId = $scholarship->id;
    }

    // Re-fetch the model on every request if it's missing
    public function hydrate()
    {
        if ($this->scholarshipId && ! $this->scholarship) {
            $this->scholarship = Scholarship::with('requirements')->findOrFail($this->scholarshipId);
        }
    }

    public function render()
    {
        // Fallback safety: if hydrate didn't run or failed, try to fetch here
        if (! $this->scholarship && $this->scholarshipId) {
            $this->scholarship = Scholarship::with('requirements')->findOrFail($this->scholarshipId);
        }

        $alreadyApplied = auth()->check()
            ? Application::where('user_id', auth()->id())
                ->where('scholarship_id', $this->scholarship->id)
                ->exists()
            : false;

        $deadlinePassed = $this->scholarship->deadline
            ? now()->startOfDay()->gt($this->scholarship->deadline)
            : false;

        $verification = auth()->check()
            ? ResidenceVerification::where('user_id', auth()->id())->first()
            : null;

        $layout = auth()->check() ? 'layouts.app' : 'layouts.public';

        return view('pages.scholarships.show', [
            'scholarship'    => $this->scholarship,
            'requirements'   => $this->scholarship->requirements()->orderBy('order')->get(),
            'verification'   => $verification,
            'alreadyApplied' => $alreadyApplied,
            'deadlinePassed' => $deadlinePassed,
        ])->layout($layout, ['title' => $this->scholarship->title]);
    }
}
