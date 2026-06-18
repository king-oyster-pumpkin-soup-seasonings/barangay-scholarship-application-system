<?php

use App\Models\Scholarship;
use Database\Seeders\DemoScholarshipSeeder;
use Database\Seeders\DemoUserSeeder;
use Database\Seeders\SuperadminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('demo scholarship seeder is idempotent and updates existing records', function () {
    // 1. Seed dependencies
    $this->seed(SuperadminSeeder::class);
    $this->seed(DemoUserSeeder::class);

    // 2. Run DemoScholarshipSeeder the first time
    $this->seed(DemoScholarshipSeeder::class);

    // 3. Verify it exists
    $scholarship = Scholarship::where('title', 'Barangay Academic Excellence Grant')->first();
    expect($scholarship)->not->toBeNull();
    expect($scholarship->slots)->toBe(10);

    // 4. Manually modify the slot count to simulate local database state deviation
    $scholarship->update(['slots' => 20]);
    expect($scholarship->fresh()->slots)->toBe(20);

    // 5. Run the seeder again (it should update the records to the seeder's configuration)
    $this->seed(DemoScholarshipSeeder::class);

    // 6. Verify that it updated back to the defined seeder value of 10
    expect($scholarship->fresh()->slots)->toBe(10);
});
