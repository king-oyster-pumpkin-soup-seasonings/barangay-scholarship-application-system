<div class="min-h-screen" style="background-color: #F5F0E8;">

    {{-- PAGE HEADER --}}
    <section class="px-6 py-12" style="background-color: #1D74E3;">
        <div class="max-w-6xl mx-auto">
            <p class="text-xs font-semibold tracking-widest uppercase mb-2"
               style="color: rgba(255,255,255,0.6);">
                SCHOLARSHIP PROGRAMS
            </p>
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-2"
                        style="font-family: 'Playfair Display', serif;">
                        Browse All Scholarships
                    </h1>
                    <p class="text-sm" style="color: rgba(255,255,255,0.7);">
                        Showing all programs available to barangay residents
                    </p>
                </div>
                {{-- Search Bar --}}
                <div class="relative w-full md:w-80">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                         class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2"
                         style="color: #AA9A98;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <input
                        type="text"
                        wire:model.live="search"
                        placeholder="Search scholarships..."
                        class="w-full pl-9 pr-4 py-2.5 rounded-xl text-sm outline-none"
                        style="background-color: white; color: #1B1A1C; border: none;"
                    />
                </div>
            </div>
        </div>
    </section>

    {{-- MAIN CONTENT --}}
    <section class="max-w-6xl mx-auto px-6 py-10">
        <div class="flex flex-col lg:flex-row gap-8">

            {{-- LEFT SIDEBAR - FILTERS --}}
            <div class="w-full lg:w-64 flex-shrink-0 space-y-4">

                {{-- Filter by Status --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border" style="border-color: #F0EDE8;">
                    <h3 class="text-xs font-bold uppercase tracking-widest mb-4" style="color: #AA9A98;">
                        Filter by Status
                    </h3>
                    <div class="space-y-2">
                        <button
                            wire:click="$set('filter', 'all')"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all"
                            style="{{ $filter === 'all' ? 'background-color: #EBF3FF; color: #1D74E3;' : 'color: #33333B;' }}">
                            <div class="w-2.5 h-2.5 rounded-full flex-shrink-0"
                                 style="{{ $filter === 'all' ? 'background-color: #1D74E3;' : 'background-color: #E5E8EF;' }}">
                            </div>
                            All Scholarships
                        </button>
                        <button
                            wire:click="$set('filter', 'available')"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all"
                            style="{{ $filter === 'available' ? 'background-color: #EBF3FF; color: #1D74E3;' : 'color: #33333B;' }}">
                            <div class="w-2.5 h-2.5 rounded-full flex-shrink-0"
                                 style="{{ $filter === 'available' ? 'background-color: #1D74E3;' : 'background-color: #22C55E;' }}">
                            </div>
                            Available
                        </button>
                        <button
                            wire:click="$set('filter', 'full')"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all"
                            style="{{ $filter === 'full' ? 'background-color: #EBF3FF; color: #1D74E3;' : 'color: #33333B;' }}">
                            <div class="w-2.5 h-2.5 rounded-full flex-shrink-0"
                                 style="{{ $filter === 'full' ? 'background-color: #1D74E3;' : 'background-color: #EF4444;' }}">
                            </div>
                            Full
                        </button>
                        <button
                            wire:click="$set('filter', 'unavailable')"
                            class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all"
                            style="{{ $filter === 'unavailable' ? 'background-color: #EBF3FF; color: #1D74E3;' : 'color: #33333B;' }}">
                            <div class="w-2.5 h-2.5 rounded-full flex-shrink-0"
                                 style="{{ $filter === 'unavailable' ? 'background-color: #1D74E3;' : 'background-color: #AA9A98;' }}">
                            </div>
                            Unavailable
                        </button>
                    </div>
                </div>

                {{-- Need Help Card --}}
                <div class="rounded-2xl p-6 border" style="background-color: #EBF3FF; border-color: #BFDBFE;">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                             class="w-5 h-5 flex-shrink-0 mt-0.5" style="color: #1D74E3;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                        </svg>
                        <div>
                            <h4 class="font-bold text-sm mb-1" style="color: #1E40AF;">
                                Need help choosing?
                            </h4>
                            <p class="text-xs leading-relaxed mb-3" style="color: #3B82F6;">
                                Visit the Scholarship Desk at the Barangay Hall, Mon–Fri, 8AM–5PM.
                            </p>
                            <a href="{{ route('contact') }}"
                               class="text-xs font-semibold flex items-center gap-1 hover:opacity-75 transition"
                               style="color: #1D74E3;">
                                Contact Us
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            {{-- RIGHT - SCHOLARSHIP LIST --}}
            <div class="flex-1 space-y-4">

                {{-- Results count --}}
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm" style="color: #AA9A98;">
                        Showing <span class="font-semibold" style="color: #33333B;">{{ count($scholarships) }}</span> programs
                    </p>
                </div>

                {{-- Empty state --}}
                @if(count($scholarships) === 0)
                    <div class="bg-white rounded-2xl p-16 text-center shadow-sm border" style="border-color: #F0EDE8;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                             class="w-12 h-12 mx-auto mb-4" style="color: #E5E8EF;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                        </svg>
                        <h3 class="font-bold text-lg mb-2" style="color: #33333B;">No scholarships found</h3>
                        <p class="text-sm" style="color: #AA9A98;">Try changing your filter or search term.</p>
                    </div>
                @endif

                {{-- Scholarship Cards - Horizontal List --}}
                @foreach($scholarships as $scholarship)
                    <div class="bg-white rounded-2xl p-6 shadow-sm border hover:shadow-md transition-all duration-200 hover:border-blue-100"
                         style="border-color: #F0EDE8;">
                        <div class="flex flex-col md:flex-row md:items-start gap-4">

                            {{-- Left Content --}}
                            <div class="flex-1">

                                {{-- Badges --}}
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-xs px-2.5 py-1 rounded-full font-medium"
                                          style="background-color: #F5F0E8; color: #AA9A98;">
                                        Academic
                                    </span>
                                    @if($scholarship['status'] === 'available')
                                        <span class="text-xs px-2.5 py-1 rounded-full font-medium bg-green-100 text-green-700 flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Open
                                        </span>
                                    @elseif($scholarship['status'] === 'full')
                                        <span class="text-xs px-2.5 py-1 rounded-full font-medium bg-red-100 text-red-700 flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Full
                                        </span>
                                    @else
                                        <span class="text-xs px-2.5 py-1 rounded-full font-medium bg-gray-100 text-gray-500 flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                            Unavailable
                                        </span>
                                    @endif
                                </div>

                                {{-- Title --}}
                                <h3 class="font-bold text-lg mb-1"
                                    style="color: #33333B; font-family: 'Playfair Display', serif;">
                                    {{ $scholarship['title'] }}
                                </h3>

                                {{-- Description --}}
                                <p class="text-sm leading-relaxed mb-4" style="color: #AA9A98;">
                                    {{ $scholarship['description'] }}
                                </p>

                                {{-- Meta Info --}}
                                <div class="flex flex-wrap items-center gap-4">
                                    <div class="flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                             class="w-4 h-4" style="color: #AA9A98;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                        </svg>
                                        <span class="text-xs" style="color: #AA9A98;">
                                            {{ $scholarship['slots'] }} slots
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                             class="w-4 h-4" style="color: #AA9A98;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                        </svg>
                                        <span class="text-xs" style="color: #AA9A98;">
                                            Deadline {{ $scholarship['deadline'] }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Right Side --}}
                            <div class="flex flex-col items-end justify-between gap-4 md:min-w-[140px]">
                                {{-- Amount --}}
                                <div class="text-right">
                                    <p class="text-2xl font-extrabold" style="color: #1D74E3;">
                                        ₱{{ number_format($scholarship['allowance'], 0) }}
                                    </p>
                                    <p class="text-xs" style="color: #AA9A98;">per semester</p>
                                </div>

                                {{-- Apply Button --}}
                                @if($scholarship['status'] === 'available')
                                    <a href="{{ route('scholarships.show', $scholarship['id']) }}"
                                       class="flex items-center gap-1.5 text-sm font-semibold px-4 py-2.5 rounded-xl text-white transition hover:opacity-90"
                                       style="background-color: #1D74E3;">
                                        Apply
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                    </a>
                                @else
                                    <a href="{{ route('scholarships.show', $scholarship['id']) }}"
                                       class="flex items-center gap-1.5 text-sm font-medium px-4 py-2.5 rounded-xl transition hover:bg-gray-100"
                                       style="border: 1px solid #E5E8EF; color: #AA9A98;">
                                        View Details
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

</div>
