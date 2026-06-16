<div class="min-h-screen bg-[#E5E8EF] p-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div>
            <div class="text-sm text-[#AA9A98] mb-1">
                <a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a> &rarr; Announcements
            </div>
            <h1 class="text-3xl font-bold text-[#33333B]">System Announcements</h1>
            <p class="text-[#AA9A98] mt-1">Manage announcements shown to residents on their dashboards.</p>
        </div>
        <button wire:click="openCreateModal" class="mt-4 md:mt-0 bg-[#1D74E3] hover:bg-[#155ab2] text-white px-5 py-2.5 rounded-lg font-semibold text-sm transition shadow-sm inline-flex items-center space-x-2">
            <span>+ Create Announcement</span>
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

    <!-- Announcements Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($announcements as $announcement)
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 flex flex-col justify-between overflow-hidden hover:shadow-md transition">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <span class="text-xs text-[#AA9A98] font-semibold uppercase tracking-wider">Posted by {{ $announcement->creator?->name ?? 'Admin' }}</span>
                        <span class="text-xs text-[#AA9A98]">{{ $announcement->created_at->format('M d, Y') }}</span>
                    </div>
                    <h2 class="text-xl font-bold text-[#33333B] mb-3">{{ $announcement->title }}</h2>
                    <p class="text-[#1B1A1C] text-sm whitespace-pre-line leading-relaxed">{{ $announcement->body }}</p>
                </div>
                
                <div class="bg-gray-50/50 border-t border-gray-100 px-6 py-3 flex justify-end space-x-3 text-xs font-semibold">
                    <button wire:click="openEditModal({{ $announcement->id }})" class="text-[#1D74E3] hover:text-[#155ab2] transition flex items-center space-x-1">
                        <span>✏️ Edit</span>
                    </button>
                    <button wire:click="delete({{ $announcement->id }})" wire:confirm="Are you sure you want to delete this announcement?" class="text-red-500 hover:text-red-700 transition flex items-center space-x-1">
                        <span>🗑️ Delete</span>
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-lg shadow-md p-12 text-center text-gray-500">
                <div class="text-lg font-medium text-[#33333B]">No announcements found!</div>
                <div class="text-sm text-[#AA9A98] mt-1">Create your first announcement to notify users about scholarships and updates.</div>
            </div>
        @endforelse
    </div>

    <!-- Create/Edit Modal -->
    @if ($showFormModal)
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-[#33333B]">
                        {{ $isEditing ? 'Edit Announcement' : 'Create Announcement' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 text-2xl font-bold focus:outline-none">&times;</button>
                </div>

                <form wire:submit.prevent="save">
                    <div class="p-6 space-y-4">
                        <!-- Title Input -->
                        <div>
                            <label class="block text-xs font-semibold text-[#33333B] mb-2 uppercase tracking-wider">Title</label>
                            <input type="text" wire:model="title" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:ring-[#1D74E3] focus:border-[#1D74E3] focus:outline-none" placeholder="e.g., Application Deadline Extended">
                            @error('title')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Body Input -->
                        <div>
                            <label class="block text-xs font-semibold text-[#33333B] mb-2 uppercase tracking-wider">Announcement Content</label>
                            <textarea wire:model="body" rows="6" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:ring-[#1D74E3] focus:border-[#1D74E3] focus:outline-none" placeholder="Enter announcement details here..."></textarea>
                            @error('body')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="p-6 border-t border-gray-100 flex justify-end gap-2 bg-gray-50/50 rounded-b-lg">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 border border-gray-200 text-sm font-semibold text-gray-500 hover:text-gray-700 rounded-lg transition">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-semibold bg-[#1D74E3] hover:bg-[#155ab2] text-white rounded-lg shadow-sm transition">
                            {{ $isEditing ? 'Save Changes' : 'Post Announcement' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
