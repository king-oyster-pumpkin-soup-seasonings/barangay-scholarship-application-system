<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-[#12325E] antialiased text-[#1B1A1C] auth-page">
    <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
        <div class="flex w-full max-w-lg flex-col gap-6">
            <!-- Branding Header -->
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/10 backdrop-blur-md border border-white/20">
                    <x-app-logo-icon class="h-6 w-6 text-white" />
                </span>
                <span class="text-xl font-bold tracking-tight text-white font-serif">BRGY 587: Iskolar iApply</span>
            </a>

            <!-- Card Content -->
            <div class="bg-white rounded-2xl shadow-xl">
                <div class="px-6 py-8 sm:px-10 sm:py-10">
                    {{ $slot }}
                </div>
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