<?php

use Laravel\Fortify\Features;

beforeEach(function () {
    $this->skipUnlessFortifyHas(Features::registration());
});

function validRegistrationPayload(array $overrides = []): array
{
    return [
        'name' => 'John Doe',
        'email' => 'test@example.com',
        'phone' => '09171234567',
        'birthdate' => now()->subYears(20)->format('Y-m-d'),
        'age' => 20,
        'gender' => 'male',
        'pronouns' => 'he_him',
        'password' => 'password',
        'password_confirmation' => 'password',
        ...$overrides,
    ];
}

test('registration screen can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertOk();
});

test('registration age input is controlled by the birthdate field', function () {
    $response = $this->get(route('register'));

    $response->assertOk()
        ->assertSee('updateBirthdateFromAge()', false)
        ->assertSee('x-bind:disabled="!birthdate"', false)
        ->assertSee('Select birthdate first', false);
});

test('new users can register', function () {
    $response = $this->post(route('register.store'), validRegistrationPayload());

    $response->assertSessionHasNoErrors()
        ->assertRedirect(route('verification.notice', absolute: false));

    $this->assertAuthenticated();

    $user = auth()->user()->fresh();

    expect($user->age)->toBe(20);
    expect($user->gender)->toBe('male');
    expect($user->pronouns)->toBe('he_him');
    expect($user->address)->toBeNull();
    expect($user->address_street)->toBeNull();
    expect($user->hasVerifiedEmail())->toBeFalse();
});

test('registration requires age to match date of birth', function () {
    $this->post(route('register.store'), validRegistrationPayload([
        'birthdate' => now()->subYears(17)->format('Y-m-d'),
        'age' => 18,
    ]))->assertSessionHasErrors('age');

    $this->assertGuest();
});

test('registration rejects passwords containing personal information', function () {
    $this->post(route('register.store'), validRegistrationPayload([
        'password' => 'John12345!',
        'password_confirmation' => 'John12345!',
    ]))->assertSessionHasErrors('password');

    $this->assertGuest();
});
