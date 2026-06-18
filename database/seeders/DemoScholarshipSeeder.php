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

        // ── AVAILABLE ────────────────────────────────────────────────────────

        $scholarship1 = Scholarship::updateOrCreate(
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

        $scholarship2 = Scholarship::updateOrCreate(
            ['title' => 'Barangay Sports Scholarship'],
            [
                'description' => 'For student-athletes representing the barangay in regional competitions.',
                'allowance' => 48000.00,
                'slots' => 5,
                'deadline' => '2026-07-15',
                'status' => 'available',
                'created_by' => $admin->id,
            ]
        );
        $this->createRequirements($scholarship2);

        $scholarship3 = Scholarship::updateOrCreate(
            ['title' => 'Out-of-School Youth Support Grant'],
            [
                'description' => 'For out-of-school youth pursuing alternative learning programs.',
                'allowance' => 32000.00,
                'slots' => 8,
                'deadline' => '2026-09-30',
                'status' => 'available',
                'created_by' => $admin->id,
            ]
        );
        $this->createRequirements($scholarship3);

        $scholarship4 = Scholarship::updateOrCreate(
            ['title' => 'STEM Achievers Scholarship'],
            [
                'description' => 'Supports students excelling in Science, Technology, Engineering, and Mathematics tracks.',
                'allowance' => 50000.00,
                'slots' => 15,
                'deadline' => '2026-10-15',
                'status' => 'available',
                'created_by' => $admin->id,
            ]
        );
        $this->createRequirements($scholarship4);

        $scholarship5 = Scholarship::updateOrCreate(
            ['title' => 'Solo Parent Dependents Scholarship'],
            [
                'description' => 'For children of registered solo parents in the barangay who need financial support to continue schooling.',
                'allowance' => 28000.00,
                'slots' => 12,
                'deadline' => '2026-11-30',
                'status' => 'available',
                'created_by' => $admin->id,
            ]
        );
        $this->createRequirements($scholarship5);

        // ── FULL ─────────────────────────────────────────────────────────────

        $scholarship6 = Scholarship::updateOrCreate(
            ['title' => 'SK Leadership & Civic Excellence Award'],
            [
                'description' => 'Recognises outstanding Sangguniang Kabataan youth leaders who demonstrate exemplary civic service.',
                'allowance' => 35000.00,
                'slots' => 0,
                'deadline' => '2026-07-31',
                'status' => 'full',
                'created_by' => $admin->id,
            ]
        );
        $this->createRequirements($scholarship6);

        $scholarship7 = Scholarship::updateOrCreate(
            ['title' => 'Arts & Culture Scholarship'],
            [
                'description' => 'For talented youth in the visual arts, performing arts, and cultural heritage programs.',
                'allowance' => 25000.00,
                'slots' => 0,
                'deadline' => '2026-06-30',
                'status' => 'full',
                'created_by' => $admin->id,
            ]
        );
        $this->createRequirements($scholarship7);

        // ── UNAVAILABLE ───────────────────────────────────────────────────────

        $scholarship8 = Scholarship::updateOrCreate(
            ['title' => 'Persons with Disability Educational Assistance'],
            [
                'description' => 'Financial assistance for PWD residents pursuing vocational or college-level education.',
                'allowance' => 40000.00,
                'slots' => 10,
                'deadline' => '2026-03-31',
                'status' => 'unavailable',
                'created_by' => $admin->id,
            ]
        );
        $this->createRequirements($scholarship8);

        $scholarship9 = Scholarship::updateOrCreate(
            ['title' => 'Senior High Technical-Vocational Grant'],
            [
                'description' => 'Supports SHS students enrolled in TVL tracks with toolkits and training allowance.',
                'allowance' => 22000.00,
                'slots' => 0,
                'deadline' => '2026-01-15',
                'status' => 'unavailable',
                'created_by' => $admin->id,
            ]
        );
        $this->createRequirements($scholarship9);
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
            ScholarshipRequirement::updateOrCreate(
                ['scholarship_id' => $scholarship->id, 'label' => $requirement['label']],
                array_merge($requirement, ['scholarship_id' => $scholarship->id])
            );
        }
    }
}
