<x-layouts::app.header :title="$title ?? null">
    <main class="w-full">
        {{ $slot }}
    </main>
</x-layouts::app.header>
