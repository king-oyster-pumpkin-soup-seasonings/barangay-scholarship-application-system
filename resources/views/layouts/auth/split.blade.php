<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-[#F8FAFC] antialiased text-[#1B1A1C] auth-page">
    <div class="relative grid h-dvh flex-col items-center justify-center lg:max-w-none lg:grid-cols-2 lg:px-0">
        <!-- Left Side Panel (Hidden on mobile) -->
        <div class="relative hidden h-full flex-col p-10 text-white lg:flex bg-[#12325E] overflow-hidden">
            <!-- Subtle gradient background -->
            <div class="absolute inset-0 bg-gradient-to-br from-[#12325E] to-[#0F172B]"></div>

            <!-- Logo Header -->
            <div class="relative z-20 flex items-center gap-2">
                <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/10 backdrop-blur-md border border-white/20">
                    <x-app-logo-icon class="h-6 w-6 text-white" />
                </span>
                <span class="text-xl font-bold tracking-tight text-white font-serif">BRGY 587: Iskolar iApply</span>
            </div>

            <!-- Quote & Image Area -->
            <div class="relative z-20 my-auto flex flex-col gap-8">
                <!-- Quote -->
                <div
                    x-data="{
                            active: 0,
                            quotes: [
                                { text: 'Education is the most powerful weapon which you can use to change the world.', author: 'Nelson Mandela' },
                                { text: 'The roots of education are bitter, but the fruit is sweet.', author: 'Aristotle' },
                                { text: 'Real education should educate us out of self-interest into service.', author: 'Cesar Chavez' },
                                { text: 'The mind is not a vessel to be filled, but a fire to be kindled.', author: 'Plutarch' },
                                { text: 'Investment in knowledge pays the best interest.', author: 'Benjamin Franklin' }
                            ],
                            init() {
                                setInterval(() => {
                                    this.active = (this.active + 1) % this.quotes.length;
                                }, 10000);
                            }
                        }"
                    class="relative min-h-[160px] flex items-center">
                    <template x-for="(quote, index) in quotes" :key="index">
                        <blockquote
                            x-show="active === index"
                            x-transition:enter="transition ease-out duration-1000 delay-300"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-300 absolute inset-x-0"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-4"
                            class="space-y-4">
                            <p class="text-3xl leading-relaxed text-white font-serif font-medium">
                                &ldquo;<span x-text="quote.text"></span>&rdquo;
                            </p>
                            <footer class="text-sm font-semibold tracking-wider text-[#FFAD3B] uppercase">
                                &mdash; <span x-text="quote.author"></span>
                            </footer>
                        </blockquote>
                    </template>
                </div>

                <!-- Image Overlay -->
                <div class="relative w-full aspect-video rounded-xl overflow-hidden shadow-2xl border border-white/10">
                    <img src="{{ asset('images/auth-bg.png') }}" alt="Scholars" class="w-full h-full object-cover opacity-85">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0F172B]/60 to-transparent"></div>
                </div>
            </div>

            <!-- Metrics Tags at the bottom -->
            <div class="relative z-20 mt-auto flex flex-wrap gap-3">
                <div class="px-4 py-2 rounded-full text-xs font-semibold bg-white/10 backdrop-blur-md border border-white/10 text-white shadow-sm">
                    <span class="text-[#FBB701] mr-1">108</span> Active Scholars
                </div>
                <div class="px-4 py-2 rounded-full text-xs font-semibold bg-white/10 backdrop-blur-md border border-white/10 text-white shadow-sm">
                    <span class="text-[#FBB701] mr-1">6</span> Scholarships
                </div>
                <div class="px-4 py-2 rounded-full text-xs font-semibold bg-white/10 backdrop-blur-md border border-white/10 text-white shadow-sm">
                    <span class="text-[#FBB701] mr-1">₱2.8M</span> Released
                </div>
            </div>
        </div>

        <!-- Right Side Form Container -->
        <div class="relative w-full h-full flex items-center justify-center p-6 sm:p-12 lg:p-16 overflow-hidden">
            <!-- Blurred Background Image -->
            <div class="absolute inset-0">
                <img src="{{ asset('images/auth-bg.png') }}" alt="Scholars" class="w-full h-full object-cover opacity-85 blur-sm/50">

                <!-- Light White Overlay -->
                <div class="absolute inset-0 bg-white/70"></div>
            </div>
            <!-- login card -->
            <div class="relative z-10 w-full max-w-[450px] bg-white p-8 sm:p-10 rounded-2xl shadow-xl border border-zinc-200/40">
                <!-- Mobile Logo (Visible on mobile only) -->
                <div class="flex flex-col items-center gap-2 lg:hidden">
                    <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#1D74E3] shadow-md">
                        <x-app-logo-icon class="h-8 w-8 text-white" />
                    </span>
                    <span class="text-2xl font-bold tracking-tight text-[#0F172B] font-serif">BRGY 587: Iskolar iApply</span>
                </div>

                {{ $slot }}
            </div>
        </div>
    </div>

    @persist('toast')
    <flux:toast.group>
        <flux:toast />
    </flux:toast.group>
    @endpersist

    <x-accessibility-widget />

    @fluxScripts
</body>

</html>