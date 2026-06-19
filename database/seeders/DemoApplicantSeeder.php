<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\ApplicationAnswer;
use App\Models\ApplicationLog;
use App\Models\ResidenceVerification;
use App\Models\Scholarship;
use App\Models\ScholarshipRequirement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemoApplicantSeeder extends Seeder
{
    private const FIRST_NAMES = [
        'Juan',
        'Maria',
        'Jose',
        'Ana',
        'Pedro',
        'Liza',
        'Carlo',
        'Grace',
        'Mark',
        'Joy',
        'Ramil',
        'Cherry',
        'Noel',
        'Daisy',
        'Arnel',
        'Vilma',
        'Ronnie',
        'Ella',
        'Dennis',
        'Rosa',
        'Ferdie',
        'Lourdes',
        'Jericho',
        'Angel',
        'Bayani',
        'Corazon',
        'Edgar',
        'Fe',
        'Gerardo',
        'Hazel',
        'Ivan',
        'Jasmine',
        'Kristoffer',
        'Luningning',
        'Marlon',
        'Nenita',
        'Oscar',
        'Precious',
        'Quennie',
        'Rafael',
        'Salvador',
        'Teresita',
        'Ulysses',
        'Veronica',
        'Wendell',
        'Ximena',
        'Yolanda',
        'Zaldy',
        'Alma',
        'Benito',
        'Carmela',
        'Domingo',
        'Estrella',
        'Florencio',
        'Gemma',
        'Herminio',
        'Imelda',
        'Junjun',
        'Katrina',
        'Leon',
    ];

    private const LAST_NAMES = [
        'Santos',
        'Reyes',
        'Cruz',
        'Bautista',
        'Garcia',
        'Mendoza',
        'Torres',
        'Flores',
        'Ramos',
        'Villanueva',
        'Castillo',
        'Aquino',
        'Del Rosario',
        'Aguilar',
        'Marquez',
        'Pascual',
        'Navarro',
        'Domingo',
        'Salazar',
        'Gonzales',
        'Lopez',
        'Fernandez',
        'Romero',
        'Vasquez',
        'Mercado',
        'Rivera',
        'Diaz',
        'Castro',
        'Ocampo',
        'Lim',
    ];

    public function run(): void
    {
        $admin = User::where('email', 'iwakura@brgyscholarship.net')->first();
        $superadmin = User::where('role', 'superadmin')->first();
        $verifier = $admin ?? $superadmin;

        $scholarships = Scholarship::all();

        if ($scholarships->isEmpty()) {
            $this->command?->warn('No scholarships found — run DemoScholarshipSeeder first. Skipping DemoApplicantSeeder.');

            return;
        }

        $usedNames = [];

        $verifiedUsers = [];

        for ($i = 1; $i <= 40; $i++) {
            $name = $this->uniqueName($usedNames);
            $email = Str::slug($name, '') . $i . '@residentmail.test';

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => 'password123',
                    'role' => 'user',
                    'phone' => '09' . random_int(100000000, 999999999),
                    'birthdate' => now()->subYears(random_int(16, 24))->subDays(random_int(0, 365))->format('Y-m-d'),
                    'sex' => random_int(0, 1) === 0 ? 'male' : 'female',
                    'address' => random_int(1, 200) . ' Sample St., Barangay Etivac',
                    'email_verified_at' => now(),
                    'verification_status' => 'verified',
                    'verified_by' => $verifier->id,
                    'verified_at' => now()->subDays(random_int(5, 60)),
                ]
            );

            ResidenceVerification::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'valid_id_path' => "demo/valid_ids/applicant_{$i}_id.jpg",
                    'proof_of_residency_path' => "demo/proofs/applicant_{$i}_proof.jpg",
                    'birth_certificate_path' => "demo/birth_certs/applicant_{$i}_birth.jpg",
                    'status' => 'verified',
                    'reviewed_by' => $verifier->id,
                    'reviewed_at' => now()->subDays(random_int(5, 60)),
                ]
            );

            $verifiedUsers[] = $user;
        }

        for ($i = 1; $i <= 20; $i++) {
            $name = $this->uniqueName($usedNames);
            $email = Str::slug($name, '') . ($i + 40) . '@residentmail.test';

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => 'password123',
                    'role' => 'user',
                    'phone' => '09' . random_int(100000000, 999999999),
                    'birthdate' => now()->subYears(random_int(16, 24))->subDays(random_int(0, 365))->format('Y-m-d'),
                    'sex' => random_int(0, 1) === 0 ? 'male' : 'female',
                    'address' => random_int(1, 200) . ' Sample St., Barangay Etivac',
                    'email_verified_at' => now(),
                    'verification_status' => 'pending',
                ]
            );

            ResidenceVerification::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'valid_id_path' => "demo/valid_ids/pending_{$i}_id.jpg",
                    'proof_of_residency_path' => "demo/proofs/pending_{$i}_proof.jpg",
                    'birth_certificate_path' => "demo/birth_certs/pending_{$i}_birth.jpg",
                    'status' => 'pending',
                ]
            );
        }

        $statusWeights = [
            'pending' => 50,
            'approved' => 30,
            'rejected' => 20,
        ];

        foreach ($verifiedUsers as $user) {
            $applyCount = $this->weightedRandom([1 => 60, 2 => 30, 3 => 10]);
            $chosenScholarships = $scholarships->random(min($applyCount, $scholarships->count()));

            foreach ($chosenScholarships as $scholarship) {
                $status = $this->weightedRandom($statusWeights);
                $submittedAt = now()->subDays(random_int(1, 45));

                $application = Application::firstOrCreate(
                    ['user_id' => $user->id, 'scholarship_id' => $scholarship->id],
                    [
                        'status' => $status,
                        'submitted_at' => $submittedAt,
                        'reviewed_by' => $status === 'pending' ? null : $verifier->id,
                        'reviewed_at' => $status === 'pending' ? null : $submittedAt->copy()->addDays(random_int(1, 10)),
                        'remarks' => match ($status) {
                            'approved' => 'All requirements met. Congratulations!',
                            'rejected' => $this->randomRejectionReason(),
                            default => null,
                        },
                    ]
                );

                $this->addAnswers($application, $scholarship);

                ApplicationLog::firstOrCreate(
                    ['application_id' => $application->id, 'new_status' => 'pending'],
                    ['old_status' => null, 'changed_by' => $user->id, 'notes' => 'Application submitted.', 'created_at' => $submittedAt]
                );

                if ($status !== 'pending') {
                    ApplicationLog::firstOrCreate(
                        ['application_id' => $application->id, 'new_status' => $status],
                        [
                            'old_status' => 'pending',
                            'changed_by' => $verifier->id,
                            'notes' => $status === 'approved' ? 'All requirements met. Congratulations!' : $this->randomRejectionReason(),
                            'created_at' => $submittedAt->copy()->addDays(random_int(1, 10)),
                        ]
                    );
                }
            }
        }

        $this->command?->info('Seeded 40 verified + 20 unverified applicants, with applications spread across ' . $scholarships->count() . ' scholarships.');
    }

    private function uniqueName(array &$usedNames): string
    {
        do {
            $name = self::FIRST_NAMES[array_rand(self::FIRST_NAMES)] . ' ' . self::LAST_NAMES[array_rand(self::LAST_NAMES)];
        } while (in_array($name, $usedNames, true));

        $usedNames[] = $name;

        return $name;
    }

    private function weightedRandom(array $weights)
    {
        $total = array_sum($weights);
        $rand = random_int(1, $total);

        foreach ($weights as $key => $weight) {
            $rand -= $weight;
            if ($rand <= 0) {
                return $key;
            }
        }

        return array_key_first($weights);
    }

    private function randomRejectionReason(): string
    {
        $reasons = [
            'Submitted documents are incomplete. Please resubmit with all required files.',
            'GPA requirement not met based on submitted transcript.',
            'Certificate of Indigency has expired. Please provide an updated copy.',
            'Application does not meet the eligibility criteria for this grant.',
            'Duplicate application detected for the same applicant.',
        ];

        return $reasons[array_rand($reasons)];
    }

    private function addAnswers(Application $application, Scholarship $scholarship): void
    {
        foreach ($scholarship->requirements as $requirement) {
            $value = $this->sampleValueFor($requirement);

            ApplicationAnswer::firstOrCreate(
                ['application_id' => $application->id, 'requirement_id' => $requirement->id],
                [
                    'value' => $requirement->field_type === 'file' ? null : $value,
                    'file_path' => $requirement->field_type === 'file' ? 'demo/answers/sample_document.pdf' : null,
                ]
            );
        }
    }

    private function sampleValueFor(ScholarshipRequirement $requirement): ?string
    {
        if ($requirement->field_type === 'select' && ! empty($requirement->options)) {
            return $requirement->options[array_rand($requirement->options)];
        }

        if ($requirement->field_type === 'checkbox' && ! empty($requirement->options)) {
            $count = random_int(1, min(2, count($requirement->options)));
            $picked = (array) array_rand(array_flip($requirement->options), $count);

            return implode(',', $picked);
        }

        if ($requirement->field_type === 'number') {
            return match (true) {
                str_contains(strtolower($requirement->label), 'gpa') => (string) random_int(88, 99),
                str_contains(strtolower($requirement->label), 'age') => (string) random_int(16, 24),
                str_contains(strtolower($requirement->label), 'year') => (string) random_int(1, 5),
                default => (string) random_int(1, 100),
            };
        }

        if ($requirement->field_type === 'date') {
            return now()->subYears(random_int(1, 5))->format('Y-m-d');
        }

        if ($requirement->field_type === 'textarea') {
            return 'I am applying for this scholarship because I want to continue my studies and contribute back to our barangay community after I graduate.';
        }

        if ($requirement->field_type === 'text') {
            return match (true) {
                str_contains(strtolower($requirement->label), 'solo parent id') => 'SP-' . random_int(10000, 99999),
                str_contains(strtolower($requirement->label), 'tournament') => 'Provincial Meet 2026',
                str_contains(strtolower($requirement->label), 'toolkit') => 'Basic hand tools set',
                default => 'Sample answer',
            };
        }

        return 'Sample answer';
    }
}
