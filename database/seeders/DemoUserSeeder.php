<?php

namespace Database\Seeders;

use App\Models\ResidenceVerification;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        $superadmin = User::where('role', 'superadmin')->first();

        // Approved admin (already verified by Superadmin)
        $admin = User::firstOrCreate(
            ['email' => 'iwakura@brgyscholarship.net'],
            [
                'name' => 'Lain Iwakura',
                'password' => 'password123',
                'role' => 'admin',
                'phone' => '09671234567',
                'email_verified_at' => now(),
                'verification_status' => 'verified',
                'verified_by' => $superadmin->id,
                'verified_at' => now(),
            ]
        );

        // Pending admin (waiting for Superadmin approval)
        User::firstOrCreate(
            ['email' => 'dantegulapa@brgyscholarship.net'],
            [
                'name' => 'Dante Gulapa',
                'password' => 'password123',
                'role' => 'admin',
                'phone' => '09171234568',
                'email_verified_at' => now(),
                'verification_status' => 'pending',
            ]
        );

        // Verified resident
        $nobitski = User::firstOrCreate(
            ['email' => 'nobitski123@email.com'],
            [
                'name' => 'Nobitski Nobi',
                'password' => 'password123',
                'role' => 'user',
                'phone' => '09181234567',
                'birthdate' => '2004-03-15',
                'sex' => 'male',
                'address' => '123 Sesami St., Barangay Etivac',
                'email_verified_at' => now(),
                'verification_status' => 'verified',
                'verified_by' => $admin->id,
                'verified_at' => now(),
            ]
        );

        ResidenceVerification::firstOrCreate(
            ['user_id' => $nobitski->id],
            [
                'valid_id_path' => 'demo/valid_ids/nobitski_id.jpg',
                'proof_of_residency_path' => 'demo/proofs/nobitski_proof.jpg',
                'birth_certificate_path' => 'demo/birth_certs/nobitski_birth.jpg',
                'status' => 'verified',
                'reviewed_by' => $admin->id,
                'reviewed_at' => now(),
            ]
        );

        // Pending resident (verification under review)
        // Verified resident
        $maria = User::firstOrCreate(
            ['email' => 'mariabatumbakal@yahoo.com'],
            [
                'name' => 'Maria Batumbakal',
                'password' => 'password123',
                'role' => 'user',
                'phone' => '09181234567',
                'birthdate' => '2005-03-15',
                'sex' => 'female',
                'address' => '167 Sesami St., Barangay Etivac',
                'email_verified_at' => now(),
                'verification_status' => 'verified',
                'verified_by' => $admin->id,
                'verified_at' => now(),
            ]
        );

        ResidenceVerification::firstOrCreate(
            ['user_id' => $maria->id],
            [
                'valid_id_path' => 'demo/valid_ids/maria_id.jpg',
                'proof_of_residency_path' => 'demo/proofs/maria_proof.jpg',
                'birth_certificate_path' => 'demo/birth_certs/maria_birth.jpg',
                'status' => 'verified',
                'reviewed_by' => $admin->id,
                'reviewed_at' => now(),
            ]
        );


        // Rejected resident
        $raul = User::firstOrCreate(
            ['email' => 'raul@hacker.net'],
            [
                'name' => 'Raul Reyes',
                'password' => 'password123',
                'role' => 'user',
                'phone' => '09181234569',
                'birthdate' => '2004-07-21',
                'sex' => 'male',
                'address' => '102 Sesami St., Barangay Etivac',
                'email_verified_at' => now(),
                'verification_status' => 'rejected',
                'verification_remarks' => 'Submitted ID photo is blurry and unreadable. Please resubmit.',
                'verified_by' => $admin->id,
                'verified_at' => now(),
            ]
        );

        ResidenceVerification::firstOrCreate(
            ['user_id' => $raul->id],
            [
                'valid_id_path' => 'demo/valid_ids/raul_id.jpg',
                'proof_of_residency_path' => 'demo/proofs/raul_proof.jpg',
                'birth_certificate_path' => 'demo/birth_certs/raul_birth.jpg',
                'status' => 'rejected',
                'rejection_reason' => 'Submitted ID photo is blurry and unreadable. Please resubmit.',
                'reviewed_by' => $admin->id,
                'reviewed_at' => now(),
            ]
        );
    }
}
