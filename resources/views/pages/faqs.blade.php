<div>
    {{-- HERO --}}
    <section style="background-color: #1D74E3;" class="py-16 px-4 text-center text-white">
        <h1 class="text-4xl font-bold mb-4">Frequently Asked Questions</h1>
        <p class="text-lg opacity-90 max-w-2xl mx-auto">
            Find answers to the most common questions about the Barangay Scholarship Program.
        </p>
    </section>

    {{-- FAQ ACCORDION --}}
    <section class="max-w-3xl mx-auto px-4 py-12">

        {{-- FAQ Item 1 --}}
        <div x-data="{ open: false }" class="bg-white rounded-xl shadow-sm mb-4">
            <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center">
                <span class="font-semibold" style="color: #33333B;">
                    Who is eligible to apply for a scholarship?
                </span>
                <span style="color: #1D74E3;" x-text="open ? '▲' : '▼'"></span>
            </button>
            <div x-show="open" x-transition class="px-6 pb-5">
                <p style="color: #1B1A1C;" class="text-sm leading-relaxed">
                    Any verified resident of the barangay may apply. You must first register
                    an account, submit your residency documents, and wait for admin verification
                    before you can apply for any scholarship.
                </p>
            </div>
        </div>

        {{-- FAQ Item 2 --}}
        <div x-data="{ open: false }" class="bg-white rounded-xl shadow-sm mb-4">
            <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center">
                <span class="font-semibold" style="color: #33333B;">
                    What documents do I need to submit?
                </span>
                <span style="color: #1D74E3;" x-text="open ? '▲' : '▼'"></span>
            </button>
            <div x-show="open" x-transition class="px-6 pb-5">
                <p style="color: #1B1A1C;" class="text-sm leading-relaxed">
                    For residency verification, you need to submit a valid government ID,
                    proof of residency (such as a utility bill), and a birth certificate.
                    Each scholarship may also have additional specific document requirements.
                </p>
            </div>
        </div>

        {{-- FAQ Item 3 --}}
        <div x-data="{ open: false }" class="bg-white rounded-xl shadow-sm mb-4">
            <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center">
                <span class="font-semibold" style="color: #33333B;">
                    How long does the verification process take?
                </span>
                <span style="color: #1D74E3;" x-text="open ? '▲' : '▼'"></span>
            </button>
            <div x-show="open" x-transition class="px-6 pb-5">
                <p style="color: #1B1A1C;" class="text-sm leading-relaxed">
                    Residency verification typically takes 3 to 5 business days after
                    submitting your documents. You will receive a notification via email
                    and on your dashboard once your verification is complete.
                </p>
            </div>
        </div>

        {{-- FAQ Item 4 --}}
        <div x-data="{ open: false }" class="bg-white rounded-xl shadow-sm mb-4">
            <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center">
                <span class="font-semibold" style="color: #33333B;">
                    Can I apply for more than one scholarship?
                </span>
                <span style="color: #1D74E3;" x-text="open ? '▲' : '▼'"></span>
            </button>
            <div x-show="open" x-transition class="px-6 pb-5">
                <p style="color: #1B1A1C;" class="text-sm leading-relaxed">
                    No. Each resident may only hold one active barangay scholarship at a time.
                    You may apply for another scholarship after your current one has ended
                    or been completed.
                </p>
            </div>
        </div>

        {{-- FAQ Item 5 --}}
        <div x-data="{ open: false }" class="bg-white rounded-xl shadow-sm mb-4">
            <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center">
                <span class="font-semibold" style="color: #33333B;">
                    How will I know if my application is approved?
                </span>
                <span style="color: #1D74E3;" x-text="open ? '▲' : '▼'"></span>
            </button>
            <div x-show="open" x-transition class="px-6 pb-5">
                <p style="color: #1B1A1C;" class="text-sm leading-relaxed">
                    You will be notified via email and through your dashboard once an admin
                    has reviewed your application. Your dashboard will also show the current
                    status of all your applications at any time.
                </p>
            </div>
        </div>

        {{-- FAQ Item 6 --}}
        <div x-data="{ open: false }" class="bg-white rounded-xl shadow-sm mb-4">
            <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center">
                <span class="font-semibold" style="color: #33333B;">
                    What happens if my application is rejected?
                </span>
                <span style="color: #1D74E3;" x-text="open ? '▲' : '▼'"></span>
            </button>
            <div x-show="open" x-transition class="px-6 pb-5">
                <p style="color: #1B1A1C;" class="text-sm leading-relaxed">
                    If your application is rejected, you will receive a notification with
                    the reason for rejection. You may reapply for the same or a different
                    scholarship in the next application period.
                </p>
            </div>
        </div>

        {{-- FAQ Item 7 --}}
        <div x-data="{ open: false }" class="bg-white rounded-xl shadow-sm mb-4">
            <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center">
                <span class="font-semibold" style="color: #33333B;">
                    How do I contact the barangay office for help?
                </span>
                <span style="color: #1D74E3;" x-text="open ? '▲' : '▼'"></span>
            </button>
            <div x-show="open" x-transition class="px-6 pb-5">
                <p style="color: #1B1A1C;" class="text-sm leading-relaxed">
                    You can reach us through the
                    <a href="{{ route('contact') }}" style="color: #1D74E3;" class="underline">
                        Contact page
                    </a>
                    by filling out the feedback form. Our team will get back to you
                    as soon as possible.
                </p>
            </div>
        </div>

        {{-- CTA --}}
        <div class="text-center mt-10">
            <p class="text-sm mb-4" style="color: #AA9A98;">Still have questions?</p>
            <a href="{{ route('contact') }}"
                class="inline-block text-white font-semibold px-8 py-3 rounded-lg transition"
                style="background-color: #1D74E3;">
                Contact Us
            </a>
        </div>

    </section>
</div>
