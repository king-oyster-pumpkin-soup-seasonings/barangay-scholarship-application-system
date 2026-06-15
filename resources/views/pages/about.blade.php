<div>
    {{-- HERO --}}
    <section style="background-color: #1D74E3;" class="py-16 px-4 text-center text-white">
        <h1 class="text-4xl font-bold mb-4">About Us</h1>
        <p class="text-lg opacity-90 max-w-2xl mx-auto">
            Learn more about the Barangay Scholarship Program and our mission to support residents through education.
        </p>
    </section>

    {{-- ABOUT CONTENT --}}
    <section class="max-w-4xl mx-auto px-4 py-12">

        {{-- Mission --}}
        <div class="bg-white rounded-xl p-8 shadow-sm mb-6">
            <h2 class="text-2xl font-bold mb-4" style="color: #33333B;">🎯 Our Mission</h2>
            <p class="text-base leading-relaxed" style="color: #1B1A1C;">
                The Barangay Scholarship Program is dedicated to providing financial assistance
                to deserving residents who wish to pursue their educational goals. We believe
                that every resident deserves access to quality education regardless of their
                financial situation.
            </p>
        </div>

        {{-- Vision --}}
        <div class="bg-white rounded-xl p-8 shadow-sm mb-6">
            <h2 class="text-2xl font-bold mb-4" style="color: #33333B;">🌟 Our Vision</h2>
            <p class="text-base leading-relaxed" style="color: #1B1A1C;">
                We envision a barangay where every student has the opportunity to reach their
                full potential through education, contributing to a stronger and more
                prosperous community for all.
            </p>
        </div>

        {{-- Who Can Apply --}}
        <div class="bg-white rounded-xl p-8 shadow-sm mb-6">
            <h2 class="text-2xl font-bold mb-4" style="color: #33333B;">👥 Who Can Apply?</h2>
            <ul class="space-y-3">
                <li class="flex items-start gap-3">
                    <span style="color: #1D74E3;" class="font-bold">✓</span>
                    <span style="color: #1B1A1C;">Must be a verified resident of the barangay</span>
                </li>
                <li class="flex items-start gap-3">
                    <span style="color: #1D74E3;" class="font-bold">✓</span>
                    <span style="color: #1B1A1C;">Must meet the specific eligibility requirements of each
                        scholarship</span>
                </li>
                <li class="flex items-start gap-3">
                    <span style="color: #1D74E3;" class="font-bold">✓</span>
                    <span style="color: #1B1A1C;">Must submit all required documents on time</span>
                </li>
                <li class="flex items-start gap-3">
                    <span style="color: #1D74E3;" class="font-bold">✓</span>
                    <span style="color: #1B1A1C;">Must not be a current recipient of another barangay scholarship</span>
                </li>
            </ul>
        </div>

        {{-- How It Works --}}
        <div class="bg-white rounded-xl p-8 shadow-sm mb-6">
            <h2 class="text-2xl font-bold mb-6" style="color: #33333B;">📋 How It Works</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="text-center">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 text-white font-bold text-lg"
                        style="background-color: #1D74E3;">1</div>
                    <h3 class="font-semibold mb-1" style="color: #33333B;">Register</h3>
                    <p class="text-sm" style="color: #AA9A98;">Create your account on the system</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 text-white font-bold text-lg"
                        style="background-color: #1D74E3;">2</div>
                    <h3 class="font-semibold mb-1" style="color: #33333B;">Verify</h3>
                    <p class="text-sm" style="color: #AA9A98;">Submit your residency documents</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 text-white font-bold text-lg"
                        style="background-color: #1D74E3;">3</div>
                    <h3 class="font-semibold mb-1" style="color: #33333B;">Apply</h3>
                    <p class="text-sm" style="color: #AA9A98;">Browse and apply for scholarships</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3 text-white font-bold text-lg"
                        style="background-color: #1D74E3;">4</div>
                    <h3 class="font-semibold mb-1" style="color: #33333B;">Receive</h3>
                    <p class="text-sm" style="color: #AA9A98;">Get notified and receive your allowance</p>
                </div>
            </div>
        </div>

        {{-- CTA --}}
        <div class="text-center mt-8">
            <a href="{{ route('scholarships.index') }}"
                class="inline-block text-white font-semibold px-8 py-3 rounded-lg transition"
                style="background-color: #1D74E3;">
                Browse Scholarships
            </a>
        </div>

    </section>
</div>
