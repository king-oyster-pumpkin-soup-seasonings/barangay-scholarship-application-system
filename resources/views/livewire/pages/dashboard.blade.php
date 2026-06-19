<div>

{{-- ============================================================ --}}
{{-- ADMIN DASHBOARD                                              --}}
{{-- ============================================================ --}}
@if (auth()->user()->role === 'admin')

    {{-- Hero Bar --}}
    <div class="relative overflow-hidden" style="background-color: #1a2f5e; min-height: 180px;">
        {{-- Grid texture --}}
        <div class="absolute inset-0 opacity-[0.07]"
             style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <p class="text-xs font-bold uppercase tracking-[0.2em] mb-2" style="color: #93afd4;">Admin Portal</p>
            <h1 class="text-4xl font-extrabold tracking-tight text-white"
                style="font-family: 'Playfair Display', serif;">Admin Dashboard</h1>
            <p class="mt-2 text-base font-medium" style="color: #93afd4;">Manage systems and review pending applications.</p>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <div class="bg-white rounded-2xl shadow-md border border-gray-100 px-6 py-5 flex items-center gap-4">
                <div class="p-3 rounded-xl" style="background-color: #EEF4FD;">
                    <svg class="w-6 h-6" fill="none" stroke="#1D74E3" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider" style="color: #AA9A98;">Pending Verifications</p>
                    <p class="text-3xl font-extrabold mt-0.5" style="color: #1D74E3;">{{ $pendingVerifications ?? 0 }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md border border-gray-100 px-6 py-5 flex items-center gap-4">
                <div class="p-3 rounded-xl" style="background-color: #EEF4FD;">
                    <svg class="w-6 h-6" fill="none" stroke="#1D74E3" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider" style="color: #AA9A98;">Pending Applications</p>
                    <p class="text-3xl font-extrabold mt-0.5" style="color: #1D74E3;">{{ $pendingApplications ?? 0 }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md border border-gray-100 px-6 py-5 flex items-center gap-4">
                <div class="p-3 rounded-xl" style="background-color: #EEF4FD;">
                    <svg class="w-6 h-6" fill="none" stroke="#1D74E3" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider" style="color: #AA9A98;">Total Scholars</p>
                    <p class="text-3xl font-extrabold mt-0.5" style="color: #1D74E3;">{{ $totalScholars ?? 0 }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md border border-gray-100 px-6 py-5 flex items-center gap-4">
                <div class="p-3 rounded-xl" style="background-color: #EEF4FD;">
                    <svg class="w-6 h-6" fill="none" stroke="#1D74E3" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider" style="color: #AA9A98;">Active Announcements</p>
                    <p class="text-3xl font-extrabold mt-0.5" style="color: #1D74E3;">{{ $activeAnnouncements ?? 0 }}</p>
                </div>
            </div>

        </div>
    </div>

    {{-- Quick Action Cards --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <p class="text-xs font-bold uppercase tracking-[0.15em] mb-1" style="color: #AA9A98;">Quick Actions</p>
        <h2 class="text-xl font-bold mb-5" style="color: #33333B;">Manage</h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            <a href="{{ route('admin.verifications') }}"
               class="group relative overflow-hidden bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between">
                <div class="absolute top-0 right-0 w-24 h-24 rounded-bl-full opacity-5 group-hover:opacity-10 transition-opacity" style="background-color: #1D74E3;"></div>
                <div>
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4" style="background-color: #EEF4FD;">
                        <svg class="w-5 h-5" fill="none" stroke="#1D74E3" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold group-hover:text-[#1D74E3] transition-colors" style="color: #33333B;">Residence Verifications</h3>
                    <p class="text-sm mt-1.5 leading-relaxed" style="color: #AA9A98;">Review and process pending residence verification requests.</p>
                </div>
                <div class="mt-5">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold px-4 py-2 rounded-lg transition-all duration-150 group-hover:text-white"
                          style="background-color: #EEF4FD; color: #1D74E3;"
                          onmouseover="this.style.backgroundColor='#1D74E3'"
                          onmouseout="this.style.backgroundColor='#EEF4FD'">
                        Review Now &rarr;
                    </span>
                </div>
            </a>

            <a href="{{ route('admin.applications') }}"
               class="group relative overflow-hidden bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between">
                <div class="absolute top-0 right-0 w-24 h-24 rounded-bl-full opacity-5 group-hover:opacity-10 transition-opacity" style="background-color: #1D74E3;"></div>
                <div>
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4" style="background-color: #EEF4FD;">
                        <svg class="w-5 h-5" fill="none" stroke="#1D74E3" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold group-hover:text-[#1D74E3] transition-colors" style="color: #33333B;">Scholarship Applications</h3>
                    <p class="text-sm mt-1.5 leading-relaxed" style="color: #AA9A98;">Review and process pending scholarship applications.</p>
                </div>
                <div class="mt-5">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold px-4 py-2 rounded-lg"
                          style="background-color: #EEF4FD; color: #1D74E3;">
                        Review Now &rarr;
                    </span>
                </div>
            </a>

            <a href="{{ route('admin.announcements') }}"
               class="group relative overflow-hidden bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between">
                <div class="absolute top-0 right-0 w-24 h-24 rounded-bl-full opacity-5 group-hover:opacity-10 transition-opacity" style="background-color: #1D74E3;"></div>
                <div>
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4" style="background-color: #EEF4FD;">
                        <svg class="w-5 h-5" fill="none" stroke="#1D74E3" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold group-hover:text-[#1D74E3] transition-colors" style="color: #33333B;">Manage Announcements</h3>
                    <p class="text-sm mt-1.5 leading-relaxed" style="color: #AA9A98;">Create, edit, and publish important updates or notices for applicants.</p>
                </div>
                <div class="mt-5">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold px-4 py-2 rounded-lg"
                          style="background-color: #EEF4FD; color: #1D74E3;">
                        Manage Now &rarr;
                    </span>
                </div>
            </a>

        </div>
    </div>


{{-- ============================================================ --}}
{{-- RESIDENT DASHBOARD                                           --}}
{{-- ============================================================ --}}
@else

    {{-- Hero Greeting Bar --}}
    <div class="relative overflow-hidden" style="background-color: #1a2f5e; min-height: 200px;">
        {{-- Grid texture (matches About/Scholarships pages) --}}
        <div class="absolute inset-0 opacity-[0.07]"
             style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 40px 40px;"></div>
        {{-- Subtle radial glow --}}
        <div class="absolute -top-20 -left-20 w-96 h-96 rounded-full opacity-10"
             style="background: radial-gradient(circle, #4a9eff 0%, transparent 70%);"></div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <p class="text-xs font-bold uppercase tracking-[0.2em] mb-2" style="color: #93afd4;">Resident Portal</p>
            <h1 class="text-4xl font-extrabold tracking-tight text-white"
                style="font-family: 'Playfair Display', serif;">
                Hi, {{ auth()->user()->name }}!
            </h1>
            <p class="mt-2 text-base font-medium" style="color: #93afd4;">Your scholarship application overview.</p>
        </div>
    </div>

    {{-- Page Body --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">

        {{-- ── Verification Status Banner ──────────────────────────────────── --}}
        @php $vstatus = $verification?->status; @endphp

        @if ($vstatus === 'verified')
            <div class="rounded-2xl border p-5 flex items-start gap-4"
                 style="background-color: #f0fdf4; border-color: #bbf7d0; border-left: 4px solid #22c55e;">
                <div class="shrink-0 mt-0.5 w-9 h-9 rounded-xl flex items-center justify-center" style="background-color: #dcfce7;">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="#22c55e" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-green-800 text-sm">Residence Verified</p>
                    <p class="text-sm text-green-700 mt-0.5">Your residency is confirmed. You can apply for scholarships below.</p>
                </div>
            </div>

        @elseif ($vstatus === 'pending')
            <div class="rounded-2xl border p-5 flex items-start gap-4"
                 style="background-color: #fefce8; border-color: #fde047; border-left: 4px solid #eab308;">
                <div class="shrink-0 mt-0.5 w-9 h-9 rounded-xl flex items-center justify-center" style="background-color: #fef9c3;">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="#ca8a04" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold text-yellow-800 text-sm">Under Review</p>
                    <p class="text-sm text-yellow-700 mt-0.5">Your documents are being reviewed by barangay staff. Please wait.</p>
                </div>
            </div>

        @elseif ($vstatus === 'rejected')
            <div class="rounded-2xl border p-5 flex items-start gap-4"
                 style="background-color: #fef2f2; border-color: #fca5a5; border-left: 4px solid #ef4444;">
                <div class="shrink-0 mt-0.5 w-9 h-9 rounded-xl flex items-center justify-center" style="background-color: #fee2e2;">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="#ef4444" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-red-800 text-sm">Verification Rejected</p>
                    <p class="text-sm text-red-700 mt-0.5">Your documents were rejected. Please visit the Barangay Hall to re-submit your documents in person or contact the scholarship office for assistance.</p>
                </div>
            </div>

        @else
            <div class="rounded-2xl border bg-white p-5 flex items-start gap-4"
                 style="border-color: #e5e7eb; border-left: 4px solid #1D74E3;">
                <div class="shrink-0 mt-0.5 w-9 h-9 rounded-xl flex items-center justify-center" style="background-color: #EEF4FD;">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="#1D74E3" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-sm" style="color: #33333B;">Verify Your Residency First</p>
                    <p class="text-sm mt-0.5" style="color: #AA9A98;">Residency verification is required before applying for any scholarship.</p>
                    <a href="{{ route('verification') }}"
                       class="inline-flex items-center gap-1.5 mt-3 text-sm font-bold px-4 py-2 rounded-xl text-white transition hover:opacity-90"
                       style="background-color: #1D74E3;">
                        Start Verification
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        @endif

        {{-- ── Two-column layout: My Applications + Announcements ──────────── --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

            {{-- My Applications (wider) --}}
            <div class="lg:col-span-3 space-y-1">
                <p class="text-xs font-bold uppercase tracking-[0.15em]" style="color: #AA9A98;">Tracking</p>
                <h2 class="text-xl font-bold mb-4" style="color: #33333B;">My Applications</h2>

                @if ($applications->isEmpty())
                    <div class="rounded-2xl bg-white border border-gray-100 px-6 py-14 flex flex-col items-center text-center shadow-sm">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-3" style="background-color: #F1F5F9;">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="#AA9A98" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium" style="color: #AA9A98;">No applications submitted yet.</p>
                        @if ($vstatus === 'verified')
                            <p class="text-xs mt-1" style="color: #CBD5E1;">Browse available scholarships below to get started.</p>
                        @endif
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
                                    'approved' => '#dcfce7',
                                    'rejected' => '#fee2e2',
                                    default    => '#fef9c3',
                                };
                                $badgeText = match($app->status) {
                                    'approved' => '#166534',
                                    'rejected' => '#991b1b',
                                    default    => '#854d0e',
                                };
                            @endphp
                            <div class="rounded-2xl bg-white border shadow-sm p-5 flex items-center justify-between gap-3"
                                 style="border-color: #e5e7eb; border-left: 4px solid {{ $borderColor }};">
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-sm truncate" style="color: #33333B;">
                                        {{ $app->scholarship->title }}
                                    </p>
                                    <p class="text-xs mt-0.5" style="color: #AA9A98;">
                                        Submitted {{ $app->created_at->timezone('Asia/Manila')->format('M d, Y') }}
                                    </p>
                                    @if ($app->remarks)
                                        <p class="text-xs mt-1.5 italic" style="color: #ef4444;">{{ $app->remarks }}</p>
                                    @endif
                                </div>
                                <span class="shrink-0 text-xs font-bold px-3 py-1.5 rounded-full"
                                      style="background-color: {{ $badgeBg }}; color: {{ $badgeText }};">
                                    {{ ucfirst($app->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Announcements (narrower sidebar) --}}
            <div class="lg:col-span-2 space-y-1">
                <p class="text-xs font-bold uppercase tracking-[0.15em]" style="color: #AA9A98;">Updates</p>
                <h2 class="text-xl font-bold mb-4" style="color: #33333B;">Announcements</h2>

                @if ($announcements->isEmpty())
                    <div class="rounded-2xl bg-white border border-gray-100 px-6 py-14 flex flex-col items-center text-center shadow-sm">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-3" style="background-color: #F1F5F9;">
                            <svg class="w-6 h-6" fill="none" stroke="#AA9A98" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 1 8.835-2.535m0 0A23.74 23.74 0 0 1 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium" style="color: #AA9A98;">No announcements at this time.</p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach ($announcements as $announcement)
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm px-5 py-4 hover:shadow-md hover:border-blue-100 transition-all duration-150">
                                <div class="flex gap-3">
                                    <div class="w-1 self-stretch rounded-full flex-shrink-0" style="background-color: #1D74E3;"></div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-bold text-sm leading-snug" style="color: #33333B;">
                                            {{ $announcement->title }}
                                        </h3>
                                        <p class="text-sm mt-1 leading-relaxed" style="color: #AA9A98;">
                                            {{ $announcement->body }}
                                        </p>
                                        <div class="flex items-center gap-2 mt-2.5 text-xs" style="color: #CBD5E1;">
                                            <span>{{ $announcement->creator->name ?? 'Barangay Office' }}</span>
                                            <span>&middot;</span>
                                            <span>{{ $announcement->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>

        {{-- ── Available Scholarships ───────────────────────────────────────── --}}
        @if ($vstatus === 'verified')
            <div>
                <div class="flex items-end justify-between mb-5">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.15em]" style="color: #AA9A98;">Open Now</p>
                        <h2 class="text-xl font-bold" style="color: #33333B;">Available Scholarships</h2>
                    </div>
                    <a href="{{ route('scholarships.index') }}" class="text-sm font-semibold hover:underline" style="color: #1D74E3;">
                        Browse all &rarr;
                    </a>
                </div>

                @if ($scholarships->isEmpty())
                    <div class="rounded-2xl bg-white border border-gray-100 px-6 py-14 flex flex-col items-center text-center shadow-sm">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-3" style="background-color: #F1F5F9;">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="#AA9A98" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium" style="color: #AA9A98;">No new scholarships available right now. Check back later.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ($scholarships as $scholarship)
                            <div class="rounded-2xl bg-white border border-gray-100 shadow-sm p-5 hover:shadow-md hover:border-blue-100 transition-all duration-150 flex flex-col justify-between">
                                <div>
                                    <p class="font-bold text-sm" style="color: #33333B;">{{ $scholarship->title }}</p>
                                    <p class="text-xs mt-1 leading-relaxed line-clamp-2" style="color: #AA9A98;">{{ $scholarship->description }}</p>

                                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-3">
                                        <span class="text-lg font-extrabold" style="color: #1D74E3;">
                                            ₱{{ number_format($scholarship->allowance) }}
                                        </span>
                                        <span class="text-xs px-2 py-0.5 rounded-full font-medium" style="background-color: #EEF4FD; color: #1D74E3;">
                                            {{ $scholarship->slots }} {{ $scholarship->slots === 1 ? 'slot' : 'slots' }} left
                                        </span>
                                    </div>
                                    <p class="text-xs mt-1.5" style="color: #AA9A98;">
                                        Deadline: {{ \Carbon\Carbon::parse($scholarship->deadline)->format('M d, Y') }}
                                    </p>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('applications.create', $scholarship) }}"
                                       class="inline-flex items-center gap-1.5 text-sm font-bold px-5 py-2 rounded-xl text-white transition hover:opacity-90"
                                       style="background-color: #1D74E3;">
                                        Apply Now &rarr;
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif

    </div>
@endif

</div>
