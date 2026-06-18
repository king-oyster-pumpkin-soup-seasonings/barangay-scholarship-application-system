<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Application;
use App\Models\ResidenceVerification;
use App\Models\Scholarship;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function render()
    {
        $user = Auth::user();

        // Grab this user's latest verification record (null if never submitted)
        $verification = ResidenceVerification::where('user_id', $user->id)
            ->latest()
            ->first();

        // All scholarship applications this user has ever submitted
        $applications = Application::with('scholarship')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        // Only show available scholarships if the user is verified
        // and hasn't applied to them yet
        $scholarships = collect(); // empty collection by default

        if ($verification?->status === 'verified') {
            $appliedIds = $applications->pluck('scholarship_id');

            $scholarships = Scholarship::where('status', 'available')
                ->whereNotIn('id', $appliedIds)
                ->get();
        }

        return view('livewire.pages.dashboard', [
            'verification'  => $verification,
            'applications'  => $applications,
            'scholarships'  => $scholarships,
        ]);
    }
}
