<div class="bg-gray-50/50 min-h-screen pb-24">
    {{-- HERO --}}
    <section class="relative overflow-hidden bg-blue-600 py-16 px-4 text-center text-white">
        <!-- Background Accents -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-blue-500 via-blue-600 to-blue-700 opacity-100"></div>
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#fff_1px,transparent_1px),linear-gradient(to_bottom,#fff_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>

        <div class="relative z-10 max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-blue-500/30 text-blue-100 mb-3 backdrop-blur-sm border border-white/10">
                📬 Help Desk Connection
            </span>
            <h1 class="text-4xl font-extrabold tracking-tight mb-3 drop-shadow-sm">Contact Us</h1>
            <p class="text-lg opacity-90 max-w-xl mx-auto font-light text-blue-100">
                Have an inquiry about your scholarship application or structural guidelines? Send our support team a direct message.
            </p>
        </div>
    </section>

    {{-- CONTACT CONTENT BODY --}}
    <section class="max-w-5xl mx-auto px-4 py-12 grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

        {{-- LEFT SIDEBAR: PHYSICAL DESK INFO --}}
        <div class="space-y-4 lg:col-span-1">
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm space-y-5">
                <h3 class="font-bold text-gray-800 text-lg border-b pb-3 border-gray-100">Barangay Secretariat</h3>

                <div class="flex items-start gap-3 text-sm">
                    <span class="text-xl">📍</span>
                    <div>
                        <h4 class="font-semibold text-gray-800">Office Address</h4>
                        <p class="text-gray-500 mt-0.5 leading-relaxed">Barangay Hall Desk, Main Public Circle, Metro Manila</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 text-sm">
                    <span class="text-xl">⏱️</span>
                    <div>
                        <h4 class="font-semibold text-gray-800">Operation Hours</h4>
                        <p class="text-gray-500 mt-0.5">Monday – Friday<br>8:00 AM – 5:00 PM</p>
                    </div>
                </div>

                <div class="flex items-start gap-3 text-sm">
                    <span class="text-xl">✉️</span>
                    <div>
                        <h4 class="font-semibold text-gray-800">Direct Support Email</h4>
                        <p class="text-blue-600 font-medium mt-0.5 break-all">support@barangayscholarship.gov.ph</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT SIDEBAR: THE FORM INTERFACE --}}
        <div class="lg:col-span-2">
            {{-- Success State --}}
            @if ($submitted)
                <div class="bg-white border border-green-100 rounded-2xl p-8 text-center shadow-sm max-w-xl mx-auto transform animate-fade-in">
                    <div class="w-16 h-16 rounded-full bg-green-50 flex items-center justify-center text-3xl mx-auto mb-4 border border-green-100">
                        ✅
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Message Dispatched!</h2>
                    <p class="text-gray-500 text-sm max-w-sm mx-auto leading-relaxed mb-6">
                        Thank you for reaching out to us. A system ticket has been opened and desk staff will verify your submission soon.
                    </p>
                    <button wire:click="$set('submitted', false)" class="text-xs font-semibold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100/80 px-4 py-2 rounded-xl transition-all">
                        Send Another Message
                    </button>
                </div>
            @else
                {{-- Form Interface Card --}}
                <div class="bg-white rounded-2xl p-6 md:p-8 border border-gray-100 shadow-sm">
                    <h2 class="text-xl font-bold text-gray-800 mb-1">Send us a Message</h2>
                    <p class="text-xs text-gray-400 mb-6">Fields marked with an asterisk (<span class="text-red-500">*</span>) are strictly required.</p>

                    <form wire:submit.prevent="submit" class="space-y-5">
                        {{-- Name --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" wire:model="name" placeholder="Juan Dela Cruz"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm outline-none transition-all focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 @error('name') border-red-400 focus:ring-red-500/10 @enderror" />
                            @error('name')
                                <span class="text-xs text-red-500 font-medium mt-1 block">⚠️ {{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" wire:model="email" placeholder="juan@example.com"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm outline-none transition-all focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 @error('email') border-red-400 focus:ring-red-500/10 @enderror" />
                            @error('email')
                                <span class="text-xs text-red-500 font-medium mt-1 block">⚠️ {{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Subject --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Subject <span class="text-red-500">*</span>
                            </label>
                            <input type="text" wire:model="subject" placeholder="Inquiry about requirements..."
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm outline-none transition-all focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 @error('subject') border-red-400 focus:ring-red-500/10 @enderror" />
                            @error('subject')
                                <span class="text-xs text-red-500 font-medium mt-1 block">⚠️ {{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Message --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea wire:model="message" placeholder="Type structural question context details here..." rows="4"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm outline-none transition-all focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 @error('message') border-red-400 focus:ring-red-500/10 @enderror"></textarea>
                            @error('message')
                                <span class="text-xs text-red-500 font-medium mt-1 block">⚠️ {{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Submit Button with Livewire Loading States --}}
                        <div class="pt-2">
                            <button type="submit" wire:loading.attr="disabled"
                                class="w-full inline-flex items-center justify-center gap-2 text-white font-semibold py-3 px-4 rounded-xl bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-100 transition-all disabled:opacity-50 disabled:cursor-not-allowed">

                                <!-- Loading Spinner Object -->
                                <svg wire:loading class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
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
