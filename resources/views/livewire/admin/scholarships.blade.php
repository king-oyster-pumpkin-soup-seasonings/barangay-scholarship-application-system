<div class="min-h-screen bg-[#E5E8EF] dark:bg-[#1B1A1C]">
    <div class="max-w-7xl mx-auto p-8">
        <!-- Enhanced Page Header & Interactive Breadcrumbs -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">
            <div>
                <div class="text-sm font-medium mb-2 flex items-center space-x-1.5">
                    <a href="{{ route('admin.dashboard') }}" class="text-[#1D74E3] hover:underline font-semibold transition duration-150">Admin Dashboard</a>
                    <span class="text-[#AA9A98]">&rarr;</span>
                    <span class="text-[#AA9A98]">Manage Scholarships</span>
                </div>
                <h1 class="text-3xl font-extrabold text-[#33333B] dark:text-white tracking-tight">Manage Scholarships</h1>
                <p class="text-[#AA9A98] dark:text-zinc-400 text-sm mt-1.5 font-medium">Create, edit, and publish scholarship programs for residents.</p>
            </div>
            <button wire:click="openCreateModal" class="mt-4 md:mt-0 bg-[#1D74E3] hover:bg-[#155ab2] text-white px-5 py-2.5 rounded-lg font-semibold text-sm transition shadow-sm inline-flex items-center space-x-2">
                <span>+ Create Scholarship</span>
            </button>
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

        <!-- Scholarships List Table -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#33333B] text-white">
                        <th class="p-4 font-semibold text-sm uppercase tracking-wider">Scholarship Details</th>
                        <th class="p-4 font-semibold text-sm uppercase tracking-wider">Allowance</th>
                        <th class="p-4 font-semibold text-sm uppercase tracking-wider">Slots Available</th>
                        <th class="p-4 font-semibold text-sm uppercase tracking-wider">Deadline</th>
                        <th class="p-4 font-semibold text-sm uppercase tracking-wider">Status</th>
                        <th class="p-4 font-semibold text-sm uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($scholarships as $scholarship)
                        <tr class="border-b border-gray-100 dark:border-zinc-700 hover:bg-[#E5E8EF]/50 dark:hover:bg-zinc-700/50 transition duration-150">
                            <td class="p-4">
                                <span class="font-semibold text-[#1B1A1C] dark:text-white text-sm block">{{ $scholarship->title }}</span>
                                <span class="text-xs text-[#AA9A98] dark:text-zinc-400 line-clamp-1 mt-0.5">{{ Str::limit($scholarship->description, 80) }}</span>
                                <span class="text-[10px] text-gray-400 dark:text-zinc-500 block mt-1">Created by {{ $scholarship->creator?->name ?? 'System' }} • {{ $scholarship->applications_count }} applicant(s)</span>
                            </td>
                            <td class="p-4 text-sm font-semibold text-[#1B1A1C] dark:text-zinc-200">
                                ₱{{ number_format($scholarship->allowance, 2) }}
                            </td>
                            <td class="p-4 text-sm text-gray-600 dark:text-zinc-300">
                                {{ $scholarship->slots }}
                            </td>
                            <td class="p-4 text-xs text-[#AA9A98] dark:text-zinc-400">
                                {{ $scholarship->deadline ? $scholarship->deadline->format('M d, Y') : 'N/A' }}
                            </td>
                            <td class="p-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold 
                                    @if($scholarship->status === 'available') bg-green-50 text-green-700 dark:bg-green-950/30 dark:text-green-400 
                                    @elseif($scholarship->status === 'full') bg-yellow-50 text-yellow-700 dark:bg-yellow-950/30 dark:text-yellow-400 
                                    @else bg-red-50 text-red-700 dark:bg-red-950/30 dark:text-red-400 @endif">
                                    {{ ucfirst($scholarship->status) }}
                                </span>
                            </td>
                            <td class="p-4 text-right whitespace-nowrap space-x-4 text-xs font-semibold">
                                <button wire:click="openEditModal({{ $scholarship->id }})" class="text-[#1D74E3] hover:underline transition">
                                    Edit
                                </button>
                                <button wire:click="delete({{ $scholarship->id }})" wire:confirm="Are you sure you want to delete this scholarship? This will cascade and delete all submitted applications and requirement records." class="text-red-500 hover:text-red-700 transition">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center text-gray-500">
                                <div class="text-lg font-medium text-[#33333B] dark:text-white">No scholarships found!</div>
                                <div class="text-sm text-[#AA9A98] dark:text-zinc-400 mt-1">Create your first scholarship program to enable resident applications.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Create/Edit Modal -->
        @if ($showFormModal)
            <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-xl max-w-lg w-full">
                    <div class="p-6 border-b border-gray-100 dark:border-zinc-700 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-[#33333B] dark:text-white">
                            {{ $isEditing ? 'Edit Scholarship Program' : 'Create Scholarship Program' }}
                        </h3>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 text-2xl font-bold focus:outline-none">&times;</button>
                    </div>

                    <form wire:submit.prevent="save">
                        <div class="p-6 space-y-4 max-h-[60vh] overflow-y-auto">
                            <!-- Title Input -->
                            <div>
                                <label class="block text-xs font-semibold text-[#33333B] dark:text-zinc-300 mb-2 uppercase tracking-wider">Title</label>
                                <input type="text" wire:model="title" class="w-full border border-gray-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white rounded-lg p-3 text-sm focus:ring-[#1D74E3] focus:border-[#1D74E3] focus:outline-none" placeholder="e.g., Barangay Tertiary Education Subsidy">
                                @error('title')
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Description Input -->
                            <div>
                                <label class="block text-xs font-semibold text-[#33333B] dark:text-zinc-300 mb-2 uppercase tracking-wider">Description</label>
                                <textarea wire:model="description" rows="4" class="w-full border border-gray-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white rounded-lg p-3 text-sm focus:ring-[#1D74E3] focus:border-[#1D74E3] focus:outline-none" placeholder="Provide a detailed description of the program and general eligibility criteria..."></textarea>
                                @error('description')
                                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Allowance Input -->
                                <div>
                                    <label class="block text-xs font-semibold text-[#33333B] dark:text-zinc-300 mb-2 uppercase tracking-wider">Allowance (₱)</label>
                                    <input type="number" step="0.01" wire:model="allowance" class="w-full border border-gray-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white rounded-lg p-3 text-sm focus:ring-[#1D74E3] focus:border-[#1D74E3] focus:outline-none" placeholder="e.g., 15000">
                                    @error('allowance')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Slots Input -->
                                <div>
                                    <label class="block text-xs font-semibold text-[#33333B] dark:text-zinc-300 mb-2 uppercase tracking-wider">Available Slots</label>
                                    <input type="number" wire:model="slotsCount" class="w-full border border-gray-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white rounded-lg p-3 text-sm focus:ring-[#1D74E3] focus:border-[#1D74E3] focus:outline-none" placeholder="e.g., 20">
                                    @error('slotsCount')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Deadline Input -->
                                <div>
                                    <label class="block text-xs font-semibold text-[#33333B] dark:text-zinc-300 mb-2 uppercase tracking-wider">Deadline</label>
                                    <input type="date" wire:model="deadline" class="w-full border border-gray-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white rounded-lg p-3 text-sm focus:ring-[#1D74E3] focus:border-[#1D74E3] focus:outline-none">
                                    @error('deadline')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Status Dropdown -->
                                <div>
                                    <label class="block text-xs font-semibold text-[#33333B] dark:text-zinc-300 mb-2 uppercase tracking-wider">Status</label>
                                    <select wire:model="status" class="w-full border border-gray-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white rounded-lg p-3 text-sm focus:ring-[#1D74E3] focus:border-[#1D74E3] focus:outline-none">
                                        <option value="available">Available</option>
                                        <option value="unavailable">Unavailable</option>
                                        <option value="full">Full</option>
                                    </select>
                                    @error('status')
                                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-100 dark:border-zinc-700 flex justify-end gap-2 bg-gray-50/50 dark:bg-zinc-900/50 rounded-b-lg">
                            <button type="button" wire:click="closeModal" class="px-4 py-2 border border-gray-200 dark:border-zinc-700 text-sm font-semibold text-gray-500 dark:text-zinc-400 hover:text-gray-700 dark:hover:text-white rounded-lg transition">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 text-sm font-semibold bg-[#1D74E3] hover:bg-[#155ab2] text-white rounded-lg shadow-sm transition">
                                {{ $isEditing ? 'Save Changes' : 'Create Scholarship' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
