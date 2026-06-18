<x-layouts::auth.card :title="__('Register')">
    <div class="flex flex-col gap-6" x-data="{ firstName: '', middleName: '', lastName: '', role: 'user' }">
        <!-- User Plus Icon (Logo) -->
        <div class="h-12 w-12 rounded-xl bg-[#1D74E3]/10 flex items-center justify-center border border-[#1D74E3]/25 shadow-sm">
            <flux:icon name="user-plus" class="h-6 w-6 text-[#1D74E3]" />
        </div>

        <!-- Header -->
        <div class="space-y-1">
            <h1 class="text-3xl font-bold font-serif text-[#0F172B]">
                {{ __('Create Account') }}
            </h1>
            <p class="text-sm text-zinc-500">
                {{ __('Register to access barangay scholarship programs') }}
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Hidden Combined Full Name Field for Backend compatibility -->
            <input type="hidden" name="name" :value="[firstName, middleName, lastName].filter(Boolean).join(' ') || 'User'" />

            <!-- First & Last Name Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label class="text-xs font-semibold text-[#0F172B] uppercase tracking-wider">
                        {{ __('Last Name') }} <span class="text-[#F54A00]">*</span>
                    </flux:label>
                    <flux:input
                        x-model="lastName"
                        required
                        placeholder="dela Cruz"
                        class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3]"
                    />
                </flux:field>

                <flux:field>
                    <flux:label class="text-xs font-semibold text-[#0F172B] uppercase tracking-wider">
                        {{ __('First Name') }} <span class="text-[#F54A00]">*</span>
                    </flux:label>
                    <flux:input
                        x-model="firstName"
                        required
                        placeholder="Juan"
                        class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3]"
                    />
                </flux:field>
            </div>

            <!-- Middle Name -->
            <flux:field>
                <flux:label class="text-xs font-semibold text-[#0F172B] uppercase tracking-wider">
                    {{ __('Middle Name') }}
                </flux:label>
                <flux:input
                    x-model="middleName"
                    placeholder="Santos (optional)"
                    class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3]"
                />
            </flux:field>

            <!-- Email Address -->
            <flux:field>
                <flux:label class="text-xs font-semibold text-[#0F172B] uppercase tracking-wider">
                    {{ __('Email Address') }} <span class="text-[#F54A00]">*</span>
                </flux:label>
                <flux:input
                    name="email"
                    :value="old('email')"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="juan@example.com"
                    class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3]"
                />
                <flux:error name="email" />
            </flux:field>

            <!-- Mobile Number -->
            <flux:field>
                <flux:label class="text-xs font-semibold text-[#0F172B] uppercase tracking-wider">
                    {{ __('Mobile Number') }} <span class="text-[#F54A00]">*</span>
                </flux:label>
                <flux:input
                    name="phone"
                    :value="old('phone')"
                    type="tel"
                    required
                    placeholder="0917-XXX-XXXX"
                    class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3]"
                />
                <flux:error name="phone" />
            </flux:field>

            <!-- Account Type (Role Selection) -->
            <flux:field>
                <flux:label class="text-xs font-semibold text-[#0F172B] uppercase tracking-wider mb-2 block">
                    {{ __('Account Type') }} <span class="text-[#F54A00]">*</span>
                </flux:label>
                <input type="hidden" name="role" x-bind:value="role" />
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Resident Button -->
                    <button 
                        type="button" 
                        x-on:click="role = 'user'"
                        x-bind:class="role === 'user' ? 'border-[#1D74E3] bg-[#1D74E3]/5 ring-1 ring-[#1D74E3]' : 'border-zinc-200 bg-white hover:bg-zinc-50'"
                        class="flex items-center gap-3 p-4 rounded-xl border text-left cursor-pointer transition-all duration-200 outline-none"
                    >
                        <flux:icon name="home" x-bind:class="role === 'user' ? 'text-[#1D74E3]' : 'text-zinc-400'" class="h-6 w-6 shrink-0" />
                        <div>
                            <div x-bind:class="role === 'user' ? 'text-[#1D74E3]' : 'text-zinc-800'" class="font-bold text-sm">Resident</div>
                            <div class="text-xs text-zinc-500">Scholar applicant</div>
                        </div>
                    </button>

                    <!-- Official Button -->
                    <button 
                        type="button" 
                        x-on:click="role = 'admin'"
                        x-bind:class="role === 'admin' ? 'border-[#1D74E3] bg-[#1D74E3]/5 ring-1 ring-[#1D74E3]' : 'border-zinc-200 bg-white hover:bg-zinc-50'"
                        class="flex items-center gap-3 p-4 rounded-xl border text-left cursor-pointer transition-all duration-200 outline-none"
                    >
                        <flux:icon name="building-office" x-bind:class="role === 'admin' ? 'text-[#1D74E3]' : 'text-zinc-400'" class="h-6 w-6 shrink-0" />
                        <div>
                            <div x-bind:class="role === 'admin' ? 'text-[#1D74E3]' : 'text-zinc-800'" class="font-bold text-sm">Admin</div>
                            <div class="text-xs text-zinc-500">Barangay staff</div>
                        </div>
                    </button>
                </div>
                <flux:error name="role" />
            </flux:field>

            <!-- Password -->
            <flux:field>
                <flux:label class="text-xs font-semibold text-[#0F172B] uppercase tracking-wider">
                    {{ __('Password') }} <span class="text-[#F54A00]">*</span>
                </flux:label>
                <flux:input
                    name="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="Minimum 8 characters"
                    class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3]"
                    viewable
                />
                <flux:error name="password" />
            </flux:field>

            <!-- Confirm Password -->
            <flux:field>
                <flux:label class="text-xs font-semibold text-[#0F172B] uppercase tracking-wider">
                    {{ __('Confirm Password') }} <span class="text-[#F54A00]">*</span>
                </flux:label>
                <flux:input
                    name="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="Re-enter your password"
                    class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3]"
                    viewable
                />
                <flux:error name="password_confirmation" />
            </flux:field>

            <!-- Terms checkbox -->
            <flux:checkbox
                name="terms"
                required
                :label="__('I agree to the Terms of Service and Privacy Policy of the Barangay San Isidro Scholarship Program')"
                class="text-zinc-600 mt-2"
            />

            <!-- Create Account Button -->
            <flux:button variant="primary" type="submit" icon="user-plus" class="w-full flex flex-row items-center justify-center gap-2 bg-[#12325E] hover:bg-[#12325E]/90 text-white font-medium py-2.5 rounded-lg shadow-sm mt-3" data-test="register-user-button">
                {{ __('Create my account') }}
            </flux:button>
        </form>

        <!-- Footer -->
        <div class="text-center text-sm text-zinc-500 mt-4 border-t border-zinc-100 pt-4">
            <span>{{ __('Already have an account?') }}</span>
            <flux:link :href="route('login')" class="text-[#1D74E3] font-semibold hover:underline" wire:navigate>
                {{ __('Sign in') }}
            </flux:link>
        </div>
    </div>
</x-layouts::auth.card>
