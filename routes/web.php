<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\About;
use App\Livewire\Pages\Faqs;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Scholarships\Index;
use App\Livewire\Pages\Scholarships\Show;

// Public pages
Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/faqs', Faqs::class)->name('faqs');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/scholarships', Index::class)->name('scholarships.index');
Route::get('/scholarships/{id}', Show::class)->name('scholarships.show');

// Authenticated pages
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__ . '/settings.php';
