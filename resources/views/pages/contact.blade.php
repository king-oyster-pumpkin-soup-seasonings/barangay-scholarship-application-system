<div class="bg-gray-50/50 min-h-screen pb-24 font-sans selection:bg-blue-500 selection:text-white">
    {{-- HERO --}}
    <section class="relative overflow-hidden py-24 px-6 text-center text-white">
        {{-- Unified Background Gradient --}}
        <div class="absolute inset-0 bg-gradient-to-br from-[#0f246e] to-[#1C398E] z-0"></div>

        {{-- Grid Pattern --}}
        <div class="absolute inset-0 opacity-[0.06] pointer-events-none z-0"
            style="background-image: linear-gradient(to right, #ffffff 1px, transparent 1px), linear-gradient(to bottom, #ffffff 1px, transparent 1px); background-size: 40px 40px;">
        </div>

        {{-- Spotlight Glow --}}
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full max-w-4xl bg-blue-400/10 blur-[100px] rounded-full z-0 pointer-events-none">
        </div>

        <div class="relative z-10 max-w-3xl mx-auto">
            {{-- Badge --}}
            <span
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium
                   bg-white/10 text-blue-100 backdrop-blur-md border border-white/10 shadow-lg mb-6 transition-transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-4 h-4 text-blue-300">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                </svg>
                Help Desk Connection
            </span>

            {{-- Title --}}
            <h1 class="font-serif text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight mb-6
                 text-transparent bg-clip-text bg-gradient-to-r from-white via-blue-100 to-blue-200
                 leading-[1.1]"
                style="font-family: 'Playfair Display', serif;">
                Contact Us
            </h1>

            {{-- Description --}}
            <p class="text-base md:text-lg leading-relaxed text-blue-100/90 max-w-xl mx-auto font-light drop-shadow-sm">
                Have an inquiry about your scholarship application or structural guidelines? Send our support team a
                direct message.
            </p>
        </div>
    </section>

    {{-- CONTACT CONTENT BODY --}}
    <section class="max-w-5xl mx-auto px-4 py-12 grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

        {{-- LEFT SIDEBAR: PHYSICAL DESK INFO --}}
        <div class="space-y-4 lg:col-span-1">
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm space-y-6">
                <h3 class="font-serif font-bold text-gray-800 text-xl border-b pb-3 border-gray-100">Barangay
                    Secretariat</h3>

                <div
                    class="group flex items-start gap-3 text-sm p-2 -mx-2 rounded-xl border border-transparent hover:border-blue-50 hover:bg-blue-50/20 transition-all duration-300">
                    <div
                        class="flex-shrink-0 w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Office Address</h4>
                        <p class="text-gray-500 mt-0.5 leading-relaxed">Barangay Hall Desk, Main Public Circle, Metro
                            Manila</p>
                    </div>
                </div>

                <div
                    class="group flex items-start gap-3 text-sm p-2 -mx-2 rounded-xl border border-transparent hover:border-blue-50 hover:bg-blue-50/20 transition-all duration-300">
                    <div
                        class="flex-shrink-0 w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">Operation Hours</h4>
                        <p class="text-gray-500 mt-0.5 leading-relaxed">Monday – Friday<br>8:00 AM – 5:00 PM</p>
                    </div>
                </div>

                <a href="mailto:support@barangayscholarship.gov.ph"
                    class="group flex items-start gap-3 text-sm p-2 -mx-2 rounded-xl border border-transparent hover:border-blue-100 hover:bg-blue-50/40 transition-all duration-300 block">
                    <div
                        class="flex-shrink-0 w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">Direct
                            Support Email</h4>
                        <p
                            class="text-blue-600 font-medium mt-0.5 break-all underline decoration-transparent group-hover:decoration-blue-600 transition-all">
                            support@barangayscholarship.gov.ph</p>
                    </div>
                </a>
            </div>
        </div>

        {{-- RIGHT SIDEBAR: THE FORM INTERFACE --}}
        <div class="lg:col-span-2">
            {{-- Success State --}}
            @if ($submitted)
                <div
                    class="bg-white border border-green-100 rounded-2xl p-8 text-center shadow-sm max-w-xl mx-auto transform animate-fade-in transition-all">
                    <div
                        class="w-16 h-16 rounded-full bg-green-50 flex items-center justify-center text-3xl mx-auto mb-4 border border-green-100 animate-bounce">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
                        </svg>
                    </div>
                    <h2 class="font-serif text-2xl font-bold text-gray-800 mb-2">Message Dispatched!</h2>
                    <p class="text-gray-500 text-sm max-w-sm mx-auto leading-relaxed mb-6">
                        Thank you for reaching out to us. A system ticket has been opened and desk staff will verify
                        your submission soon.
                    </p>
                    <button wire:click="$set('submitted', false)"
                        class="text-xs font-semibold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100/80 px-5 py-2.5 rounded-xl transition-all active:scale-95 duration-150">
                        Send Another Message
                    </button>
                </div>
            @else
                {{-- Form Interface Card --}}
                <div class="bg-white rounded-2xl p-6 md:p-8 border border-gray-100 shadow-sm">
                    <h2 class="font-serif text-2xl font-bold text-gray-800 mb-1">Send us a Message</h2>
                    <p class="text-xs text-gray-400 mb-6">Fields marked with an asterisk (<span
                            class="text-red-500">*</span>) are strictly required.</p>

                    <form wire:submit.prevent="submit" class="space-y-5">
                        {{-- Name --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" wire:model="name" placeholder="Juan Dela Cruz"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm outline-none transition-all duration-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100/80 @error('name') border-red-400 focus:ring-red-500/10 @enderror" />
                            @error('name')
                                <span class="text-xs text-red-500 font-medium mt-1.5 block flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 inline animate-pulse" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z">
                                        </path>
                                    </svg>
                                    {{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" wire:model="email" placeholder="juan@example.com"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm outline-none transition-all duration-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100/80 @error('email') border-red-400 focus:ring-red-500/10 @enderror" />
                            @error('email')
                                <span class="text-xs text-red-500 font-medium mt-1.5 block flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 inline animate-pulse" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z">
                                        </path>
                                    </svg>
                                    {{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Subject --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Subject <span class="text-red-500">*</span>
                            </label>
                            <input type="text" wire:model="subject" placeholder="Inquiry about requirements..."
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm outline-none transition-all duration-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100/80 @error('subject') border-red-400 focus:ring-red-500/10 @enderror" />
                            @error('subject')
                                <span class="text-xs text-red-500 font-medium mt-1.5 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 inline animate-pulse" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z">
                                        </path>
                                    </svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Message --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea wire:model="message" placeholder="Type structural question context details here..." rows="4"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm outline-none transition-all duration-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100/80 @error('message') border-red-400 focus:ring-red-500/10 @enderror"></textarea>
                            @error('message')
                                <span class="text-xs text-red-500 font-medium mt-1.5 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 inline animate-pulse" fill="none" stroke="currentColor"
                                        stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z">
                                        </path>
                                    </svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Submit Button with Livewire Loading States --}}
                        <div class="pt-2">
                            <button type="submit" wire:loading.attr="disabled"
                                class="w-full inline-flex items-center justify-center gap-2 text-white font-semibold py-3 px-4 rounded-xl bg-blue-600 hover:bg-blue-700 active:scale-[0.99] shadow-lg shadow-blue-100 transition-all duration-150 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">

                                <svg wire:loading class="animate-spin h-4 w-4 text-white" fill="none"
                                    viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>

                                <span wire:loading.remove>Send Message</span>
                                <span wire:loading>Processing...</span>
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </section>
</div>
