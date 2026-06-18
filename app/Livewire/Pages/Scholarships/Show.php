<?php

namespace App\Livewire\Pages\Scholarships;

use Livewire\Component;
use App\Models\Scholarship;

class Show extends Component
{
    public $scholarshipId;
    protected $scholarship;

    public function mount(Scholarship $scholarship)
    {
        $this->scholarship = $scholarship;
        $this->scholarshipId = $scholarship->id;
    }

    public function hydrate()  // ← was missing the opening { brace
    {
        if ($this->scholarshipId && !$this->scholarship) {
            $this->scholarship = Scholarship::with('requirements')->findOrFail($this->scholarshipId);
        }
    }

    public function render()
    {
        if (!$this->scholarship && $this->scholarshipId) {
            $this->scholarship = Scholarship::with('requirements')->findOrFail($this->scholarshipId);
        }

        $layout = auth()->check() ? 'layouts.app' : 'layouts.public';

        return view('pages.scholarships.show', [
            'scholarship' => $this->scholarship,
            'requirements' => $this->scholarship->requirements()->orderBy('order')->get(),
        ])->layout($layout, ['title' => $this->scholarship->title]);
    }
}
