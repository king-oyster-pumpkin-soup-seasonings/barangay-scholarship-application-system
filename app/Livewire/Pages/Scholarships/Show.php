<?php

namespace App\Livewire\Pages\Scholarships;

use Livewire\Component;

class Show extends Component
{
    public int $id;

    public function mount(int $id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $scholarships = [
            1 => [
                'id' => 1,
                'title' => 'Barangay Academic Excellence Grant',
                'description' => 'For graduating students with high academic standing (GPA 90 and above).',
                'allowance' => 5000.00,
                'slots' => 10,
                'deadline' => '2026-08-31',
                'status' => 'available',
            ],
            2 => [
                'id' => 2,
                'title' => 'Barangay Sports Scholarship',
                'description' => 'For student-athletes representing the barangay in regional competitions.',
                'allowance' => 3000.00,
                'slots' => 5,
                'deadline' => '2026-07-15',
                'status' => 'full',
            ],
            3 => [
                'id' => 3,
                'title' => 'Out-of-School Youth Support Grant',
                'description' => 'For out-of-school youth pursuing alternative learning programs.',
                'allowance' => 2000.00,
                'slots' => 8,
                'deadline' => '2026-09-30',
                'status' => 'unavailable',
            ],
        ];

        $scholarship = $scholarships[$this->id];

        $requirements = [
            ['category' => 'eligibility', 'field_type' => 'number', 'label' => 'Current GPA', 'is_required' => true],
            ['category' => 'eligibility', 'field_type' => 'select', 'label' => 'Year Level', 'options' => ['Grade 11', 'Grade 12', 'College'], 'is_required' => true],
            ['category' => 'general_document', 'field_type' => 'file', 'label' => 'Valid ID', 'is_required' => true],
            ['category' => 'general_document', 'field_type' => 'file', 'label' => 'Certificate of Indigency', 'is_required' => true],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => 'Report Card / Transcript', 'is_required' => true],
            ['category' => 'additional_field', 'field_type' => 'textarea', 'label' => 'Why do you deserve this scholarship?', 'is_required' => false],
        ];

        return view('pages.scholarships.show', [
            'scholarship' => $scholarship,
            'requirements' => $requirements,
        ])->layout('layouts.public', ['title' => $scholarship['title']]);
    }
}
