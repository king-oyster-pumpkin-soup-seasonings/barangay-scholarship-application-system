{{-- resources/views/components/app-logo.blade.php --}}
@props([
    'sidebar' => false,
    'href' => '/',
])

@if($sidebar)
    <flux:sidebar.brand name="BRGY 587 Iskolar iApply" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground">
            <x-app-logo-icon class="size-5 text-white dark:text-black" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <a href="{{ $href }}" wire:navigate class="flex items-center gap-3 hover:opacity-80 transition-opacity">
        {{-- Icon --}}
        <div class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground flex-shrink-0">
            <x-app-logo-icon class="size-5 text-white dark:text-black" />
        </div>
        {{-- Name + Subtitle --}}
        <div class="flex flex-col leading-tight">
            <span class="text-sm font-semibold text-zinc-900 dark:text-white">
                BRGY 587 Iskolar iApply
            </span>
            <span class="text-xs text-zinc-500 dark:text-zinc-400">
                Brgy. Scholarship System
            </span>
        </div>
    </a>
@endif
