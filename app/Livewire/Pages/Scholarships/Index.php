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

        $scholarshipModels = $query->orderBy('created_at')->get();

        // Fetch all scholarship IDs this user has already applied to,
        // in ONE query — not one query per card.
        $appliedScholarshipIds = auth()->check()
            ? \App\Models\Application::where('user_id', auth()->id())
            ->whereIn('scholarship_id', $scholarshipModels->pluck('id'))
            ->pluck('scholarship_id')
            ->all()
            : [];

        $scholarships = $scholarshipModels->map(fn($s) => [
            'id' => $s->id,
            'title' => $s->title,
            'description' => $s->description,
            'allowance' => (float) $s->allowance,
            'slots' => $s->slots,
            'deadline' => $s->deadline->format('Y-m-d'),
            'status' => $s->status,
            'already_applied' => in_array($s->id, $appliedScholarshipIds, true),
        ])->values()->all();

        return view('pages.scholarships.index', [
            'scholarships' => array_values($scholarships),
        ])->layout(auth()->check() ? 'layouts.app' : 'layouts.public', ['title' => 'Scholarships']);
    }
}
