<div class="min-h-screen bg-[#E5E8EF] p-8">
    <!-- Enhanced Page Header & Interactive Breadcrumbs -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">
        <div>
            <div class="text-sm font-medium mb-2 flex items-center space-x-1.5">
                <a href="{{ route('admin.dashboard') }}" class="text-[#1D74E3] hover:underline font-semibold transition duration-150">Dashboard</a>
                <span class="text-[#AA9A98]">&rarr;</span>
                <span class="text-[#AA9A98]">Announcements</span>
            </div>
            <h1 class="text-3xl font-extrabold text-[#33333B] tracking-tight">Manage Announcements</h1>
            <p class="text-[#AA9A98] text-sm mt-1.5 font-medium">Create, edit, and publish important updates or notices for applicants.</p>
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

    <!-- Announcements List Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-[#33333B]">
                    <th class="p-4 font-semibold text-sm">Announcement Title</th>
                    <th class="p-4 font-semibold text-sm">Author</th>
                    <th class="p-4 font-semibold text-sm">Date Published</th>
                    <th class="p-4 font-semibold text-sm text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($announcements as $announcement)
                    <tr class="border-b border-gray-100 hover:bg-gray-50/50 transition duration-150">
                        <td class="p-4">
                            <span class="font-semibold text-[#1B1A1C] text-sm block">{{ $announcement->title }}</span>
                            <span class="text-xs text-[#AA9A98] line-clamp-1 mt-0.5">{{ Str::limit($announcement->body, 80) }}</span>
                        </td>
                        <td class="p-4 text-sm text-gray-600">
                            {{ $announcement->creator?->name ?? 'Admin' }}
                        </td>
                        <td class="p-4 text-xs text-[#AA9A98]">
                            {{ $announcement->created_at->format('M d, Y h:i A') }}
                        </td>
                        <td class="p-4 text-right whitespace-nowrap space-x-4 text-xs font-semibold">
                            <button wire:click="openEditModal({{ $announcement->id }})" class="text-[#1D74E3] hover:underline transition">
                                Edit
                            </button>
                            <button wire:click="delete({{ $announcement->id }})" wire:confirm="Are you sure you want to delete this announcement?" class="text-red-500 hover:text-red-700 transition">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-12 text-center text-gray-500">
                            <div class="text-lg font-medium text-[#33333B]">No announcements found!</div>
                            <div class="text-sm text-[#AA9A98] mt-1">Create your first announcement to notify users about scholarships and updates.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
