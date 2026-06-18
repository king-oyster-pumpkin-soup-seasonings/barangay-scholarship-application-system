<div class="min-h-screen bg-[#E5E8EF] py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Enhanced Page Header & Interactive Breadcrumbs -->
    <div class="mb-10 flex justify-between items-end">
        <div>
            <div class="text-sm font-medium mb-2 flex items-center space-x-1.5">
                <a href="{{ route('admin.dashboard') }}" class="text-[#1D74E3] hover:underline font-semibold transition duration-150">Admin Dashboard</a>
                <span class="text-[#AA9A98]">&rarr;</span>
                <span class="text-[#AA9A98]">Admin Management</span>
            </div>
            <h1 class="text-3xl font-extrabold text-[#33333B] tracking-tight">Admin Accounts</h1>
            <p class="text-[#AA9A98] text-sm mt-1.5 font-medium">Manage and create administrator accounts for the system.</p>
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
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-[#33333B]">
                    <th class="p-4 font-semibold text-sm">Admin Name</th>
                    <th class="p-4 font-semibold text-sm">Email</th>
                    <th class="p-4 font-semibold text-sm">Date Added</th>
                    <th class="p-4 font-semibold text-sm">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $admin)
                    <tr class="border-b border-gray-100 hover:bg-gray-50/50 transition duration-150">
                        <td class="p-4">
                            <span class="font-semibold text-[#1B1A1C] text-sm block">{{ $admin->name }}</span>
                            @if ($admin->phone)
                                <span class="text-xs text-[#AA9A98]">{{ $admin->phone }}</span>
                            @endif
                        </td>
                        <td class="p-4 text-sm text-gray-600">
                            {{ $admin->email }}
                        </td>
                        <td class="p-4 text-xs text-[#AA9A98]">
                            {{ $admin->created_at->format('M d, Y h:i A') }}
                        </td>
                        <td class="p-4">
                            @if ($admin->verification_status === 'verified')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-50 text-green-700">
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                    {{ ucfirst($admin->verification_status) }}
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-12 text-center text-gray-500">
                            <div class="text-lg font-medium text-[#33333B]">No admin accounts found!</div>
                            <div class="text-sm text-[#AA9A98] mt-1">There are currently no administrators in the system.</div>
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
                <h2 class="text-lg font-bold text-[#33333B]">Create Admin Account</h2>
                <p class="text-sm text-[#AA9A98] mt-1">Fill in the details below to provision a new administrator account.</p>
            </div>

            <form wire:submit="createAdmin" class="space-y-4">
                <flux:input wire:model="name" label="Full Name" required placeholder="Jane Doe" />
                
                <flux:input wire:model="email" type="email" label="Email Address" required placeholder="jane@example.com" />
                
                <flux:input wire:model="password" type="password" label="Password" required viewable placeholder="Minimum 8 characters" />
                
                <flux:input wire:model="password_confirmation" type="password" label="Confirm Password" required viewable placeholder="Re-enter password" />

                <div class="flex gap-2 pt-4">
                    <flux:spacer />
                    <flux:button wire:click="closeCreateModal" variant="ghost">Cancel</flux:button>
                    <flux:button type="submit" variant="primary" class="bg-[#12325E] hover:bg-[#12325E]/90">Create Account</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
    </div>
</div>
