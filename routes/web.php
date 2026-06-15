<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

// Resident-only routes (must be logged in, role=user, AND residency verified)
Route::middleware(['auth', 'role:user', 'verified.resident'])->group(function () {
    Route::get('/scholarships', /* ... */);
    Route::get('/scholarships/{scholarship}', /* ... */);
});

// Admin panel routes (must be logged in, role=admin or superadmin, AND admin approved)
Route::middleware(['auth', 'role:admin,superadmin', 'approved.admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', /* ... */);
});

// Superadmin-only routes
Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->group(function () {
    Route::get('/admins', /* ... */);
});

require __DIR__ . '/settings.php';
