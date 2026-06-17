<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Verification;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\Applications\Create;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');

    // Route::get('/verification', Verification::class)->name('verification');
});

// Resident-only routes (must be logged in, role=user, AND residency verified)
Route::middleware(['auth', 'role:user', 'verified.resident'])->group(function () {
    Route::get('/scholarships', /* ... */);
    Route::get('/scholarships/{scholarship}', /* ... */);
    Route::get('/scholarships/{scholarship}/apply', Create::class)->name('applications.create');
});

// Admin panel routes (must be logged in, role=admin or superadmin, AND admin approved)
Route::middleware(['auth', 'role:admin,superadmin', 'approved.admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', /* ... */);
});

// Superadmin-only routes
Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->group(function () {
    Route::get('/admins', /* ... */);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/verification', Verification::class)->name('verification');
});

require __DIR__ . '/settings.php';
