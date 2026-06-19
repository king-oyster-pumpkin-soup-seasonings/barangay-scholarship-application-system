<?php

namespace App\Livewire\Pages;

use App\Models\Announcement; // ← add this import
use App\Models\Application;
use App\Models\ResidenceVerification;
use App\Models\Scholarship;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $user = Auth::user();

        $verification = ResidenceVerification::where('user_id', $user->id)
            ->latest()
            ->first();

        $applications = Application::with('scholarship')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $scholarships = collect();

        if ($verification?->status === 'verified') {
            $appliedIds = $applications->pluck('scholarship_id');

            $scholarships = Scholarship::where('status', 'available')
                ->whereNotIn('id', $appliedIds)
                ->get();
        }

        $announcements = Announcement::with('creator') // ← add this
            ->latest()
            ->get();

        return view('livewire.pages.dashboard', [
            'verification'  => $verification,
            'applications'  => $applications,
            'scholarships'  => $scholarships,
            'announcements' => $announcements, // ← and pass it to the view
        ]);
    }
}
