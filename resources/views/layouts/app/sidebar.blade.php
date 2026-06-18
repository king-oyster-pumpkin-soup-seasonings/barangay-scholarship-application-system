<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <style>
            /* Custom Sidebar Styles */
            .custom-sidebar {
                background-color: #ffffff !important;
            }
            .custom-sidebar [data-flux-sidebar-item] {
                color: #1B1A1C !important;
                transition: all 0.2s ease-in-out;
            }
            .custom-sidebar [data-flux-sidebar-item] svg {
                color: #AA9A98 !important;
                transition: all 0.2s ease-in-out;
            }
            .custom-sidebar [data-flux-sidebar-item]:hover {
                background-color: rgba(29, 116, 227, 0.05) !important;
                color: #1B1A1C !important;
            }
            .custom-sidebar [data-flux-sidebar-item]:hover svg {
                color: #1D74E3 !important;
            }
            .custom-sidebar [data-flux-sidebar-item][data-current] {
                color: #1D74E3 !important;
                background-color: rgba(29, 116, 227, 0.08) !important;
            }
            .custom-sidebar [data-flux-sidebar-item][data-current] svg {
                color: #1D74E3 !important;
            }
            .custom-sidebar [data-flux-heading] {
                color: #33333B !important;
            }

            /* Dark mode overrides */
            .dark .custom-sidebar {
                background-color: #171717 !important;
            }
            .dark .custom-sidebar [data-flux-sidebar-item] {
                color: #e5e7eb !important;
            }
            .dark .custom-sidebar [data-flux-sidebar-item] svg {
                color: #9ca3af !important;
            }
            .dark .custom-sidebar [data-flux-sidebar-item]:hover {
                background-color: rgba(255, 255, 255, 0.05) !important;
                color: #ffffff !important;
            }
            .dark .custom-sidebar [data-flux-sidebar-item]:hover svg {
                color: #1D74E3 !important;
            }
            .dark .custom-sidebar [data-flux-sidebar-item][data-current] {
                color: #1D74E3 !important;
                background-color: rgba(29, 116, 227, 0.15) !important;
            }
            .dark .custom-sidebar [data-flux-sidebar-item][data-current] svg {
                color: #1D74E3 !important;
            }
            .dark .custom-sidebar [data-flux-heading] {
                color: #e5e7eb !important;
            }
        </style>
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky collapsible="mobile" class="custom-sidebar border-e border-zinc-200 dark:border-zinc-700">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('admin.dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('Platform')" class="grid">
                    @if(auth()->user()->role === 'user')
                        <flux:sidebar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                            {{ __('Resident Dashboard') }}
                        </flux:sidebar.item>
                    @endif

                    @if(in_array(auth()->user()->role, ['admin', 'superadmin']))
                        <flux:sidebar.item icon="home" :href="route('admin.dashboard')" :current="request()->routeIs('admin.dashboard')" wire:navigate>
                            {{ __('Admin Dashboard') }}
                        </flux:sidebar.item>
                        <flux:sidebar.item icon="academic-cap" :href="route('admin.applications')" :current="request()->routeIs('admin.applications')" wire:navigate>
                            {{ __('Scholarship Applications') }}
                        </flux:sidebar.item>
                        <flux:sidebar.item icon="document-check" :href="route('admin.verifications')" :current="request()->routeIs('admin.verifications')" wire:navigate>
                            {{ __('Residence Verifications') }}
                        </flux:sidebar.item>
                        <flux:sidebar.item icon="megaphone" :href="route('admin.announcements')" :current="request()->routeIs('admin.announcements')" wire:navigate>
                            {{ __('Manage Announcements') }}
                        </flux:sidebar.item>
                        @if(auth()->user()->role === 'superadmin')
                            <flux:sidebar.item icon="users" :href="route('superadmin.admins')" :current="request()->routeIs('superadmin.admins')" wire:navigate>
                                {{ __('Admin Management') }}
                            </flux:sidebar.item>
                        @endif
                    @endif
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                    {{ __('Repository') }}
                </flux:sidebar.item>

                <flux:sidebar.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                    {{ __('Documentation') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>

            <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="auth()->user()->initials()"
                                />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer"
                            data-test="logout-button"
                        >
                            {{ __('Log out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
