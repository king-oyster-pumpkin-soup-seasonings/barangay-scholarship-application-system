<?php

namespace App\Livewire\Superadmin;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class AdminManagement extends Component
{
    public bool $showCreateModal = false;

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Open the create admin modal
     */
    public function openCreateModal(): void
    {
        $this->reset(['name', 'email', 'password', 'password_confirmation']);
        $this->resetValidation();
        $this->showCreateModal = true;
    }

    /**
     * Close the create admin modal
     */
    public function closeCreateModal(): void
    {
        $this->showCreateModal = false;
        $this->reset(['name', 'email', 'password', 'password_confirmation']);
        $this->resetValidation();
    }

    /**
     * Create a new admin account
     */
    public function createAdmin(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', Password::defaults(), 'confirmed'],
        ]);

        $admin = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'admin',
            'verification_status' => 'verified',
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        session()->flash('success', "Admin account for {$admin->name} has been successfully created.");

        $this->closeCreateModal();
    }

    public function render(): View
    {
        // Fetch all users with 'admin' role to list on the superadmin management view
        $admins = User::where('role', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.superadmin.admin-management', [
            'admins' => $admins,
        ]);
    }
}
