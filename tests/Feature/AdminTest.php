<?php

use App\Livewire\Admin\Announcements;
use App\Livewire\Admin\Applications;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Verifications;
use App\Livewire\Superadmin\AdminManagement;
use App\Models\Announcement;
use App\Models\Application;
use App\Models\ResidenceVerification;
use App\Models\Scholarship;
use App\Models\User;
use App\Notifications\ApplicationStatusUpdatedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('admin dashboard renders and calculates statistics correctly', function () {
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
        'verification_status' => 'pending',
    ]);

    ResidenceVerification::create([
        'user_id' => $user->id,
        'valid_id_path' => 'demo/valid_ids/nobitski_id.jpg',
        'proof_of_residency_path' => 'demo/proofs/nobitski_proof.jpg',
        'birth_certificate_path' => 'demo/birth_certs/nobitski_birth.jpg',
        'status' => 'pending',
    ]);

    $scholarship = Scholarship::create([
        'title' => 'Test Scholarship',
        'description' => 'Test Description',
        'allowance' => 5000.00,
        'slots' => 5,
        'deadline' => now()->addDays(30),
        'status' => 'available',
        'created_by' => $admin->id,
    ]);

    Application::create([
        'user_id' => $user->id,
        'scholarship_id' => $scholarship->id,
        'status' => 'pending',
        'submitted_at' => now(),
    ]);

    Application::create([
        'user_id' => $user->id,
        'scholarship_id' => $scholarship->id,
        'status' => 'approved',
        'submitted_at' => now(),
    ]);

    $this->actingAs($admin);

    Livewire::test(Dashboard::class)
        ->assertOk()
        ->assertSee('Welcome back')
        ->assertViewHas('pendingVerifications', 1)
        ->assertViewHas('pendingApplications', 1)
        ->assertViewHas('totalScholars', 1);
});

test('admin can approve residence verification', function () {
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
        'verification_status' => 'pending',
    ]);

    $verification = ResidenceVerification::create([
        'user_id' => $user->id,
        'valid_id_path' => 'demo/valid_ids/nobitski_id.jpg',
        'proof_of_residency_path' => 'demo/proofs/nobitski_proof.jpg',
        'birth_certificate_path' => 'demo/birth_certs/nobitski_birth.jpg',
        'status' => 'pending',
    ]);

    $this->actingAs($admin);

    Livewire::test(Verifications::class)
        ->call('approve', $verification->id)
        ->assertHasNoErrors();

    expect($verification->refresh()->status)->toBe('verified');
    expect($user->refresh()->verification_status)->toBe('verified');
});

test('admin can reject residence verification with remarks', function () {
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
        'verification_status' => 'pending',
    ]);

    $verification = ResidenceVerification::create([
        'user_id' => $user->id,
        'valid_id_path' => 'demo/valid_ids/nobitski_id.jpg',
        'proof_of_residency_path' => 'demo/proofs/nobitski_proof.jpg',
        'birth_certificate_path' => 'demo/birth_certs/nobitski_birth.jpg',
        'status' => 'pending',
    ]);

    $this->actingAs($admin);

    Livewire::test(Verifications::class)
        ->call('openRejectionModal', $verification->id)
        ->set('rejectionReason', 'Invalid document submitted')
        ->call('reject')
        ->assertHasNoErrors();

    expect($verification->refresh()->status)->toBe('rejected');
    expect($verification->rejection_reason)->toBe('Invalid document submitted');
    expect($user->refresh()->verification_status)->toBe('rejected');
    expect($user->verification_remarks)->toBe('Invalid document submitted');
});

test('admin can approve scholarship application', function () {
    Notification::fake();

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
        'verification_status' => 'verified',
    ]);

    $scholarship = Scholarship::create([
        'title' => 'Test Scholarship',
        'description' => 'Test Description',
        'allowance' => 5000.00,
        'slots' => 5,
        'deadline' => now()->addDays(30),
        'status' => 'available',
        'created_by' => $admin->id,
    ]);

    $application = Application::create([
        'user_id' => $user->id,
        'scholarship_id' => $scholarship->id,
        'status' => 'pending',
        'submitted_at' => now(),
    ]);

    $this->actingAs($admin);

    Livewire::test(Applications::class)
        ->call('approve', $application->id)
        ->assertHasNoErrors();

    expect($application->refresh()->status)->toBe('approved');
    expect($scholarship->refresh()->slots)->toBe(4);

    Notification::assertSentTo(
        $user,
        ApplicationStatusUpdatedNotification::class,
        function ($notification) use ($scholarship) {
            return $notification->application->status === 'approved'
                && $notification->application->scholarship_id === $scholarship->id;
        }
    );
});

test('scholarship status transitions to full when slots reach zero upon application approval', function () {
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
        'verification_status' => 'verified',
    ]);

    $scholarship = Scholarship::create([
        'title' => 'Test Scholarship',
        'description' => 'Test Description',
        'allowance' => 5000.00,
        'slots' => 1,
        'deadline' => now()->addDays(30),
        'status' => 'available',
        'created_by' => $admin->id,
    ]);

    $application = Application::create([
        'user_id' => $user->id,
        'scholarship_id' => $scholarship->id,
        'status' => 'pending',
        'submitted_at' => now(),
    ]);

    $this->actingAs($admin);

    Livewire::test(Applications::class)
        ->call('approve', $application->id)
        ->assertHasNoErrors();

    expect($application->refresh()->status)->toBe('approved');
    expect($scholarship->refresh()->slots)->toBe(0);
    expect($scholarship->refresh()->status)->toBe('full');
});

test('admin can reject scholarship application with remarks', function () {
    Notification::fake();

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
        'verification_status' => 'verified',
    ]);

    $scholarship = Scholarship::create([
        'title' => 'Test Scholarship',
        'description' => 'Test Description',
        'allowance' => 5000.00,
        'slots' => 5,
        'deadline' => now()->addDays(30),
        'status' => 'available',
        'created_by' => $admin->id,
    ]);

    $application = Application::create([
        'user_id' => $user->id,
        'scholarship_id' => $scholarship->id,
        'status' => 'pending',
        'submitted_at' => now(),
    ]);

    $this->actingAs($admin);

    Livewire::test(Applications::class)
        ->call('openRejectionModal', $application->id)
        ->set('rejectionRemarks', 'GPA requirement not met')
        ->call('reject')
        ->assertHasNoErrors();

    expect($application->refresh()->status)->toBe('rejected');
    expect($application->remarks)->toBe('GPA requirement not met');

    Notification::assertSentTo(
        $user,
        ApplicationStatusUpdatedNotification::class,
        function ($notification) use ($scholarship) {
            return $notification->application->status === 'rejected'
                && $notification->application->remarks === 'GPA requirement not met'
                && $notification->application->scholarship_id === $scholarship->id;
        }
    );
});

test('admin can manage announcements', function () {
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password123'),
        'role' => 'admin',
    ]);

    $this->actingAs($admin);

    // Create
    Livewire::test(Announcements::class)
        ->call('openCreateModal')
        ->set('title', 'New Scholarship Open')
        ->set('body', 'You can now apply for sports scholarship.')
        ->call('save')
        ->assertHasNoErrors();

    $announcement = Announcement::first();
    expect($announcement->title)->toBe('New Scholarship Open');

    // Update
    Livewire::test(Announcements::class)
        ->call('openEditModal', $announcement->id)
        ->set('title', 'Sports Scholarship Update')
        ->call('save')
        ->assertHasNoErrors();

    expect($announcement->refresh()->title)->toBe('Sports Scholarship Update');

    // Delete
    Livewire::test(Announcements::class)
        ->call('delete', $announcement->id)
        ->assertHasNoErrors();

    expect(Announcement::count())->toBe(0);
});

test('superadmin can create a new admin directly', function () {
    $superadmin = User::create([
        'name' => 'Superadmin User',
        'email' => 'superadmin@example.com',
        'password' => bcrypt('password123'),
        'role' => 'superadmin',
    ]);

    $this->actingAs($superadmin);

    Livewire::test(AdminManagement::class)
        ->call('openCreateModal')
        ->set('name', 'New Admin')
        ->set('email', 'newadmin@example.com')
        ->set('password', 'password123')
        ->set('password_confirmation', 'password123')
        ->call('createAdmin')
        ->assertHasNoErrors();

    $newAdmin = User::where('email', 'newadmin@example.com')->first();

    expect($newAdmin)->not->toBeNull();
    expect($newAdmin->role)->toBe('admin');
    expect($newAdmin->verification_status)->toBe('verified');
    expect($newAdmin->verified_by)->toBe($superadmin->id);
    expect($newAdmin->verified_at)->not->toBeNull();
});
