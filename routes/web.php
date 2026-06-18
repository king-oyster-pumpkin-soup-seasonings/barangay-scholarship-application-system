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
Route::get('/scholarships/{scholarship}', Show::class)->name('scholarships.show');
Route::get('/scholarships', Index::class)->name('scholarships.index');

// Authenticated pages
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__ . '/settings.php';

// Practice routes
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

    $scholarships = [
        [
            'id' => 1,
            'title' => 'Barangay Academic Excellence Grant',
            'allowance' => 5000.00,
            'slots' => 10,
            'deadline' => '2026-08-31',
            'status' => 'available',
        ],
        [
            'id' => 2,
            'title' => 'Barangay Sports Scholarship',
            'allowance' => 3000.00,
            'slots' => 5,
            'deadline' => '2026-07-15',
            'status' => 'full',
        ],
        [
            'id' => 3,
            'title' => 'Out-of-School Youth Support Grant',
            'allowance' => 2000.00,
            'slots' => 8,
            'deadline' => '2026-09-30',
            'status' => 'unavailable',
        ],
    ];

    return view('practice.home', [
        'announcements' => $announcements,
        'scholarships' => $scholarships,
    ]);
});

Route::get('/practice/about', function () {
    return view('practice.about');
});

Route::get('/practice/faqs', function () {
    return view('practice.faqs');
});

Route::get('/practice/contact', function () {
    return view('practice.contact', [
        'submitted' => false,
    ]);
});

Route::get('/practice/scholarships', function () {
    $scholarships = [
        [
            'id' => 1,
            'title' => 'Barangay Academic Excellence Grant',
            'description' => 'For graduating students with high academic standing (GPA 90 and above).',
            'allowance' => 5000.00,
            'slots' => 10,
            'deadline' => '2026-08-31',
            'status' => 'available',
        ],
        [
            'id' => 2,
            'title' => 'Barangay Sports Scholarship',
            'description' => 'For student-athletes representing the barangay in regional competitions.',
            'allowance' => 3000.00,
            'slots' => 5,
            'deadline' => '2026-07-15',
            'status' => 'full',
        ],
        [
            'id' => 3,
            'title' => 'Out-of-School Youth Support Grant',
            'description' => 'For out-of-school youth pursuing alternative learning programs.',
            'allowance' => 2000.00,
            'slots' => 8,
            'deadline' => '2026-09-30',
            'status' => 'unavailable',
        ],
    ];

    return view('practice.scholarships.index', [
        'scholarships' => $scholarships,
        'filter' => 'available',
    ]);
});

Route::get('/practice/scholarships/show', function () {
    $scholarship = [
        'id' => 1,
        'title' => 'Barangay Academic Excellence Grant',
        'description' => 'For graduating students with high academic standing (GPA 90 and above).',
        'allowance' => 5000.00,
        'slots' => 10,
        'deadline' => '2026-08-31',
        'status' => 'available',
    ];

    $requirements = [
        ['category' => 'eligibility', 'field_type' => 'number', 'label' => 'Current GPA', 'is_required' => true],
        ['category' => 'eligibility', 'field_type' => 'select', 'label' => 'Year Level', 'options' => ['Grade 11', 'Grade 12', 'College'], 'is_required' => true],
        ['category' => 'general_document', 'field_type' => 'file', 'label' => 'Valid ID', 'is_required' => true],
        ['category' => 'general_document', 'field_type' => 'file', 'label' => 'Certificate of Indigency', 'is_required' => true],
        ['category' => 'specific_document', 'field_type' => 'file', 'label' => 'Report Card / Transcript', 'is_required' => true],
        ['category' => 'additional_field', 'field_type' => 'textarea', 'label' => 'Why do you deserve this scholarship?', 'is_required' => false],
    ];

    return view('practice.scholarships.show', [
        'scholarship' => $scholarship,
        'requirements' => $requirements,
    ]);
});
