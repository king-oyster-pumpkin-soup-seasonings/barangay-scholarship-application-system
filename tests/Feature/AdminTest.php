<?php

use App\Livewire\Admin\Announcements;
use App\Livewire\Admin\Applications;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Scholarships;
use App\Livewire\Admin\Verifications;
use App\Livewire\Pages\Applications\Create as CreateApplicationPage;
use App\Livewire\Superadmin\AdminManagement;
use App\Models\AdminAuditLog;
use App\Models\Announcement;
use App\Models\Application;
use App\Models\ApplicationAnswer;
use App\Models\ApplicationLog;
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

    $approvedScholarship = Scholarship::create([
        'title' => 'Approved Scholarship',
        'description' => 'Test Description',
        'allowance' => 5000.00,
        'slots' => 5,
        'deadline' => now()->addDays(30),
        'status' => 'available',
        'created_by' => $admin->id,
    ]);

    Application::create([
        'user_id' => $user->id,
        'scholarship_id' => $approvedScholarship->id,
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
        ->call('openApprovalModal', $application->id)
        ->call('confirmApprove')
        ->assertHasNoErrors();

    expect($application->refresh()->status)->toBe('approved');
    expect($application->reviewed_by)->toBe($admin->id);
    expect($application->reviewed_at)->not->toBeNull();
    expect($scholarship->refresh()->slots)->toBe(4);
    expect(ApplicationLog::where('application_id', $application->id)
        ->where('changed_by', $admin->id)
        ->where('new_status', 'approved')
        ->exists())->toBeTrue();

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
        ->call('openApprovalModal', $application->id)
        ->call('confirmApprove')
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
    expect($application->reviewed_by)->toBe($admin->id);
    expect($application->reviewed_at)->not->toBeNull();
    expect($application->remarks)->toBe('GPA requirement not met');
    expect(ApplicationLog::where('application_id', $application->id)
        ->where('changed_by', $admin->id)
        ->where('new_status', 'rejected')
        ->exists())->toBeTrue();

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
        ->call('openDeleteModal', $announcement->id)
        ->assertSet('showDeleteModal', true)
        ->call('delete')
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

test('admin and superadmin routes redirect unauthorized roles to forbidden page', function () {
    $resident = User::create([
        'name' => 'Resident User',
        'email' => 'resident-route@example.com',
        'email_verified_at' => now(),
        'password' => bcrypt('password123'),
        'role' => 'user',
        'verification_status' => 'verified',
    ]);

    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin-route@example.com',
        'email_verified_at' => now(),
        'password' => bcrypt('password123'),
        'role' => 'admin',
        'verification_status' => 'verified',
    ]);

    $resident->forceFill(['email_verified_at' => now()])->save();
    $admin->forceFill(['email_verified_at' => now()])->save();

    $this->actingAs($resident)
        ->get('/admin/dashboard')
        ->assertRedirect(route('errors.403'));

    $this->actingAs($admin)
        ->get('/superadmin/admins')
        ->assertRedirect(route('errors.403'));

    $this->actingAs($admin)
        ->get('/super-admin/admins')
        ->assertRedirect(route('errors.403'));
});

test('session lifetime is configured for inactivity logout', function () {
    expect(config('session.lifetime'))->toBe(20);
});

test('approved applications cannot be approved or rejected again', function () {
    Notification::fake();

    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin-state@example.com',
        'password' => bcrypt('password123'),
        'role' => 'admin',
    ]);

    $user = User::create([
        'name' => 'Resident User',
        'email' => 'resident-state@example.com',
        'password' => bcrypt('password123'),
        'role' => 'user',
        'verification_status' => 'verified',
    ]);

    $scholarship = Scholarship::create([
        'title' => 'State Scholarship',
        'description' => 'State transition test scholarship.',
        'allowance' => 5000.00,
        'slots' => 5,
        'deadline' => now()->addDays(30),
        'status' => 'available',
        'created_by' => $admin->id,
    ]);

    $application = Application::create([
        'user_id' => $user->id,
        'scholarship_id' => $scholarship->id,
        'status' => 'approved',
        'submitted_at' => now(),
    ]);

    $this->actingAs($admin);

    Livewire::test(Applications::class)
        ->call('openApprovalModal', $application->id)
        ->call('confirmApprove')
        ->assertHasNoErrors()
        ->assertSet('infoMessage', 'Only pending applications can be approved.');

    Livewire::test(Applications::class)
        ->call('openRejectionModal', $application->id)
        ->set('rejectionRemarks', 'Trying to reject an already approved record')
        ->call('reject')
        ->assertHasNoErrors()
        ->assertSet('infoMessage', 'Only pending applications can be rejected.');

    expect($application->refresh()->status)->toBe('approved');
    expect($scholarship->refresh()->slots)->toBe(5);
    expect(ApplicationLog::where('application_id', $application->id)->count())->toBe(0);
});

test('superadmin can view admin audit logs', function () {
    $superadmin = User::create([
        'name' => 'Superadmin User',
        'email' => 'superadmin-audit@example.com',
        'password' => bcrypt('password123'),
        'role' => 'superadmin',
    ]);

    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin-audit@example.com',
        'password' => bcrypt('password123'),
        'role' => 'admin',
        'verification_status' => 'verified',
    ]);

    AdminAuditLog::create([
        'super_admin_id' => $superadmin->id,
        'super_admin_name' => $superadmin->name,
        'action_type' => 'Created',
        'target_admin_name' => $admin->name,
        'target_admin_email' => $admin->email,
        'ip_address' => '127.0.0.1',
    ]);

    $this->actingAs($superadmin);

    Livewire::test(AdminManagement::class)
        ->assertViewHas('adminAuditLogs')
        ->assertSee('Super Admin Account Audit')
        ->assertSee($admin->email);
});

test('superadmin cannot delete the last admin account', function () {
    $superadmin = User::create([
        'name' => 'Superadmin User',
        'email' => 'superadmin-lock@example.com',
        'password' => bcrypt('password123'),
        'role' => 'superadmin',
    ]);

    $admin = User::create([
        'name' => 'Only Admin',
        'email' => 'only-admin@example.com',
        'password' => bcrypt('password123'),
        'role' => 'admin',
        'verification_status' => 'verified',
    ]);

    $this->actingAs($superadmin);

    Livewire::test(AdminManagement::class)
        ->set('deleteAdminId', $admin->id)
        ->set('superAdminPassword', 'password123')
        ->call('deleteAdmin')
        ->assertHasNoErrors();

    expect(User::where('role', 'admin')->count())->toBe(1);
    expect(User::whereKey($admin->id)->exists())->toBeTrue();
});

test('standard admin cannot call superadmin account management actions', function () {
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'not-superadmin@example.com',
        'password' => bcrypt('password123'),
        'role' => 'admin',
        'verification_status' => 'verified',
    ]);

    $this->actingAs($admin);

    Livewire::test(AdminManagement::class)
        ->call('openCreateModal')
        ->assertForbidden();
});

test('admin can manage scholarships', function () {
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => bcrypt('password123'),
        'role' => 'admin',
    ]);

    $this->actingAs($admin);

    // Create
    Livewire::test(Scholarships::class)
        ->call('openCreateModal')
        ->set('title', 'New Tertiary Education Subsidy')
        ->set('description', 'This is a test description for scholarship program.')
        ->set('allowance', '15000')
        ->set('slotsCount', '10')
        ->set('deadline', '2026-12-31')
        ->set('status', 'available')
        ->set('requirements', [
            [
                'id' => null,
                'category' => 'eligibility',
                'field_type' => 'number',
                'label' => 'Minimum GPA',
                'optionsText' => '',
                'is_required' => true,
            ],
            [
                'id' => null,
                'category' => 'specific_document',
                'field_type' => 'file',
                'label' => 'Latest Certificate of Registration',
                'optionsText' => '',
                'is_required' => true,
            ],
            [
                'id' => null,
                'category' => 'additional_field',
                'field_type' => 'select',
                'label' => 'Preferred payout method',
                'optionsText' => "Cash\nBank Transfer",
                'is_required' => false,
            ],
        ])
        ->call('save')
        ->assertHasNoErrors();

    $scholarship = Scholarship::where('title', 'New Tertiary Education Subsidy')->first();
    expect($scholarship)->not->toBeNull();
    expect($scholarship->description)->toBe('This is a test description for scholarship program.');
    expect($scholarship->allowance)->toEqual(15000);
    expect($scholarship->slots)->toBe(10);
    expect($scholarship->status)->toBe('available');

    expect($scholarship->requirements()->count())->toBe(3);
    expect($scholarship->requirements()->where('label', 'Minimum GPA')->exists())->toBeTrue();
    expect($scholarship->requirements()->where('label', 'Preferred payout method')->first()->options)->toBe(['Cash', 'Bank Transfer']);

    // Update
    Livewire::test(Scholarships::class)
        ->call('openEditModal', $scholarship->id)
        ->set('title', 'Updated Tertiary Education Subsidy')
        ->set('slotsCount', '5')
        ->set('requirements.0.label', 'Current weighted average')
        ->call('save')
        ->assertHasNoErrors();

    expect($scholarship->refresh()->title)->toBe('Updated Tertiary Education Subsidy');
    expect($scholarship->slots)->toBe(5);
    expect($scholarship->requirements()->where('label', 'Current weighted average')->exists())->toBeTrue();

    // Update slots to 0 should set status to full
    Livewire::test(Scholarships::class)
        ->call('openEditModal', $scholarship->id)
        ->set('slotsCount', '0')
        ->call('save')
        ->assertHasNoErrors();

    expect($scholarship->refresh()->slots)->toBe(0);
    expect($scholarship->status)->toBe('full');

    // Delete
    Livewire::test(Scholarships::class)
        ->call('openDeleteModal', $scholarship->id)
        ->assertSet('showDeleteModal', true)
        ->call('delete')
        ->assertHasNoErrors();

    expect(Scholarship::count())->toBe(0);
});

test('resident can submit custom additional scholarship requirements', function () {
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
        'title' => 'Flexible Scholarship',
        'description' => 'A scholarship with custom application requirements.',
        'allowance' => 5000.00,
        'slots' => 5,
        'deadline' => now()->addDays(30),
        'status' => 'available',
        'created_by' => $admin->id,
    ]);

    $gpaRequirement = $scholarship->requirements()->create([
        'category' => 'eligibility',
        'field_type' => 'number',
        'label' => 'Current GPA',
        'is_required' => true,
        'order' => 1,
    ]);

    $interviewDateRequirement = $scholarship->requirements()->create([
        'category' => 'additional_field',
        'field_type' => 'date',
        'label' => 'Preferred interview date',
        'is_required' => true,
        'order' => 2,
    ]);

    $interestRequirement = $scholarship->requirements()->create([
        'category' => 'additional_field',
        'field_type' => 'checkbox',
        'label' => 'Academic interests',
        'options' => ['STEM', 'Arts'],
        'is_required' => true,
        'order' => 3,
    ]);

    $this->actingAs($user);

    Livewire::test(CreateApplicationPage::class, ['scholarship' => $scholarship])
        ->assertSee('Current GPA')
        ->set("answers.{$gpaRequirement->id}", '4.0')
        ->call('nextStep')
        ->assertHasNoErrors()
        ->assertSee('Preferred interview date')
        ->assertSee('Academic interests')
        ->set("answers.{$interviewDateRequirement->id}", now()->addWeek()->format('Y-m-d'))
        ->set("answers.{$interestRequirement->id}", ['STEM'])
        ->call('submit')
        ->assertHasNoErrors();

    $application = Application::where('user_id', $user->id)
        ->where('scholarship_id', $scholarship->id)
        ->first();

    expect($application)->not->toBeNull();
    expect(ApplicationAnswer::where('application_id', $application->id)->count())->toBe(3);
    expect(ApplicationAnswer::where('requirement_id', $interestRequirement->id)->first()->value)->toBe('STEM');
});
