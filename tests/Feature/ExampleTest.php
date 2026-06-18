<?php

use App\Models\Scholarship;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('returns a successful response', function () {
    $response = $this->get(route('home'));

    $response->assertOk();
});

test('home page lists only available scholarships', function () {
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password123'),
        'role' => 'admin',
    ]);

    // Available scholarship
    $available = Scholarship::create([
        'title' => 'Available Scholarship',
        'description' => 'Test Description',
        'allowance' => 5000.00,
        'slots' => 5,
        'deadline' => now()->addDays(30),
        'status' => 'available',
        'created_by' => $admin->id,
    ]);

    // Full scholarship
    $full = Scholarship::create([
        'title' => 'Full Scholarship',
        'description' => 'Test Description',
        'allowance' => 5000.00,
        'slots' => 0,
        'deadline' => now()->addDays(30),
        'status' => 'full',
        'created_by' => $admin->id,
    ]);

    // Unavailable scholarship
    $unavailable = Scholarship::create([
        'title' => 'Unavailable Scholarship',
        'description' => 'Test Description',
        'allowance' => 5000.00,
        'slots' => 5,
        'deadline' => now()->addDays(30),
        'status' => 'unavailable',
        'created_by' => $admin->id,
    ]);

    $response = $this->get(route('home'));

    $response->assertOk();

    // The response view should contain the available scholarship, but not the full/unavailable ones.
    $response->assertSee('Available Scholarship');
    $response->assertDontSee('Full Scholarship');
    $response->assertDontSee('Unavailable Scholarship');
});
