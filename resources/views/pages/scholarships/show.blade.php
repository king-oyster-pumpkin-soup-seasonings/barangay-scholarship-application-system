<div>
    {{-- HERO --}}
    <section style="background-color: #1D74E3;" class="py-16 px-4 text-center text-white">
        <h1 class="text-4xl font-bold mb-4">{{ $scholarship['title'] }}</h1>
        <p class="text-lg opacity-90 max-w-2xl mx-auto">
            {{ $scholarship['description'] }}
        </p>
    </section>

    <section class="max-w-4xl mx-auto px-4 py-12">

        {{-- Scholarship Overview Card --}}
        <div class="bg-white rounded-xl p-8 shadow-sm mb-8">
            <h2 class="text-xl font-bold mb-6" style="color: #33333B;">
                📋 Scholarship Overview
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-4 rounded-lg" style="background-color: #E5E8EF;">
                    <p class="text-2xl font-bold mb-1" style="color: #1D74E3;">
                        ₱{{ number_format($scholarship['allowance'], 2) }}
                    </p>
                    <p class="text-sm" style="color: #AA9A98;">Monthly Allowance</p>
                </div>
                <div class="text-center p-4 rounded-lg" style="background-color: #E5E8EF;">
                    <p class="text-2xl font-bold mb-1" style="color: #1D74E3;">
                        {{ $scholarship['slots'] }}
                    </p>
                    <p class="text-sm" style="color: #AA9A98;">Available Slots</p>
                </div>
                <div class="text-center p-4 rounded-lg" style="background-color: #E5E8EF;">
                    <p class="text-2xl font-bold mb-1" style="color: #1D74E3;">
                        {{ $scholarship['deadline'] }}
                    </p>
                    <p class="text-sm" style="color: #AA9A98;">Application Deadline</p>
                </div>
            </div>

            {{-- Status Badge --}}
            <div class="mt-6">
                @if ($scholarship['status'] === 'available')
                    <span class="text-sm font-semibold px-3 py-1 rounded-full bg-green-100 text-green-700">
                        ● Available
                    </span>
                @elseif($scholarship['status'] === 'full')
                    <span class="text-sm font-semibold px-3 py-1 rounded-full bg-red-100 text-red-700">
                        ● Full
                    </span>
                @else
                    <span class="text-sm font-semibold px-3 py-1 rounded-full bg-gray-100 text-gray-600">
                        ● Unavailable
                    </span>
                @endif
            </div>
        </div>

        {{-- Eligibility Requirements --}}
        @php
            $eligibility = array_filter($requirements, fn($r) => $r['category'] === 'eligibility');
            $generalDocs = array_filter($requirements, fn($r) => $r['category'] === 'general_document');
            $specificDocs = array_filter($requirements, fn($r) => $r['category'] === 'specific_document');
            $additionalFields = array_filter($requirements, fn($r) => $r['category'] === 'additional_field');
        @endphp

        {{-- Eligibility Section --}}
        @if (count($eligibility) > 0)
            <div class="bg-white rounded-xl p-8 shadow-sm mb-6">
                <h2 class="text-xl font-bold mb-4" style="color: #33333B;">
                    ✅ Eligibility Requirements
                </h2>
                <ul class="space-y-3">
                    @foreach ($eligibility as $req)
                        <li class="flex items-start gap-3">
                            <span style="color: #1D74E3;" class="font-bold mt-0.5">•</span>
                            <div>
                                <span class="text-sm font-semibold" style="color: #1B1A1C;">
                                    {{ $req['label'] }}
                                </span>
                                @if ($req['is_required'])
                                    <span class="text-red-500 text-xs ml-1">*Required</span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- General Documents Section --}}
        @if (count($generalDocs) > 0)
            <div class="bg-white rounded-xl p-8 shadow-sm mb-6">
                <h2 class="text-xl font-bold mb-4" style="color: #33333B;">
                    📄 General Documents
                </h2>
                <ul class="space-y-3">
                    @foreach ($generalDocs as $req)
                        <li class="flex items-start gap-3">
                            <span style="color: #1D74E3;" class="font-bold mt-0.5">•</span>
                            <div>
                                <span class="text-sm font-semibold" style="color: #1B1A1C;">
                                    {{ $req['label'] }}
                                </span>
                                @if ($req['is_required'])
                                    <span class="text-red-500 text-xs ml-1">*Required</span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Specific Documents Section --}}
        @if (count($specificDocs) > 0)
            <div class="bg-white rounded-xl p-8 shadow-sm mb-6">
                <h2 class="text-xl font-bold mb-4" style="color: #33333B;">
                    📁 Specific Documents
                </h2>
                <ul class="space-y-3">
                    @foreach ($specificDocs as $req)
                        <li class="flex items-start gap-3">
                            <span style="color: #1D74E3;" class="font-bold mt-0.5">•</span>
                            <div>
                                <span class="text-sm font-semibold" style="color: #1B1A1C;">
                                    {{ $req['label'] }}
                                </span>
                                @if ($req['is_required'])
                                    <span class="text-red-500 text-xs ml-1">*Required</span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Additional Fields Section --}}
        @if (count($additionalFields) > 0)
            <div class="bg-white rounded-xl p-8 shadow-sm mb-6">
                <h2 class="text-xl font-bold mb-4" style="color: #33333B;">
                    📝 Additional Information
                </h2>
                <ul class="space-y-3">
                    @foreach ($additionalFields as $req)
                        <li class="flex items-start gap-3">
                            <span style="color: #1D74E3;" class="font-bold mt-0.5">•</span>
                            <div>
                                <span class="text-sm font-semibold" style="color: #1B1A1C;">
                                    {{ $req['label'] }}
                                </span>
                                @if (!$req['is_required'])
                                    <span class="text-xs ml-1" style="color: #AA9A98;">(Optional)</span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Action Buttons --}}
        <div class="flex gap-4 mt-8">
            <a href="{{ route('scholarships.index') }}"
                class="px-6 py-3 rounded-lg text-sm font-semibold border transition"
                style="border-color: #1D74E3; color: #1D74E3;">
                ← Back to Scholarships
            </a>
            @if ($scholarship['status'] === 'available')
                <a href="{{ route('register') }}"
                    class="px-6 py-3 rounded-lg text-sm font-semibold text-white transition hover:opacity-90"
                    style="background-color: #1D74E3;">
                    Apply Now
                </a>
            @endif
        </div>

    </section>
</div>
