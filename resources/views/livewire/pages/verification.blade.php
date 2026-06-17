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

    {{-- Success message --}}
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

            <div wire:loading wire:target="valid_id" class="mt-2 flex items-center gap-2 text-xs font-semibold text-[#1D74E3] pl-1">
                <svg class="w-4 h-4 animate-spin text-[#1D74E3]" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Uploading file...</span>
            </div>

            {{-- Selected File Indicator --}}
            @if ($valid_id)
                <div class="mt-2 flex items-center gap-1.5 text-xs text-green-600 font-semibold bg-green-50/60 border border-green-100 rounded-lg py-1.5 px-2.5 w-fit">
                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="truncate max-w-[280px]">
                        {{ method_exists($valid_id, 'getClientOriginalName') ? $valid_id->getClientOriginalName() : 'File selected' }}
                    </span>
                </div>
            @endif

            @error('valid_id')
                <p class="text-red-500 text-xs mt-1.5 pl-1 flex items-center gap-1">{{ $message }}</p>
            @enderror
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

            <div wire:loading wire:target="proof_of_residency" class="mt-2 flex items-center gap-2 text-xs font-semibold text-[#1D74E3] pl-1">
                <svg class="w-4 h-4 animate-spin text-[#1D74E3]" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Uploading file...</span>
            </div>

            {{-- Selected File Indicator --}}
            @if ($proof_of_residency)
                <div class="mt-2 flex items-center gap-1.5 text-xs text-green-600 font-semibold bg-green-50/60 border border-green-100 rounded-lg py-1.5 px-2.5 w-fit">
                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="truncate max-w-[280px]">
                        {{ method_exists($proof_of_residency, 'getClientOriginalName') ? $proof_of_residency->getClientOriginalName() : 'File selected' }}
                    </span>
                </div>
            @endif

            @error('proof_of_residency')
                <p class="text-red-500 text-xs mt-1.5 pl-1 flex items-center gap-1">{{ $message }}</p>
            @enderror
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

            <div wire:loading wire:target="birth_certificate" class="mt-2 flex items-center gap-2 text-xs font-semibold text-[#1D74E3] pl-1">
                <svg class="w-4 h-4 animate-spin text-[#1D74E3]" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Uploading file...</span>
            </div>

            {{-- Selected File Indicator --}}
            @if ($birth_certificate)
                <div class="mt-2 flex items-center gap-1.5 text-xs text-green-600 font-semibold bg-green-50/60 border border-green-100 rounded-lg py-1.5 px-2.5 w-fit">
                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="truncate max-w-[280px]">
                        {{ method_exists($birth_certificate, 'getClientOriginalName') ? $birth_certificate->getClientOriginalName() : 'File selected' }}
                    </span>
                </div>
            @endif

            @error('birth_certificate')
                <p class="text-red-500 text-xs mt-1.5 pl-1 flex items-center gap-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit Button Row --}}
        <div class="pt-4">
            <button type="submit"
                    class="w-full bg-[#1D74E3] text-white font-semibold text-sm py-3 px-4 rounded-xl shadow-sm hover:bg-blue-600 active:transform active:scale-[0.99] transition duration-150 disabled:opacity-40 disabled:pointer-events-none"
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
