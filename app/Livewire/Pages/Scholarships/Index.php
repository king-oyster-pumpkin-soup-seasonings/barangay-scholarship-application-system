<?php

namespace App\Livewire\Pages\Scholarships;

use Livewire\Component;

class Index extends Component
{
    public string $filter = 'available';

    public function render()
    {
        $allScholarships = [
            [
                'id' => 1,
                'title' => 'Barangay Academic Excellence Grant',
                'description' => 'For graduating students with high academic standing (GPA 90 and above).',
                'allowance' => 5000.00,
                'slots' => 10,
                'deadline' => '2026-08-31',
                'status' => 'available',
            ],
            [
                'id' => 2,
                'title' => 'Barangay Sports Scholarship',
                'description' => 'For student-athletes representing the barangay in regional competitions.',
                'allowance' => 3000.00,
                'slots' => 5,
                'deadline' => '2026-07-15',
                'status' => 'full',
            ],
            [
                'id' => 3,
                'title' => 'Out-of-School Youth Support Grant',
                'description' => 'For out-of-school youth pursuing alternative learning programs.',
                'allowance' => 2000.00,
                'slots' => 8,
                'deadline' => '2026-09-30',
                'status' => 'unavailable',
            ],
        ];

        $scholarships = array_filter(
            $allScholarships,
            fn($s) => $s['status'] === $this->filter
        );

        return view('pages.scholarships.index', [
            'scholarships' => $scholarships,
        ])->layout('layouts.public', ['title' => 'Scholarships']);
    }
}
