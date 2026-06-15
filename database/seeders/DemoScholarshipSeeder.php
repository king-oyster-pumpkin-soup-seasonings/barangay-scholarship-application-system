<?php

namespace Database\Seeders;

use App\Models\Scholarship;
use App\Models\ScholarshipRequirement;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoScholarshipSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'iwakura@brgyscholarship.net')->first();

        $scholarship1 = Scholarship::firstOrCreate(
            ['title' => 'Barangay Academic Excellence Grant'],
            [
                'description' => 'For graduating students with high academic standing (GPA 90 and above).',
                'allowance' => 45000.00,
                'slots' => 10,
                'deadline' => '2026-08-31',
                'status' => 'available',
                'created_by' => $admin->id,
            ]
        );
        $this->createRequirements($scholarship1);

        $scholarship2 = Scholarship::firstOrCreate(
            ['title' => 'Barangay Sports Scholarship'],
            [
                'description' => 'For student-athletes representing the barangay in regional competitions.',
                'allowance' => 48000.00,
                'slots' => 5,
                'deadline' => '2026-07-15',
                'status' => 'full',
                'created_by' => $admin->id,
            ]
        );
        $this->createRequirements($scholarship2);

        $scholarship3 = Scholarship::firstOrCreate(
            ['title' => 'Out-of-School Youth Support Grant'],
            [
                'description' => 'For out-of-school youth pursuing alternative learning programs.',
                'allowance' => 32000.00,
                'slots' => 8,
                'deadline' => '2026-09-30',
                'status' => 'unavailable',
                'created_by' => $admin->id,
            ]
        );
        $this->createRequirements($scholarship3);
    }

    private function createRequirements(Scholarship $scholarship): void
    {
        $requirements = [
            ['category' => 'eligibility', 'field_type' => 'number', 'label' => 'Current GPA', 'is_required' => true, 'order' => 1],
            ['category' => 'eligibility', 'field_type' => 'select', 'label' => 'Year Level', 'options' => ['Grade 11', 'Grade 12', 'College'], 'is_required' => true, 'order' => 2],
            ['category' => 'general_document', 'field_type' => 'file', 'label' => 'Valid ID', 'is_required' => true, 'order' => 1],
            ['category' => 'general_document', 'field_type' => 'file', 'label' => 'Certificate of Indigency', 'is_required' => true, 'order' => 2],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => 'Report Card / Transcript', 'is_required' => true, 'order' => 1],
            ['category' => 'additional_field', 'field_type' => 'textarea', 'label' => 'Why do you deserve this scholarship?', 'is_required' => false, 'order' => 1],
        ];

        foreach ($requirements as $requirement) {
            ScholarshipRequirement::firstOrCreate(
                ['scholarship_id' => $scholarship->id, 'label' => $requirement['label']],
                array_merge($requirement, ['scholarship_id' => $scholarship->id])
            );
        }
    }
}
