<x-layouts::auth.split :title="__('Log in')">
    <div class="flex flex-col gap-6">
        <!-- Title and Description -->
        <div class="space-y-2 text-center lg:text-left">
            <h1 class="text-3xl font-bold font-serif text-[#0F172B]">
                {{ __('Welcome back') }}
            </h1>
            <p class="text-sm text-zinc-500">
                {{ __('Sign in to your account to continue') }}
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
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
                    class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3]"
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
                    class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3]"
                    viewable
                />
                <flux:error name="password" />
                @if (Route::has('password.request'))
                    <div class="flex justify-end mt-1.5">
                        <flux:link class="text-xs text-[#1D74E3] hover:underline" :href="route('password.request')" wire:navigate>
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
        class="h-5 w-5 rounded border border-[#E5E7EB] bg-white shadow-sm text-[#1D74E3] focus:ring-2 focus:ring-[#1D74E3] focus:border-[#1D74E3] cursor-pointer"
        {{ old('remember') ? 'checked' : '' }}
    >

    <label
        for="remember"
        class="text-sm font-medium text-[#0F172B] cursor-pointer select-none"
    >
        Remember me
    </label>
</div>
            <!-- Buttons -->
            <div class="flex flex-col gap-3">
                <flux:button variant="primary" type="submit" class="w-full flex flex-row items-center justify-center gap-2 bg-[#12325E] hover:bg-[#12325E]/90 text-white font-medium py-2.5 rounded-lg shadow-sm" data-test="login-button">
                    {{ __('Sign In') }}
                </flux:button>
            </div>
        </form>

        <!-- Create Account Footer -->
        <div class="text-center text-sm text-zinc-500">
            <span>{{ __('Don\'t have an account?') }}</span>
            <flux:link :href="route('register')" class="text-[#1D74E3] font-semibold hover:underline" wire:navigate>
                {{ __('Create one here') }}
            </flux:link>
        </div>
    </div>
</x-layouts::auth.split>
