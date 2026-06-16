<?php

namespace App\Livewire\Admin;

use App\Models\Application;
use App\Models\ResidenceVerification;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Dashboard extends Component
{
    public function render(): View
    {
        $pendingVerifications = ResidenceVerification::where('status', 'pending')->count();
        $pendingApplications = Application::where('status', 'pending')->count();

        // Scholars are residents with approved applications
        $totalScholars = Application::where('status', 'approved')->count();

        return view('livewire.admin.dashboard', [
            'pendingVerifications' => $pendingVerifications,
            'pendingApplications' => $pendingApplications,
            'totalScholars' => $totalScholars,
        ]);
    }
}
