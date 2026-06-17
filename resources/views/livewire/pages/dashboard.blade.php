
    <div class="space-y-6 p-4" style="background-color: #E5E8EF; min-height: 100%;">

        {{-- Welcome header --}}
        <div>
            <h1 class="text-2xl font-bold" style="color: #33333B;">
                Hi, {{ auth()->user()->name }}! 👋
            </h1>
            <p class="text-sm mt-1" style="color: #AA9A98;">
                Here's your scholarship application overview.
            </p>
        </div>

        {{-- ────────────────────────────────────────
             SECTION 1: Residence Verification Card
        ──────────────────────────────────────────── --}}

        @php $vstatus = $verification?->status; @endphp

        @if ($vstatus === 'verified')
            <div class="rounded-xl p-5 flex items-start gap-4 border"
                 style="background-color: #f0fdf4; border-color: #bbf7d0;">
                <span class="text-green-500 text-xl mt-0.5">✅</span>
                <div>
                    <p class="font-semibold text-green-800">Residence Verified</p>
                    <p class="text-sm text-green-700 mt-0.5">
                        Your residency has been confirmed. You can now apply for scholarships below.
                    </p>
                </div>
            </div>

        @elseif ($vstatus === 'pending')
            <div class="rounded-xl p-5 flex items-start gap-4 border"
                 style="background-color: #fefce8; border-color: #fde047;">
                <span class="text-yellow-500 text-xl mt-0.5">🕐</span>
                <div>
                    <p class="font-semibold text-yellow-800">Verification Under Review</p>
                    <p class="text-sm text-yellow-700 mt-0.5">
                        Your documents are being reviewed by the barangay staff. Please wait.
                    </p>
                </div>
            </div>

        @elseif ($vstatus === 'rejected')
            <div class="rounded-xl p-5 flex items-start gap-4 border"
                 style="background-color: #fef2f2; border-color: #fca5a5;">
                <span class="text-red-500 text-xl mt-0.5">❌</span>
                <div class="flex-1">
                    <p class="font-semibold text-red-800">Verification Rejected</p>
                    <p class="text-sm text-red-700 mt-0.5">
                        Your documents were rejected. Please re-submit with valid files.
                    </p>
                    <a href="{{ route('verification') }}"
                       class="inline-block mt-3 text-sm font-medium px-4 py-2 rounded-lg text-white"
                       style="background-color: #1D74E3;">
                        Re-submit Documents →
                    </a>
                </div>
            </div>

        @else
            {{-- Never submitted yet --}}
            <div class="rounded-xl p-5 flex items-start gap-4 border bg-white"
                 style="border-color: #e5e7eb;">
                <span class="text-gray-400 text-xl mt-0.5">📋</span>
                <div class="flex-1">
                    <p class="font-semibold" style="color: #33333B;">Complete Your Verification First</p>
                    <p class="text-sm mt-0.5" style="color: #AA9A98;">
                        You need to verify your residency before you can apply for any scholarship.
                    </p>
                    <a href="{{ route('verification') }}"
                       class="inline-block mt-3 text-sm font-medium px-4 py-2 rounded-lg text-white"
                       style="background-color: #1D74E3;">
                        Start Verification →
                    </a>
                </div>
            </div>
        @endif

        {{-- ────────────────────────────────────────
             SECTION 2: My Applications
        ──────────────────────────────────────────── --}}
        <div>
            <h2 class="text-lg font-semibold mb-3" style="color: #33333B;">My Applications</h2>

            @if ($applications->isEmpty())
                <div class="rounded-xl bg-white border p-6 text-center"
                     style="border-color: #e5e7eb;">
                    <p class="text-sm" style="color: #AA9A98;">
                        You haven't submitted any applications yet.
                    </p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach ($applications as $app)
                        @php
                            // Pick badge color based on application status
                            $badge = match($app->status) {
                                'approved' => 'background-color:#dcfce7; color:#166534;',
                                'rejected' => 'background-color:#fee2e2; color:#991b1b;',
                                default    => 'background-color:#fef9c3; color:#854d0e;',
                            };
                        @endphp

                        <div class="rounded-xl bg-white border p-4 flex items-center justify-between gap-3"
                             style="border-color: #e5e7eb;">
                            <div class="flex-1 min-w-0">
                                <p class="font-medium truncate" style="color: #1B1A1C;">
                                    {{ $app->scholarship->title }}
                                </p>
                                <p class="text-xs mt-0.5" style="color: #AA9A98;">
                                    Applied: {{ $app->submitted_at?->format('M d, Y') ?? '—' }}
                                </p>
                                @if ($app->remarks)
                                    <p class="text-xs mt-1 text-red-500 italic">
                                        Remarks: {{ $app->remarks }}
                                    </p>
                                @endif
                            </div>

                            <span class="shrink-0 text-xs font-semibold px-3 py-1 rounded-full"
                                  style="{{ $badge }}">
                                {{ ucfirst($app->status) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- ────────────────────────────────────────
             SECTION 3: Available Scholarships
             (only shown when residency is verified)
        ──────────────────────────────────────────── --}}
        @if ($vstatus === 'verified')
            <div>
                <h2 class="text-lg font-semibold mb-3" style="color: #33333B;">
                    Available Scholarships
                </h2>

                @if ($scholarships->isEmpty())
                    <div class="rounded-xl bg-white border p-6 text-center"
                         style="border-color: #e5e7eb;">
                        <p class="text-sm" style="color: #AA9A98;">
                            No new scholarships are available right now. Check back later.
                        </p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach ($scholarships as $scholarship)
                            <div class="rounded-xl bg-white border p-4"
                                 style="border-color: #e5e7eb;">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold" style="color: #33333B;">
                                            {{ $scholarship->title }}
                                        </p>
                                        <p class="text-sm mt-1" style="color: #AA9A98;">
                                            {{ $scholarship->description }}
                                        </p>

                                        {{-- Quick stats --}}
                                        <div class="flex flex-wrap gap-4 mt-3 text-xs"
                                             style="color: #AA9A98;">
                                            <span>
                                                💰 ₱{{ number_format($scholarship->allowance) }}
                                            </span>
                                            <span>
                                                🪑 {{ $scholarship->slots }}
                                                {{ $scholarship->slots === 1 ? 'slot' : 'slots' }} available
                                            </span>
                                            <span>
                                                📅 Deadline:
                                                {{ \Carbon\Carbon::parse($scholarship->deadline)->format('M d, Y') }}
                                            </span>
                                        </div>
                                    </div>

                                    <a href="{{ route('applications.create', $scholarship) }}"
                                       class="shrink-0 text-sm font-medium px-4 py-2 rounded-lg text-white"
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

    </div>

