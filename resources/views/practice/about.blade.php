<div class="bg-gray-50/50 min-h-screen pb-24">
    {{-- HERO --}}
    <section class="relative overflow-hidden bg-blue-600 py-20 px-4 text-center text-white">
        <!-- Background Accents -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-blue-500 via-blue-600 to-blue-700 opacity-100"></div>
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#fff_1px,transparent_1px),linear-gradient(to_bottom,#fff_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>

        <div class="relative z-10 max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-blue-500/30 text-blue-100 mb-3 backdrop-blur-sm border border-white/10">
                Learn About Our Initiative
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4 drop-shadow-sm">About Our Program</h1>
            <p class="text-lg opacity-90 max-w-2xl mx-auto font-light leading-relaxed text-blue-100">
                Discover the framework behind the Barangay Scholarship Program and our commitment to empowering local residents through educational grants.
            </p>
        </div>
    </section>

    {{-- ABOUT CONTENT --}}
    <section class="max-w-5xl mx-auto px-4 py-16 space-y-12">

        {{-- Mission & Vision Side-by-Side Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Mission --}}
            <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition duration-200">
                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-2xl mb-5">
                    🎯
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Our Mission</h2>
                <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                    The Barangay Scholarship Program is dedicated to providing strategic financial assistance to deserving residents who wish to pursue their educational benchmarks. We firmly believe that every resident deserves access to quality schooling options regardless of their household's economic situation.
                </p>
            </div>

            {{-- Vision --}}
            <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition duration-200">
                <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center text-2xl mb-5">
                    🌟
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Our Vision</h2>
                <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                    We envision a progressive barangay environment where every student possesses the functional opportunity to maximize their academic potential, directly contributing to a highly skilled, sustainable, and prosperous local community ecosystem for generations to come.
                </p>
            </div>
        </div>

        {{-- Who Can Apply --}}
        <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center text-xl">
                    👥
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Who Can Apply?</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-start gap-3.5 p-4 rounded-xl bg-gray-50/50 border border-gray-100">
                    <span class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold">✓</span>
                    <span class="text-gray-700 text-sm md:text-base font-medium">Must be a verified and registered resident of the barangay.</span>
                </div>

                <div class="flex items-start gap-3.5 p-4 rounded-xl bg-gray-50/50 border border-gray-100">
                    <span class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold">✓</span>
                    <span class="text-gray-700 text-sm md:text-base font-medium">Must satisfy the explicit eligibility thresholds of the specific program.</span>
                </div>

                <div class="flex items-start gap-3.5 p-4 rounded-xl bg-gray-50/50 border border-gray-100">
                    <span class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold">✓</span>
                    <span class="text-gray-700 text-sm md:text-base font-medium">Must cleanly organize and submit all required data within deadline structures.</span>
                </div>

                <div class="flex items-start gap-3.5 p-4 rounded-xl bg-gray-50/50 border border-gray-100">
                    <span class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold">✓</span>
                    <span class="text-gray-700 text-sm md:text-base font-medium">Must not hold concurrent scholarship slots within different local funds.</span>
                </div>
            </div>
        </div>

        {{-- How It Works --}}
        <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
            <div class="text-center md:text-left mb-8">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center justify-center md:justify-start gap-2">
                    📋 How The System Works
                </h2>
                <p class="text-sm text-gray-500 mt-1">Get through the application workflow process seamlessly.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 relative">
                <!-- Step 1 -->
                <div class="text-center relative group">
                    <div class="w-12 h-12 rounded-2xl bg-blue-600 flex items-center justify-center mx-auto mb-4 text-white font-bold text-lg shadow-md shadow-blue-200 group-hover:scale-105 transition-transform">
                        1
                    </div>
                    <h3 class="font-bold text-gray-800 mb-1">Register</h3>
                    <p class="text-xs text-gray-500 px-4 leading-relaxed">Securely build out your unique portal login credentials profile.</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center relative group">
                    <div class="w-12 h-12 rounded-2xl bg-blue-600 flex items-center justify-center mx-auto mb-4 text-white font-bold text-lg shadow-md shadow-blue-200 group-hover:scale-105 transition-transform">
                        2
                    </div>
                    <h3 class="font-bold text-gray-800 mb-1">Verify</h3>
                    <p class="text-xs text-gray-500 px-4 leading-relaxed">Upload official proof of residency data markers to desk clerks.</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center relative group">
                    <div class="w-12 h-12 rounded-2xl bg-blue-600 flex items-center justify-center mx-auto mb-4 text-white font-bold text-lg shadow-md shadow-blue-200 group-hover:scale-105 transition-transform">
                        3
                    </div>
                    <h3 class="font-bold text-gray-800 mb-1">Apply</h3>
                    <p class="text-xs text-gray-500 px-4 leading-relaxed">Select an operational grant index and submit your requirements.</p>
                </div>

                <!-- Step 4 -->
                <div class="text-center relative group">
                    <div class="w-12 h-12 rounded-2xl bg-blue-600 flex items-center justify-center mx-auto mb-4 text-white font-bold text-lg shadow-md shadow-blue-200 group-hover:scale-105 transition-transform">
                        4
                    </div>
                    <h3 class="font-bold text-gray-800 mb-1">Receive</h3>
                    <p class="text-xs text-gray-500 px-4 leading-relaxed">Track assessment approvals and get your disbursement notifications.</p>
                </div>
            </div>
        </div>

        {{-- CTA Button --}}
        <div class="text-center pt-4">
            <a href="{{ route('scholarships.index') }}"
                class="inline-flex items-center justify-center bg-blue-600 text-white font-semibold px-8 py-3.5 rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transform hover:-translate-y-0.5 transition-all duration-200">
                Browse Active Scholarships &rarr;
            </a>
        </div>

    </section>
</div>
