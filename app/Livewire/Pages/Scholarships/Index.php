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

<<<<<<< HEAD
        // Apply status filter
        $scholarships = $this->filter === 'all'
            ? $allScholarships
            : array_filter($allScholarships, fn ($s) => $s['status'] === $this->filter);

        // Apply search filter
        if ($this->search !== '') {
            $search = strtolower($this->search);
            $scholarships = array_filter($scholarships, fn ($s) => str_contains(strtolower($s['title']), $search) ||
                str_contains(strtolower($s['description']), $search)
            );
=======
        if ($this->filter !== 'all') {
            $query->where('status', $this->filter);
>>>>>>> 5a7852a8247af5fd814bbd8ce20f091035636e78
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
