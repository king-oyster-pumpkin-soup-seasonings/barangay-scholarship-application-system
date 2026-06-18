<?php

namespace App\Livewire\Pages;

use App\Models\Announcement;
use App\Models\Scholarship;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $announcements = Announcement::latest()->take(2)->get();
        $scholarships = Scholarship::where('status', 'available')->get();

        return view('pages.home', [
            'announcements' => $announcements,
            'scholarships' => $scholarships,
        ])->layout('layouts.public', ['title' => 'Home']);
    }
}
