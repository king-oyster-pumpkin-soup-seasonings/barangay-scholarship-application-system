<?php

namespace App\Livewire\Pages\Scholarships;

use App\Models\Scholarship;
use Livewire\Component;

class Show extends Component
{
    // 1. Store the ID (integer), NOT the model. Integers persist across Livewire updates.
    public $scholarshipId;

    // 2. Store the model as a private/protected variable so it's not sent to the browser
    protected $scholarship;

    // 3. Accept the model from the route (Route Model Binding)
    public function mount(Scholarship $scholarship)
    {
        $this->scholarship = $scholarship;
        $this->scholarshipId = $scholarship->id;
    }

    // 4. CRITICAL: Re-fetch the model on every request if it's missing
    // This ensures the data is fresh and available even if Livewire "lost" the object
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

        // Pass the model to the view
        return view('pages.scholarships.show', [
            'scholarship' => $this->scholarship,
            'requirements' => $this->scholarship->requirements()->orderBy('order')->get(),
        ])->layout('layouts.public', ['title' => $this->scholarship->title]);
    }
}
