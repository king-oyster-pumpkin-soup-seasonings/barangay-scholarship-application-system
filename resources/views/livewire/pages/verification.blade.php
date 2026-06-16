<div class="min-h-screen bg-[#E5E8EF] py-10 px-4">
    <div class="max-w-2xl mx-auto">

        {{-- Page Title --}}
        <h1 class="text-2xl font-bold text-[#33333B] mb-2">Residence Verification</h1>
        <p class="text-[#AA9A98] mb-8">
            Submit your documents to verify that you are a resident of this barangay.
            You can only apply for scholarships after your verification is approved.
        </p>

        {{-- ========================================== --}}
        {{-- STATE 1: Already submitted — show status  --}}
        {{-- ========================================== --}}
        @if ($existingVerification)

            <div class="bg-white rounded-2xl shadow p-6">
                <h2 class="text-lg font-semibold text-[#33333B] mb-4">Your Verification Status</h2>

                {{-- PENDING --}}
                @if ($existingVerification->status === 'pending')
                    <div class="flex items-center gap-3 bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                        <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                        <div>
                            <p class="font-semibold text-yellow-700">Under Review</p>
                            <p class="text-sm text-yellow-600">Your documents have been submitted and are being reviewed by the admin. Please wait.</p>
                        </div>
                    </div>
                @endif

                {{-- VERIFIED --}}
                @if ($existingVerification->status === 'verified')
                    <div class="flex items-center gap-3 bg-green-50 border border-green-200 rounded-xl p-4">
                        <div class="w-3 h-3 rounded-full bg-green-400"></div>
                        <div>
                            <p class="font-semibold text-green-700">Verified ✓</p>
                            <p class="text-sm text-green-600">Your residency has been verified. You can now browse and apply for scholarships.</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('scholarships.index') }}"
                           class="inline-block bg-[#1D74E3] text-white font-semibold px-6 py-2 rounded-xl hover:opacity-90 transition">
                            Browse Scholarships →
                        </a>
                    </div>
                @endif

                {{-- REJECTED --}}
                @if ($existingVerification->status === 'rejected')
                    <div class="flex items-start gap-3 bg-red-50 border border-red-200 rounded-xl p-4">
                        <div class="w-3 h-3 rounded-full bg-red-400 mt-1"></div>
                        <div>
                            <p class="font-semibold text-red-700">Rejected</p>
                            <p class="text-sm text-red-600 mt-1">
                                Reason: {{ $existingVerification->rejection_reason ?? 'No reason provided.' }}
                            </p>
                        </div>
                    </div>
                    <p class="text-sm text-[#AA9A98] mt-4">
                        Please contact the barangay office or resubmit your documents.
                    </p>
                @endif

                {{-- Submitted documents list --}}
                <div class="mt-6 border-t pt-4">
                    <p class="text-sm font-medium text-[#33333B] mb-2">Documents Submitted:</p>
                    <ul class="text-sm text-[#AA9A98] space-y-1 list-disc list-inside">
                        <li>Valid ID</li>
                        <li>Proof of Residency</li>
                        <li>Birth Certificate</li>
                    </ul>
                </div>
            </div>

        {{-- ========================================== --}}
        {{-- STATE 2: No submission yet — show form    --}}
        {{-- ========================================== --}}
        @else

            <div class="bg-white rounded-2xl shadow p-6">
                <h2 class="text-lg font-semibold text-[#33333B] mb-1">Submit Your Documents</h2>
                <p class="text-sm text-[#AA9A98] mb-6">
                    Accepted formats: JPG, PNG, PDF. Maximum size: 5MB per file.
                </p>

                {{-- Success message (shown after submission) --}}
                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl p-3 mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit.prevent="submit" class="space-y-6">

                    {{-- Valid ID --}}
                    <div>
                        <label class="block text-sm font-medium text-[#33333B] mb-1">
                            Valid ID <span class="text-red-500">*</span>
                        </label>
                        <input type="file"
                               wire:model="valid_id"
                               accept=".jpg,.jpeg,.png,.pdf"
                               class="block w-full text-sm text-[#1B1A1C]
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-xl file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-[#1D74E3] file:text-white
                                      hover:file:opacity-90 cursor-pointer" />
                        @error('valid_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Proof of Residency --}}
                    <div>
                        <label class="block text-sm font-medium text-[#33333B] mb-1">
                            Proof of Residency <span class="text-red-500">*</span>
                        </label>
                        <p class="text-xs text-[#AA9A98] mb-1">e.g. Utility bill, barangay certificate</p>
                        <input type="file"
                               wire:model="proof_of_residency"
                               accept=".jpg,.jpeg,.png,.pdf"
                               class="block w-full text-sm text-[#1B1A1C]
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-xl file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-[#1D74E3] file:text-white
                                      hover:file:opacity-90 cursor-pointer" />
                        @error('proof_of_residency')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Birth Certificate --}}
                    <div>
                        <label class="block text-sm font-medium text-[#33333B] mb-1">
                            Birth Certificate <span class="text-sm text-red-500">*</span>
                        </label>
                        <input type="file"
                               wire:model="birth_certificate"
                               accept=".jpg,.jpeg,.png,.pdf"
                               class="block w-full text-sm text-[#1B1A1C]
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-xl file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-[#1D74E3] file:text-white
                                      hover:file:opacity-90 cursor-pointer" />
                        @error('birth_certificate')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Upload progress indicator --}}
                    <div wire:loading wire:target="valid_id,proof_of_residency,birth_certificate"
                         class="text-sm text-[#1D74E3]">
                        ⏳ Uploading file, please wait...
                    </div>

                    {{-- Submit Button --}}
                    <div class="pt-2">
                        <button type="submit"
                                class="w-full bg-[#1D74E3] text-white font-semibold py-3 rounded-xl
                                       hover:opacity-90 transition disabled:opacity-50"
                                wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="submit">Submit Documents</span>
                            <span wire:loading wire:target="submit">Submitting...</span>
                        </button>
                    </div>

                </form>
            </div>

        @endif

    </div>
</div>
