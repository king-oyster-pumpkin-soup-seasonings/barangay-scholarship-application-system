<?php

namespace App\Livewire\Pages;

use App\Models\ResidenceVerification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Verification extends Component
{
    use WithFileUploads;

    // These hold the uploaded files from the form
    public $valid_id;

    public $proof_of_residency;

    public $birth_certificate;

    // This holds the existing verification record (if any)
    public $existingVerification;

    // Runs automatically when the component loads
    public function mount()
    {
        $this->existingVerification = ResidenceVerification::where('user_id', Auth::id())->first();
    }

    public function removeFile(string $field): void
    {
        $this->$field = null;
    }

    // Runs when the user clicks Submit
    public function submit()
    {
        // 1. Validate the uploaded files
        $this->validate([
            'valid_id' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'proof_of_residency' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'birth_certificate' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // 2. Save files to the storage/app/public folder
        $validIdPath = $this->valid_id->store('verifications', 'public');
        $proofPath = $this->proof_of_residency->store('verifications', 'public');
        $birthCertPath = $this->birth_certificate->store('verifications', 'public');

        // 3. Save a new record in the database
        ResidenceVerification::create([
            'user_id' => Auth::id(),
            'valid_id_path' => $validIdPath,
            'proof_of_residency_path' => $proofPath,
            'birth_certificate_path' => $birthCertPath,
            'status' => 'pending',
        ]);

        // 4. Reload the existing verification so the UI updates
        $this->existingVerification = ResidenceVerification::where('user_id', Auth::id())->first();

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.pages.verification');
    }
}
