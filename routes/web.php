<?php

use App\Livewire\Admin\AdminApplications;
use App\Livewire\Admin\Announcements;
use App\Livewire\Admin\Applications;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Verifications;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\About;
use App\Livewire\Pages\Faqs;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Scholarships\Index;
use App\Livewire\Pages\Scholarships\Show;
use App\Livewire\Pages\Verification;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\Applications\Create;

// Public pages
Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/faqs', Faqs::class)->name('faqs');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/scholarships/{scholarship}', Show::class)->name('scholarships.show');
Route::get('/scholarships', Index::class)->name('scholarships.index');

// Authenticated pages
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
});

// Resident-only routes (must be logged in, role=user, AND residency verified)
Route::middleware(['auth', 'role:user', 'verified.resident'])->group(function () {
    Route::get('/scholarships/{scholarship}/apply', Create::class)->name('applications.create');
});

// Admin panel routes (must be logged in, role=admin or superadmin, AND admin approved)
Route::middleware(['auth', 'role:admin,superadmin', 'approved.admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/verifications', Verifications::class)->name('admin.verifications');
    Route::get('/applications', Applications::class)->name('admin.applications');
    Route::get('/announcements', Announcements::class)->name('admin.announcements');
});

// Superadmin-only routes
Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->group(function () {
    Route::get('/admins', AdminApplications::class)->name('superadmin.admins');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/verification', Verification::class)->name('verification');
});

// Practice routes (demo UI only)
require __DIR__ . '/settings.php';

Route::get('/practice/home', function () {
    $announcements = [
        [
            'title' => 'New Scholarship Now Open',
            'body' => 'The Barangay Academic Excellence Grant is now accepting applications until August 31.',
            'created_at' => '2026-06-10',
        ],
        [
            'title' => 'Office Closed for Holiday',
            'body' => 'The Barangay office will be closed on June 19 in observance of the local holiday.',
            'created_at' => '2026-06-12',
        ],
    ];
    return view('practice.home', [
        'announcements' => $announcements,
        'scholarships' => [],
    ]);
});
Route::get('/practice/about', fn() => view('practice.about'));
Route::get('/practice/faqs', fn() => view('practice.faqs'));
Route::get('/practice/contact', function () {
    return view('practice.contact', ['submitted' => false]);
});
Route::get('/practice/scholarships', function () {
    return view('practice.scholarships.index', [
        'scholarships' => [],
        'filter' => 'available',
    ]);
});
Route::get('/practice/scholarships/show', function () {
    return view('practice.scholarships.show', [
        'scholarship' => [],
        'requirements' => [],
    ]);
});
