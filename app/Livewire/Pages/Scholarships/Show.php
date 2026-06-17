<?php

namespace App\Livewire\Pages\Scholarships;

use Livewire\Component;
use App\Models\Scholarship;

class Show extends Component
{
    public int $id;

    public function mount(int $id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $scholarship = Scholarship::with('requirements')->findOrFail($this->id);
        $requirements = $scholarship->requirements()->orderBy('order')->get();

        return view('pages.scholarships.show', [
            'scholarship' => $scholarship,
            'requirements' => $requirements,
        ])->layout('layouts.public', ['title' => $scholarship->title]);
    }
}
