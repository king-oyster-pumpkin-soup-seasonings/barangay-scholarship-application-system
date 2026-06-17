<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Scholarship;
use App\Models\Announcement;

class Home extends Component
{
    public function render()
    {
        $announcements = Announcement::latest()->take(2)->get();
        $scholarships = Scholarship::all();

        return view('pages.home', [
            'announcements' => $announcements,
            'scholarships' => $scholarships,
        ])->layout('layouts.public', ['title' => 'Home']);
    }
}
