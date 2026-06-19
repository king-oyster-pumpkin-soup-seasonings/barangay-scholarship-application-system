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
        $this->academicExcellenceRequirements($scholarship1);

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
        $this->sportsRequirements($scholarship2);

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
        $this->outOfSchoolYouthRequirements($scholarship3);

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
        $this->stemRequirements($scholarship4);

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
        $this->soloParentDependentRequirements($scholarship5);

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
        $this->skLeadershipRequirements($scholarship6);

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
        $this->artsAndCultureRequirements($scholarship7);

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
        $this->pwdRequirements($scholarship8);

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
        $this->techVocRequirements($scholarship9);
    }

    /**
     * Shared by almost every scholarship: identity + indigency proof.
     */
    private function baseGeneralDocuments(Scholarship $scholarship): void
    {
        $this->saveAll($scholarship, [
            ['category' => 'general_document', 'field_type' => 'file', 'label' => 'Valid ID', 'is_required' => true, 'order' => 1],
            ['category' => 'general_document', 'field_type' => 'file', 'label' => 'Certificate of Indigency', 'is_required' => true, 'order' => 2],
            ['category' => 'general_document', 'field_type' => 'file', 'label' => 'Barangay Residency Certificate', 'is_required' => true, 'order' => 3],
        ]);
    }

    private function academicExcellenceRequirements(Scholarship $scholarship): void
    {
        $this->baseGeneralDocuments($scholarship);

        $this->saveAll($scholarship, [
            ['category' => 'eligibility', 'field_type' => 'number', 'label' => 'Current GPA', 'is_required' => true, 'order' => 1],
            ['category' => 'eligibility', 'field_type' => 'select', 'label' => 'Year Level', 'options' => ['Grade 11', 'Grade 12', 'College'], 'is_required' => true, 'order' => 2],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => 'Report Card / Transcript of Records', 'is_required' => true, 'order' => 1],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => 'Certificate of Good Moral Character', 'is_required' => true, 'order' => 2],
            ['category' => 'additional_field', 'field_type' => 'textarea', 'label' => 'Why do you deserve this scholarship?', 'is_required' => false, 'order' => 1],
        ]);
    }

    private function sportsRequirements(Scholarship $scholarship): void
    {
        $this->baseGeneralDocuments($scholarship);

        $this->saveAll($scholarship, [
            ['category' => 'eligibility', 'field_type' => 'select', 'label' => 'Primary Sport', 'options' => ['Basketball', 'Volleyball', 'Track and Field', 'Boxing', 'Swimming', 'Badminton'], 'is_required' => true, 'order' => 1],
            ['category' => 'eligibility', 'field_type' => 'select', 'label' => 'Competition Level Represented', 'options' => ['Barangay', 'City/Municipal', 'Provincial', 'Regional', 'National'], 'is_required' => true, 'order' => 2],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => 'Certificate of Athletic Participation', 'is_required' => true, 'order' => 1],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => 'Coach or Sports Official Endorsement Letter', 'is_required' => true, 'order' => 2],
            ['category' => 'additional_field', 'field_type' => 'text', 'label' => 'Most Recent Tournament or Meet', 'is_required' => false, 'order' => 1],
        ]);
    }

    private function outOfSchoolYouthRequirements(Scholarship $scholarship): void
    {
        $this->baseGeneralDocuments($scholarship);

        $this->saveAll($scholarship, [
            ['category' => 'eligibility', 'field_type' => 'number', 'label' => 'Age', 'is_required' => true, 'order' => 1],
            ['category' => 'eligibility', 'field_type' => 'select', 'label' => 'Reason Out of School', 'options' => ['Financial difficulty', 'Family responsibility', 'Health reasons', 'Other'], 'is_required' => true, 'order' => 2],
            ['category' => 'eligibility', 'field_type' => 'select', 'label' => 'ALS Program Enrolled In', 'options' => ['Elementary ALS', 'Junior High School ALS', 'Senior High School ALS'], 'is_required' => true, 'order' => 3],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => 'ALS Enrollment Certificate', 'is_required' => true, 'order' => 1],
            ['category' => 'additional_field', 'field_type' => 'textarea', 'label' => 'What are your plans after completing the ALS program?', 'is_required' => false, 'order' => 1],
        ]);
    }

    private function stemRequirements(Scholarship $scholarship): void
    {
        $this->baseGeneralDocuments($scholarship);

        $this->saveAll($scholarship, [
            ['category' => 'eligibility', 'field_type' => 'number', 'label' => 'Current GPA', 'is_required' => true, 'order' => 1],
            ['category' => 'eligibility', 'field_type' => 'select', 'label' => 'STEM Track or Course', 'options' => ['STEM (SHS)', 'Computer Science', 'Engineering', 'Information Technology', 'Mathematics', 'Other Science Course'], 'is_required' => true, 'order' => 2],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => 'Report Card / Transcript of Records', 'is_required' => true, 'order' => 1],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => 'Certificate from Science/Math Competition (if any)', 'is_required' => false, 'order' => 2],
            ['category' => 'additional_field', 'field_type' => 'textarea', 'label' => 'Describe a STEM project you are proud of', 'is_required' => false, 'order' => 1],
        ]);
    }

    private function soloParentDependentRequirements(Scholarship $scholarship): void
    {
        $this->baseGeneralDocuments($scholarship);

        $this->saveAll($scholarship, [
            ['category' => 'eligibility', 'field_type' => 'text', 'label' => "Parent's Solo Parent ID Number", 'is_required' => true, 'order' => 1],
            ['category' => 'eligibility', 'field_type' => 'select', 'label' => 'Year Level', 'options' => ['Elementary', 'Junior High School', 'Senior High School', 'College'], 'is_required' => true, 'order' => 2],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => "Parent's Solo Parent ID (DSWD)", 'is_required' => true, 'order' => 1],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => 'Certificate of Enrollment', 'is_required' => true, 'order' => 2],
            ['category' => 'additional_field', 'field_type' => 'textarea', 'label' => 'Briefly describe your family situation', 'is_required' => false, 'order' => 1],
        ]);
    }

    private function skLeadershipRequirements(Scholarship $scholarship): void
    {
        $this->baseGeneralDocuments($scholarship);

        $this->saveAll($scholarship, [
            ['category' => 'eligibility', 'field_type' => 'select', 'label' => 'SK Position Held', 'options' => ['SK Chairperson', 'SK Kagawad', 'SK Committee Head', 'Active SK Volunteer'], 'is_required' => true, 'order' => 1],
            ['category' => 'eligibility', 'field_type' => 'number', 'label' => 'Years of Active SK Involvement', 'is_required' => true, 'order' => 2],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => 'SK Endorsement Letter', 'is_required' => true, 'order' => 1],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => 'Proof of Civic/Community Projects Led or Joined', 'is_required' => true, 'order' => 2],
            ['category' => 'additional_field', 'field_type' => 'textarea', 'label' => 'Describe your most impactful community project', 'is_required' => true, 'order' => 1],
        ]);
    }

    private function artsAndCultureRequirements(Scholarship $scholarship): void
    {
        $this->baseGeneralDocuments($scholarship);

        $this->saveAll($scholarship, [
            ['category' => 'eligibility', 'field_type' => 'select', 'label' => 'Art Discipline', 'options' => ['Visual Arts', 'Music', 'Dance', 'Theater', 'Literary Arts', 'Cultural Heritage / Folk Arts'], 'is_required' => true, 'order' => 1],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => 'Portfolio or Performance Sample', 'is_required' => true, 'order' => 1],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => 'Certificate from Workshop, Competition, or Mentor', 'is_required' => false, 'order' => 2],
            ['category' => 'additional_field', 'field_type' => 'textarea', 'label' => 'Tell us about your artistic journey', 'is_required' => false, 'order' => 1],
        ]);
    }

    private function pwdRequirements(Scholarship $scholarship): void
    {
        $this->baseGeneralDocuments($scholarship);

        $this->saveAll($scholarship, [
            ['category' => 'eligibility', 'field_type' => 'select', 'label' => 'Type of Disability', 'options' => ['Visual', 'Hearing', 'Physical/Orthopedic', 'Intellectual', 'Psychosocial', 'Speech and Language', 'Multiple'], 'is_required' => true, 'order' => 1],
            ['category' => 'eligibility', 'field_type' => 'select', 'label' => 'Education Level Pursuing', 'options' => ['Vocational/TESDA', 'College'], 'is_required' => true, 'order' => 2],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => 'PWD ID', 'is_required' => true, 'order' => 1],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => "Doctor's Medical Certificate / Assessment", 'is_required' => true, 'order' => 2],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => 'Certificate of Enrollment', 'is_required' => true, 'order' => 3],
            ['category' => 'additional_field', 'field_type' => 'checkbox', 'label' => 'Support Needed', 'options' => ['Assistive devices', 'Transportation allowance', 'Tutoring support', 'None'], 'is_required' => false, 'order' => 1],
        ]);
    }

    private function techVocRequirements(Scholarship $scholarship): void
    {
        $this->baseGeneralDocuments($scholarship);

        $this->saveAll($scholarship, [
            ['category' => 'eligibility', 'field_type' => 'select', 'label' => 'TVL Specialization', 'options' => ['Cookery', 'Electrical Installation', 'Automotive Servicing', 'Computer Systems Servicing', 'Beauty Care', 'Welding', 'Other'], 'is_required' => true, 'order' => 1],
            ['category' => 'eligibility', 'field_type' => 'select', 'label' => 'Grade Level', 'options' => ['Grade 11', 'Grade 12'], 'is_required' => true, 'order' => 2],
            ['category' => 'specific_document', 'field_type' => 'file', 'label' => 'Certificate of Enrollment (TVL Track)', 'is_required' => true, 'order' => 1],
            ['category' => 'additional_field', 'field_type' => 'text', 'label' => 'Preferred Toolkit/Equipment Needed', 'is_required' => false, 'order' => 1],
        ]);
    }

    /**
     * @param  list<array<string, mixed>>  $requirements
     */
    private function saveAll(Scholarship $scholarship, array $requirements): void
    {
        foreach ($requirements as $requirement) {
            ScholarshipRequirement::updateOrCreate(
                ['scholarship_id' => $scholarship->id, 'label' => $requirement['label']],
                array_merge($requirement, ['scholarship_id' => $scholarship->id])
            );
        }
    }
}
