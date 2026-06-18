<!-- Google Fonts Integration -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
    rel="stylesheet">

<style>
    /* Mapping the requested font families to standard utility-ready classes */
    .font-serif-elegant {
        font-family: 'Playfair Display', Georgia, serif;
    }

    .font-sans-clean {
        font-family: 'Inter', sans-serif;
    }
</style>

<div class="font-sans-clean bg-gray-50/50 min-h-screen pb-24 selection:bg-blue-500 selection:text-white">
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
                        d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                </svg>
                Learn About Our Initiative
            </span>

            {{-- Title (Fixed Clipping) --}}
            <h1
                class="font-serif-elegant text-4xl md:text-6xl font-extrabold tracking-tight mb-6
                     text-transparent bg-clip-text bg-gradient-to-r from-white via-blue-100 to-blue-200
                     leading-[1.3] drop-shadow-sm">
                About Our Program
            </h1>

            {{-- Description --}}
            <p
                class="text-base md:text-lg leading-relaxed text-blue-100/90 max-w-2xl mx-auto font-light drop-shadow-sm">
                Discover the framework behind the Barangay Scholarship Program and our commitment to empowering local
                residents through educational grants.
            </p>
        </div>
    </section>

    {{-- ABOUT CONTENT --}}
    <section class="max-w-5xl mx-auto px-4 py-16 space-y-12">

        {{-- Mission & Vision Side-by-Side Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Mission --}}
            <div
                class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-md hover:border-blue-100 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 mb-5">
                    <!-- Academic Cap Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>
                </div>
                <h2 class="font-serif-elegant text-2xl font-bold text-gray-800 mb-3">Our Mission</h2>
                <p class="text-gray-600 leading-relaxed text-sm md:text-base font-normal">
                    The Barangay Scholarship Program is dedicated to providing strategic financial assistance to
                    deserving residents who wish to pursue their educational benchmarks. We firmly believe that every
                    resident deserves access to quality schooling options regardless of their household's economic
                    situation.
                </p>
            </div>

            {{-- Vision --}}
            <div
                class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-md hover:border-amber-100 transition-all duration-300">
                <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600 mb-5">
                    <!-- Eye Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
                <h2 class="font-serif-elegant text-2xl font-bold text-gray-800 mb-3">Our Vision</h2>
                <p class="text-gray-600 leading-relaxed text-sm md:text-base font-normal">
                    We envision a progressive barangay environment where every student possesses the functional
                    opportunity to maximize their academic potential, directly contributing to a highly skilled,
                    sustainable, and prosperous local community ecosystem for generations to come.
                </p>
            </div>
        </div>

        {{-- Interactive Eligibility Checker (Alpine.js / Vanilla JS Ready) --}}
        <div x-data="{ checkedCount: 0 }" id="eligibility-card"
            class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm transition-all duration-300">
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-gray-50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center text-green-600">
                        <!-- User Group Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-serif-elegant text-2xl font-bold text-gray-800">Am I Eligible?</h2>
                        <p class="text-xs text-gray-400 mt-0.5">Click the items below to verify your standing.</p>
                    </div>
                </div>
                <!-- Interactive Dynamic Badge Counter -->
                <div id="eligibility-status"
                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-gray-100 text-gray-600 text-xs font-semibold transition-all duration-300">
                    <span id="checked-text">0 of 4 Completed</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Requirement 1 --}}
                <label
                    class="eligibility-item flex items-start gap-3.5 p-4 rounded-xl bg-gray-50/50 border border-gray-100 cursor-pointer hover:bg-blue-50/20 hover:border-blue-200 transition-all duration-200 group">
                    <input type="checkbox" onchange="updateEligibility()"
                        class="mt-1 rounded text-blue-600 focus:ring-blue-500 border-gray-300 w-4 h-4 transition">
                    <span
                        class="text-gray-700 text-sm md:text-base font-medium group-hover:text-gray-900 transition-colors">Must
                        be a verified and registered resident of the barangay.</span>
                </label>

                {{-- Requirement 2 --}}
                <label
                    class="eligibility-item flex items-start gap-3.5 p-4 rounded-xl bg-gray-50/50 border border-gray-100 cursor-pointer hover:bg-blue-50/20 hover:border-blue-200 transition-all duration-200 group">
                    <input type="checkbox" onchange="updateEligibility()"
                        class="mt-1 rounded text-blue-600 focus:ring-blue-500 border-gray-300 w-4 h-4 transition">
                    <span
                        class="text-gray-700 text-sm md:text-base font-medium group-hover:text-gray-900 transition-colors">Must
                        satisfy the explicit eligibility thresholds of the specific program.</span>
                </label>

                {{-- Requirement 3 --}}
                <label
                    class="eligibility-item flex items-start gap-3.5 p-4 rounded-xl bg-gray-50/50 border border-gray-100 cursor-pointer hover:bg-blue-50/20 hover:border-blue-200 transition-all duration-200 group">
                    <input type="checkbox" onchange="updateEligibility()"
                        class="mt-1 rounded text-blue-600 focus:ring-blue-500 border-gray-300 w-4 h-4 transition">
                    <span
                        class="text-gray-700 text-sm md:text-base font-medium group-hover:text-gray-900 transition-colors">Must
                        cleanly organize and submit all required data within deadline structures.</span>
                </label>

                {{-- Requirement 4 --}}
                <label
                    class="eligibility-item flex items-start gap-3.5 p-4 rounded-xl bg-gray-50/50 border border-gray-100 cursor-pointer hover:bg-blue-50/20 hover:border-blue-200 transition-all duration-200 group">
                    <input type="checkbox" onchange="updateEligibility()"
                        class="mt-1 rounded text-blue-600 focus:ring-blue-500 border-gray-300 w-4 h-4 transition">
                    <span
                        class="text-gray-700 text-sm md:text-base font-medium group-hover:text-gray-900 transition-colors">Must
                        not hold concurrent scholarship slots within different local funds.</span>
                </label>
            </div>
        </div>

        {{-- How It Works --}}
        <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
            <div class="text-center md:text-left mb-10">
                <h2
                    class="font-serif-elegant text-2xl font-bold text-gray-800 flex items-center justify-center md:justify-start gap-2.5">
                    <!-- Clipboard Document Check Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 text-blue-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                    </svg>
                    How The System Works
                </h2>
                <p class="text-sm text-gray-500 mt-1">Get through the application workflow process seamlessly.</p>
            </div>

            <!-- Enhanced Visual Connections for Steps -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 relative">
                <!-- Step 1 -->
                <div class="text-center relative group">
                    <div
                        class="w-12 h-12 rounded-2xl bg-blue-600 flex items-center justify-center mx-auto mb-4 text-white font-bold text-lg shadow-md shadow-blue-200 group-hover:bg-blue-700 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        1
                    </div>
                    <h3 class="font-serif-elegant font-bold text-gray-800 mb-1.5 text-base">Register</h3>
                    <p class="text-xs text-gray-500 px-3 leading-relaxed">Securely build out your unique portal login
                        credentials profile.</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center relative group">
                    <div
                        class="w-12 h-12 rounded-2xl bg-blue-600 flex items-center justify-center mx-auto mb-4 text-white font-bold text-lg shadow-md shadow-blue-200 group-hover:bg-blue-700 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        2
                    </div>
                    <h3 class="font-serif-elegant font-bold text-gray-800 mb-1.5 text-base">Verify</h3>
                    <p class="text-xs text-gray-500 px-3 leading-relaxed">Upload official proof of residency data
                        markers to desk clerks.</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center relative group">
                    <div
                        class="w-12 h-12 rounded-2xl bg-blue-600 flex items-center justify-center mx-auto mb-4 text-white font-bold text-lg shadow-md shadow-blue-200 group-hover:bg-blue-700 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        3
                    </div>
                    <h3 class="font-serif-elegant font-bold text-gray-800 mb-1.5 text-base">Apply</h3>
                    <p class="text-xs text-gray-500 px-3 leading-relaxed">Select an operational grant index and submit
                        your requirements.</p>
                </div>

                <!-- Step 4 -->
                <div class="text-center relative group">
                    <div
                        class="w-12 h-12 rounded-2xl bg-blue-600 flex items-center justify-center mx-auto mb-4 text-white font-bold text-lg shadow-md shadow-blue-200 group-hover:bg-blue-700 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        4
                    </div>
                    <h3 class="font-serif-elegant font-bold text-gray-800 mb-1.5 text-base">Receive</h3>
                    <p class="text-xs text-gray-500 px-3 leading-relaxed">Track assessment approvals and get your
                        disbursement notifications.</p>
                </div>
            </div>
        </div>

        {{-- CTA Button --}}
        <div class="text-center pt-4">
            <a href="{{ route('scholarships.index') }}"
                class="inline-flex items-center justify-center gap-2 bg-blue-600 text-white font-semibold px-8 py-4 rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transform hover:-translate-y-0.5 hover:shadow-xl transition-all duration-300 group">
                Browse Active Scholarships
                <!-- Arrow Right Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor"
                    class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>

    </section>
</div>

{{-- Vanilla JavaScript for Interactive Eligibility Checklist --}}
<script>
    function updateEligibility() {
        const checkboxes = document.querySelectorAll('#eligibility-card input[type="checkbox"]');
        const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
        const statusBadge = document.getElementById('eligibility-status');
        const checkedText = document.getElementById('checked-text');
        const mainCard = document.getElementById('eligibility-card');

        checkedText.innerText = `${checkedCount} of 4 Completed`;

        if (checkedCount === 4) {
            statusBadge.className =
                "inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-green-500 text-white text-xs font-semibold transition-all duration-300 animate-bounce";
            checkedText.innerText = "🎉 You Look Eligible!";
            mainCard.classList.add('border-green-200', 'ring-2', 'ring-green-500/10');
        } else if (checkedCount > 0) {
            statusBadge.className =
                "inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-blue-50 text-blue-600 text-xs font-semibold transition-all duration-300";
            mainCard.classList.remove('border-green-200', 'ring-2', 'ring-green-500/10');
        } else {
            statusBadge.className =
                "inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-gray-100 text-gray-600 text-xs font-semibold transition-all duration-300";
            mainCard.classList.remove('border-green-200', 'ring-2', 'ring-green-500/10');
        }
    }
</script>
