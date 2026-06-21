<?php

namespace App\Livewire\Admin;

use App\Models\Application;
use App\Models\ResidenceVerification;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Dashboard extends Component
{
    public function render(): View
    {
        $pendingVerifications = ResidenceVerification::where('status', 'pending')->count();
        $pendingApplications = Application::where('status', 'pending')->count();
        $totalScholars = Application::where('status', 'approved')->count();
        $totalResidents = User::where('role', 'user')->count();

        // appear at the top instead of staying in their original creation order
        $recentApplications = Application::with(['user', 'scholarship'])
            ->latest('updated_at')
            ->take(15)
            ->get();

        return view('livewire.admin.dashboard', [
            'pendingVerifications' => $pendingVerifications,
            'pendingApplications'  => $pendingApplications,
            'totalScholars'        => $totalScholars,
            'totalResidents'       => $totalResidents,
            'recentApplications'   => $recentApplications,
        ]);
    }
}
