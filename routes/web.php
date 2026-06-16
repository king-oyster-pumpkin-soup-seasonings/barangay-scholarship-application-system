<?php

use App\Livewire\Admin\AdminApplications;
use App\Livewire\Admin\Announcements;
use App\Livewire\Admin\Applications;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Verifications;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

// Admin panel routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/verifications', Verifications::class)->name('admin.verifications');
    Route::get('/applications', Applications::class)->name('admin.applications');
    Route::get('/announcements', Announcements::class)->name('admin.announcements');
    Route::get('/admin-applications', AdminApplications::class)->name('superadmin.admins');
});

require __DIR__.'/settings.php';
