<?php

use App\Models\Application;
use App\Models\Scholarship;
use App\Models\User;
use App\Notifications\ApplicationStatusUpdatedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('application status updated notification sends correct database and email payload', function () {
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password123'),
        'role' => 'admin',
    ]);

    $user = User::create([
        'name' => 'Resident User',
        'email' => 'resident@example.com',
        'password' => bcrypt('password123'),
        'role' => 'user',
    ]);

    $scholarship = Scholarship::create([
        'title' => 'Academic Gold',
        'description' => 'Test Description',
        'allowance' => 10000.00,
        'slots' => 5,
        'deadline' => now()->addDays(30),
        'status' => 'available',
        'created_by' => $admin->id,
    ]);

    $application = Application::create([
        'user_id' => $user->id,
        'scholarship_id' => $scholarship->id,
        'status' => 'approved',
        'remarks' => 'Congratulations!',
        'submitted_at' => now(),
    ]);

    $notification = new ApplicationStatusUpdatedNotification($application);

    // Verify channels
    expect($notification->via($user))->toBe(['database', 'mail']);

    // Verify database array representation
    $dbData = $notification->toArray($user);
    expect($dbData)->toBe([
        'title' => 'Application Status Updated',
        'message' => 'Your scholarship application is now approved.',
        'type' => 'application_status_updated',
        'status' => 'approved',
    ]);

    // Verify mail representation
    $mailMessage = $notification->toMail($user);
    expect($mailMessage->subject)->toBe('Scholarship Application Approved - Academic Gold');
    expect($mailMessage->greeting)->toBe('Hello Resident User,');
    expect($mailMessage->introLines[0])->toBe('Your application for the scholarship program "Academic Gold" has been approved.');
    expect($mailMessage->introLines[1])->toBe('Remarks: Congratulations!');
    expect($mailMessage->actionText)->toBe('View My Dashboard');
});
