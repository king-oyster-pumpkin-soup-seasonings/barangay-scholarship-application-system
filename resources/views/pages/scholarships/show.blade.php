<div style="background-color: #E5E8EF;" class="min-h-screen pb-24">

    {{-- HERO --}}
    <section class="relative overflow-hidden py-14 px-6 text-white" style="background-color: #1C398E;">
        <div class="absolute inset-0 opacity-10"
             style="background-image: linear-gradient(to right, #fff 1px, transparent 1px), linear-gradient(to bottom, #fff 1px, transparent 1px); background-size: 4rem 4rem;">
        </div>

        <div class="relative z-10 max-w-6xl mx-auto">

            {{-- Breadcrumb --}}
            <a href="{{ route('scholarships.index') }}"
               class="inline-flex items-center gap-2 text-sm font-medium mb-8 transition-opacity hover:opacity-75"
               style="color: rgba(255,255,255,0.8);">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                Back to Scholarships
            </a>

            {{-- Badges + Title --}}
            <div class="max-w-3xl">
                <div class="flex items-center gap-3 mb-5">
                    @if($scholarship->status === 'available')
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full"
                              style="background-color: rgba(74,222,128,0.2); color: #bbf7d0; border: 1px solid rgba(74,222,128,0.3);">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>
                            Open Application
                        </span>
                    @elseif($scholarship->status === 'full')
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full"
                              style="background-color: rgba(248,113,113,0.2); color: #fecaca; border: 1px solid rgba(248,113,113,0.3);">
                            No Open Slots
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full"
                              style="background-color: rgba(156,163,175,0.2); color: #e5e7eb; border: 1px solid rgba(156,163,175,0.3);">
                            Inactive
                        </span>
                    @endif
                    <span class="text-xs font-mono px-2.5 py-1 rounded-lg"
                          style="background-color: rgba(255,255,255,0.1); color: rgba(255,255,255,0.7); border: 1px solid rgba(255,255,255,0.15);">
                        ID: #{{ str_pad($scholarship->id, 3, '0', STR_PAD_LEFT) }}
                    </span>
                </div>

                <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-4"
                    style="font-family: 'Playfair Display', serif;">
                    {{ $scholarship->title }}
                </h1>
                <p class="text-base max-w-2xl" style="color: rgba(255,255,255,0.8);">
                    {{ $scholarship->description }}
                </p>
            </div>
        </div>
    </section>

    {{-- MAIN CONTENT --}}
    <section class="max-w-6xl mx-auto px-6 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- LEFT COLUMN --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Program Overview --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border" style="border-color: #F0EDE8;">
                    <h2 class="text-xl font-bold mb-4 flex items-center gap-3"
                        style="color: #33333B; font-family: 'Playfair Display', serif;">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                             style="background-color: #EBF3FF;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" style="color: #1D74E3;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </div>
                        Program Overview
                    </h2>
                    <p class="text-sm leading-relaxed" style="color: #1B1A1C;">
                        {{ $scholarship->description }}
                    </p>
                    <p class="text-sm leading-relaxed mt-3" style="color: #AA9A98;">
                        This scholarship aims to support qualified barangay residents in pursuing their
                        educational goals. Recipients are selected based on academic merit, financial need,
                        and community involvement.
                    </p>
                </div>

                {{-- Requirements sections using Eloquent collection filter --}}
                @php
                    $eligibility     = $requirements->where('category', 'eligibility');
                    $generalDocs     = $requirements->where('category', 'general_document');
                    $specificDocs    = $requirements->where('category', 'specific_document');
                    $additionalFields = $requirements->where('category', 'additional_field');
                @endphp

                {{-- Eligibility --}}
                @if($eligibility->count() > 0)
                <div class="bg-white rounded-2xl p-8 shadow-sm border" style="border-color: #F0EDE8;">
                    <h2 class="text-xl font-bold mb-5 flex items-center gap-3"
                        style="color: #33333B; font-family: 'Playfair Display', serif;">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                             style="background-color: #EBF3FF;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" style="color: #1D74E3;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        Eligibility Requirements
                    </h2>
                    <ul class="space-y-3">
                        @foreach($eligibility as $req)
                            <li class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mt-0.5 flex-shrink-0" style="color: #1D74E3;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                <div>
                                    <span class="text-sm font-medium" style="color: #1B1A1C;">{{ $req->label }}</span>
                                    @if($req->is_required)
                                        <span class="text-xs ml-2 text-red-500">*Required</span>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- General Documents --}}
                @if($generalDocs->count() > 0)
                <div class="bg-white rounded-2xl p-8 shadow-sm border" style="border-color: #F0EDE8;">
                    <h2 class="text-xl font-bold mb-5 flex items-center gap-3"
                        style="color: #33333B; font-family: 'Playfair Display', serif;">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                             style="background-color: #EBF3FF;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" style="color: #1D74E3;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </div>
                        General Documents
                    </h2>
                    <ul class="space-y-3">
                        @foreach($generalDocs as $req)
                            <li class="flex items-center gap-3 p-3 rounded-xl" style="background-color: #E5E8EF;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0" style="color: #1D74E3;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12-3-3m0 0-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                <span class="flex-1 text-sm font-medium" style="color: #33333B;">{{ $req->label }}</span>
                                @if($req->is_required)
                                    <span class="text-xs font-medium text-red-500">Required</span>
                                @else
                                    <span class="text-xs" style="color: #AA9A98;">Optional</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Specific Documents --}}
                @if($specificDocs->count() > 0)
                <div class="bg-white rounded-2xl p-8 shadow-sm border" style="border-color: #F0EDE8;">
                    <h2 class="text-xl font-bold mb-5 flex items-center gap-3"
                        style="color: #33333B; font-family: 'Playfair Display', serif;">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                             style="background-color: #EBF3FF;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" style="color: #1D74E3;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                            </svg>
                        </div>
                        Specific Documents
                    </h2>
                    <ul class="space-y-3">
                        @foreach($specificDocs as $req)
                            <li class="flex items-center gap-3 p-3 rounded-xl" style="background-color: #E5E8EF;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 flex-shrink-0" style="color: #1D74E3;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12-3-3m0 0-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                <span class="flex-1 text-sm font-medium" style="color: #33333B;">{{ $req->label }}</span>
                                @if($req->is_required)
                                    <span class="text-xs font-medium text-red-500">Required</span>
                                @else
                                    <span class="text-xs" style="color: #AA9A98;">Optional</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Additional Fields --}}
                @if($additionalFields->count() > 0)
                <div class="bg-white rounded-2xl p-8 shadow-sm border" style="border-color: #F0EDE8;">
                    <h2 class="text-xl font-bold mb-5 flex items-center gap-3"
                        style="color: #33333B; font-family: 'Playfair Display', serif;">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                             style="background-color: #EBF3FF;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" style="color: #1D74E3;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                            </svg>
                        </div>
                        Additional Information
                    </h2>
                    <ul class="space-y-3">
                        @foreach($additionalFields as $req)
                            <li class="flex items-start gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mt-0.5 flex-shrink-0" style="color: #AA9A98;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <div>
                                    <span class="text-sm font-medium" style="color: #1B1A1C;">{{ $req->label }}</span>
                                    <span class="text-xs ml-2" style="color: #AA9A98;">(Optional)</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Empty state if no requirements --}}
                @if($requirements->count() === 0)
                <div class="bg-white rounded-2xl p-12 text-center shadow-sm border" style="border-color: #F0EDE8;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 mx-auto mb-4" style="color: #E5E8EF;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <p class="font-semibold mb-1" style="color: #33333B;">No requirements listed yet</p>
                    <p class="text-sm" style="color: #AA9A98;">Check back later or contact the barangay office.</p>
                </div>
                @endif

            </div>

            {{-- RIGHT SIDEBAR --}}
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-5">

                    {{-- Grant Parameters --}}
                    <div class="bg-white rounded-2xl p-6 shadow-sm border" style="border-color: #F0EDE8;">
                        <h3 class="font-bold mb-5" style="color: #33333B; font-family: 'Playfair Display', serif;">
                            Grant Parameters
                        </h3>

                        {{-- Allowance --}}
                        <div class="rounded-xl p-4 mb-4" style="background-color: #E5E8EF;">
                            <span class="block text-xs font-medium mb-1" style="color: #AA9A98;">Financial Grant</span>
                            <span class="block text-3xl font-extrabold" style="color: #1D74E3;">
                                ₱{{ number_format($scholarship->allowance, 2) }}
                            </span>
                            <span class="block text-xs mt-1" style="color: #AA9A98;">per semester</span>
                        </div>

                        {{-- Slots --}}
                        <div class="flex justify-between items-center py-3 border-b" style="border-color: #F0EDE8;">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" style="color: #AA9A98;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                                <span class="text-sm" style="color: #AA9A98;">Slots Available</span>
                            </div>
                            <span class="font-semibold text-sm" style="color: #33333B;">
                                {{ $scholarship->slots }} remaining
                            </span>
                        </div>

                        {{-- Deadline --}}
                        <div class="flex justify-between items-center py-3">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4" style="color: #AA9A98;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                                <span class="text-sm" style="color: #AA9A98;">Deadline</span>
                            </div>
                            <span class="font-semibold text-sm text-red-500">
                                {{ $scholarship->deadline}}
                            </span>
                        </div>

                        {{-- Action Button --}}
                        <div class="mt-5">
                            @if($scholarship->status === 'available')
                                @auth
                                    <a href="{{ route('applications.create', $scholarship) }}"
                                       class="flex items-center justify-center gap-2 w-full text-center text-sm font-semibold py-3.5 px-4 rounded-xl text-white transition hover:opacity-90 shadow-md"
                                       style="background-color: #1D74E3;">
                                        Begin Application
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}"
                                       class="flex items-center justify-center gap-2 w-full text-center text-sm font-semibold py-3.5 px-4 rounded-xl text-white transition hover:opacity-90 shadow-md"
                                       style="background-color: #1D74E3;">
                                        Sign In to Apply
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                    </a>
                                @endauth
                                <p class="text-center text-xs mt-3" style="color: #AA9A98;">
                                    Takes approximately 10-15 minutes.
                                </p>
                            @else
                                <button disabled
                                        class="w-full text-center text-sm font-semibold py-3.5 px-4 rounded-xl cursor-not-allowed"
                                        style="background-color: #F0EDE8; color: #AA9A98; border: 1px solid #E5E8EF;">
                                    Applications Closed
                                </button>
                            @endif
                        </div>
                    </div>

                    {{-- Help Card --}}
                    <div class="rounded-2xl p-6 border" style="background-color: #EBF3FF; border-color: #BFDBFE;">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"
                                 style="background-color: #DBEAFE;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" style="color: #1D74E3;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm mb-1" style="color: #1E40AF;">Need Assistance?</h4>
                                <p class="text-xs leading-relaxed mb-3" style="color: #3B82F6;">
                                    Questions about this scholarship? Contact our scholarship secretariat.
                                </p>
                                <a href="{{ route('contact') }}"
                                   class="text-xs font-semibold hover:opacity-75 transition flex items-center gap-1"
                                   style="color: #1D74E3;">
                                    Contact Us
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>
