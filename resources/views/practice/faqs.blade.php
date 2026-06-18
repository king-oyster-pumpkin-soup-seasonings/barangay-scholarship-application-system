<div class="bg-gray-50/50 min-h-screen pb-24">
    {{-- HERO --}}
    <section class="relative overflow-hidden bg-blue-600 py-16 px-4 text-center text-white">
        <!-- Background Accents -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-blue-500 via-blue-600 to-blue-700 opacity-100"></div>
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#fff_1px,transparent_1px),linear-gradient(to_bottom,#fff_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>

        <div class="relative z-10 max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-blue-500/30 text-blue-100 mb-3 backdrop-blur-sm border border-white/10">
                💡 Knowledge Base Desk
            </span>
            <h1 class="text-4xl font-extrabold tracking-tight mb-3 drop-shadow-sm">Frequently Asked Questions</h1>
            <p class="text-lg opacity-90 max-w-2xl mx-auto font-light text-blue-100">
                Find immediate answers regarding eligibility criteria, validation timelines, and document requirements.
            </p>
        </div>
    </section>

    {{-- FAQ ACCORDION STRUCTURE --}}
    <section class="max-w-3xl mx-auto px-4 py-12 space-y-4">

        {{-- FAQ Item 1 --}}
        <div x-data="{ open: false }"
            class="rounded-2xl border transition-all duration-200 overflow-hidden shadow-sm"
            :class="open ? 'bg-blue-50/30 border-blue-200 ring-4 ring-blue-50' : 'bg-white border-gray-100 hover:border-gray-200'">
            <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center gap-4 group">
                <span class="font-bold text-gray-800 text-base md:text-md group-hover:text-blue-600 transition-colors">
                    Who is eligible to apply for a scholarship?
                </span>
                <svg class="w-5 h-5 text-blue-600 transform transition-transform duration-200 flex-shrink-0" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" x-transition.opacity class="px-6 pb-5">
                <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                    Any verified resident of the barangay may apply. You must first register an account, submit your core residency documents, and wait for admin validation clearance before you can queue into any specific grant profile window.
                </p>
            </div>
        </div>

        {{-- FAQ Item 2 --}}
        <div x-data="{ open: false }"
            class="rounded-2xl border transition-all duration-200 overflow-hidden shadow-sm"
            :class="open ? 'bg-blue-50/30 border-blue-200 ring-4 ring-blue-50' : 'bg-white border-gray-100 hover:border-gray-200'">
            <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center gap-4 group">
                <span class="font-bold text-gray-800 text-base md:text-md group-hover:text-blue-600 transition-colors">
                    What documents do I need to submit?
                </span>
                <svg class="w-5 h-5 text-blue-600 transform transition-transform duration-200 flex-shrink-0" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" x-transition.opacity class="px-6 pb-5">
                <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                    For baseline residency profile verification, you must upload a valid government-issued ID, a recent proof of residency document (such as a utility bill, layout certification, or formal lease contract), and your birth certificate. Individual scholarship grants may specify unique academic data prerequisites later.
                </p>
            </div>
        </div>

        {{-- FAQ Item 3 --}}
        <div x-data="{ open: false }"
            class="rounded-2xl border transition-all duration-200 overflow-hidden shadow-sm"
            :class="open ? 'bg-blue-50/30 border-blue-200 ring-4 ring-blue-50' : 'bg-white border-gray-100 hover:border-gray-200'">
            <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center gap-4 group">
                <span class="font-bold text-gray-800 text-base md:text-md group-hover:text-blue-600 transition-colors">
                    How long does the verification process take?
                </span>
                <svg class="w-5 h-5 text-blue-600 transform transition-transform duration-200 flex-shrink-0" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" x-transition.opacity class="px-6 pb-5">
                <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                    Residency validation assessment typically logs around 3 to 5 clear business days once paperwork is uploaded. The core platform engine will instantly dispatch a notification alert to your email address and structural account dashboard layout upon execution.
                </p>
            </div>
        </div>

        {{-- FAQ Item 4 --}}
        <div x-data="{ open: false }"
            class="rounded-2xl border transition-all duration-200 overflow-hidden shadow-sm"
            :class="open ? 'bg-blue-50/30 border-blue-200 ring-4 ring-blue-50' : 'bg-white border-gray-100 hover:border-gray-200'">
            <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center gap-4 group">
                <span class="font-bold text-gray-800 text-base md:text-md group-hover:text-blue-600 transition-colors">
                    Can I apply for more than one scholarship?
                </span>
                <svg class="w-5 h-5 text-blue-600 transform transition-transform duration-200 flex-shrink-0" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" x-transition.opacity class="px-6 pb-5">
                <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                    No. To provide balanced, equitable distribution across our community, each verified student may only map into one active barangay allowance system at a time. Re-applying into separate pipelines is permitted once active structures finish processing or expire.
                </p>
            </div>
        </div>

        {{-- FAQ Item 5 --}}
        <div x-data="{ open: false }"
            class="rounded-2xl border transition-all duration-200 overflow-hidden shadow-sm"
            :class="open ? 'bg-blue-50/30 border-blue-200 ring-4 ring-blue-50' : 'bg-white border-gray-100 hover:border-gray-200'">
            <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center gap-4 group">
                <span class="font-bold text-gray-800 text-base md:text-md group-hover:text-blue-600 transition-colors">
                    How will I know if my application is approved?
                </span>
                <svg class="w-5 h-5 text-blue-600 transform transition-transform duration-200 flex-shrink-0" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" x-transition.opacity class="px-6 pb-5">
                <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                    You will automatically receive automated email transaction confirmations along with real-time status card modifications directly inside your verified profile login view, indicating acceptance benchmarks from the executive committee review desk.
                </p>
            </div>
        </div>

        {{-- FAQ Item 6 --}}
        <div x-data="{ open: false }"
            class="rounded-2xl border transition-all duration-200 overflow-hidden shadow-sm"
            :class="open ? 'bg-blue-50/30 border-blue-200 ring-4 ring-blue-50' : 'bg-white border-gray-100 hover:border-gray-200'">
            <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center gap-4 group">
                <span class="font-bold text-gray-800 text-base md:text-md group-hover:text-blue-600 transition-colors">
                    What happens if my application is rejected?
                </span>
                <svg class="w-5 h-5 text-blue-600 transform transition-transform duration-200 flex-shrink-0" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" x-transition.opacity class="px-6 pb-5">
                <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                    If an application is rejected, an administrative notice detailing the explicit rationale (e.g., mismatched data files or unclear uploads) will populate your feed. Corrective profiles or adjustments can be instantly lined up during subsequent submission cycles.
                </p>
            </div>
        </div>

        {{-- FAQ Item 7 --}}
        <div x-data="{ open: false }"
            class="rounded-2xl border transition-all duration-200 overflow-hidden shadow-sm"
            :class="open ? 'bg-blue-50/30 border-blue-200 ring-4 ring-blue-50' : 'bg-white border-gray-100 hover:border-gray-200'">
            <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center gap-4 group">
                <span class="font-bold text-gray-800 text-base md:text-md group-hover:text-blue-600 transition-colors">
                    How do I contact the barangay office for help?
                </span>
                <svg class="w-5 h-5 text-blue-600 transform transition-transform duration-200 flex-shrink-0" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div x-show="open" x-transition.opacity class="px-6 pb-5">
                <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                    You can easily lodge structural requests through our digital
                    <a href="{{ route('contact') }}" class="text-blue-600 font-semibold underline decoration-2 hover:text-blue-700 transition-colors">
                        Contact page Form
                    </a>.
                    Alternatively, feel free to visit the support secretariat in person at the central office venue during standard operation hours.
                </p>
            </div>
        </div>

        {{-- CTA FOOTER --}}
        <div class="text-center pt-10">
            <p class="text-sm text-gray-400 font-medium mb-3">Still have an unresolved technical detail?</p>
            <a href="{{ route('contact') }}"
                class="inline-flex items-center justify-center bg-blue-600 text-white font-semibold px-8 py-3.5 rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transform hover:-translate-y-0.5 transition-all duration-200">
                Contact Desk Support &rarr;
            </a>
        </div>

    </section>
</div>
