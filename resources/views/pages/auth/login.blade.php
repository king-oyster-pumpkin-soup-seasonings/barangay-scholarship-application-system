<x-layouts::auth.split :title="__('Log in')">
    <div class="flex flex-col gap-5 px-1 sm:px-0 w-full max-w-sm mx-auto">

        <!-- Title and Description -->
        <div class="space-y-1.5 text-center lg:text-left">
            <h1 class="text-2xl sm:text-3xl font-bold font-serif text-[#0F172B] leading-tight">
                {{ __('Welcome back') }}
            </h1>
            <p class="text-sm text-zinc-500">
                {{ __('Sign in to your account to continue') }}
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        @if (session('error'))
            <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

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
                    autofocus
                    autocomplete="email"
                    placeholder="you@example.com"
                    class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3] text-base min-h-[44px]"
                />
                <flux:error name="email" />
            </flux:field>

            <!-- Password -->
            <flux:field>
                <div class="flex justify-between items-center mb-1">
                    <flux:label class="text-xs font-semibold text-[#0F172B] uppercase tracking-wider">
                        {{ __('Password') }} <span class="text-[#F54A00]">*</span>
                    </flux:label>
                </div>
                <flux:input
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="Enter your password"
                    class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3] text-base min-h-[44px]"
                    viewable
                />
                <flux:error name="password" />
                @if (Route::has('password.request'))
                    <div class="flex justify-end mt-2">
                        <flux:link
                            class="text-xs text-[#1D74E3] hover:underline py-1 -my-1"
                            :href="route('password.request')"
                            wire:navigate
                        >
                            {{ __('Forgot password?') }}
                        </flux:link>
                    </div>
                @endif
            </flux:field>

            <!-- Remember Me -->
            <div class="flex items-center gap-3">
                <input
                    type="checkbox"
                    name="remember"
                    id="remember"
                    class="h-5 w-5 rounded border border-[#E5E7EB] bg-white shadow-sm text-[#1D74E3]
                           focus:ring-2 focus:ring-[#1D74E3] focus:border-[#1D74E3] cursor-pointer
                           flex-shrink-0"
                    {{ old('remember') ? 'checked' : '' }}
                >
                <label
                    for="remember"
                    class="text-sm font-medium text-[#0F172B] cursor-pointer select-none leading-snug"
                >
                    {{ __('Remember me') }}
                </label>
            </div>

            <!-- Submit Button -->
            <flux:button
                variant="primary"
                type="submit"
                class="w-full flex flex-row items-center justify-center gap-2
                       bg-[#12325E] hover:bg-[#12325E]/90 active:bg-[#12325E]/80
                       text-white font-medium py-3 min-h-[48px] rounded-lg shadow-sm
                       transition-colors duration-150"
                data-test="login-button"
            >
                {{ __('Sign In') }}
            </flux:button>
        </form>

        <!-- Create Account Footer -->
        <div class="text-center text-sm text-zinc-500 pb-safe">
            <span>{{ __("Don't have an account?") }}</span>
            <flux:link
                :href="route('register')"
                class="text-[#1D74E3] font-semibold hover:underline ml-1"
                wire:navigate
            >
                {{ __('Create one here') }}
            </flux:link>
        </div>
    </div>
</x-layouts::auth.split>
