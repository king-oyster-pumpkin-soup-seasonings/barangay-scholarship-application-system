<div>
    {{-- HERO SECTION --}}
    <section style="background-color: #1D74E3;" class="py-20 px-4 text-center">
        <h1 class="text-4xl font-bold mb-4 text-white">
            Barangay Scholarship Program
        </h1>
        <p class="text-lg mb-8 text-white opacity-90">
            Empowering residents through education. Apply for a scholarship today.
        </p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('scholarships.index') }}"
                class="bg-white font-semibold px-6 py-3 rounded-lg hover:opacity-90 transition" style="color: #1D74E3;">
                Browse Scholarships
            </a>
            <a href="{{ route('register') }}"
                class="border border-white text-white px-6 py-3 rounded-lg hover:bg-white transition"
                style="hover:color: #1D74E3;">
                Register Now
            </a>
        </div>
    </section>

    {{-- QUICK LINKS --}}
    <section class="max-w-6xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-6 text-center" style="color: #33333B;">
            Quick Links
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('scholarships.index') }}"
                class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition text-center">
                <div class="text-3xl mb-3">🎓</div>
                <h3 class="font-semibold text-lg mb-1" style="color: #33333B;">View Scholarships</h3>
                <p class="text-sm" style="color: #AA9A98;">Browse all available scholarship programs</p>
            </a>
            <a href="{{ route('register') }}"
                class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition text-center">
                <div class="text-3xl mb-3">📝</div>
                <h3 class="font-semibold text-lg mb-1" style="color: #33333B;">Apply Now</h3>
                <p class="text-sm" style="color: #AA9A98;">Register and submit your application</p>
            </a>
            <a href="{{ route('contact') }}"
                class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition text-center">
                <div class="text-3xl mb-3">📬</div>
                <h3 class="font-semibold text-lg mb-1" style="color: #33333B;">Contact Us</h3>
                <p class="text-sm" style="color: #AA9A98;">Send us a message or feedback</p>
            </a>
        </div>
    </section>

    {{-- ANNOUNCEMENTS --}}
    <section class="max-w-6xl mx-auto px-4 pb-12">
        <h2 class="text-2xl font-bold mb-6" style="color: #33333B;">
            📢 Latest Announcements
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($announcements as $announcement)
                <div class="bg-white rounded-xl p-6 shadow-sm border-l-4" style="border-color: #1D74E3;">
                    <h3 class="font-semibold text-lg mb-2" style="color: #33333B;">
                        {{ $announcement['title'] }}
                    </h3>
                    <p class="text-sm mb-3" style="color: #1B1A1C;">
                        {{ $announcement['body'] }}
                    </p>
                    <span class="text-xs" style="color: #AA9A98;">
                        {{ $announcement['created_at'] }}
                    </span>
                </div>
            @endforeach
        </div>
    </section>

    {{-- FEATURED SCHOLARSHIPS --}}
    <section class="max-w-6xl mx-auto px-4 pb-16">
        <h2 class="text-2xl font-bold mb-6" style="color: #33333B;">
            🎓 Featured Scholarships
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($scholarships as $scholarship)
                <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                    @if ($scholarship['status'] === 'available')
                        <span class="text-xs font-semibold px-2 py-1 rounded-full bg-green-100 text-green-700">
                            Available
                        </span>
                    @elseif($scholarship['status'] === 'full')
                        <span class="text-xs font-semibold px-2 py-1 rounded-full bg-red-100 text-red-700">
                            Full
                        </span>
                    @else
                        <span class="text-xs font-semibold px-2 py-1 rounded-full bg-gray-100 text-gray-600">
                            Unavailable
                        </span>
                    @endif

                    <h3 class="font-semibold text-lg mt-3 mb-2" style="color: #33333B;">
                        {{ $scholarship['title'] }}
                    </h3>
                    <p class="text-sm mb-1" style="color: #AA9A98;">
                        💰 ₱{{ number_format($scholarship['allowance'], 2) }}
                    </p>
                    <p class="text-sm mb-1" style="color: #AA9A98;">
                        👥 {{ $scholarship['slots'] }} slots
                    </p>
                    <p class="text-sm mb-4" style="color: #AA9A98;">
                        📅 Deadline: {{ $scholarship['deadline'] }}
                    </p>
                    <a href="{{ route('scholarships.show', $scholarship['id']) }}"
                        class="block text-center text-sm font-semibold py-2 px-4 rounded-lg text-white transition"
                        style="background-color: #1D74E3;">
                        View Details
                    </a>
                </div>
            @endforeach
        </div>
    </section>
</div>
