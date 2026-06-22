<div>
    <a
        href="{{ route('home') }}"
        class="inline-flex items-center gap-1.5 rounded-lg px-3 py-1.5 text-sm font-medium text-zinc-500 transition-all hover:bg-[#EBF3FF] hover:text-[#1D74E3]"
        wire:navigate>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
        </svg>
        {{ __('Back') }}
    </a>
</div>