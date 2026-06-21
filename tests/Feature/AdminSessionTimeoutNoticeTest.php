<?php

use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Models\User;
use Livewire\Attributes\Poll;

it('shows the inactivity session notice only for admin panel users', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'verification_status' => 'verified',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('admin-session-timeout-modal', false)
        ->assertSee('Your admin session is about to expire because no activity was detected.', false);
});

it('does not show the admin inactivity session notice for resident users', function () {
    $resident = User::factory()->create([
        'role' => 'user',
    ]);

    $this->actingAs($resident)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertDontSee('admin-session-timeout-modal', false);
});

it('allows admin users to refresh their session while active', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'verification_status' => 'verified',
    ]);

    $this->actingAs($admin)
        ->post(route('admin.session.keep-alive'))
        ->assertNoContent();
});

it('does not use background dashboard polling as user activity', function () {
    $renderMethod = new ReflectionMethod(AdminDashboard::class, 'render');

    expect($renderMethod->getAttributes(Poll::class))->toBe([]);
});
