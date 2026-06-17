<div class="min-h-screen py-10 px-4" style="background-color: #E5E8EF;">
    <div class="max-w-2xl mx-auto">

        {{-- ── Page Header ──────────────────────── --}}
        <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color: #AA9A98;">
            Step 1 of 2
        </p>
        <h1 class="text-2xl font-bold mb-1" style="color: #33333B;">Residence Verification</h1>
        <p class="text-sm mb-8" style="color: #AA9A98;">
            Verify your residency to unlock scholarship applications.
        </p>

        {{-- ══════════════════════════════════════
             STATE 1 — Already submitted
        ══════════════════════════════════════════ --}}
        @if ($existingVerification)

            {{-- PENDING --}}
            @if ($existingVerification->status === 'pending')
                <div class="rounded-xl border-l-4 p-5 flex items-start gap-4 mb-6"
                     style="background-color: #fefce8; border-left-color: #eab308; border-top: 1px solid #fde047; border-right: 1px solid #fde047; border-bottom: 1px solid #fde047;">
                    <div class="shrink-0 mt-0.5">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#ca8a04">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-yellow-800 text-sm">Under Review</p>
                        <p class="text-sm text-yellow-700 mt-0.5">
                            Your documents have been submitted and are being reviewed by barangay staff. Please wait.
                        </p>
                    </div>
                </div>
            @endif

            {{-- VERIFIED --}}
            @if ($existingVerification->status === 'verified')
                <div class="rounded-xl border-l-4 p-5 flex items-start gap-4 mb-6"
                     style="background-color: #f0fdf4; border-left-color: #22c55e; border-top: 1px solid #bbf7d0; border-right: 1px solid #bbf7d0; border-bottom: 1px solid #bbf7d0;">
                    <div class="shrink-0 mt-0.5">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#22c55e">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-green-800 text-sm">Residence Verified</p>
                        <p class="text-sm text-green-700 mt-0.5">
                            Your residency has been confirmed. You can now apply for scholarships.
                        </p>
                        <a href="{{ route('scholarships.index') }}"
                           class="inline-flex items-center gap-1.5 mt-3 text-sm font-semibold px-4 py-2 rounded-lg text-white"
                           style="background-color: #1D74E3;">
                            Browse Scholarships
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endif

            {{-- REJECTED --}}
            @if ($existingVerification->status === 'rejected')
                <div class="rounded-xl border-l-4 p-5 flex items-start gap-4 mb-6"
                     style="background-color: #fef2f2; border-left-color: #ef4444; border-top: 1px solid #fca5a5; border-right: 1px solid #fca5a5; border-bottom: 1px solid #fca5a5;">
                    <div class="shrink-0 mt-0.5">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#ef4444">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-red-800 text-sm">Verification Rejected</p>
                        @if ($existingVerification->rejection_reason)
                            <p class="text-sm text-red-700 mt-1">
                                Reason: {{ $existingVerification->rejection_reason }}
                            </p>
                        @endif
                        <p class="text-sm mt-2" style="color: #AA9A98;">
                            Please contact the barangay office or resubmit your documents.
                        </p>
                    </div>
                </div>
            @endif

            {{-- Submitted documents --}}
            <div class="bg-white rounded-xl border p-5" style="border-color: #e5e7eb;">
                <p class="text-xs font-semibold uppercase tracking-widest mb-4" style="color: #AA9A98;">
                    Documents Submitted
                </p>
                <div class="space-y-3">
                    @foreach ([
                        'Valid ID',
                        'Proof of Residency',
                        'Birth Certificate'
                    ] as $doc)
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0"
                                 style="background-color: #E5E8EF;">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="color: #1D74E3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium" style="color: #1B1A1C;">{{ $doc }}</span>
                            <svg class="w-4 h-4 ml-auto shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#22c55e">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </div>
                    @endforeach
                </div>
            </div>

        {{-- ══════════════════════════════════════
             STATE 2 — Upload form
        ══════════════════════════════════════════ --}}
        @else

            @if (session('success'))
                <div class="rounded-xl border-l-4 p-4 mb-6 text-sm"
                     style="background-color: #f0fdf4; border-left-color: #22c55e; border-top: 1px solid #bbf7d0; border-right: 1px solid #bbf7d0; border-bottom: 1px solid #bbf7d0; color: #166534;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-xl border p-6 space-y-6" style="border-color: #e5e7eb;">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color: #AA9A98;">
                        Required Documents
                    </p>
                    <p class="text-sm" style="color: #AA9A98;">
                        JPG, PNG, or PDF — max 5MB each.
                    </p>
                </div>

                <form wire:submit.prevent="submit" class="space-y-5">

                    {{-- Upload loading indicator --}}
                    <div wire:loading wire:target="valid_id,proof_of_residency,birth_certificate"
                         class="flex items-center gap-2 text-sm rounded-lg px-3 py-2"
                         style="background-color: #EBF2FD; color: #1D74E3;">
                        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                        </svg>
                        Uploading file, please wait…
                    </div>

                    {{-- ── Upload Field Macro ── --}}
                    {{-- 1. Valid ID --}}
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-6 h-6 rounded-full text-xs font-bold flex items-center justify-center shrink-0 text-white"
                                  style="background-color: #1D74E3;">1</span>
                            <label class="text-sm font-semibold" style="color: #33333B;">
                                Valid ID <span class="text-red-500">*</span>
                            </label>
                        </div>
                        <label for="valid_id_input"
                               class="flex flex-col items-center justify-center gap-2 w-full rounded-xl border-2 border-dashed p-6 cursor-pointer transition-colors hover:border-[#1D74E3] hover:bg-[#EBF2FD]"
                               style="border-color: #d1d5db;">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="color: #AA9A98">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                            </svg>
                            <span class="text-sm font-medium" style="color: #33333B;">Click to upload</span>
                            <span class="text-xs" style="color: #AA9A98;">e.g. SSS, PhilSys, Driver's License</span>
                        </label>
                        <input id="valid_id_input" type="file" wire:model="valid_id"
                               accept=".jpg,.jpeg,.png,.pdf" class="sr-only"/>
                        @error('valid_id')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 2. Proof of Residency --}}
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-6 h-6 rounded-full text-xs font-bold flex items-center justify-center shrink-0 text-white"
                                  style="background-color: #1D74E3;">2</span>
                            <label class="text-sm font-semibold" style="color: #33333B;">
                                Proof of Residency <span class="text-red-500">*</span>
                            </label>
                        </div>
                        <label for="residency_input"
                               class="flex flex-col items-center justify-center gap-2 w-full rounded-xl border-2 border-dashed p-6 cursor-pointer transition-colors hover:border-[#1D74E3] hover:bg-[#EBF2FD]"
                               style="border-color: #d1d5db;">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="color: #AA9A98">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                            </svg>
                            <span class="text-sm font-medium" style="color: #33333B;">Click to upload</span>
                            <span class="text-xs" style="color: #AA9A98;">e.g. Utility bill, Barangay certificate</span>
                        </label>
                        <input id="residency_input" type="file" wire:model="proof_of_residency"
                               accept=".jpg,.jpeg,.png,.pdf" class="sr-only"/>
                        @error('proof_of_residency')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 3. Birth Certificate --}}
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="w-6 h-6 rounded-full text-xs font-bold flex items-center justify-center shrink-0 text-white"
                                  style="background-color: #1D74E3;">3</span>
                            <label class="text-sm font-semibold" style="color: #33333B;">
                                Birth Certificate <span class="text-red-500">*</span>
                            </label>
                        </div>
                        <label for="birth_cert_input"
                               class="flex flex-col items-center justify-center gap-2 w-full rounded-xl border-2 border-dashed p-6 cursor-pointer transition-colors hover:border-[#1D74E3] hover:bg-[#EBF2FD]"
                               style="border-color: #d1d5db;">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="color: #AA9A98">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                            </svg>
                            <span class="text-sm font-medium" style="color: #33333B;">Click to upload</span>
                            <span class="text-xs" style="color: #AA9A98;">PSA-issued copy preferred</span>
                        </label>
                        <input id="birth_cert_input" type="file" wire:model="birth_certificate"
                               accept=".jpg,.jpeg,.png,.pdf" class="sr-only"/>
                        @error('birth_certificate')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <div class="pt-2">
                        <button type="submit"
                                class="w-full text-white font-semibold py-3 rounded-xl transition disabled:opacity-50"
                                style="background-color: #1D74E3;"
                                wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="submit">Submit Documents</span>
                            <span wire:loading wire:target="submit">Submitting…</span>
                        </button>
                    </div>

                </form>
            </div>

        @endif

    </div>
</div>
