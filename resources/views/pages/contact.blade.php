<div>
    {{-- HERO --}}
    <section style="background-color: #1D74E3;" class="py-16 px-4 text-center text-white">
        <h1 class="text-4xl font-bold mb-4">Contact Us</h1>
        <p class="text-lg opacity-90 max-w-2xl mx-auto">
            Have a question or feedback? Send us a message and we'll get back to you.
        </p>
    </section>

    {{-- CONTACT FORM --}}
    <section class="max-w-2xl mx-auto px-4 py-12">

        {{-- Success Message --}}
        @if ($submitted)
            <div class="bg-green-50 border border-green-200 rounded-xl p-6 text-center mb-6">
                <div class="text-4xl mb-3">✅</div>
                <h2 class="text-xl font-bold mb-2" style="color: #33333B;">
                    Message Sent!
                </h2>
                <p class="text-sm" style="color: #1B1A1C;">
                    Thank you for reaching out. We will get back to you as soon as possible.
                </p>
            </div>
        @else
            <div class="bg-white rounded-xl p-8 shadow-sm">
                <h2 class="text-xl font-bold mb-6" style="color: #33333B;">
                    Send us a Message
                </h2>

                {{-- Name --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1" style="color: #33333B;">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" wire:model="name" placeholder="Enter your full name"
                        class="w-full border rounded-lg px-4 py-2 text-sm outline-none focus:ring-2"
                        style="border-color: #AA9A98; color: #1B1A1C;" />
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1" style="color: #33333B;">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input type="email" wire:model="email" placeholder="Enter your email address"
                        class="w-full border rounded-lg px-4 py-2 text-sm outline-none focus:ring-2"
                        style="border-color: #AA9A98; color: #1B1A1C;" />
                </div>

                {{-- Subject --}}
                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1" style="color: #33333B;">
                        Subject <span class="text-red-500">*</span>
                    </label>
                    <input type="text" wire:model="subject" placeholder="What is your message about?"
                        class="w-full border rounded-lg px-4 py-2 text-sm outline-none focus:ring-2"
                        style="border-color: #AA9A98; color: #1B1A1C;" />
                </div>

                {{-- Message --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-1" style="color: #33333B;">
                        Message <span class="text-red-500">*</span>
                    </label>
                    <textarea wire:model="message" placeholder="Write your message here..." rows="5"
                        class="w-full border rounded-lg px-4 py-2 text-sm outline-none focus:ring-2"
                        style="border-color: #AA9A98; color: #1B1A1C;"></textarea>
                </div>

                {{-- Submit Button --}}
                <button wire:click="submit"
                    class="w-full text-white font-semibold py-3 rounded-lg transition hover:opacity-90"
                    style="background-color: #1D74E3;">
                    Send Message
                </button>
            </div>
        @endif

    </section>
</div>
