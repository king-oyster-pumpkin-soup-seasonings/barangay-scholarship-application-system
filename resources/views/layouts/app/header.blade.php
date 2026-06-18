<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
        {{-- ── Clean Top Horizontal Navbar ── --}}
        <header class="sticky top-0 z-40 w-full border-b border-[#E5E8EF] bg-white dark:bg-[#1B1A1C] dark:border-zinc-800 px-6 py-4 shadow-sm transition-all duration-300">
            <div class="mx-auto flex max-w-7xl items-center justify-between">

                {{-- Left Side: Brand Logo & Title --}}
                <div class="flex items-center space-x-3">
                    @auth
                        @if (auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
                            <x-app-logo href="{{ route('admin.dashboard') }}" wire:navigate />
                        @else
                            <x-app-logo href="{{ route('dashboard') }}" wire:navigate />
                        @endif
                    @else
                        <x-app-logo href="{{ route('home') }}" wire:navigate />
                    @endauth
                </div>

                {{-- Center Side: Navigation Menu Links --}}
                <nav class="hidden items-center space-x-1 md:flex">
                    @auth
                        @if (auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
                            {{-- 🔒 ADMIN LINKS --}}
                            <a href="{{ route('admin.dashboard') }}" wire:navigate
                               class="text-xs lg:text-sm px-2 lg:px-3.5 py-2 rounded-lg transition-all duration-200
                                      {{ request()->routeIs('admin.dashboard') ? 'text-[#1D74E3] bg-[#1D74E3]/10 font-bold' : 'text-[#33333B] hover:bg-[#E5E8EF]/50 hover:text-[#1D74E3] dark:text-zinc-300 dark:hover:bg-white/10 dark:hover:text-[#1D74E3] font-medium' }}">
                                {{ __('Dashboard') }}
                            </a>
                            <a href="{{ route('admin.applications') }}" wire:navigate
                               class="text-xs lg:text-sm px-2 lg:px-3.5 py-2 rounded-lg transition-all duration-200
                                      {{ request()->routeIs('admin.applications') ? 'text-[#1D74E3] bg-[#1D74E3]/10 font-bold' : 'text-[#33333B] hover:bg-[#E5E8EF]/50 hover:text-[#1D74E3] dark:text-zinc-300 dark:hover:bg-white/10 dark:hover:text-[#1D74E3] font-medium' }}">
                                {{ __('Scholarship Applications') }}
                            </a>
                            <a href="{{ route('admin.scholarships') }}" wire:navigate
                               class="text-xs lg:text-sm px-2 lg:px-3.5 py-2 rounded-lg transition-all duration-200
                                      {{ request()->routeIs('admin.scholarships') ? 'text-[#1D74E3] bg-[#1D74E3]/10 font-bold' : 'text-[#33333B] hover:bg-[#E5E8EF]/50 hover:text-[#1D74E3] dark:text-zinc-300 dark:hover:bg-white/10 dark:hover:text-[#1D74E3] font-medium' }}">
                                {{ __('Manage Scholarships') }}
                            </a>
                            <a href="{{ route('admin.verifications') }}" wire:navigate
                               class="text-xs lg:text-sm px-2 lg:px-3.5 py-2 rounded-lg transition-all duration-200
                                      {{ request()->routeIs('admin.verifications') ? 'text-[#1D74E3] bg-[#1D74E3]/10 font-bold' : 'text-[#33333B] hover:bg-[#E5E8EF]/50 hover:text-[#1D74E3] dark:text-zinc-300 dark:hover:bg-white/10 dark:hover:text-[#1D74E3] font-medium' }}">
                                {{ __('Verifications') }}
                            </a>
                            <a href="{{ route('admin.announcements') }}" wire:navigate
                               class="text-xs lg:text-sm px-2 lg:px-3.5 py-2 rounded-lg transition-all duration-200
                                      {{ request()->routeIs('admin.announcements') ? 'text-[#1D74E3] bg-[#1D74E3]/10 font-bold' : 'text-[#33333B] hover:bg-[#E5E8EF]/50 hover:text-[#1D74E3] dark:text-zinc-300 dark:hover:bg-white/10 dark:hover:text-[#1D74E3] font-medium' }}">
                                {{ __('Announcements') }}
                            </a>
                            @if (auth()->user()->role === 'superadmin')
                                <a href="{{ route('superadmin.admins') }}" wire:navigate
                                   class="text-xs lg:text-sm px-2 lg:px-3.5 py-2 rounded-lg transition-all duration-200
                                          {{ request()->routeIs('superadmin.admins') ? 'text-[#1D74E3] bg-[#1D74E3]/10 font-bold' : 'text-[#33333B] hover:bg-[#E5E8EF]/50 hover:text-[#1D74E3] dark:text-zinc-300 dark:hover:bg-white/10 dark:hover:text-[#1D74E3] font-medium' }}">
                                    {{ __('Admin Management') }}
                                </a>
                            @endif
                        @else
                            {{-- 👤 RESIDENT LINKS --}}
                            <a href="{{ route('dashboard') }}" wire:navigate
                               class="text-sm px-4 py-2 rounded-lg transition-all duration-200
                                      {{ request()->routeIs('dashboard') ? 'text-[#1D74E3] bg-[#1D74E3]/10 font-bold' : 'text-[#33333B] hover:bg-[#E5E8EF]/50 hover:text-[#1D74E3] dark:text-zinc-300 dark:hover:bg-white/10 dark:hover:text-[#1D74E3] font-medium' }}">
                                {{ __('Dashboard') }}
                            </a>
                            <a href="{{ route('scholarships.index') }}" wire:navigate
                               class="text-sm px-4 py-2 rounded-lg transition-all duration-200
                                      {{ request()->routeIs('scholarships.*') ? 'text-[#1D74E3] bg-[#1D74E3]/10 font-bold' : 'text-[#33333B] hover:bg-[#E5E8EF]/50 hover:text-[#1D74E3] dark:text-zinc-300 dark:hover:bg-white/10 dark:hover:text-[#1D74E3] font-medium' }}">
                                {{ __('Scholarships') }}
                            </a>
                            <a href="{{ route('about') }}" wire:navigate
                               class="text-sm px-4 py-2 rounded-lg transition-all duration-200
                                      {{ request()->routeIs('about') ? 'text-[#1D74E3] bg-[#1D74E3]/10 font-bold' : 'text-[#33333B] hover:bg-[#E5E8EF]/50 hover:text-[#1D74E3] dark:text-zinc-300 dark:hover:bg-white/10 dark:hover:text-[#1D74E3] font-medium' }}">
                                {{ __('About') }}
                            </a>
                            <a href="{{ route('faqs') }}" wire:navigate
                               class="text-sm px-4 py-2 rounded-lg transition-all duration-200
                                      {{ request()->routeIs('faqs') ? 'text-[#1D74E3] bg-[#1D74E3]/10 font-bold' : 'text-[#33333B] hover:bg-[#E5E8EF]/50 hover:text-[#1D74E3] dark:text-zinc-300 dark:hover:bg-white/10 dark:hover:text-[#1D74E3] font-medium' }}">
                                {{ __('FAQ') }}
                            </a>
                            <a href="{{ route('contact') }}" wire:navigate
                               class="text-sm px-4 py-2 rounded-lg transition-all duration-200
                                      {{ request()->routeIs('contact') ? 'text-[#1D74E3] bg-[#1D74E3]/10 font-bold' : 'text-[#33333B] hover:bg-[#E5E8EF]/50 hover:text-[#1D74E3] dark:text-zinc-300 dark:hover:bg-white/10 dark:hover:text-[#1D74E3] font-medium' }}">
                                {{ __('Contact') }}
                            </a>
                        @endif
                    @else
                        {{-- 🌐 GUEST LINKS --}}
                        <a href="{{ route('scholarships.index') }}" wire:navigate
                           class="text-sm px-4 py-2 rounded-lg transition-all duration-200
                                  {{ request()->routeIs('scholarships.*') ? 'text-[#1D74E3] bg-[#1D74E3]/10 font-bold' : 'text-[#33333B] hover:bg-[#E5E8EF]/50 hover:text-[#1D74E3] dark:text-zinc-300 dark:hover:bg-white/10 dark:hover:text-[#1D74E3] font-medium' }}">
                            {{ __('Scholarships') }}
                        </a>
                        <a href="{{ route('about') }}" wire:navigate
                           class="text-sm px-4 py-2 rounded-lg transition-all duration-200
                                  {{ request()->routeIs('about') ? 'text-[#1D74E3] bg-[#1D74E3]/10 font-bold' : 'text-[#33333B] hover:bg-[#E5E8EF]/50 hover:text-[#1D74E3] dark:text-zinc-300 dark:hover:bg-white/10 dark:hover:text-[#1D74E3] font-medium' }}">
                            {{ __('About') }}
                        </a>
                        <a href="{{ route('faqs') }}" wire:navigate
                           class="text-sm px-4 py-2 rounded-lg transition-all duration-200
                                  {{ request()->routeIs('faqs') ? 'text-[#1D74E3] bg-[#1D74E3]/10 font-bold' : 'text-[#33333B] hover:bg-[#E5E8EF]/50 hover:text-[#1D74E3] dark:text-zinc-300 dark:hover:bg-white/10 dark:hover:text-[#1D74E3] font-medium' }}">
                            {{ __('FAQ') }}
                        </a>
                        <a href="{{ route('contact') }}" wire:navigate
                           class="text-sm px-4 py-2 rounded-lg transition-all duration-200
                                  {{ request()->routeIs('contact') ? 'text-[#1D74E3] bg-[#1D74E3]/10 font-bold' : 'text-[#33333B] hover:bg-[#E5E8EF]/50 hover:text-[#1D74E3] dark:text-zinc-300 dark:hover:bg-white/10 dark:hover:text-[#1D74E3] font-medium' }}">
                            {{ __('Contact') }}
                        </a>
                    @endauth
                </nav>

                {{-- Right Side: Profile Menu (auth) or Login/Register (guest) --}}
                <div class="flex items-center space-x-4">
                    @auth
                        <x-desktop-user-menu />
                    @else
                        <a href="{{ route('login') }}" wire:navigate
                           class="text-sm font-bold text-[#33333B] hover:text-[#1D74E3] dark:text-zinc-300 dark:hover:text-[#1D74E3] transition-colors duration-200">
                            {{ __('Log in') }}
                        </a>
                        <a href="{{ route('register') }}" wire:navigate
                           class="rounded-lg bg-[#1D74E3] px-5 py-2.5 text-sm font-bold text-white shadow-sm hover:shadow-md hover:-translate-y-0.5 hover:bg-[#155ab2] transition-all duration-200">
                            {{ __('Register') }}
                        </a>
                    @endauth
                </div>

            </div>
        </header>

        {{-- ── Main Page Content Slot ── --}}
        <main class="w-full">
            {{ $slot }}
        </main>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        <x-accessibility-widget />

        @fluxScripts
    </body>
</html>
