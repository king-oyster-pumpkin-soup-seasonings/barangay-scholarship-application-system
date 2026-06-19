<div class="min-h-screen bg-[#E5E8EF] dark:bg-[#1B1A1C]">
    <div class="max-w-7xl mx-auto p-8">
        <!-- Enhanced Page Header & Interactive Breadcrumbs -->
        <div class="mb-10">
        <div class="text-sm font-medium mb-2 flex items-center space-x-1.5">
            <a href="{{ route('admin.dashboard') }}" class="text-[#1D74E3] hover:underline font-semibold transition duration-150">Dashboard</a>
            <span class="text-[#AA9A98]">&rarr;</span>
            <span class="text-[#AA9A98]">Verifications</span>
        </div>
        <h1 class="text-3xl font-extrabold text-[#33333B] dark:text-white tracking-tight">Residence Verifications</h1>
        <p class="text-[#AA9A98] dark:text-zinc-400 text-sm mt-1.5 font-medium">Review student residency verification submissions and identity documents.</p>
    </div>

    @if (session()->has('success'))
        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r shadow-sm">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('info'))
        <div class="mb-6 bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-r shadow-sm">
            {{ session('info') }}
        </div>
    @endif

    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-md overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#33333B] text-white">
                    <th class="p-4 font-semibold text-sm uppercase tracking-wider">Student Name</th>
                    <th class="p-4 font-semibold text-sm uppercase tracking-wider">Email</th>
                    <th class="p-4 font-semibold text-sm uppercase tracking-wider">Documents</th>
                    <th class="p-4 font-semibold text-sm uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendingVerifications as $verification)
                    <tr class="border-b border-gray-100 dark:border-zinc-700 hover:bg-[#E5E8EF]/50 dark:hover:bg-zinc-700/50 transition duration-150">
                        <td class="p-4 font-semibold text-[#1B1A1C] dark:text-white">
                            {{ $verification->user->name }}
                            <div class="text-xs text-[#AA9A98] dark:text-zinc-400 font-normal">{{ $verification->user->address }}</div>
                        </td>
                        <td class="p-4 text-gray-600 dark:text-zinc-350">
                            {{ $verification->user->email }}
                            <div class="text-xs text-[#AA9A98] dark:text-zinc-400">{{ $verification->user->phone }}</div>
                        </td>
                        <td class="p-4 space-y-1">
                            <div class="text-xs">
                                <a href="/storage/{{ $verification->valid_id_path }}" target="_blank" class="text-[#1D74E3] hover:underline font-medium">📄 Valid ID</a>
                            </div>
                            <div class="text-xs">
                                <a href="/storage/{{ $verification->proof_of_residency_path }}" target="_blank" class="text-[#1D74E3] hover:underline font-medium">📄 Proof of Residency</a>
                            </div>
                            <div class="text-xs">
                                <a href="/storage/{{ $verification->birth_certificate_path }}" target="_blank" class="text-[#1D74E3] hover:underline font-medium">📄 Birth Certificate</a>
                            </div>
                        </td>
                        <td class="p-4 text-right whitespace-nowrap space-x-2">
                            <button wire:click="approve({{ $verification->id }})" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium text-sm transition">
                                Approve
                            </button>
                            <button wire:click="openRejectionModal({{ $verification->id }})" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium text-sm transition">
                                Reject
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-gray-500 dark:text-zinc-400">
                            <p class="text-lg font-medium text-[#33333B] dark:text-white">No pending verifications right now!</p>
                            <p class="text-sm mt-1">All registered residents have been processed.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($showRejectionModal)
        <div class="fixed inset-0 bg-black/55 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-xl max-w-md w-full">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-[#33333B] dark:text-white mb-2">Reject Residence Verification</h3>
                    <p class="text-xs text-[#AA9A98] dark:text-zinc-400 mb-4">Please provide a clear reason. This will be sent to the resident's dashboard.</p>

                    <form wire:submit.prevent="reject">
                        <div class="mb-4">
                            <label class="block text-xs font-semibold text-[#33333B] dark:text-zinc-300 mb-2 uppercase tracking-wider">Rejection Reason</label>
                            <textarea wire:model="rejectionReason" rows="4" class="w-full border border-gray-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white rounded p-3 text-sm focus:ring-[#1D74E3] focus:border-[#1D74E3] focus:outline-none" placeholder="e.g., The submitted ID is blurry and unreadable."></textarea>
                            @error('rejectionReason')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex justify-end gap-2 border-t dark:border-zinc-700 pt-4">
                            <button type="button" wire:click="closeRejectionModal" class="px-4 py-2 text-xs font-semibold text-[#AA9A98] hover:text-[#33333B] dark:text-zinc-400 dark:hover:text-white transition">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 text-xs font-semibold bg-red-600 hover:bg-red-700 text-white rounded shadow-sm transition">
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
