<div class="min-h-screen bg-[#E5E8EF] p-8">
    <!-- Enhanced Page Header & Interactive Breadcrumbs -->
    <div class="mb-10">
        <div class="text-sm font-medium mb-2 flex items-center space-x-1.5">
            <a href="{{ route('admin.dashboard') }}" class="text-[#1D74E3] hover:underline font-semibold transition duration-150">Admin Dashboard</a>
            <span class="text-[#AA9A98]">&rarr;</span>
            <span class="text-[#AA9A98]">Admin Applications</span>
        </div>
        <h1 class="text-3xl font-extrabold text-[#33333B] tracking-tight">Admin Registration Requests</h1>
        <p class="text-[#AA9A98] text-sm mt-1.5 font-medium">Review, approve, or reject new administrator registration applications.</p>
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
                    <th class="p-4 font-semibold text-sm">Applicant Name</th>
                    <th class="p-4 font-semibold text-sm">Email</th>
                    <th class="p-4 font-semibold text-sm">Date Applied</th>
                    <th class="p-4 font-semibold text-sm">Status</th>
                    <th class="p-4 font-semibold text-sm text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($adminApplications as $admin)
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
                            @if ($admin->verification_status === 'pending')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-[#AA9A98]">
                                    Pending Approval
                                </span>
                            @elseif ($admin->verification_status === 'verified')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-50 text-green-700">
                                    Approved
                                </span>
                            @elseif ($admin->verification_status === 'rejected')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-50 text-red-700">
                                    Rejected
                                </span>
                            @endif
                        </td>
                        <td class="p-4 text-right whitespace-nowrap space-x-3 text-xs font-semibold">
                            @if ($admin->verification_status === 'pending')
                                <button wire:click="approve({{ $admin->id }})" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-lg font-semibold transition shadow-sm">
                                    Approve
                                </button>
                                <button wire:click="openRejectionModal({{ $admin->id }})" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg font-semibold transition shadow-sm">
                                    Reject
                                </button>
                            @else
                                <div class="text-xs text-[#AA9A98]">
                                    @if ($admin->verification_status === 'verified')
                                        Reviewed by {{ $admin->verifier?->name ?? 'System' }} on {{ $admin->verified_at?->format('M d, Y') }}
                                    @else
                                        Rejected: <span class="italic font-medium">"{{ Str::limit($admin->verification_remarks, 30) }}"</span>
                                    @endif
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-12 text-center text-gray-500">
                            <div class="text-lg font-medium text-[#33333B]">No admin registration applications!</div>
                            <div class="text-sm text-[#AA9A98] mt-1">All administrator requests have been processed.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Rejection Remarks Modal -->
    @if ($showRejectionModal)
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-[#33333B] mb-2">Reject Admin Registration</h3>
                    <p class="text-xs text-[#AA9A98] mb-4">Please provide detailed remarks explaining why this admin request is being rejected.</p>

                    <form wire:submit.prevent="reject">
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-[#33333B] mb-2 uppercase tracking-wider">Rejection Remarks</label>
                            <textarea wire:model="rejectionRemarks" rows="4" class="w-full border border-gray-200 rounded-lg p-3 text-sm focus:ring-[#1D74E3] focus:border-[#1D74E3] focus:outline-none" placeholder="e.g., Unrecognized email or name. Please coordinate with the Superadmin."></textarea>
                            @error('rejectionRemarks')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex justify-end gap-2 border-t pt-4">
                            <button type="button" wire:click="closeRejectionModal" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-gray-700 transition">
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
