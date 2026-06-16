<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ResidenceVerification;

class Dashboard extends Component
{
    public function render()
    {
        $pendingVerifications = ResidenceVerification::where('status', 'pending')->count();

        return view('livewire.admin.dashboard', [
            'pendingVerifications' => $pendingVerifications,
        ]);
    }
}
