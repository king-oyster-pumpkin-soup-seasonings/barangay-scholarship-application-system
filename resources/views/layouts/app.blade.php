@if (auth()->check() && in_array(auth()->user()->role, ['admin', 'superadmin']))
    <x-layouts::app.sidebar :title="$title ?? null">
        <flux:main>
            {{ $slot }}
        </flux:main>
    </x-layouts::app.sidebar>
@else
    <x-layouts::app.header :title="$title ?? null">
        <main class="w-full">
            {{ $slot }}
        </main>
    </x-layouts::app.header>
@endif
