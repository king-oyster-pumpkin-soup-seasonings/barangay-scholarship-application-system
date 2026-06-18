<x-layouts::auth.card :title="__('Register')">
    <div class="flex flex-col gap-6" x-data="{ firstName: '', middleName: '', lastName: '' }">
        <!-- User Plus Icon (Logo) -->
        <div class="h-12 w-12 rounded-xl bg-[#1D74E3]/10 flex items-center justify-center border border-[#1D74E3]/25 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-[#1D74E3]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
            </svg>
        </div>

        <!-- Header -->
        <div class="space-y-1">
            <h1 class="text-3xl font-bold font-serif text-[#33333B]">
                {{ __('Create Account') }}
            </h1>
            <p class="text-sm text-[#AA9A98]">
                {{ __('Register to access barangay scholarship programs') }}
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Hidden Combined Full Name Field for Backend compatibility -->
            <input type="hidden" name="name"
                :value="[firstName, middleName, lastName].filter(Boolean).join(' ') || 'User'" />

            <!-- First & Last Name Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                        {{ __('Last Name') }} <span class="text-[#F54A00]">*</span>
                    </label>
                    <input
                        type="text"
                        x-model="lastName"
                        required
                        placeholder="dela Cruz"
                        class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition"
                    />
                    @error('name')
                        <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                        {{ __('First Name') }} <span class="text-[#F54A00]">*</span>
                    </label>
                    <input
                        type="text"
                        x-model="firstName"
                        required
                        placeholder="Juan"
                        class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition"
                    />
                </div>
            </div>

            <!-- Middle Name -->
            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                    {{ __('Middle Name') }}
                </label>
                <input
                    type="text"
                    x-model="middleName"
                    placeholder="Santos (optional)"
                    class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition"
                />
            </div>

            <!-- Email Address & Phone Number Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                        {{ __('Email Address') }} <span class="text-[#F54A00]">*</span>
                    </label>
                    <input
                        name="email"
                        value="{{ old('email') }}"
                        type="email"
                        required
                        autocomplete="email"
                        placeholder="juan@example.com"
                        class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition"
                    />
                    @error('email')
                        <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                        {{ __('Mobile Number') }} <span class="text-[#F54A00]">*</span>
                    </label>
                    <input
                        name="phone"
                        value="{{ old('phone') }}"
                        type="tel"
                        required
                        placeholder="09171234567"
                        class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition"
                    />
                    @error('phone')
                        <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Birthdate & Sex Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                        {{ __('Birthdate') }} <span class="text-[#F54A00]">*</span>
                    </label>
                    <input
                        name="birthdate"
                        value="{{ old('birthdate') }}"
                        type="date"
                        required
                        class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition"
                    />
                    @error('birthdate')
                        <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                        {{ __('Sex') }} <span class="text-[#F54A00]">*</span>
                    </label>
                    <select
                        name="sex"
                        required
                        class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition"
                    >
                        <option value="" disabled {{ old('sex') ? '' : 'selected' }}>{{ __('Select Sex') }}</option>
                        <option value="male" {{ old('sex') === 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                        <option value="female" {{ old('sex') === 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                    </select>
                    @error('sex')
                        <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Address -->
            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                    {{ __('Address') }} <span class="text-[#F54A00]">*</span>
                </label>
                <input
                    name="address"
                    value="{{ old('address') }}"
                    type="text"
                    required
                    placeholder="House No., Street, Barangay, Quezon City"
                    class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition"
                />
                @error('address')
                    <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password & Confirm Password Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                        {{ __('Password') }} <span class="text-[#F54A00]">*</span>
                    </label>
                    <input
                        name="password"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="Min. 8 characters"
                        class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition"
                    />
                    @error('password')
                        <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                        {{ __('Confirm Password') }} <span class="text-[#F54A00]">*</span>
                    </label>
                    <input
                        name="password_confirmation"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="Re-enter password"
                        class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition"
                    />
                    @error('password_confirmation')
                        <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Terms checkbox -->
            <div class="flex items-start gap-3 mt-2">
                <input
                    type="checkbox"
                    name="terms"
                    id="terms"
                    required
                    class="mt-1 h-4 w-4 rounded border-zinc-300 text-[#1D74E3] focus:ring-[#1D74E3]"
                />
                <label for="terms" class="text-xs text-zinc-600 select-none">
                    {{ __('I agree to the Terms of Service and Privacy Policy of the Barangay San Isidro Scholarship Program') }}
                </label>
            </div>

            <!-- Create Account Button -->
            <button type="submit" class="w-full flex flex-row items-center justify-center gap-2 bg-[#1D74E3] hover:bg-[#1D74E3]/90 text-white font-medium py-2.5 rounded-lg shadow-sm mt-3 transition cursor-pointer" data-test="register-user-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>
                {{ __('Create my account') }}
            </button>
        </form>

        <!-- Footer -->
        <div class="text-center text-sm text-zinc-500 mt-4 border-t border-zinc-100 pt-4">
            <span>{{ __('Already have an account?') }}</span>
            <a href="{{ route('login') }}" class="text-[#1D74E3] font-semibold hover:underline" wire:navigate>
                {{ __('Sign in') }}
            </a>
        </div>
    </div>
</x-layouts::auth.card>
