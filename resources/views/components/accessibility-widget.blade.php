<div 
    x-data="{
        open: false,
        settings: {
            textSize: localStorage.getItem('acc_textSize') || 'normal',
            highContrast: localStorage.getItem('acc_highContrast') === 'true',
            grayscale: localStorage.getItem('acc_grayscale') === 'true',
            dyslexicFont: localStorage.getItem('acc_dyslexicFont') === 'true',
            highlightLinks: localStorage.getItem('acc_highlightLinks') === 'true'
        },
        save(key, value) {
            this.settings[key] = value;
            localStorage.setItem('acc_' + key, value);
            this.applySettings();
        },
        toggle(key) {
            this.save(key, !this.settings[key]);
        },
        setTextSize(size) {
            this.save('textSize', size);
        },
        applySettings() {
            // Text size
            document.documentElement.classList.remove('acc-text-lg', 'acc-text-xl');
            if (this.settings.textSize === 'lg') document.documentElement.classList.add('acc-text-lg');
            if (this.settings.textSize === 'xl') document.documentElement.classList.add('acc-text-xl');

            // High Contrast
            document.documentElement.classList.toggle('acc-high-contrast', this.settings.highContrast);

            // Grayscale
            document.documentElement.classList.toggle('acc-grayscale', this.settings.grayscale);

            // Dyslexic Font
            document.documentElement.classList.toggle('acc-dyslexic', this.settings.dyslexicFont);

            // Highlight Links
            document.documentElement.classList.toggle('acc-highlight-links', this.settings.highlightLinks);
        },
        resetAll() {
            this.save('textSize', 'normal');
            this.save('highContrast', false);
            this.save('grayscale', false);
            this.save('dyslexicFont', false);
            this.save('highlightLinks', false);
        }
    }"
    x-init="applySettings();"
    class="fixed bottom-6 right-6 z-50 font-sans"
>
    <!-- Floating Button Trigger -->
    <button 
        @click="open = !open" 
        class="flex h-14 w-14 items-center justify-center rounded-full bg-blue-600 text-white shadow-lg transition-all duration-300 hover:bg-blue-700 hover:scale-105 active:scale-95 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800"
        aria-label="Open Accessibility Menu"
        :aria-expanded="open.toString()"
    >
        <!-- Accessibility Icon (Person in Circle) -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-8 w-8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1 1 0 0 1 .548-.115l.003-.001.004-.001.017-.002.067-.002a19.693 19.693 0 0 1 2.622 0l.067.002.017.002.004.001.003.001a1 1 0 0 1 .548.115l.004.002.008.005a1 1 0 0 1 .376.54l.002.007c.302 1.127.492 2.296.568 3.5H18a1 1 0 1 1 0 2h-3.09a20.73 20.73 0 0 1-.58 3.655l.004.004 1.492 1.493a1 1 0 0 1-1.414 1.414l-1.636-1.636a21.43 21.43 0 0 1-2.552 0l-1.636 1.636a1 1 0 1 1-1.414-1.414l1.492-1.493.004-.004A20.73 20.73 0 0 1 9.09 10H6a1 1 0 1 1 0-2h2.932c.076-1.204.266-2.373.568-3.5l.002-.007a1 1 0 0 1 .376-.54l.008-.005.004-.002Z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 12a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" />
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
        </svg>
    </button>

    <!-- Settings Panel Dropdown -->
    <div 
        x-show="open" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
        @click.away="open = false"
        class="absolute bottom-18 right-0 w-80 sm:w-96 rounded-2xl border border-zinc-200 bg-white/95 p-5 shadow-2xl backdrop-blur-md dark:border-zinc-700 dark:bg-zinc-900/95 text-zinc-900 dark:text-zinc-100"
        style="max-height: 80vh; overflow-y: auto;"
    >
        <!-- Panel Header -->
        <div class="flex items-center justify-between border-b border-zinc-200 pb-3 dark:border-zinc-700">
            <div class="flex items-center space-x-2">
                <div class="rounded-lg bg-blue-50 p-1.5 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.43l-1.003.828c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.43l1.004-.827c.292-.24.437-.613.43-.991a7.72 7.72 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
                <h3 class="text-base font-bold tracking-tight">Accessibility Panel</h3>
            </div>
            
            <button @click="resetAll()" class="rounded-lg px-2.5 py-1 text-xs font-semibold text-blue-600 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-900/30 transition-colors">
                Reset All
            </button>
        </div>

        <!-- Section 1: Font Size Adjustment -->
        <div class="mt-4">
            <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mb-2">Text Size</h4>
            <div class="flex rounded-xl bg-zinc-100 p-1 dark:bg-zinc-800">
                <button 
                    @click="setTextSize('normal')" 
                    :class="settings.textSize === 'normal' ? 'bg-white text-zinc-900 shadow-sm dark:bg-zinc-700 dark:text-white' : 'text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white'"
                    class="flex-1 rounded-lg py-1.5 text-center text-xs font-semibold transition-all"
                >
                    Default
                </button>
                <button 
                    @click="setTextSize('lg')" 
                    :class="settings.textSize === 'lg' ? 'bg-white text-zinc-900 shadow-sm dark:bg-zinc-700 dark:text-white' : 'text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white'"
                    class="flex-1 rounded-lg py-1.5 text-center text-xs font-semibold transition-all"
                >
                    Large
                </button>
                <button 
                    @click="setTextSize('xl')" 
                    :class="settings.textSize === 'xl' ? 'bg-white text-zinc-900 shadow-sm dark:bg-zinc-700 dark:text-white' : 'text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white'"
                    class="flex-1 rounded-lg py-1.5 text-center text-xs font-semibold transition-all"
                >
                    Extra Large
                </button>
            </div>
        </div>

        <!-- Section 2: Visual Aids Toggles -->
        <div class="mt-5 space-y-3.5">
            <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Accessibility Tools</h4>
            
            <!-- High Contrast Toggle -->
            <div class="flex items-center justify-between rounded-xl border border-zinc-100 p-3 dark:border-zinc-800 hover:bg-zinc-50/50 dark:hover:bg-zinc-800/30 transition-colors">
                <div class="flex items-center space-x-3">
                    <div class="text-zinc-500 dark:text-zinc-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M12 3a9 9 0 1 1 0 18M12 3a9 9 0 0 0 0 18" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm font-semibold">High Contrast</div>
                        <div class="text-[10px] text-zinc-500 dark:text-zinc-400">High contrast text & backgrounds</div>
                    </div>
                </div>
                <button 
                    @click="toggle('highContrast')" 
                    class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-200 focus:outline-none"
                    :class="settings.highContrast ? 'bg-blue-600' : 'bg-zinc-200 dark:bg-zinc-700'"
                >
                    <span 
                        class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform duration-200"
                        :class="settings.highContrast ? 'translate-x-6' : 'translate-x-1'"
                    ></span>
                </button>
            </div>

            <!-- Grayscale Toggle -->
            <div class="flex items-center justify-between rounded-xl border border-zinc-100 p-3 dark:border-zinc-800 hover:bg-zinc-50/50 dark:hover:bg-zinc-800/30 transition-colors">
                <div class="flex items-center space-x-3">
                    <div class="text-zinc-500 dark:text-zinc-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122A3 3 0 0 0 12 17.75a3 3 0 0 0 2.47-1.628M9.53 16.122a3 3 0 0 1-1.86-4.484M9.53 16.122a3.02 3.02 0 0 0 .73 2.148M14.47 16.122a3 3 0 0 0 1.86-4.484M14.47 16.122a3.02 3.02 0 0 1-.73 2.148M8.25 9.75h.008v.008H8.25V9.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM15.75 9.75h.008v.008H15.75V9.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM9.832 5.172a3 3 0 0 0 .728 2.147m0 0a3 3 0 0 0 2.88 0m-2.88 0a3 3 0 0 1-1.88-4.484M13.44 7.319a3 3 0 0 0 .728-2.147m-3.608 2.147a3 3 0 0 0 3.608 0M14.168 5.172a3 3 0 0 0-1.88-4.484" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm font-semibold">Grayscale</div>
                        <div class="text-[10px] text-zinc-500 dark:text-zinc-400">Remove colors for visual focus</div>
                    </div>
                </div>
                <button 
                    @click="toggle('grayscale')" 
                    class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-200 focus:outline-none"
                    :class="settings.grayscale ? 'bg-blue-600' : 'bg-zinc-200 dark:bg-zinc-700'"
                >
                    <span 
                        class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform duration-200"
                        :class="settings.grayscale ? 'translate-x-6' : 'translate-x-1'"
                    ></span>
                </button>
            </div>

            <!-- Dyslexia Font Toggle -->
            <div class="flex items-center justify-between rounded-xl border border-zinc-100 p-3 dark:border-zinc-800 hover:bg-zinc-50/50 dark:hover:bg-zinc-800/30 transition-colors">
                <div class="flex items-center space-x-3">
                    <div class="text-zinc-500 dark:text-zinc-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-16.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-16.25v16.25" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm font-semibold">Dyslexia Font</div>
                        <div class="text-[10px] text-zinc-500 dark:text-zinc-400">Use dyslexia-friendly typeface</div>
                    </div>
                </div>
                <button 
                    @click="toggle('dyslexicFont')" 
                    class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-200 focus:outline-none"
                    :class="settings.dyslexicFont ? 'bg-blue-600' : 'bg-zinc-200 dark:bg-zinc-700'"
                >
                    <span 
                        class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform duration-200"
                        :class="settings.dyslexicFont ? 'translate-x-6' : 'translate-x-1'"
                    ></span>
                </button>
            </div>

            <!-- Highlight Links Toggle -->
            <div class="flex items-center justify-between rounded-xl border border-zinc-100 p-3 dark:border-zinc-800 hover:bg-zinc-50/50 dark:hover:bg-zinc-800/30 transition-colors">
                <div class="flex items-center space-x-3">
                    <div class="text-zinc-500 dark:text-zinc-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm font-semibold">Highlight Links</div>
                        <div class="text-[10px] text-zinc-500 dark:text-zinc-400">Add high-contrast link borders</div>
                    </div>
                </div>
                <button 
                    @click="toggle('highlightLinks')" 
                    class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-200 focus:outline-none"
                    :class="settings.highlightLinks ? 'bg-blue-600' : 'bg-zinc-200 dark:bg-zinc-700'"
                >
                    <span 
                        class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform duration-200"
                        :class="settings.highlightLinks ? 'translate-x-6' : 'translate-x-1'"
                    ></span>
                </button>
            </div>
        </div>

        <!-- Panel Footer Info -->
        <div class="mt-4 text-center text-[10px] text-zinc-400 dark:text-zinc-500">
            Preferences auto-save to this browser session.
        </div>
    </div>
</div>
