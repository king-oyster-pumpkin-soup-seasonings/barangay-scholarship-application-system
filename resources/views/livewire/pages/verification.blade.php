<div>
    @php $status = $existingVerification?->status; @endphp

    {{-- ── STATUS VIEW (already submitted) ─────────────────────────────── --}}
    @if ($existingVerification)
        <div class="max-w-2xl mx-auto py-10 px-4">

            {{-- Page header --}}
            <div class="mb-8">
                <p class="text-xs font-bold uppercase tracking-[0.2em] mb-1" style="color: #AA9A98;">Residence Verification</p>
                <h1 class="text-2xl font-bold" style="color: #33333B;">Verification Status</h1>
            </div>

            {{-- Status card --}}
            @if ($status === 'verified')
                <div class="rounded-2xl border p-6 flex items-start gap-4 mb-6"
                     style="background-color: #f0fdf4; border-color: #bbf7d0; border-left: 4px solid #22c55e;">
                    <div class="shrink-0 w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: #dcfce7;">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="#22c55e" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-green-800">Residence Verified</p>
                        <p class="text-sm text-green-700 mt-1">Your residency has been confirmed by the barangay office. You are now eligible to apply for scholarships.</p>
                    </div>
                </div>

            @elseif ($status === 'pending')
                <div class="rounded-2xl border p-6 flex items-start gap-4 mb-6"
                     style="background-color: #fefce8; border-color: #fde047; border-left: 4px solid #eab308;">
                    <div class="shrink-0 w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: #fef9c3;">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="#ca8a04" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-yellow-800">Under Review</p>
                        <p class="text-sm text-yellow-700 mt-1">Your documents have been submitted and are currently being reviewed by barangay staff. This may take a few business days.</p>
                    </div>
                </div>

            @elseif ($status === 'rejected')
                <div class="rounded-2xl border p-6 flex items-start gap-4 mb-6"
                     style="background-color: #fef2f2; border-color: #fca5a5; border-left: 4px solid #ef4444;">
                    <div class="shrink-0 w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: #fee2e2;">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="#ef4444" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-red-800">Verification Rejected</p>
                        <p class="text-sm text-red-700 mt-1">Your documents were not accepted. Please visit the Barangay Hall or contact the scholarship office for assistance on next steps.</p>
                    </div>
                </div>
            @endif

            {{-- Submitted documents (read-only) --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="text-sm font-bold mb-4" style="color: #33333B;">Submitted Documents</h2>
                <ul class="space-y-3">
                    @foreach ([
                        ['label' => 'Valid ID',               'path' => $existingVerification->valid_id_path],
                        ['label' => 'Proof of Residency',     'path' => $existingVerification->proof_of_residency_path],
                        ['label' => 'Birth Certificate',      'path' => $existingVerification->birth_certificate_path],
                    ] as $doc)
                        <li class="flex items-center justify-between gap-3 p-3 rounded-xl" style="background-color: #E5E8EF;">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="#1D74E3" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                </svg>
                                <span class="text-sm font-medium" style="color: #33333B;">{{ $doc['label'] }}</span>
                            </div>
                            @if ($doc['path'])
                                <a href="{{ Storage::url($doc['path']) }}"
                                   target="_blank"
                                   class="text-xs font-semibold hover:underline"
                                   style="color: #1D74E3;">
                                    View File →
                                </a>
                            @else
                                <span class="text-xs" style="color: #AA9A98;">Not submitted</span>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <p class="text-xs mt-4" style="color: #AA9A98;">
                    Submitted {{ $existingVerification->created_at->timezone('Asia/Manila')->format('M d, Y \a\t g:i A') }}
                </p>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('dashboard') }}" wire:navigate
                   class="text-sm font-semibold hover:underline"
                   style="color: #1D74E3;">
                    ← Back to Dashboard
                </a>
            </div>
        </div>

    {{-- ── FORM VIEW (never submitted) ──────────────────────────────────── --}}
    @else
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sm:p-8">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-[#33333B] tracking-tight">Submit Your Documents</h2>
                <p class="text-xs text-[#AA9A98] mt-1 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4m0-4h.01M22 12a10 10 0 11-20 0 10 10 0 0120 0z" />
                    </svg>
                    Accepted formats: JPG, PNG, PDF (Max 5MB per file)
                </p>
            </div>

            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl p-4 mb-6 flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <form wire:submit.prevent="submit" class="space-y-6">

                {{-- 1. Valid ID --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="valid_id_input" class="text-sm font-semibold text-[#33333B] cursor-pointer flex items-center gap-2">
                            <span class="inline-flex items-center justify-center w-5 h-5 text-[11px] font-bold text-white rounded-full bg-[#1D74E3]">1</span>
                            Valid ID <span class="text-red-500">*</span>
                        </label>
                        <span class="text-[11px] text-[#AA9A98] font-medium tracking-wide uppercase">UMID, Philsys, Driver's License</span>
                    </div>
                    @if (!$valid_id)
                        <label for="valid_id_input" class="flex flex-col items-center justify-center gap-2 w-full rounded-xl border-2 border-dashed border-gray-200 hover:border-[#1D74E3] transition-colors px-4 py-8 cursor-pointer bg-gray-50/50 hover:bg-blue-50/30 group">
                            <svg class="w-7 h-7 text-[#AA9A98] group-hover:text-[#1D74E3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            <div class="text-center">
                                <span class="text-sm font-semibold text-[#1D74E3]">Click to upload</span>
                                <span class="text-sm text-gray-500 font-medium"> or drag and drop</span>
                            </div>
                            <p class="text-xs text-[#AA9A98]">PDF, JPG, PNG up to 5MB</p>
                            <input type="file" wire:model="valid_id" id="valid_id_input" accept=".jpg,.jpeg,.png,.pdf" class="sr-only" />
                        </label>
                    @endif
                    <div wire:loading wire:target="valid_id" class="mt-2 flex items-center gap-2 text-xs font-semibold text-[#1D74E3] pl-1">
                        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Uploading file...</span>
                    </div>
                    @if ($valid_id)
                        <div class="mt-2 flex items-center justify-between gap-2 bg-green-50/60 border border-green-100 rounded-lg py-1.5 px-2.5">
                            <div class="flex items-center gap-1.5 text-xs text-green-600 font-semibold min-w-0">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="truncate max-w-[240px]">{{ method_exists($valid_id, 'getClientOriginalName') ? $valid_id->getClientOriginalName() : 'File selected' }}</span>
                            </div>
                            <button type="button" wire:click="removeFile('valid_id')" class="shrink-0 text-[#AA9A98] hover:text-red-500 transition-colors ml-2" title="Remove file">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    @endif
                    @error('valid_id') <p class="text-red-500 text-xs mt-1.5 pl-1">{{ $message }}</p> @enderror
                </div>

                {{-- 2. Proof of Residency --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="residency_input" class="text-sm font-semibold text-[#33333B] cursor-pointer flex items-center gap-2">
                            <span class="inline-flex items-center justify-center w-5 h-5 text-[11px] font-bold text-white rounded-full bg-[#1D74E3]">2</span>
                            Proof of Residency <span class="text-red-500">*</span>
                        </label>
                        <span class="text-[11px] text-[#AA9A98] font-medium tracking-wide uppercase">Utility Bill, Barangay Cert</span>
                    </div>
                    @if (!$proof_of_residency)
                        <label for="residency_input" class="flex flex-col items-center justify-center gap-2 w-full rounded-xl border-2 border-dashed border-gray-200 hover:border-[#1D74E3] transition-colors px-4 py-8 cursor-pointer bg-gray-50/50 hover:bg-blue-50/30 group">
                            <svg class="w-7 h-7 text-[#AA9A98] group-hover:text-[#1D74E3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            <div class="text-center">
                                <span class="text-sm font-semibold text-[#1D74E3]">Click to upload</span>
                                <span class="text-sm text-gray-500 font-medium"> or drag and drop</span>
                            </div>
                            <p class="text-xs text-[#AA9A98]">PDF, JPG, PNG up to 5MB</p>
                            <input type="file" wire:model="proof_of_residency" id="residency_input" accept=".jpg,.jpeg,.png,.pdf" class="sr-only" />
                        </label>
                    @endif
                    <div wire:loading wire:target="proof_of_residency" class="mt-2 flex items-center gap-2 text-xs font-semibold text-[#1D74E3] pl-1">
                        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Uploading file...</span>
                    </div>
                    @if ($proof_of_residency)
                        <div class="mt-2 flex items-center justify-between gap-2 bg-green-50/60 border border-green-100 rounded-lg py-1.5 px-2.5">
                            <div class="flex items-center gap-1.5 text-xs text-green-600 font-semibold min-w-0">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="truncate max-w-[240px]">{{ method_exists($proof_of_residency, 'getClientOriginalName') ? $proof_of_residency->getClientOriginalName() : 'File selected' }}</span>
                            </div>
                            <button type="button" wire:click="removeFile('proof_of_residency')" class="shrink-0 text-[#AA9A98] hover:text-red-500 transition-colors ml-2" title="Remove file">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    @endif
                    @error('proof_of_residency') <p class="text-red-500 text-xs mt-1.5 pl-1">{{ $message }}</p> @enderror
                </div>

                {{-- 3. Birth Certificate --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="birth_cert_input" class="text-sm font-semibold text-[#33333B] cursor-pointer flex items-center gap-2">
                            <span class="inline-flex items-center justify-center w-5 h-5 text-[11px] font-bold text-white rounded-full bg-[#1D74E3]">3</span>
                            Birth Certificate <span class="text-red-500">*</span>
                        </label>
                        <span class="text-[11px] text-[#AA9A98] font-medium tracking-wide uppercase">PSA copy preferred</span>
                    </div>
                    @if (!$birth_certificate)
                        <label for="birth_cert_input" class="flex flex-col items-center justify-center gap-2 w-full rounded-xl border-2 border-dashed border-gray-200 hover:border-[#1D74E3] transition-colors px-4 py-8 cursor-pointer bg-gray-50/50 hover:bg-blue-50/30 group">
                            <svg class="w-7 h-7 text-[#AA9A98] group-hover:text-[#1D74E3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            <div class="text-center">
                                <span class="text-sm font-semibold text-[#1D74E3]">Click to upload</span>
                                <span class="text-sm text-gray-500 font-medium"> or drag and drop</span>
                            </div>
                            <p class="text-xs text-[#AA9A98]">PDF, JPG, PNG up to 5MB</p>
                            <input type="file" wire:model="birth_certificate" id="birth_cert_input" accept=".jpg,.jpeg,.png,.pdf" class="sr-only" />
                        </label>
                    @endif
                    <div wire:loading wire:target="birth_certificate" class="mt-2 flex items-center gap-2 text-xs font-semibold text-[#1D74E3] pl-1">
                        <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Uploading file...</span>
                    </div>
                    @if ($birth_certificate)
                        <div class="mt-2 flex items-center justify-between gap-2 bg-green-50/60 border border-green-100 rounded-lg py-1.5 px-2.5">
                            <div class="flex items-center gap-1.5 text-xs text-green-600 font-semibold min-w-0">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="truncate max-w-[240px]">{{ method_exists($birth_certificate, 'getClientOriginalName') ? $birth_certificate->getClientOriginalName() : 'File selected' }}</span>
                            </div>
                            <button type="button" wire:click="removeFile('birth_certificate')" class="shrink-0 text-[#AA9A98] hover:text-red-500 transition-colors ml-2" title="Remove file">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    @endif
                    @error('birth_certificate') <p class="text-red-500 text-xs mt-1.5 pl-1">{{ $message }}</p> @enderror
                </div>

                {{-- Submit --}}
                <div class="pt-4">
                    <button type="submit"
                            class="w-full bg-[#1D74E3] text-white font-semibold text-sm py-3 px-4 rounded-xl shadow-sm hover:bg-blue-600 transition duration-150 disabled:opacity-40 disabled:pointer-events-none"
                            wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="submit">Submit Verification Profile</span>
                        <span wire:loading wire:target="submit" class="inline-flex items-center justify-center gap-2">
                            <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                            </svg>
                            Processing Documents…
                        </span>
                    </button>
                </div>

            </form>
        </div>
    @endif
</div>
