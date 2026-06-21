<?php

use App\Models\SystemSetting;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

beforeEach(function () {});

test('security settings page can be rendered', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->withSession(['auth.password_confirmed_at' => time()])
        ->get(route('security.edit'));

    $response->assertOk();
});

test('security settings page requires password confirmation when enabled', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->get(route('security.edit'));

    $response->assertRedirect(route('password.confirm'));
});

test('security settings page renders without two factor when feature is disabled', function () {
    config(['fortify.features' => []]);

    $user = User::factory()->create();

    $this->actingAs($user)
        ->withSession(['auth.password_confirmed_at' => time()])
        ->get(route('security.edit'))
        ->assertOk()
        ->assertSee('Update password')
        ->assertDontSee('Manage your passkeys for passwordless sign-in')
        ->assertDontSee('Add a passkey to sign in without a password')
        ->assertDontSee('Two-factor authentication');
});

test('password can be updated', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password'),
    ]);

    $this->actingAs($user);

    $response = Livewire::test('pages::settings.security')
        ->set('current_password', 'password')
        ->set('password', 'new-password')
        ->set('password_confirmation', 'new-password')
        ->call('updatePassword');

    $response->assertHasNoErrors();

    expect(Hash::check('new-password', $user->refresh()->password))->toBeTrue();
});

test('correct password must be provided to update password', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password'),
    ]);

    $this->actingAs($user);

    $response = Livewire::test('pages::settings.security')
        ->set('current_password', 'wrong-password')
        ->set('password', 'new-password')
        ->set('password_confirmation', 'new-password')
        ->call('updatePassword');

    $response->assertHasErrors(['current_password']);
});

test('inactive users are logged out and see a session expired message', function () {
    SystemSetting::setSessionTimeoutMinutes(20);

    $user = User::factory()->create();

    $this->actingAs($user)
        ->withSession(['last_activity' => now()->subMinutes(21)])
        ->get(route('dashboard'))
        ->assertRedirect(route('login'))
        ->assertSessionHas('error', 'Your session expired after 20 minutes of inactivity. Please sign in again.');

    expect(auth()->check())->toBeFalse();
});

test('active users remain signed in before the session timeout', function () {
    SystemSetting::setSessionTimeoutMinutes(20);

    $user = User::factory()->create();

    $this->actingAs($user)
        ->withSession(['last_activity' => now()->subMinutes(19)])
        ->get(route('dashboard'))
        ->assertOk();
});

test('superadmin can configure session timeout in settings', function () {
    $superadmin = User::factory()->create([
        'role' => 'superadmin',
    ]);

    $this->actingAs($superadmin);

    $this->get(route('session-timeout.edit'))
        ->assertOk()
        ->assertSee('Session timeout');

    Livewire::test('pages::settings.session-timeout')
        ->set('timeoutAmount', 2)
        ->set('timeoutUnit', 'hours')
        ->call('save')
        ->assertHasNoErrors();

    expect(SystemSetting::sessionTimeoutMinutes())->toBe(120);
});

test('standard users cannot configure session timeout settings', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('session-timeout.edit'))
        ->assertRedirect(route('errors.403'));
});
