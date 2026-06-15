<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        // Dummy data — will be replaced with real DB queries later
        $announcements = [
            [
                'title' => 'New Scholarship Now Open',
                'body' => 'The Barangay Academic Excellence Grant is now accepting applications until August 31.',
                'created_at' => '2026-06-10',
            ],
            [
                'title' => 'Office Closed for Holiday',
                'body' => 'The Barangay office will be closed on June 19 in observance of the local holiday.',
                'created_at' => '2026-06-12',
            ],
        ];

        $scholarships = [
            [
                'id' => 1,
                'title' => 'Barangay Academic Excellence Grant',
                'allowance' => 5000.00,
                'slots' => 10,
                'deadline' => '2026-08-31',
                'status' => 'available',
            ],
            [
                'id' => 2,
                'title' => 'Barangay Sports Scholarship',
                'allowance' => 3000.00,
                'slots' => 5,
                'deadline' => '2026-07-15',
                'status' => 'full',
            ],
            [
                'id' => 3,
                'title' => 'Out-of-School Youth Support Grant',
                'allowance' => 2000.00,
                'slots' => 8,
                'deadline' => '2026-09-30',
                'status' => 'unavailable',
            ],
        ];

        return view('pages.home', [
            'announcements' => $announcements,
            'scholarships' => $scholarships,
        ])->layout('layouts.public', ['title' => 'Home']);
    }
}
