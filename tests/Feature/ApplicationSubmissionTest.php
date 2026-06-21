<?php

use App\Livewire\Pages\Applications\Create as CreateApplicationPage;
use App\Models\Application;
use App\Models\Scholarship;
use App\Models\User;
use Livewire\Livewire;

test('resident can submit one application for a scholarship', function () {
    $user = User::factory()->create([
        'verification_status' => 'verified',
    ]);
    $scholarship = Scholarship::create([
        'title' => 'Academic Support Grant',
        'description' => 'A scholarship with no extra application requirements.',
        'allowance' => 5000,
        'slots' => 5,
        'deadline' => now()->addMonth(),
        'status' => 'available',
        'created_by' => $user->id,
    ]);

    $this->actingAs($user);

    Livewire::test(CreateApplicationPage::class, ['scholarship' => $scholarship])
        ->call('submit')
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard'));

    expect(Application::where('user_id', $user->id)
        ->where('scholarship_id', $scholarship->id)
        ->count())->toBe(1);
});

test('resident cannot start a duplicate scholarship application', function () {
    $user = User::factory()->create([
        'verification_status' => 'verified',
    ]);
    $scholarship = Scholarship::create([
        'title' => 'Academic Support Grant',
        'description' => 'A scholarship with no extra application requirements.',
        'allowance' => 5000,
        'slots' => 5,
        'deadline' => now()->addMonth(),
        'status' => 'available',
        'created_by' => $user->id,
    ]);

    Application::create([
        'user_id' => $user->id,
        'scholarship_id' => $scholarship->id,
        'status' => 'pending',
        'submitted_at' => now(),
    ]);

    $this->actingAs($user);

    Livewire::test(CreateApplicationPage::class, ['scholarship' => $scholarship])
        ->assertRedirect(route('scholarships.show', $scholarship));
});
