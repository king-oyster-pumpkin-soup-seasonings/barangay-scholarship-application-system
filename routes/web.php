<?php
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Verifications;
use App\Livewire\Admin\Applications;
use App\Livewire\Admin\Announcements;

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
});

require __DIR__ . '/settings.php';
