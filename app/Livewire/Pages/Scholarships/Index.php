<?php

namespace App\Livewire\Pages\Scholarships;

use App\Models\Scholarship;
use Livewire\Component;

class Index extends Component
{
    public string $filter = 'all';

    public string $search = '';

    public function render()
    {
        $query = Scholarship::query();

        if ($this->filter !== 'all') {
            $query->where('status', $this->filter);
        }

        if ($this->search !== '') {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'ilike', "%{$search}%")
                    ->orWhere('description', 'ilike', "%{$search}%");
            });
        }

        $scholarships = $query->orderBy('created_at')->get()->map(fn ($s) => [
            'id' => $s->id,
            'title' => $s->title,
            'description' => $s->description,
            'allowance' => (float) $s->allowance,
            'slots' => $s->slots,
            'deadline' => $s->deadline->format('Y-m-d'),
            'status' => $s->status,
        ])->values()->all();

        return view('pages.scholarships.index', [
            'scholarships' => $scholarships,
        ])->layout('layouts.public', ['title' => 'Scholarships']);
    }
}
