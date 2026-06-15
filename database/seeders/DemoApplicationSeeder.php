<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\ApplicationAnswer;
use App\Models\ApplicationLog;
use App\Models\Scholarship;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $maria = User::where('email', 'mariabatumbakal@yahoo.com')->first();
        $admin = User::where('email', 'iwakura@brgyscholarship.net')->first();

        $scholarship1 = Scholarship::where('title', 'Barangay Academic Excellence Grant')->first();
        $scholarship2 = Scholarship::where('title', 'Barangay Sports Scholarship')->first();

        // Application 1: pending review
        $application1 = Application::firstOrCreate(
            ['user_id' => $maria->id, 'scholarship_id' => $scholarship1->id],
            ['status' => 'pending', 'submitted_at' => now()->subDays(2)]
        );
        $this->addAnswers($application1, $scholarship1);

        ApplicationLog::firstOrCreate(
            ['application_id' => $application1->id, 'new_status' => 'pending'],
            ['old_status' => null, 'changed_by' => $maria->id, 'notes' => 'Application submitted.']
        );

        // Application 2: already approved
        $application2 = Application::firstOrCreate(
            ['user_id' => $maria->id, 'scholarship_id' => $scholarship2->id],
            [
                'status' => 'approved',
                'submitted_at' => now()->subDays(5),
                'reviewed_by' => $admin->id,
                'reviewed_at' => now()->subDay(),
                'remarks' => 'All requirements met. Congratulations!',
            ]
        );
        $this->addAnswers($application2, $scholarship2);

        ApplicationLog::firstOrCreate(
            ['application_id' => $application2->id, 'new_status' => 'pending'],
            ['old_status' => null, 'changed_by' => $maria->id, 'notes' => 'Application submitted.']
        );
        ApplicationLog::firstOrCreate(
            ['application_id' => $application2->id, 'new_status' => 'approved'],
            ['old_status' => 'pending', 'changed_by' => $admin->id, 'notes' => 'All requirements met. Congratulations!']
        );
    }

    private function addAnswers(Application $application, Scholarship $scholarship): void
    {
        foreach ($scholarship->requirements as $requirement) {
            $value = match ($requirement->field_type) {
                'file' => null,
                'select' => $requirement->options[0] ?? null,
                'number' => '95',
                'textarea' => 'I want to finish my studies and help my family.',
                default => 'Sample answer',
            };

            ApplicationAnswer::firstOrCreate(
                ['application_id' => $application->id, 'requirement_id' => $requirement->id],
                [
                    'value' => $value,
                    'file_path' => $requirement->field_type === 'file' ? 'demo/answers/sample_document.pdf' : null,
                ]
            );
        }
    }
}
