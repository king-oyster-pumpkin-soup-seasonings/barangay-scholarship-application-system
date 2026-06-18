<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-[#F8FAFC] antialiased text-[#1B1A1C] auth-page">
        <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-sm flex-col gap-4">
                <!-- Branding Header -->
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#12325E] shadow-sm">
                        <x-app-logo-icon class="h-6 w-6 text-white" />
                    </span>
                    <span class="text-xl font-bold tracking-tight text-[#0F172B] font-serif">Iskolar iApply</span>
                </a>
                
                <!-- Main Slot -->
                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        <x-accessibility-widget />

        @fluxScripts
    </body>
</html>
