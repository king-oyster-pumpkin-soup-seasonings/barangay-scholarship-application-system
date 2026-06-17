<div class="min-h-screen bg-[#E5E8EF] py-10 px-4">
    <div class="max-w-2xl mx-auto">

        {{-- Page Header --}}
        <div class="mb-8">
            <a href="{{ route('dashboard') }}" wire:navigate
               class="inline-flex items-center gap-1.5 text-sm text-[#AA9A98] hover:text-[#1B1A1C] transition-colors mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Dashboard
            </a>
            <h1 class="text-2xl font-bold text-[#33333B]">{{ $scholarship->title }}</h1>
            <p class="text-sm text-[#AA9A98] mt-1">
                Allowance: ₱{{ number_format($scholarship->allowance, 2) }}
                &bull;
                Deadline: {{ \Carbon\Carbon::parse($scholarship->deadline)->format('M d, Y') }}
            </p>
        </div>

        {{-- Step Indicator --}}
        @if ($totalSteps > 1)
            <div class="flex items-center gap-2 mb-8">
                @for ($i = 1; $i <= $totalSteps; $i++)
                    {{-- Step circle --}}
                    <div class="flex items-center gap-2">
                        <div @class([
                            'w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold transition-colors',
                            'bg-[#1D74E3] text-white'  => $step >= $i,
                            'bg-white text-[#AA9A98] border border-[#AA9A98]' => $step < $i,
                        ])>
                            @if ($step > $i)
                                {{-- Checkmark for completed steps --}}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            @else
                                {{ $i }}
                            @endif
                        </div>
                    </div>
                    {{-- Connector line between steps --}}
                    @if ($i < $totalSteps)
                        <div @class([
                            'flex-1 h-0.5 transition-colors',
                            'bg-[#1D74E3]' => $step > $i,
                            'bg-[#D1D5DB]' => $step <= $i,
                        ])></div>
                    @endif
                @endfor
            </div>
        @endif

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-white/60 p-8">

            {{-- Step Title --}}
            <div class="mb-6 pb-5 border-b border-[#E5E8EF]">
                <p class="text-xs font-semibold uppercase tracking-widest text-[#1D74E3] mb-1">
                    Step {{ $step }} of {{ $totalSteps }}
                </p>
                <h2 class="text-xl font-bold text-[#33333B]">{{ $stepLabel }}</h2>
            </div>

            {{-- Fields for the current step --}}
            <div class="space-y-6">
                @forelse ($currentRequirements as $req)
                    <div>
                        {{-- Label --}}
                        <label class="block text-sm font-medium text-[#1B1A1C] mb-1.5">
                            {{ $req['label'] }}
                            @if ($req['is_required'])
                                <span class="text-red-500 ml-0.5">*</span>
                            @endif
                        </label>

                        {{-- Render the correct input based on field_type --}}
                        @switch($req['field_type'])

                            @case('text')
                                <input
                                    type="text"
                                    wire:model="answers.{{ $req['id'] }}"
                                    class="w-full rounded-lg border border-[#D1D5DB] px-3.5 py-2.5 text-sm text-[#1B1A1C] placeholder-[#AA9A98] focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition"
                                    placeholder="Type your answer here"
                                />
                                @break

                            @case('number')
                                <input
                                    type="number"
                                    wire:model="answers.{{ $req['id'] }}"
                                    class="w-full rounded-lg border border-[#D1D5DB] px-3.5 py-2.5 text-sm text-[#1B1A1C] placeholder-[#AA9A98] focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition"
                                    placeholder="0"
                                />
                                @break

                            @case('textarea')
                                <textarea
                                    wire:model="answers.{{ $req['id'] }}"
                                    rows="4"
                                    class="w-full rounded-lg border border-[#D1D5DB] px-3.5 py-2.5 text-sm text-[#1B1A1C] placeholder-[#AA9A98] focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition resize-none"
                                    placeholder="Type your answer here"
                                ></textarea>
                                @break

                            @case('select')
                                <select
                                    wire:model="answers.{{ $req['id'] }}"
                                    class="w-full rounded-lg border border-[#D1D5DB] px-3.5 py-2.5 text-sm text-[#1B1A1C] focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition bg-white"
                                >
                                    <option value="">Select an option</option>
                                    @foreach (is_array($req['options']) ? $req['options'] : json_decode($req['options'] ?? '[]', true) as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                </select>
                                @break

                            @case('checkbox')
                                <div class="space-y-2">
                                    @foreach (is_array($req['options']) ? $req['options'] : json_decode($req['options'] ?? '[]', true) as $option)
                                        <label class="flex items-center gap-2.5 cursor-pointer">
                                            <input
                                                type="checkbox"
                                                wire:model="answers.{{ $req['id'] }}"
                                                value="{{ $option }}"
                                                class="w-4 h-4 rounded border-[#D1D5DB] text-[#1D74E3] focus:ring-[#1D74E3]"
                                            />
                                            <span class="text-sm text-[#1B1A1C]">{{ $option }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @break

                            @case('file')
                                {{-- File upload area --}}
                                <div>
                                    <label
                                        for="file-{{ $req['id'] }}"
                                        class="flex flex-col items-center justify-center gap-2 w-full rounded-lg border-2 border-dashed border-[#D1D5DB] hover:border-[#1D74E3] transition-colors px-4 py-8 cursor-pointer bg-[#F9FAFB] hover:bg-blue-50"
                                    >
                                        <svg class="w-7 h-7 text-[#AA9A98]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                        </svg>
                                        <div class="text-center">
                                            <span class="text-sm font-medium text-[#1D74E3]">Click to upload</span>
                                            <span class="text-sm text-[#AA9A98]"> or drag and drop</span>
                                        </div>
                                        <p class="text-xs text-[#AA9A98]">PDF, JPG, PNG up to 10MB</p>
                                        <input
                                            id="file-{{ $req['id'] }}"
                                            type="file"
                                            wire:model="files.{{ $req['id'] }}"
                                            class="sr-only"
                                        />
                                    </label>

                                    {{-- Show file name once uploaded --}}
                                    @if (!empty($files[$req['id']]))
                                        <p class="mt-2 text-xs text-green-600 font-medium flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            {{ $files[$req['id']]->getClientOriginalName() }}
                                        </p>
                                    @endif

                                    {{-- Loading indicator while Livewire uploads the file --}}
                                    <div wire:loading wire:target="files.{{ $req['id'] }}" class="mt-2 text-xs text-[#AA9A98]">
                                        Uploading...
                                    </div>
                                </div>
                                @break

                            @default
                                {{-- Fallback for unknown field types --}}
                                <input
                                    type="text"
                                    wire:model="answers.{{ $req['id'] }}"
                                    class="w-full rounded-lg border border-[#D1D5DB] px-3.5 py-2.5 text-sm text-[#1B1A1C] focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition"
                                />
                        @endswitch

                        {{-- Validation error message --}}
                        @error("answers.{$req['id']}")
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        @error("files.{$req['id']}")
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                @empty
                    <p class="text-sm text-[#AA9A98] text-center py-6">
                        No fields for this step. Click Next to continue.
                    </p>
                @endforelse
            </div>

            {{-- Navigation Buttons --}}
            <div class="flex items-center justify-between mt-8 pt-6 border-t border-[#E5E8EF]">

                {{-- Back button — hidden on step 1 --}}
                @if ($step > 1)
                    <button
                        type="button"
                        wire:click="previousStep"
                        class="inline-flex items-center gap-1.5 px-5 py-2.5 rounded-lg border border-[#D1D5DB] text-sm font-medium text-[#1B1A1C] hover:bg-[#E5E8EF] transition-colors"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Back
                    </button>
                @else
                    <div></div> {{-- Empty div keeps Next/Submit pushed to the right --}}
                @endif

                {{-- Next or Submit --}}
                @if ($step < $totalSteps)
                    <button
                        type="button"
                        wire:click="nextStep"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center gap-1.5 px-6 py-2.5 rounded-lg bg-[#1D74E3] text-white text-sm font-semibold hover:bg-blue-700 transition-colors disabled:opacity-60"
                    >
                        <span wire:loading.remove wire:target="nextStep">
                            Next
                            <svg class="w-4 h-4 inline ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                        <span wire:loading wire:target="nextStep">Saving...</span>
                    </button>
                @else
                    <button
                        type="button"
                        wire:click="submit"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center gap-1.5 px-6 py-2.5 rounded-lg bg-[#1D74E3] text-white text-sm font-semibold hover:bg-blue-700 transition-colors disabled:opacity-60"
                    >
                        <span wire:loading.remove wire:target="submit">Submit Application</span>
                        <span wire:loading wire:target="submit">Submitting...</span>
                    </button>
                @endif
            </div>
        </div>

        {{-- Scholarship info footer --}}
        <p class="text-center text-xs text-[#AA9A98] mt-6">
            Your application will be reviewed by the scholarship committee. You can track its status on your dashboard.
        </p>

    </div>
</div>
