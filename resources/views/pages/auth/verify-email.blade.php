<x-layouts::auth.card :title="__('Email verification')">
    <div class="flex flex-col gap-6">
        <!-- Envelope Open Icon & Header -->
        <div class="space-y-4">
            <div class="h-12 w-12 rounded-xl bg-[#1D74E3]/10 flex items-center justify-center border border-[#1D74E3]/25 shadow-sm">
                <flux:icon name="envelope-open" class="h-6 w-6 text-[#1D74E3]" />
            </div>
            <div class="space-y-1">
                <h1 class="text-3xl font-bold font-serif text-[#0F172B]">
                    {{ __('Verify Email') }}
                </h1>
                <p class="text-sm text-zinc-500">
                    {{ __('Please verify your email address by clicking on the link we just emailed to you.') }}
                </p>
            </div>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="p-3 bg-[#00BC7D]/10 border border-[#00BC7D]/25 rounded-lg text-sm text-[#00BC7D] font-medium text-center">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="flex flex-col gap-3">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <flux:button type="submit" variant="primary" icon="arrow-path" class="w-full flex flex-row items-center justify-center gap-2 bg-[#1D74E3] hover:bg-[#1D74E3]/90 text-white font-medium py-2.5 rounded-lg shadow-sm">
                    {{ __('Resend verification email') }}
                </flux:button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:button variant="ghost" type="submit" class="w-full text-sm font-semibold text-zinc-500 hover:text-[#0F172B] py-2.5 rounded-lg cursor-pointer" data-test="logout-button">
                    {{ __('Log out') }}
                </flux:button>
            </form>
        </div>
    </div>
</x-layouts::auth.card>
