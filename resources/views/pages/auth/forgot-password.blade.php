<x-layouts::auth.card :title="__('Forgot password')">
    <div class="flex flex-col gap-6">
        <x-auth-home-link />

        <!-- Lock Open Icon & Header -->
        <div class="space-y-4">
            <div class="h-12 w-12 rounded-xl bg-[#1D74E3]/10 flex items-center justify-center border border-[#1D74E3]/25 shadow-sm">
                <flux:icon name="lock-open" class="h-6 w-6 text-[#1D74E3]" />
            </div>
            <div class="space-y-1">
                <h1 class="text-3xl font-bold font-serif text-[#0F172B]">
                    {{ __('Reset Password') }}
                </h1>
                <p class="text-sm text-zinc-500">
                    {{ __('Enter your registered email and we\'ll send a password reset link.') }}
                </p>
            </div>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <flux:field>
                <flux:label class="text-xs font-semibold text-[#0F172B] uppercase tracking-wider">
                    {{ __('Email Address') }} <span class="text-[#F54A00]">*</span>
                </flux:label>
                <flux:input
                    name="email"
                    type="email"
                    required
                    autofocus
                    placeholder="you@example.com"
                    class="bg-white border-zinc-300 text-zinc-900 focus:border-[#1D74E3]" />
                <flux:error name="email" />
            </flux:field>

            <!-- Submit Button -->
            <flux:button variant="primary" type="submit" icon="paper-airplane" class="w-full flex flex-row items-center justify-center gap-2 bg-[#12325E] hover:bg-[#12325E]/90 text-white font-medium py-2.5 rounded-lg shadow-sm" data-test="email-password-reset-link-button">
                {{ __('Send Reset Link') }}
            </flux:button>
        </form>

        <!-- Back Link -->
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-xs font-semibold text-zinc-500 hover:text-[#0F172B] inline-flex items-center gap-1" wire:navigate>
                <flux:icon name="arrow-left" class="h-3 w-3" />
                {{ __('Back to Sign In') }}
            </a>
        </div>
    </div>
</x-layouts::auth.card>