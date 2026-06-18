<div style="background-color: #E5E8EF; min-height: 100%;" class="p-4 pb-10 space-y-8">

    @if (auth()->user()->role === 'admin')
        {{-- ========================================================================== --}}
        {{-- ── ADMIN HUB LAYOUT ────────────────────────────────────────────────────── --}}
        {{-- ========================================================================== --}}

        <div class="pt-2">
            <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color: #AA9A98;">
                Admin Portal
            </p>
            <h1 class="text-3xl font-extrabold text-[#33333B] tracking-tight">Admin Dashboard</h1>
            <p class="text-[#AA9A98] text-sm mt-1.5 font-medium">Welcome to the admin panel. Manage systems and review pending applications.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 my-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex justify-between items-start">
                <div>
                    <p class="text-xs text-[#AA9A98] uppercase font-bold tracking-wider">Pending Verifications</p>
                    <p class="text-4xl font-extrabold text-[#1D74E3] mt-2">{{ $pendingVerifications ?? 0 }}</p>
                </div>
                <div class="p-2.5 bg-[#1D74E3]/10 rounded-lg text-[#1D74E3] shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex justify-between items-start">
                <div>
                    <p class="text-xs text-[#AA9A98] uppercase font-bold tracking-wider">Pending Applications</p>
                    <p class="text-4xl font-extrabold text-[#1D74E3] mt-2">{{ $pendingApplications ?? 0 }}</p>
                </div>
                <div class="p-2.5 bg-[#1D74E3]/10 rounded-lg text-[#1D74E3] shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex justify-between items-start">
                <div>
                    <p class="text-xs text-[#AA9A98] uppercase font-bold tracking-wider">Total Scholars</p>
                    <p class="text-4xl font-extrabold text-[#1D74E3] mt-2">{{ $totalScholars ?? 0 }}</p>
                </div>
                <div class="p-2.5 bg-[#1D74E3]/10 rounded-lg text-[#1D74E3] shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex justify-between items-start">
                <div>
                    <p class="text-xs text-[#AA9A98] uppercase font-bold tracking-wider">Active Announcements</p>
                    <p class="text-4xl font-extrabold text-[#1D74E3] mt-2">{{ $activeAnnouncements ?? 0 }}</p>
                </div>
                <div class="p-2.5 bg-[#1D74E3]/10 rounded-lg text-[#1D74E3] shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <a href="{{ route('admin.verifications') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:-translate-y-1 hover:shadow-md hover:border-[#1D74E3]/30 transition duration-200 ease-in-out group flex flex-col justify-between">
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-[#33333B] group-hover:text-[#1D74E3] transition duration-150">Residence Verifications</h2>
                    <p class="text-sm text-[#AA9A98] mt-1.5 font-medium leading-relaxed">Review and process pending residence verification requests.</p>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center text-xs font-bold bg-[#1D74E3]/10 text-[#1D74E3] group-hover:bg-[#1D74E3] group-hover:text-white px-3.5 py-2 rounded-lg transition duration-150">
                        Review Now &rarr;
                    </span>
                </div>
            </a>

            <a href="{{ route('admin.applications') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:-translate-y-1 hover:shadow-md hover:border-[#1D74E3]/30 transition duration-200 ease-in-out group flex flex-col justify-between">
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-[#33333B] group-hover:text-[#1D74E3] transition duration-150">Scholarship Applications</h2>
                    <p class="text-sm text-[#AA9A98] mt-1.5 font-medium leading-relaxed">Review and process pending scholarship applications.</p>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center text-xs font-bold bg-[#1D74E3]/10 text-[#1D74E3] group-hover:bg-[#1D74E3] group-hover:text-white px-3.5 py-2 rounded-lg transition duration-150">
                        Review Now &rarr;
                    </span>
                </div>
            </a>

            <a href="{{ route('admin.announcements') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:-translate-y-1 hover:shadow-md hover:border-[#1D74E3]/30 transition duration-200 ease-in-out group flex flex-col justify-between">
                <div class="mb-4">
                    <h2 class="text-lg font-bold text-[#33333B] group-hover:text-[#1D74E3] transition duration-150">Manage Announcements</h2>
                    <p class="text-sm text-[#AA9A98] mt-1.5 font-medium leading-relaxed">Create, edit, and publish important updates or notices for applicants.</p>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center text-xs font-bold bg-[#1D74E3]/10 text-[#1D74E3] group-hover:bg-[#1D74E3] group-hover:text-white px-3.5 py-2 rounded-lg transition duration-150">
                        Manage Now &rarr;
                    </span>
                </div>
            </a>
        </div>

    @else
        {{-- ========================================================================== --}}
        {{-- ── RESIDENT / USER LAYOUT ──────────────────────────────────────────────── --}}
        {{-- ========================================================================== --}}

        <div class="pt-2">
            <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color: #AA9A98;">
                Resident Portal
            </p>
            <h1 class="text-2xl font-bold leading-tight" style="color: #33333B;">
                Hi, {{ auth()->user()->name }}!
            </h1>
            <p class="text-sm mt-1" style="color: #AA9A98;">
                Your scholarship application overview.
            </p>
        </div>

        {{-- ── Verification Status ────────────────── --}}
        @php $vstatus = $verification?->status; @endphp

        @if ($vstatus === 'verified')
            <div class="rounded-xl border-l-4 p-5 flex items-start gap-4"
                 style="background-color: #f0fdf4; border-left-color: #22c55e; border-top: 1px solid #bbf7d0; border-right: 1px solid #bbf7d0; border-bottom: 1px solid #bbf7d0;">
                <div class="shrink-0 mt-0.5">
                    <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#22c55e">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-green-800 text-sm">Residence Verified</p>
                    <p class="text-sm text-green-700 mt-0.5">
                        Your residency is confirmed. You can apply for scholarships below.
                    </p>
                </div>
            </div>

        @elseif ($vstatus === 'pending')
            <div class="rounded-xl border-l-4 p-5 flex items-start gap-4"
                 style="background-color: #fefce8; border-left-color: #eab308; border-top: 1px solid #fde047; border-right: 1px solid #fde047; border-bottom: 1px solid #fde047;">
                <div class="shrink-0 mt-0.5">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#ca8a04">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-yellow-800 text-sm">Under Review</p>
                    <p class="text-sm text-yellow-700 mt-0.5">
                        Your documents are being reviewed by barangay staff. Please wait.
                    </p>
                </div>
            </div>

        @elseif ($vstatus === 'rejected')
            <div class="rounded-xl border-l-4 p-5 flex items-start gap-4"
                 style="background-color: #fef2f2; border-left-color: #ef4444; border-top: 1px solid #fca5a5; border-right: 1px solid #fca5a5; border-bottom: 1px solid #fca5a5;">
                <div class="shrink-0 mt-0.5">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#ef4444">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-red-800 text-sm">Verification Rejected</p>
                    <p class="text-sm text-red-700 mt-0.5">
                        Your documents were rejected. Please re-submit with valid files.
                    </p>
                    <a href="{{ route('verification') }}"
                       class="inline-flex items-center gap-1.5 mt-3 text-sm font-semibold px-4 py-2 rounded-lg text-white"
                       style="background-color: #1D74E3;">
                        Re-submit Documents
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                </div>
            </div>

        @else
            <div class="rounded-xl border-l-4 p-5 flex items-start gap-4 bg-white"
                 style="border-left-color: #1D74E3; border-top: 1px solid #e5e7eb; border-right: 1px solid #e5e7eb; border-bottom: 1px solid #e5e7eb;">
                <div class="shrink-0 mt-0.5">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#1D74E3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-sm" style="color: #33333B;">Verify Your Residency First</p>
                    <p class="text-sm mt-0.5" style="color: #AA9A98;">
                        Residency verification is required before applying for any scholarship.
                    </p>
                    <a href="{{ route('verification') }}"
                       class="inline-flex items-center gap-1.5 mt-3 text-sm font-semibold px-4 py-2 rounded-lg text-white"
                       style="background-color: #1D74E3;">
                        Start Verification
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        @endif

        {{-- ── My Applications ────────────────────── --}}
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color: #AA9A98;">
                Tracking
            </p>
            <h2 class="text-lg font-bold mb-3" style="color: #33333B;">My Applications</h2>

            @if ($applications->isEmpty())
                <div class="rounded-xl bg-white border p-8 text-center" style="border-color: #e5e7eb;">
                    <svg class="w-8 h-8 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color:#AA9A98">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/>
                    </svg>
                    <p class="text-sm" style="color: #AA9A98;">No applications submitted yet.</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach ($applications as $app)
                        @php
                            $borderColor = match($app->status) {
                                'approved' => '#22c55e',
                                'rejected' => '#ef4444',
                                default    => '#eab308',
                            };
                            $badgeBg = match($app->status) {
                                'approved' => 'background-color:#dcfce7; color:#166534;',
                                'rejected' => 'background-color:#fee2e2; color:#991b1b;',
                                default    => 'background-color:#fef9c3; color:#854d0e;',
                            };
                        @endphp

                        <div class="rounded-xl bg-white border-l-4 border p-4 flex items-center justify-between gap-3"
                             style="border-left-color: {{ $borderColor }}; border-top-color: #e5e7eb; border-right-color: #e5e7eb; border-bottom-color: #e5e7eb;">
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-sm truncate" style="color: #1B1A1C;">
                                    {{ $app->scholarship->title }}
                                </p>
                                <p class="text-xs mt-0.5" style="color: #AA9A98;">
                                    <span>Submitted {{ $app->created_at->timezone('Asia/Manila')->format('M d, Y') }}</span>
                                </p>
                                @if ($app->remarks)
                                    <p class="text-xs mt-1.5 italic" style="color: #ef4444;">
                                        {{ $app->remarks }}
                                    </p>
                                @endif
                            </div>
                            <span class="shrink-0 text-xs font-semibold px-3 py-1 rounded-full"
                                  style="{{ $badgeBg }}">
                                {{ ucfirst($app->status) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- ── Available Scholarships ─────────────── --}}
        @if ($vstatus === 'verified')
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color: #AA9A98;">
                    Open Now
                </p>
                <h2 class="text-lg font-bold mb-3" style="color: #33333B;">Available Scholarships</h2>

                @if ($scholarships->isEmpty())
                    <div class="rounded-xl bg-white border p-8 text-center" style="border-color: #e5e7eb;">
                        <svg class="w-8 h-8 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color:#AA9A98">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                        </svg>
                        <p class="text-sm" style="color: #AA9A98;">No new scholarships available right now. Check back later.</p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach ($scholarships as $scholarship)
                            <div class="rounded-xl bg-white border p-4" style="border-color: #e5e7eb;">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-sm" style="color: #33333B;">
                                            {{ $scholarship->title }}
                                        </p>
                                        <p class="text-xs mt-1 line-clamp-2" style="color: #AA9A98;">
                                            {{ $scholarship->description }}
                                        </p>

                                        {{-- Stats row --}}
                                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-3">
                                            <span class="text-base font-bold" style="color: #1D74E3;">
                                                ₱{{ number_format($scholarship->allowance) }}
                                            </span>
                                            <span class="text-xs" style="color: #AA9A98;">
                                                {{ $scholarship->slots }} {{ $scholarship->slots === 1 ? 'slot' : 'slots' }} left
                                            </span>
                                            <span class="text-xs" style="color: #AA9A98;">
                                                Deadline: {{ \Carbon\Carbon::parse($scholarship->deadline)->format('M d, Y') }}
                                            </span>
                                        </div>
                                    </div>

                                    <a href="{{ route('applications.create', $scholarship) }}"
                                       class="shrink-0 self-center text-sm font-semibold px-4 py-2 rounded-lg text-white"
                                       style="background-color: #1D74E3;">
                                        Apply
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
    @endif

</div>
