<?php

namespace App\Livewire\Superadmin;

use App\Models\AdminAuditLog;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class AdminManagement extends Component
{
    // Create Properties
    public bool $showCreateModal = false;

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    // Edit Properties
    public bool $showEditModal = false;

    public ?int $editAdminId = null;

    public string $editName = '';

    public string $editEmail = '';

    public string $editPhone = '';

    public bool $editResetPassword = false;

    public string $editPassword = '';

    public string $editPasswordConfirmation = '';

    // Delete Properties
    public bool $showDeleteModal = false;

    public ?int $deleteAdminId = null;

    public ?User $adminToDelete = null;

    public string $superAdminPassword = '';

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

    /**
     * Open the edit admin modal
     */
    public function openEditModal(int $adminId): void
    {
        $admin = User::findOrFail($adminId);
        $this->editAdminId = $admin->id;
        $this->editName = $admin->name;
        $this->editEmail = $admin->email;
        $this->editPhone = $admin->phone ?? '';

        $this->reset(['editResetPassword', 'editPassword', 'editPasswordConfirmation']);
        $this->resetValidation();
        $this->showEditModal = true;
    }

    /**
     * Close the edit admin modal
     */
    public function closeEditModal(): void
    {
        $this->showEditModal = false;
        $this->reset(['editAdminId', 'editName', 'editEmail', 'editPhone', 'editResetPassword', 'editPassword', 'editPasswordConfirmation']);
        $this->resetValidation();
    }

    /**
     * Update an admin account
     */
    public function updateAdmin(): void
    {
        $rules = [
            'editName' => ['required', 'string', 'max:255'],
            'editEmail' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->editAdminId)],
            'editPhone' => ['nullable', 'string', 'max:255'],
        ];

        if ($this->editResetPassword) {
            $rules['editPassword'] = ['required', 'string', Password::defaults(), 'same:editPasswordConfirmation'];
        }

        $this->validate($rules);

        $admin = User::findOrFail($this->editAdminId);

        $admin->name = $this->editName;
        $admin->email = $this->editEmail;
        $admin->phone = $this->editPhone;

        if ($this->editResetPassword) {
            $admin->password = Hash::make($this->editPassword);
        }

        $admin->save();

        AdminAuditLog::create([
            'super_admin_id' => auth()->id(),
            'super_admin_name' => auth()->user()->name,
            'action_type' => 'Edited',
            'target_admin_name' => $admin->name,
            'target_admin_email' => $admin->email,
            'ip_address' => request()->ip(),
        ]);

        session()->flash('success', "Admin account for {$admin->name} has been successfully updated.");

        $this->closeEditModal();
    }

    /**
     * Open the delete admin modal
     */
    public function openDeleteModal(int $adminId): void
    {
        if ($adminId === auth()->id()) {
            session()->flash('info', 'You cannot delete your own Super Admin account.');

            return;
        }

        $this->adminToDelete = User::findOrFail($adminId);
        $this->deleteAdminId = $adminId;
        $this->reset(['superAdminPassword']);
        $this->resetValidation();
        $this->showDeleteModal = true;
    }

    /**
     * Close the delete admin modal
     */
    public function closeDeleteModal(): void
    {
        $this->showDeleteModal = false;
        $this->reset(['deleteAdminId', 'adminToDelete', 'superAdminPassword']);
        $this->resetValidation();
    }

    /**
     * Securely delete an admin account
     */
    public function deleteAdmin(): void
    {
        $this->validate([
            'superAdminPassword' => ['required', 'string'],
        ]);

        if (! Hash::check($this->superAdminPassword, auth()->user()->password)) {
            $this->addError('superAdminPassword', 'Incorrect password. Please try again.');

            return;
        }

        if ($this->deleteAdminId === auth()->id()) {
            session()->flash('info', 'You cannot delete your own Super Admin account.');
            $this->closeDeleteModal();

            return;
        }

        $admin = User::findOrFail($this->deleteAdminId);

        AdminAuditLog::create([
            'super_admin_id' => auth()->id(),
            'super_admin_name' => auth()->user()->name,
            'action_type' => 'Deleted',
            'target_admin_name' => $admin->name,
            'target_admin_email' => $admin->email,
            'ip_address' => request()->ip(),
        ]);

        $adminName = $admin->name;
        $admin->delete();

        session()->flash('success', "Admin account for {$adminName} has been successfully deleted.");

        $this->closeDeleteModal();
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
