<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

<style>
    /* Styling overrides for the requested typography */
    .font-heading { font-family: 'Playfair Display', serif; }
    .font-body { font-family: 'Inter', sans-serif; }
</style>

<div class="font-body bg-gray-50/50 min-h-screen pb-24">
    {{-- HERO --}}
    <section class="relative overflow-hidden bg-blue-900 py-20 px-4 text-center text-white">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-blue-500 via-blue-600 to-blue-700 opacity-100"></div>
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#fff_1px,transparent_1px),linear-gradient(to_bottom,#fff_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>

        <div class="relative z-10 max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-blue-500/30 text-blue-100 mb-4 backdrop-blur-sm border border-white/10">
                <svg class="w-3.5 h-3.5 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M5.636 18.364l3.536-3.536m0-5.656L5.636 5.636M12 12a4 4 0 100-8 4 4 0 000 8zm0 0v8"></path>
                </svg>
                Knowledge Base Desk
            </span>
            <h1 class="font-heading text-4xl md:text-5xl font-bold tracking-tight mb-4 drop-shadow-sm">Frequently Asked Questions</h1>
            <p class="text-lg opacity-90 max-w-2xl mx-auto font-light text-blue-100 leading-relaxed">
                Find immediate answers regarding eligibility criteria, validation timelines, and document requirements.
            </p>
        </div>
    </section>

    {{-- INTERACTIVE FAQ WRAPPER WITH LIVE SEARCH --}}
    <section x-data="{ search: '' }" class="max-w-3xl mx-auto px-4 py-12">

        <div class="mb-8 relative">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input
                x-model="search"
                type="text"
                placeholder="Search queries, keywords, or topics..."
                class="w-full pl-11 pr-4 py-3.5 bg-white border border-gray-200 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-gray-400 text-sm"
            >
        </div>

        <div class="space-y-4">
            {{-- FAQ Item 1 --}}
            <div x-data="{ open: false, question: 'who is eligible to apply for a scholarship?' }"
                 x-show="search === '' || question.includes(search.toLowerCase())"
                 x-transition.duration.300ms
                 class="rounded-2xl border transition-all duration-200 overflow-hidden shadow-sm"
                 :class="open ? 'bg-blue-50/30 border-blue-200 ring-4 ring-blue-50' : 'bg-white border-gray-100 hover:border-gray-200'">
                <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center gap-4 group">
                    <div class="p-2 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-100 transition-colors flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-800 text-base md:text-md group-hover:text-blue-600 transition-colors flex-1">
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
            <div x-data="{ open: false, question: 'what documents do i need to submit?' }"
                 x-show="search === '' || question.includes(search.toLowerCase())"
                 x-transition.duration.300ms
                 class="rounded-2xl border transition-all duration-200 overflow-hidden shadow-sm"
                 :class="open ? 'bg-blue-50/30 border-blue-200 ring-4 ring-blue-50' : 'bg-white border-gray-100 hover:border-gray-200'">
                <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center gap-4 group">
                    <div class="p-2 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-100 transition-colors flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-800 text-base md:text-md group-hover:text-blue-600 transition-colors flex-1">
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
            <div x-data="{ open: false, question: 'how long does the verification process take?' }"
                 x-show="search === '' || question.includes(search.toLowerCase())"
                 x-transition.duration.300ms
                 class="rounded-2xl border transition-all duration-200 overflow-hidden shadow-sm"
                 :class="open ? 'bg-blue-50/30 border-blue-200 ring-4 ring-blue-50' : 'bg-white border-gray-100 hover:border-gray-200'">
                <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center gap-4 group">
                    <div class="p-2 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-100 transition-colors flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-800 text-base md:text-md group-hover:text-blue-600 transition-colors flex-1">
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
            <div x-data="{ open: false, question: 'can i apply for more than one scholarship?' }"
                 x-show="search === '' || question.includes(search.toLowerCase())"
                 x-transition.duration.300ms
                 class="rounded-2xl border transition-all duration-200 overflow-hidden shadow-sm"
                 :class="open ? 'bg-blue-50/30 border-blue-200 ring-4 ring-blue-50' : 'bg-white border-gray-100 hover:border-gray-200'">
                <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center gap-4 group">
                    <div class="p-2 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-100 transition-colors flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-800 text-base md:text-md group-hover:text-blue-600 transition-colors flex-1">
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
            <div x-data="{ open: false, question: 'how will i know if my application is approved?' }"
                 x-show="search === '' || question.includes(search.toLowerCase())"
                 x-transition.duration.300ms
                 class="rounded-2xl border transition-all duration-200 overflow-hidden shadow-sm"
                 :class="open ? 'bg-blue-50/30 border-blue-200 ring-4 ring-blue-50' : 'bg-white border-gray-100 hover:border-gray-200'">
                <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center gap-4 group">
                    <div class="p-2 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-100 transition-colors flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-800 text-base md:text-md group-hover:text-blue-600 transition-colors flex-1">
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
            <div x-data="{ open: false, question: 'what happens if my application is rejected?' }"
                 x-show="search === '' || question.includes(search.toLowerCase())"
                 x-transition.duration.300ms
                 class="rounded-2xl border transition-all duration-200 overflow-hidden shadow-sm"
                 :class="open ? 'bg-blue-50/30 border-blue-200 ring-4 ring-blue-50' : 'bg-white border-gray-100 hover:border-gray-200'">
                <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center gap-4 group">
                    <div class="p-2 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-100 transition-colors flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-800 text-base md:text-md group-hover:text-blue-600 transition-colors flex-1">
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
            <div x-data="{ open: false, question: 'how do i contact the barangay office for help?' }"
                 x-show="search === '' || question.includes(search.toLowerCase())"
                 x-transition.duration.300ms
                 class="rounded-2xl border transition-all duration-200 overflow-hidden shadow-sm"
                 :class="open ? 'bg-blue-50/30 border-blue-200 ring-4 ring-blue-50' : 'bg-white border-gray-100 hover:border-gray-200'">
                <button @click="open = !open" class="w-full text-left px-6 py-5 flex justify-between items-center gap-4 group">
                    <div class="p-2 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-100 transition-colors flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M5.636 18.364l3.536-3.536m0-5.656L5.636 5.636M12 12a4 4 0 100-8 4 4 0 000 8zm0 0v8"></path>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-800 text-base md:text-md group-hover:text-blue-600 transition-colors flex-1">
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
        </div>

        {{-- CTA FOOTER --}}
        <div class="text-center pt-14">
            <p class="text-sm text-gray-400 font-medium mb-3">Still have an unresolved technical detail?</p>
            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center bg-blue-600 text-white font-semibold px-8 py-3.5 rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 group transform hover:-translate-y-0.5 transition-all duration-200 gap-2">
                <span>Contact Desk Support</span>
                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>

    </section>
</div>
