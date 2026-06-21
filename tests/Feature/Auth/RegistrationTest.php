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
        'address_street' => '123 Barangay St.',
        'address_city' => 'Quezon City',
        'address_province_state' => 'Metro Manila',
        'address_country' => 'PH',
        'address_postal_code' => '1100',
        'password' => 'password',
        'password_confirmation' => 'password',
        ...$overrides,
    ];
}

test('registration screen can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertOk();
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
    expect($user->address_city)->toBe('Quezon City');
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

test('registration validates postal code for selected country', function () {
    $this->post(route('register.store'), validRegistrationPayload([
        'address_country' => 'PH',
        'address_postal_code' => '90210',
    ]))->assertSessionHasErrors('address_postal_code');

    $this->assertGuest();
});
