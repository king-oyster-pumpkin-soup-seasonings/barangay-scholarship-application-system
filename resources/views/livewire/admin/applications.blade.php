<div class="min-h-screen bg-[#E5E8EF] dark:bg-[#1B1A1C]">
    <div class="max-w-7xl mx-auto p-8">
        <!-- Enhanced Page Header & Interactive Breadcrumbs -->
    <div class="mb-10">
        <div class="text-sm font-medium mb-2 flex items-center space-x-1.5">
            <a href="{{ route('admin.dashboard') }}" class="text-[#1D74E3] hover:underline font-semibold transition duration-150">Admin Dashboard</a>
            <span class="text-[#AA9A98]">&rarr;</span>
            <span class="text-[#AA9A98]">Applications</span>
        </div>
        <h1 class="text-3xl font-extrabold text-[#33333B] dark:text-white tracking-tight">Scholarship Applications</h1>
        <p class="text-[#AA9A98] dark:text-zinc-400 text-sm mt-1.5 font-medium">Review and process student scholarship applications.</p>
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

    <!-- Main Table Container -->
    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#33333B] text-white">
                    <th class="p-4 font-semibold text-sm uppercase tracking-wider">Applicant Name</th>
                    <th class="p-4 font-semibold text-sm uppercase tracking-wider">Scholarship</th>
                    <th class="p-4 font-semibold text-sm uppercase tracking-wider">Date Submitted</th>
                    <th class="p-4 font-semibold text-sm uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendingApplications as $application)
                    <tr class="border-b border-gray-100 dark:border-zinc-700 hover:bg-[#E5E8EF]/50 dark:hover:bg-zinc-700/50 transition duration-150">
                        <td class="p-4 font-semibold text-[#1B1A1C] dark:text-white">
                            {{ $application->user->name }}
                            <div class="text-xs text-[#AA9A98] dark:text-zinc-400 font-normal">{{ $application->user->email }}</div>
                        </td>
                        <td class="p-4 text-[#1B1A1C] dark:text-zinc-200">
                            <span class="font-medium">{{ $application->scholarship->title }}</span>
                            <div class="text-xs text-[#AA9A98] dark:text-zinc-400">Allowance: ₱{{ number_format($application->scholarship->allowance, 2) }}</div>
                        </td>
                        <td class="p-4 text-sm text-gray-600 dark:text-zinc-350">
                            {{ $application->created_at->format('M d, Y h:i A') }}
                            <div class="text-xs text-[#AA9A98] dark:text-zinc-400">{{ $application->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="p-4 text-right whitespace-nowrap space-x-2">
                            <button wire:click="viewDetails({{ $application->id }})" class="bg-[#1D74E3] hover:bg-[#155ab2] text-white px-3 py-1.5 rounded-lg font-medium text-xs transition inline-flex items-center space-x-1 shadow-sm">
                                <span>👁️ View Details</span>
                            </button>
                            <button wire:click="approve({{ $application->id }})" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-lg font-medium text-xs transition inline-flex items-center space-x-1 shadow-sm">
                                <span>✓ Approve</span>
                            </button>
                            <button wire:click="openRejectionModal({{ $application->id }})" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg font-medium text-xs transition inline-flex items-center space-x-1 shadow-sm">
                                <span>✗ Reject</span>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-12 text-center text-gray-500">
                            <div class="text-lg font-medium text-[#33333B] dark:text-white">No pending scholarship applications!</div>
                            <div class="text-sm text-[#AA9A98] dark:text-zinc-400 mt-1">All applications have been successfully reviewed.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Details Modal -->
    @if ($showDetailsModal && $selectedApplication)
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-40 p-4">
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-xl max-w-2xl w-full flex flex-col max-h-[85vh]">
                <!-- Modal Header -->
                <div class="p-6 border-b border-gray-100 dark:border-zinc-700 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-[#33333B] dark:text-white">Review Scholarship Application</h3>
                        <p class="text-xs text-[#AA9A98] dark:text-zinc-400 mt-1">Submitted by <strong class="text-gray-700 dark:text-zinc-200">{{ $selectedApplication->user->name }}</strong> for <strong class="text-[#1D74E3]">{{ $selectedApplication->scholarship->title }}</strong></p>
                    </div>
                    <button wire:click="closeDetailsModal" class="text-gray-400 hover:text-gray-600 text-2xl font-bold focus:outline-none">&times;</button>
                </div>

                <!-- Modal Body (Scrollable) -->
                <div class="p-6 overflow-y-auto space-y-6 flex-1 bg-gray-50 dark:bg-zinc-900">
                    <h4 class="text-xs font-semibold text-[#AA9A98] dark:text-zinc-400 uppercase tracking-wider mb-2">Requirement Answers</h4>
                    
                    <div class="grid grid-cols-1 gap-4">
                        @foreach($selectedApplication->scholarship->requirements as $requirement)
                            @php
                                $answer = $selectedApplication->answers->firstWhere('requirement_id', $requirement->id);
                            @endphp
                            
                            <div class="bg-white dark:bg-zinc-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-zinc-700 border-t-4 border-t-transparent hover:border-t-[#1D74E3] hover:shadow-md transition-all duration-300">
                                <label class="block text-sm font-semibold text-[#33333B] dark:text-white mb-1">
                                    {{ $requirement->label }} 
                                    @if($requirement->is_required)
                                        <span class="text-red-500 text-xs">*</span>
                                    @endif
                                </label>
                                
                                <div class="mt-2 text-sm text-[#1B1A1C] dark:text-white">
                                    @if ($requirement->field_type === 'file')
                                        @if ($answer && $answer->file_path)
                                            <a href="/storage/{{ $answer->file_path }}" target="_blank" class="inline-flex items-center space-x-2 text-[#1D74E3] hover:underline font-medium bg-[#1D74E3]/10 px-3 py-1.5 rounded-lg border border-[#1D74E3]/20">
                                                <span>📄 View Uploaded Document</span>
                                            </a>
                                        @else
                                            <span class="text-[#AA9A98] dark:text-zinc-400 italic">No document submitted</span>
                                        @endif
                                    @else
                                        <div class="p-3 bg-gray-50 dark:bg-zinc-900 rounded border border-gray-100 dark:border-zinc-700">
                                            @if($answer && $answer->value)
                                                {{ $answer->value }}
                                            @else
                                                <span class="text-[#AA9A98] dark:text-zinc-400 italic">No answer provided</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="p-6 border-t border-gray-100 dark:border-zinc-700 flex justify-between bg-white dark:bg-zinc-800 rounded-b-lg">
                    <button wire:click="closeDetailsModal" class="px-4 py-2 border border-gray-200 dark:border-zinc-700 text-sm font-semibold text-gray-500 dark:text-zinc-400 hover:text-[#33333B] dark:hover:text-white rounded-lg transition">
                        Close
                    </button>
                    
                    <div class="flex space-x-2">
                        <button wire:click="openRejectionModal({{ $selectedApplication->id }})" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-semibold text-sm transition">
                            Reject Application
                        </button>
                        <button wire:click="approve({{ $selectedApplication->id }})" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-semibold text-sm transition">
                            Approve Application
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Rejection Remarks Modal -->
    @if ($showRejectionModal)
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-xl max-w-md w-full">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-[#33333B] dark:text-white mb-2">Reject Scholarship Application</h3>
                    <p class="text-xs text-[#AA9A98] dark:text-zinc-400 mb-4">Please provide detailed remarks outlining the reason for rejection. This will be logged and displayed to the student.</p>

                    <form wire:submit.prevent="reject">
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-[#33333B] dark:text-zinc-350 mb-2 uppercase tracking-wider">Rejection Remarks</label>
                            <textarea wire:model="rejectionRemarks" rows="4" class="w-full border border-gray-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white rounded-lg p-3 text-sm focus:ring-[#1D74E3] focus:border-[#1D74E3] focus:outline-none" placeholder="e.g., Your submitted grades do not meet the minimum GPA requirement of 85."></textarea>
                            @error('rejectionRemarks')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex justify-end gap-2 border-t dark:border-zinc-700 pt-4">
                            <button type="button" wire:click="closeRejectionModal" class="px-4 py-2 text-sm font-semibold text-gray-500 dark:text-zinc-400 hover:text-gray-700 dark:hover:text-white transition">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 text-sm font-semibold bg-red-500 hover:bg-red-600 text-white rounded-lg shadow-sm transition">
                                Confirm Reject
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    </div>
</div>
