<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
        {{-- ── Clean Top Horizontal Navbar ── --}}
        <header class="sticky top-0 z-40 w-full border-b border-zinc-200 bg-white px-6 py-4 dark:border-zinc-700 dark:bg-zinc-800">
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
                               class="text-sm font-medium px-3 py-1.5 rounded-lg transition-colors
                                      {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                                {{ __('Dashboard') }}
                            </a>
                            <a href="{{ route('admin.applications') }}" wire:navigate
                               class="text-sm font-medium px-3 py-1.5 rounded-lg transition-colors
                                      {{ request()->routeIs('admin.applications') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                                {{ __('Scholarship Applications') }}
                            </a>
                            <a href="{{ route('admin.verifications') }}" wire:navigate
                               class="text-sm font-medium px-3 py-1.5 rounded-lg transition-colors
                                      {{ request()->routeIs('admin.verifications') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                                {{ __('Verifications') }}
                            </a>
                            <a href="{{ route('admin.announcements') }}" wire:navigate
                               class="text-sm font-medium px-3 py-1.5 rounded-lg transition-colors
                                      {{ request()->routeIs('admin.announcements') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                                {{ __('Announcements') }}
                            </a>
                            @if (auth()->user()->role === 'superadmin')
                                <a href="{{ route('superadmin.admins') }}" wire:navigate
                                   class="text-sm font-medium px-3 py-1.5 rounded-lg transition-colors
                                          {{ request()->routeIs('superadmin.admins') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                                    {{ __('Admin Management') }}
                                </a>
                            @endif
                        @else
                            {{-- 👤 RESIDENT LINKS --}}
                            <a href="{{ route('dashboard') }}" wire:navigate
                               class="text-sm font-medium px-3 py-1.5 rounded-lg transition-colors
                                      {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                                {{ __('Dashboard') }}
                            </a>
                            <a href="{{ route('scholarships.index') }}" wire:navigate
                               class="text-sm font-medium px-3 py-1.5 rounded-lg transition-colors
                                      {{ request()->routeIs('scholarships.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                                {{ __('Scholarships') }}
                            </a>
                            <a href="{{ route('about') }}" wire:navigate
                               class="text-sm font-medium px-3 py-1.5 rounded-lg transition-colors
                                      {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                                {{ __('About') }}
                            </a>
                            <a href="{{ route('faqs') }}" wire:navigate
                               class="text-sm font-medium px-3 py-1.5 rounded-lg transition-colors
                                      {{ request()->routeIs('faqs') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                                {{ __('FAQ') }}
                            </a>
                            <a href="{{ route('contact') }}" wire:navigate
                               class="text-sm font-medium px-3 py-1.5 rounded-lg transition-colors
                                      {{ request()->routeIs('contact') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                                {{ __('Contact') }}
                            </a>
                        @endif
                    @else
                        {{-- 🌐 GUEST LINKS --}}
                        <a href="{{ route('scholarships.index') }}" wire:navigate
                           class="text-sm font-medium px-3 py-1.5 rounded-lg transition-colors
                                  {{ request()->routeIs('scholarships.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                            {{ __('Scholarships') }}
                        </a>
                        <a href="{{ route('about') }}" wire:navigate
                           class="text-sm font-medium px-3 py-1.5 rounded-lg transition-colors
                                  {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                            {{ __('About') }}
                        </a>
                        <a href="{{ route('faqs') }}" wire:navigate
                           class="text-sm font-medium px-3 py-1.5 rounded-lg transition-colors
                                  {{ request()->routeIs('faqs') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
                            {{ __('FAQ') }}
                        </a>
                        <a href="{{ route('contact') }}" wire:navigate
                           class="text-sm font-medium px-3 py-1.5 rounded-lg transition-colors
                                  {{ request()->routeIs('contact') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-700' }}">
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
                           class="text-sm font-medium text-zinc-600 hover:text-blue-600 dark:text-zinc-300 dark:hover:text-blue-400">
                            {{ __('Log in') }}
                        </a>
                        <a href="{{ route('register') }}" wire:navigate
                           class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
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
