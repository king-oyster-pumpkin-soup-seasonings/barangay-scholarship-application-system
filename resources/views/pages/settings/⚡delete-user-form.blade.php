<?php

use Livewire\Component;

new class extends Component {}; ?>

<section class="mt-10 space-y-6">
    <div class="relative mb-5">
        <flux:heading>{{ __('Delete account') }}</flux:heading>
        @if (auth()->user()?->role === 'superadmin')
            <flux:subheading>{{ __('Super Admin accounts are protected and cannot be deleted from Profile settings.') }}</flux:subheading>
        @else
            <flux:subheading>{{ __('Delete your account and all of its resources') }}</flux:subheading>
        @endif
    </div>

    @if (auth()->user()?->role !== 'superadmin')
        <flux:modal.trigger name="confirm-user-deletion">
            <flux:button variant="danger" data-test="delete-user-button">
                {{ __('Delete account') }}
            </flux:button>
        </flux:modal.trigger>
    @endif

    <livewire:pages::settings.delete-user-modal />
</section>
