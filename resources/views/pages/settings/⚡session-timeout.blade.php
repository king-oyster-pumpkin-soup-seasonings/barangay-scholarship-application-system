<?php

use App\Models\SystemSetting;
use Flux\Flux;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Session timeout settings')] class extends Component
{
    public int $timeoutAmount = 20;

    public string $timeoutUnit = 'minutes';

    public function mount(): void
    {
        abort_unless(auth()->user()?->role === 'superadmin', 403);

        $minutes = SystemSetting::sessionTimeoutMinutes();

        if ($minutes % 60 === 0) {
            $this->timeoutAmount = (int) ($minutes / 60);
            $this->timeoutUnit = 'hours';

            return;
        }

        $this->timeoutAmount = $minutes;
        $this->timeoutUnit = 'minutes';
    }

    public function save(): void
    {
        abort_unless(auth()->user()?->role === 'superadmin', 403);

        $this->validate([
            'timeoutAmount' => ['required', 'integer', 'min:1', 'max:1440'],
            'timeoutUnit' => ['required', 'in:minutes,hours'],
        ]);

        $minutes = $this->timeoutUnit === 'hours'
            ? $this->timeoutAmount * 60
            : $this->timeoutAmount;

        if ($minutes < 5 || $minutes > 1440) {
            $this->addError('timeoutAmount', __('Session timeout must be between 5 minutes and 24 hours.'));

            return;
        }

        SystemSetting::setSessionTimeoutMinutes($minutes);

        Flux::toast(variant: 'success', text: __('Session timeout updated.'));
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <flux:heading class="sr-only">{{ __('Session timeout settings') }}</flux:heading>

    <x-pages::settings.layout :heading="__('Session timeout')" :subheading="__('Set how long users may stay inactive before they are automatically signed out.')">
        <form wire:submit="save" class="space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-[1fr_auto] gap-3">
                <flux:input
                    wire:model="timeoutAmount"
                    type="number"
                    min="1"
                    max="1440"
                    label="{{ __('Timeout length') }}"
                    required
                />

                <flux:select wire:model="timeoutUnit" label="{{ __('Unit') }}" class="sm:w-36">
                    <flux:select.option value="minutes">{{ __('Minutes') }}</flux:select.option>
                    <flux:select.option value="hours">{{ __('Hours') }}</flux:select.option>
                </flux:select>
            </div>

            <div class="rounded-lg border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800 dark:border-amber-700 dark:bg-amber-900/20 dark:text-amber-300">
                {{ __('Users will see a session expired message on the login page after this period of inactivity.') }}
            </div>

            <flux:button type="submit" variant="primary">
                {{ __('Save timeout') }}
            </flux:button>
        </form>
    </x-pages::settings.layout>
</section>
