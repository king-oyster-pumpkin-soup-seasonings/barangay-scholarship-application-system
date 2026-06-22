<x-layouts::auth.card :title="__('Register')">
    <div class="flex flex-col gap-6" x-data="{
        firstName: '',
        middleName: '',
        lastName: '',
        email: @js(old('email', '')),
        birthdate: @js(old('birthdate', '')),
        age: @js(old('age', '')),
        showPassword: false,
        showConfirmPassword: false,
        isDirty: false,
        isSubmitting: false,
        init() {
            window.addEventListener('beforeunload', (event) => {
                if (!this.isDirty) return;

                event.preventDefault();
                event.returnValue = '';
            });

            if (this.birthdate && !this.age) {
                this.calculateAge();
            }
        },
        calculateAge() {
            if (!this.birthdate) {
                this.age = '';

                return;
            }

            const today = new Date();
            const dateOfBirth = new Date(this.birthdate + 'T00:00:00');
            let calculatedAge = today.getFullYear() - dateOfBirth.getFullYear();
            const monthDifference = today.getMonth() - dateOfBirth.getMonth();

            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dateOfBirth.getDate())) {
                calculatedAge--;
            }

            this.age = calculatedAge >= 0 ? calculatedAge.toString() : '';
        },
        updateBirthdateFromAge() {
            this.age = this.age.replace(/[^0-9]/g, '').slice(0, 3);

            if (!this.birthdate || !this.age) {
                return;
            }

            const desiredAge = parseInt(this.age, 10);

            if (Number.isNaN(desiredAge)) {
                return;
            }

            const today = new Date();
            const currentBirthdate = new Date(this.birthdate + 'T00:00:00');
            const birthMonth = currentBirthdate.getMonth();
            const birthDay = currentBirthdate.getDate();
            const birthdayHasPassedThisYear = birthMonth < today.getMonth()
                || (birthMonth === today.getMonth() && birthDay <= today.getDate());

            let birthYear = today.getFullYear() - desiredAge;

            if (!birthdayHasPassedThisYear) {
                birthYear--;
            }

            const daysInTargetMonth = new Date(birthYear, birthMonth + 1, 0).getDate();
            const safeBirthDay = Math.min(birthDay, daysInTargetMonth);
            const adjustedBirthdate = new Date(birthYear, birthMonth, safeBirthDay);

            this.birthdate = this.formatDate(adjustedBirthdate);
        },
        formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');

            return `${year}-${month}-${day}`;
        },
    }">

        <x-auth-home-link />

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

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-5" @input="isDirty = true" @change="isDirty = true" @submit="isSubmitting = true; isDirty = false">
            @csrf

            <!-- Hidden Combined Full Name Field for Backend compatibility -->
            <input type="hidden" name="name"
                :value="[firstName, middleName, lastName].filter(Boolean).join(' ') || 'User'" />

            <!-- Last Name & First Name Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                        {{ __('Last Name') }} <span class="text-[#F54A00]">*</span>
                    </label>
                    <input
                        type="text"
                        x-model="lastName"
                        @input="lastName = $event.target.value.replace(/[^a-zA-ZÀ-ÿñÑ\s\-']/g, '')"
                        title="{{ __('Only letters, spaces, hyphens, and apostrophes are allowed') }}"
                        required
                        placeholder="Dela Cruz"
                        class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition" />
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
                        @input="firstName = $event.target.value.replace(/[^a-zA-ZÀ-ÿñÑ\s\-']/g, '')"
                        title="{{ __('Only letters, spaces, hyphens, and apostrophes are allowed') }}"
                        required
                        placeholder="Juan"
                        class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition" />
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
                    @input="middleName = $event.target.value.replace(/[^a-zA-ZÀ-ÿñÑ\s\-']/g, '')"
                    title="{{ __('Only letters, spaces, hyphens, and apostrophes are allowed') }}"
                    placeholder="Santos (optional)"
                    class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition" />
            </div>

            <!-- Email Address & Phone Number Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                        {{ __('Email Address') }} <span class="text-[#F54A00]">*</span>
                    </label>
                    <input
                        name="email"
                        type="email"
                        x-model="email"
                        @input="email = email.replace(/[^A-Za-z0-9@._\-+]/g, '')"
                        pattern="^[a-zA-Z0-9._%+\-]+@(gmail|outlook|yahoo)\.com$"
                        title="{{ __('Please enter a valid Gmail, Outlook, or Yahoo email address.') }}"
                        required
                        autocomplete="email"
                        placeholder="juan@gmail.com"
                        class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition" />
                    @error('email')
                    <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1.5" x-data="{ phone: '{{ old('phone', '') }}' }">
                    <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                        {{ __('Mobile Number') }} <span class="text-[#F54A00]">*</span>
                    </label>
                    <input
                        name="phone"
                        x-model="phone"
                        @input="phone = phone.replace(/[^0-9]/g, '')"
                        type="tel"
                        pattern="09[0-9]{9}"
                        maxlength="11"
                        title="{{ __('Please enter a valid 11-digit Philippine mobile number starting with 09 (e.g., 09171234567)') }}"
                        required
                        placeholder="09171234567"
                        class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition" />
                    @error('phone')
                    <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Birthdate, Age, Gender & Pronouns Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                        {{ __('Date of Birth') }} <span class="text-[#F54A00]">*</span>
                    </label>
                    <input
                        name="birthdate"
                        x-model="birthdate"
                        @change="calculateAge()"
                        type="date"
                        required
                        max="{{ date('Y-m-d') }}"
                        onclick="this.showPicker()"
                        class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition cursor-pointer" />
                    @error('birthdate')
                    <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                        {{ __('Age') }} <span class="text-[#F54A00]">*</span>
                    </label>
                    <input
                        name="age"
                        x-model="age"
                        @input="age = $event.target.value.replace(/[^0-9]/g, '').slice(0, 3); updateBirthdateFromAge()"
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9]+"
                        min="18"
                        max="120"
                        maxlength="3"
                        required
                        x-bind:disabled="!birthdate"
                        x-bind:placeholder="birthdate ? '18' : '{{ __('Select birthdate first') }}'"
                        title="{{ __('Select your date of birth first. Changing age will adjust the birth year automatically.') }}"
                        class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition disabled:bg-zinc-100 disabled:text-zinc-500 disabled:cursor-not-allowed disabled:opacity-80" />
                    @error('age')
                    <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                        {{ __('Gender') }} <span class="text-[#F54A00]">*</span>
                    </label>
                    <select
                        name="gender"
                        required
                        class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition">
                        <option value="" disabled {{ old('gender') ? '' : 'selected' }}>{{ __('Select Gender') }}</option>
                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                        <option value="non_binary" {{ old('gender') === 'non_binary' ? 'selected' : '' }}>{{ __('Non-binary') }}</option>
                        <option value="prefer_not_to_say" {{ old('gender') === 'prefer_not_to_say' ? 'selected' : '' }}>{{ __('Prefer not to say') }}</option>
                    </select>
                    @error('gender')
                    <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                        {{ __('Pronouns') }} <span class="text-[#F54A00]">*</span>
                    </label>
                    <select
                        name="pronouns"
                        required
                        class="w-full rounded-xl border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition">
                        <option value="" disabled {{ old('pronouns') ? '' : 'selected' }}>{{ __('Select Pronouns') }}</option>
                        <option value="he_him" {{ old('pronouns') === 'he_him' ? 'selected' : '' }}>{{ __('He/Him') }}</option>
                        <option value="she_her" {{ old('pronouns') === 'she_her' ? 'selected' : '' }}>{{ __('She/Her') }}</option>
                        <option value="they_them" {{ old('pronouns') === 'they_them' ? 'selected' : '' }}>{{ __('They/Them') }}</option>
                        <option value="prefer_not_to_say" {{ old('pronouns') === 'prefer_not_to_say' ? 'selected' : '' }}>{{ __('Prefer not to say') }}</option>
                    </select>
                    @error('pronouns')
                    <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Password & Confirm Password Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" x-data="{
                showPassword: false,
                showConfirmPassword: false,
                password: '',
                get hasUpper() { return /[A-Z]/.test(this.password) },
                get hasLower() { return /[a-z]/.test(this.password) },
                get hasNumber() { return /[0-9]/.test(this.password) },
                get hasSpecial() { return /[^A-Za-z0-9]/.test(this.password) },
                get hasLength() { return this.password.length >= 8 },
                get avoidsPersonalInfo() {
                    const password = this.password.toLowerCase();
                    const restricted = [firstName, middleName, lastName, email, email.split('@')[0]]
                        .filter(Boolean)
                        .flatMap(value => value.toLowerCase().split(/\s+/))
                        .filter(value => value.length >= 3);

                    return !restricted.some(value => password.includes(value));
                },
                get score() { return [this.hasUpper, this.hasLower, this.hasNumber, this.hasSpecial, this.hasLength, this.avoidsPersonalInfo].filter(Boolean).length },
                get barColor() {
                    if (this.score <= 2) return '#ef4444';
                    if (this.score === 3) return '#f97316';
                    if (this.score === 4) return '#eab308';
                    return '#16a34a';
                },
                get strengthLabel() {
                    const labels = ['', 'Weak', 'Fair', 'Good', 'Strong'];
                    return this.score > 0 ? labels[Math.min(this.score, 4)] : '';
                }
            }">

                {{-- Password --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                        {{ __('Password') }} <span class="text-[#F54A00]">*</span>
                    </label>
                    <div class="relative w-full">
                        <input name="password" :type="showPassword ? 'text' : 'password'" x-model="password" required
                            autocomplete="new-password" placeholder="Min. 8 characters"
                            class="w-full rounded-xl border border-zinc-300 bg-white pl-3.5 pr-11 py-2.5 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition" />
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-zinc-400 hover:text-zinc-600 transition focus:outline-none">
                            {{-- eye icon (same SVGs as before) --}}
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
                    </div>

                    {{-- Strength bars --}}
                    <div x-show="password.length > 0" class="grid grid-cols-4 gap-1 mt-1">
                        <template x-for="i in 4">
                            <div class="h-1 rounded-full transition-all duration-300"
                                :style="i <= score ? `background:${barColor}` : 'background:#e4e4e7'">
                            </div>
                        </template>
                    </div>

                    {{-- Strength label --}}
                    <p x-show="password.length > 0" class="text-xs font-medium transition-colors duration-300"
                        :style="`color:${barColor}`" x-text="'Strength: ' + strengthLabel">
                    </p>

                    {{-- Requirements checklist --}}
                    <ul x-show="password.length > 0" class="mt-1 space-y-0.5">
                        <template
                            x-for="[met, label] in [
                [hasUpper,  'Uppercase letter'],
                [hasLower,  'Lowercase letter'],
                [hasNumber, 'Number'],
                [hasSpecial,'Special character (!@#$...)'],
                [hasLength, 'At least 8 characters'],
                [avoidsPersonalInfo, 'Does not include your name or email']
            ]">
                            <li class="flex items-center gap-1.5 text-xs transition-colors duration-200"
                                :class="met ? 'text-green-600' : 'text-zinc-400'">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path x-show="met" stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    <path x-show="!met" stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.75 9.75l4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span x-text="label"></span>
                            </li>
                        </template>
                    </ul>

                    @error('password')
                    <p class="mt-1 text-xs text-red-600 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-semibold text-[#33333B] uppercase tracking-wider">
                        {{ __('Confirm Password') }} <span class="text-[#F54A00]">*</span>
                    </label>
                    <div class="relative w-full">
                        <input name="password_confirmation" :type="showConfirmPassword ? 'text' : 'password'" required
                            autocomplete="new-password" placeholder="Re-enter password"
                            class="w-full rounded-xl border border-zinc-300 bg-white pl-3.5 pr-11 py-2.5 text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-[#1D74E3] focus:border-transparent transition" />
                        <button type="button" @click="showConfirmPassword = !showConfirmPassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-zinc-400 hover:text-zinc-600 transition focus:outline-none">
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
                    </div>
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
                    class="mt-1 h-4 w-4 rounded border-zinc-300 text-[#1D74E3] focus:ring-[#1D74E3]" />
                <label for="terms" class="text-xs text-zinc-600 select-none">
                    {{ __('I agree to the Terms of Service and Privacy Policy of the Barangay San Isidro Scholarship Program') }}
                </label>
            </div>

            <!-- Create Account Button -->
            <button type="submit" x-bind:disabled="isSubmitting" class="w-full flex flex-row items-center justify-center gap-2 bg-[#1D74E3] hover:bg-[#1D74E3]/90 text-white font-medium py-2.5 rounded-lg shadow-sm mt-3 transition cursor-pointer disabled:cursor-not-allowed disabled:opacity-70" data-test="register-user-button">
                <svg x-show="!isSubmitting" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>
                <svg x-show="isSubmitting" x-cloak class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                </svg>
                <span x-text="isSubmitting ? '{{ __('Creating account...') }}' : '{{ __('Create my account') }}'"></span>
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