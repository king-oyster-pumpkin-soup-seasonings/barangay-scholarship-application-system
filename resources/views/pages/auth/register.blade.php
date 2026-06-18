<x-layouts::auth.card :title="__('Register')">
    <div class="flex flex-col gap-6" x-data="{ firstName: '', middleName: '', lastName: '' }">
        <!-- User Plus Icon (Logo) -->
<<<<<<< HEAD
<<<<<<< HEAD
        <div
            class="h-12 w-12 rounded-xl bg-[#1D74E3]/10 flex items-center justify-center border border-[#1D74E3]/25 shadow-sm">
            <flux:icon name="user-plus" class="h-6 w-6 text-[#1D74E3]" />
=======
=======
>>>>>>> d0ad4c9d553fd6d23882e88791d5137b87cccb31
        <div class="h-12 w-12 rounded-xl bg-[#1D74E3]/10 flex items-center justify-center border border-[#1D74E3]/25 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-[#1D74E3]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
            </svg>
<<<<<<< HEAD
>>>>>>> main
=======
>>>>>>> d0ad4c9d553fd6d23882e88791d5137b87cccb31
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
<<<<<<< HEAD
<<<<<<< HEAD
                    </flux:label>
                    <flux:input x-model="lastName" required placeholder="dela Cruz" {{-- Letters, spaces, hyphens, and apostrophes only (handles compound surnames) --}}
                        pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s'\-]{1,50}"
                        title="Last name may only contain letters, spaces, hyphens, and apostrophes (max 50 characters)"
                        maxlength="50" autocomplete="family-name"
                        x-on:input="lastName = $event.target.value.replace(/[^A-Za-zÀ-ÖØ-öø-ÿ\s'\-]/g, '')"
                        class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3]" />
                </flux:field>
=======
=======
>>>>>>> d0ad4c9d553fd6d23882e88791d5137b87cccb31
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
<<<<<<< HEAD
>>>>>>> main
=======
>>>>>>> d0ad4c9d553fd6d23882e88791d5137b87cccb31

                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                        {{ __('First Name') }} <span class="text-[#F54A00]">*</span>
<<<<<<< HEAD
<<<<<<< HEAD
                    </flux:label>
                    <flux:input x-model="firstName" required placeholder="Juan" {{-- Letters, spaces, hyphens, and apostrophes only --}}
                        pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s'\-]{1,50}"
                        title="First name may only contain letters, spaces, hyphens, and apostrophes (max 50 characters)"
                        maxlength="50" autocomplete="given-name"
                        x-on:input="firstName = $event.target.value.replace(/[^A-Za-zÀ-ÖØ-öø-ÿ\s'\-]/g, '')"
                        class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3]" />
                </flux:field>
=======
=======
>>>>>>> d0ad4c9d553fd6d23882e88791d5137b87cccb31
                    </label>
                    <input
                        type="text"
                        x-model="firstName"
                        required
                        placeholder="Juan"
                        class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition"
                    />
                </div>
<<<<<<< HEAD
>>>>>>> main
=======
>>>>>>> d0ad4c9d553fd6d23882e88791d5137b87cccb31
            </div>

            <!-- Middle Name -->
            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                    {{ __('Middle Name') }}
<<<<<<< HEAD
<<<<<<< HEAD
                </flux:label>
                <flux:input x-model="middleName" placeholder="Santos (optional)" {{-- Same rules as name fields, but optional --}}
                    pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s'\-]{0,50}"
                    title="Middle name may only contain letters, spaces, hyphens, and apostrophes (max 50 characters)"
                    maxlength="50" autocomplete="additional-name"
                    x-on:input="middleName = $event.target.value.replace(/[^A-Za-zÀ-ÖØ-öø-ÿ\s'\-]/g, '')"
                    class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3]" />
            </flux:field>

            <!-- Email Address -->
            <flux:field>
                <flux:label class="text-xs font-semibold text-[#0F172B] uppercase tracking-wider">
                    {{ __('Email Address') }} <span class="text-[#F54A00]">*</span>
                </flux:label>
                <flux:input name="email" :value="old('email')" type="email" required autocomplete="email"
                    placeholder="juan@gmail.com" {{--
                        Accepts common Philippine/global email providers:
                        gmail, yahoo, outlook, hotmail, live, icloud, proton,
                        deped.gov.ph, ched.gov.ph, and general .com/.net/.org/.edu/.ph domains.
                        Rejects obviously invalid TLDs and typo domains (e.g. gmial, yaho).
                    --}}
                    pattern="^[a-zA-Z0-9._%+\-]+@(gmail|yahoo|outlook|hotmail|live|icloud|proton|protonmail|me|mac|googlemail|ymail|rocketmail)\.(com|ph|co\.ph|net|org)$|^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9\-]+\.(gov\.ph|edu\.ph|com\.ph|org\.ph|net\.ph|com|net|org|edu|ph)$"
                    title="Enter a valid email address from a recognised provider (e.g. gmail.com, yahoo.com, outlook.com, deped.gov.ph)"
                    maxlength="254" class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3]" />
                <flux:error name="email" />
            </flux:field>

            <!-- Mobile Number -->
            <flux:field>
                <flux:label class="text-xs font-semibold text-[#0F172B] uppercase tracking-wider">
                    {{ __('Mobile Number') }} <span class="text-[#F54A00]">*</span>
                </flux:label>
                <flux:input name="phone" :value="old('phone')" type="tel" required placeholder="09171234567"
                    {{--
                        Philippine mobile numbers:
                        - 11-digit format starting with 09 (e.g. 09171234567)
                        - or +63 country code followed by 10 digits (e.g. +639171234567)
                    --}} pattern="^(09|\+639)\d{9}$"
                    title="Enter a valid Philippine mobile number (e.g. 09171234567 or +639171234567)" maxlength="13"
                    x-on:input="$event.target.value = $event.target.value.replace(/[^0-9+]/g, '')"
                    class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3]" />
                <flux:error name="phone" />
            </flux:field>

            <!-- Role is always 'user' for public registration -->
            <input type="hidden" name="role" value="user" />

            <!-- Password -->
            <flux:field x-data="{ showPassword: false }">
                <flux:label class="text-xs font-semibold text-[#0F172B] uppercase tracking-wider">
                    {{ __('Password') }} <span class="text-[#F54A00]">*</span>
                </flux:label>

                <flux:input name="password" ::type="showPassword ? 'text' : 'password'" required
                    autocomplete="new-password" placeholder="Minimum 8 characters"
                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':&quot;\\|,.<>\/?]).{8,72}$"
                    title="Password must be 8–72 characters and include at least one uppercase letter, one lowercase letter, one number, and one special character"
                    minlength="8" maxlength="72"
                    class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3] w-full">
                    <x-slot:icon-trailing>
                        <button type="button" @click="showPassword = !showPassword"
                            class="text-zinc-400 hover:text-zinc-600 transition-colors focus:outline-none flex items-center justify-center">
                            <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <svg x-show="showPassword" x-cloak xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </x-slot:icon-trailing>
                </flux:input>
                <flux:error name="password" />
            </flux:field>

            <flux:field x-data="{ showConfirmPassword: false }">
                <flux:label class="text-xs font-semibold text-[#0F172B] uppercase tracking-wider">
                    {{ __('Confirm Password') }} <span class="text-[#F54A00]">*</span>
                </flux:label>

                <flux:input name="password_confirmation" ::type="showConfirmPassword ? 'text' : 'password'" required
                    autocomplete="new-password" placeholder="Re-enter your password" minlength="8" maxlength="72"
                    class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3] w-full">
                    <x-slot:icon-trailing>
                        <button type="button" @click="showConfirmPassword = !showConfirmPassword"
                            class="text-zinc-400 hover:text-zinc-600 transition-colors focus:outline-none flex items-center justify-center">
                            <svg x-show="!showConfirmPassword" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <svg x-show="showConfirmPassword" x-cloak xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </x-slot:icon-trailing>
                </flux:input>
                <flux:error name="password_confirmation" />
            </flux:field>

            <!-- Terms checkbox -->
            <flux:checkbox name="terms" required
                :label="__('I agree to the Terms of Service and Privacy Policy of the Barangay San Isidro Scholarship Program')"
                class="text-zinc-600 mt-2" />

            <!-- Create Account Button -->
            <flux:button variant="primary" type="submit" icon="user-plus"
                class="w-full flex flex-row items-center justify-center gap-2 bg-[#12325E] hover:bg-[#12325E]/90 text-white font-medium py-2.5 rounded-lg shadow-sm mt-3"
                data-test="register-user-button">
=======
=======
>>>>>>> d0ad4c9d553fd6d23882e88791d5137b87cccb31
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
                        placeholder="0917-XXX-XXXX"
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

            <!-- Account Type (Role Selection) -->
            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider mb-2 block">
                    {{ __('Account Type') }} <span class="text-[#F54A00]">*</span>
                </label>
                <input type="hidden" name="role" x-bind:value="role" />
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Resident Button -->
                    <button
                        type="button"
                        x-on:click="role = 'user'"
                        x-bind:class="role === 'user' ? 'border-[#1D74E3] bg-[#1D74E3]/5 ring-1 ring-[#1D74E3]' : 'border-zinc-200 bg-white hover:bg-zinc-50'"
                        class="flex items-center gap-3 p-4 rounded-xl border text-left cursor-pointer transition-all duration-200 outline-none"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" x-bind:class="role === 'user' ? 'text-[#1D74E3]' : 'text-zinc-400'" class="h-6 w-6 shrink-0 transition-colors duration-200">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <div>
                            <div x-bind:class="role === 'user' ? 'text-[#1D74E3]' : 'text-zinc-800'" class="font-bold text-sm">Resident</div>
                            <div class="text-xs text-[#AA9A98]">Scholar applicant</div>
                        </div>
                    </button>

                    <!-- Official Button -->
                    <button
                        type="button"
                        x-on:click="role = 'admin'"
                        x-bind:class="role === 'admin' ? 'border-[#1D74E3] bg-[#1D74E3]/5 ring-1 ring-[#1D74E3]' : 'border-zinc-200 bg-white hover:bg-zinc-50'"
                        class="flex items-center gap-3 p-4 rounded-xl border text-left cursor-pointer transition-all duration-200 outline-none"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" x-bind:class="role === 'admin' ? 'text-[#1D74E3]' : 'text-zinc-400'" class="h-6 w-6 shrink-0 transition-colors duration-200">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                        </svg>
                        <div>
                            <div x-bind:class="role === 'admin' ? 'text-[#1D74E3]' : 'text-zinc-800'" class="font-bold text-sm">Admin</div>
                            <div class="text-xs text-[#AA9A98]">Barangay staff</div>
                        </div>
                    </button>
                </div>
                @error('role')
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
<<<<<<< HEAD
>>>>>>> main
=======
                
>>>>>>> d0ad4c9d553fd6d23882e88791d5137b87cccb31
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
