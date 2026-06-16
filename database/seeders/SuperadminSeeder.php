<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperadminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'superadmin@brgyscholarship.net'],
            [
                'name' => 'Satoshi Nakamoto',
                'password' => 'password123', // auto-hashed by the 'hashed' cast on User
                'role' => 'superadmin',
                'email_verified_at' => now(),
                'verification_status' => 'verified',
            ]
        );
    }
}
