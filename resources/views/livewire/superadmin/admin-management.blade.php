<div class="min-h-screen bg-[#E5E8EF] dark:bg-[#1B1A1C]">
    <div class="max-w-7xl mx-auto p-8">
        <!-- Enhanced Page Header & Interactive Breadcrumbs -->
        <div class="mb-10 flex justify-between items-end">
        <div>
            <div class="text-sm font-medium mb-2 flex items-center space-x-1.5">
                <a href="{{ route('admin.dashboard') }}" class="text-[#1D74E3] hover:underline font-semibold transition duration-150">Admin Dashboard</a>
                <span class="text-[#AA9A98]">&rarr;</span>
                <span class="text-[#AA9A98]">Admin Management</span>
            </div>
            <h1 class="text-3xl font-extrabold text-[#33333B] dark:text-white tracking-tight">Admin Accounts</h1>
            <p class="text-[#AA9A98] dark:text-zinc-400 text-sm mt-1.5 font-medium">Manage and create administrator accounts for the system.</p>
        </div>
        <div>
            <flux:button variant="primary" wire:click="openCreateModal" icon="user-plus" class="bg-[#12325E] hover:bg-[#12325E]/90 text-white font-medium py-2 px-4 rounded-lg shadow-sm">
                Create Admin Account
            </flux:button>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session()->has('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <span class="font-semibold">Success:</span>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif
    @if (session()->has('info'))
        <div class="mb-6 bg-blue-50 border-l-4 border-[#1D74E3] text-blue-700 p-4 rounded shadow-sm flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <span class="font-semibold">Notification:</span>
                <span>{{ session('info') }}</span>
            </div>
        </div>
    @endif

    <!-- Admin Registration Table -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-md overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#33333B] text-white">
                    <th class="p-4 font-semibold text-sm uppercase tracking-wider">Admin Name</th>
                    <th class="p-4 font-semibold text-sm uppercase tracking-wider">Email</th>
                    <th class="p-4 font-semibold text-sm uppercase tracking-wider">Date Added</th>
                    <th class="p-4 font-semibold text-sm uppercase tracking-wider text-right w-32">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $admin)
                    <tr class="border-b border-gray-100 dark:border-zinc-700 hover:bg-gray-50/50 dark:hover:bg-zinc-700/50 transition duration-150">
                        <td class="p-4">
                            <span class="font-semibold text-[#1B1A1C] dark:text-white text-sm block">{{ $admin->name }}</span>
                            @if ($admin->phone)
                                <span class="text-xs text-[#AA9A98] dark:text-zinc-400">{{ $admin->phone }}</span>
                            @endif
                        </td>
                        <td class="p-4 text-sm text-gray-600 dark:text-zinc-300">
                            {{ $admin->email }}
                        </td>
                        <td class="p-4 text-xs text-[#AA9A98] dark:text-zinc-400">
                            {{ $admin->created_at->format('M d, Y h:i A') }}
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <flux:button variant="primary" size="sm" icon="pencil" wire:click="openEditModal({{ $admin->id }})" class="!px-2.5 !py-1" aria-label="Edit {{ $admin->name }}" />
                                @if(auth()->id() !== $admin->id)
                                    <flux:button variant="danger" size="sm" icon="trash" wire:click="openDeleteModal({{ $admin->id }})" class="!px-2.5 !py-1" aria-label="Delete {{ $admin->name }}" />
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-12 text-center text-gray-500 dark:text-zinc-400">
                            <div class="text-lg font-medium text-[#33333B] dark:text-white">No admin accounts found!</div>
                            <div class="text-sm text-[#AA9A98] dark:text-zinc-400 mt-1">There are currently no administrators in the system.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Create Admin Modal -->
    <flux:modal wire:model="showCreateModal" class="max-w-md">
        <div class="space-y-6">
            <div>
                <h2 class="text-lg font-bold text-[#33333B] dark:text-white">Create Admin Account</h2>
                <p class="text-sm text-[#AA9A98] dark:text-zinc-400 mt-1">Fill in the details below to provision a new administrator account.</p>
            </div>

            <form wire:submit="createAdmin" class="space-y-4">
                <flux:input wire:model="name" label="Full Name" required placeholder="Jane Doe" />
                
                <flux:input wire:model="email" type="email" label="Email Address" required placeholder="jane@example.com" />
                
                <flux:input wire:model="password" type="password" label="Password" required viewable placeholder="Minimum 8 characters" />
                
                <flux:input wire:model="password_confirmation" type="password" label="Confirm Password" required viewable placeholder="Re-enter password" />

                <div class="flex gap-2 pt-4">
                    <flux:spacer />
                    <flux:button wire:click="closeCreateModal" variant="ghost">Cancel</flux:button>
                    <flux:button type="submit" variant="primary" class="bg-[#12325E] hover:bg-[#12325E]/90 text-white">Create Account</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Edit Admin Modal -->
    <flux:modal wire:model="showEditModal" class="max-w-md">
        <div class="space-y-6">
            <div>
                <h2 class="text-lg font-bold text-[#33333B] dark:text-white">Edit Admin Account</h2>
                <p class="text-sm text-[#AA9A98] dark:text-zinc-400 mt-1">Update the details of the administrator account.</p>
            </div>

            <form wire:submit="updateAdmin" class="space-y-4">
                <flux:input wire:model="editName" label="Full Name" required placeholder="Jane Doe" />
                
                <flux:input wire:model="editEmail" type="email" label="Email Address" required placeholder="jane@example.com" />
                
                <flux:input wire:model="editPhone" label="Contact Number" placeholder="+1234567890" />

                <flux:checkbox wire:model.live="editResetPassword" label="Reset Password" />

                @if($editResetPassword)
                    <flux:input wire:model="editPassword" type="password" label="New Password" required viewable placeholder="Minimum 8 characters" />
                    
                    <flux:input wire:model="editPasswordConfirmation" type="password" label="Confirm New Password" required viewable placeholder="Re-enter password" />
                @endif

                <div class="flex gap-2 pt-4">
                    <flux:spacer />
                    <flux:button wire:click="closeEditModal" variant="ghost">Cancel</flux:button>
                    <flux:button type="submit" variant="primary" class="bg-[#1D74E3] hover:bg-[#1D74E3]/90 text-white">Save Changes</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Secure Delete Modal -->
    <flux:modal wire:model="showDeleteModal" class="max-w-md">
        <div class="space-y-6">
            <div>
                <h2 class="text-lg font-bold text-red-600 dark:text-red-400 flex items-center gap-2">
                    <flux:icon.trash class="size-5" />
                    Delete Administrator Account
                </h2>
                <div class="mt-4 p-4 bg-red-50 dark:bg-red-950/30 rounded-lg border border-red-100 dark:border-red-900/50">
                    <p class="text-sm text-red-800 dark:text-red-300 font-medium">You are about to permanently remove this administrator account.</p>
                    @if($adminToDelete)
                        <div class="mt-3">
                            <p class="text-sm font-bold text-zinc-900 dark:text-zinc-100">Admin:</p>
                            <p class="text-sm text-zinc-700 dark:text-zinc-300">{{ $adminToDelete->name }}</p>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $adminToDelete->email }}</p>
                        </div>
                    @endif
                </div>
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mt-4 font-semibold">This action cannot be undone.</p>
                <p class="text-sm text-zinc-600 dark:text-zinc-400 mt-1">To continue, please enter your Super Admin password.</p>
            </div>

            <form wire:submit="deleteAdmin" class="space-y-4">
                <flux:input wire:model="superAdminPassword" type="password" label="Super Admin Password" required viewable placeholder="Enter your password" />

                <div class="flex gap-2 pt-4">
                    <flux:spacer />
                    <flux:button wire:click="closeDeleteModal" variant="ghost">Cancel</flux:button>
                    <flux:button type="submit" variant="danger">Confirm Delete</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
    </div>
</div>
