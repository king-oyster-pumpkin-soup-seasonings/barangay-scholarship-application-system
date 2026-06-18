<div class="bg-gray-50/50 min-h-screen pb-24">
    {{-- HERO --}}
    <section class="relative overflow-hidden bg-blue-600 py-16 px-4 text-center text-white">
        <!-- Background Accents -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-blue-500 via-blue-600 to-blue-700 opacity-100"></div>
        <div class="absolute inset-0 opacity-10 bg-[linear-gradient(to_right,#fff_1px,transparent_1px),linear-gradient(to_bottom,#fff_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>

        <div class="relative z-10 max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-blue-500/30 text-blue-100 mb-3 backdrop-blur-sm border border-white/10">
                📚 Active Registry
            </span>
            <h1 class="text-4xl font-extrabold tracking-tight mb-3 drop-shadow-sm">Scholarship Programs</h1>
            <p class="text-lg opacity-90 max-w-2xl mx-auto font-light text-blue-100">
                Explore open academic funds, financial support channels, and structural subsidies managed directly by your local secretariat.
            </p>
        </div>
    </section>

    {{-- FILTER TABS + CARDS --}}
    <section class="max-w-6xl mx-auto px-4 py-12 space-y-8">

        {{-- Interactive Navigation Filter Pills --}}
        <div class="flex flex-wrap items-center justify-start gap-2 border-b border-gray-200 pb-5">
            <button wire:click="$set('filter', 'available')"
                class="px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 border {{ $filter === 'available' ? 'bg-blue-600 border-blue-600 text-white shadow-md shadow-blue-100' : 'bg-white border-gray-200 text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                🟢 Available Grants
            </button>

            <button wire:click="$set('filter', 'full')"
                class="px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 border {{ $filter === 'full' ? 'bg-blue-600 border-blue-600 text-white shadow-md shadow-blue-100' : 'bg-white border-gray-200 text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                🔴 Full Slots
            </button>

            <button wire:click="$set('filter', 'unavailable')"
                class="px-5 py-2 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 border {{ $filter === 'unavailable' ? 'bg-blue-600 border-blue-600 text-white shadow-md shadow-blue-100' : 'bg-white border-gray-200 text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                ⚪ Closed Windows
            </button>
        </div>

        {{-- Scholarship Cards Grid --}}
        @if (count($scholarships) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($scholarships as $scholarship)
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md hover:scale-[1.015] transition-all duration-200 flex flex-col justify-between h-full">

                        <div>
                            {{-- Dynamic Status Badge Header --}}
                            <div class="flex justify-between items-center gap-2 mb-4">
                                @if ($scholarship['status'] === 'available')
                                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full bg-green-50 text-green-700 border border-green-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Open Application
                                    </span>
                                @elseif($scholarship['status'] === 'full')
                                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full bg-red-50 text-red-700 border border-red-200">
                                        No Open Slots
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full bg-gray-100 text-gray-500 border border-gray-200">
                                        Inactive
                                    </span>
                                @endif

                                <span class="text-xs font-mono text-gray-400">ID: #{{ str_pad($scholarship['id'], 3, '0', STR_PAD_LEFT) }}</span>
                            </div>

                            {{-- Scholarship Typography Content --}}
                            <h3 class="font-bold text-lg text-gray-800 tracking-tight leading-snug mb-2">
                                {{ $scholarship['title'] }}
                            </h3>

                            <p class="text-sm text-gray-500 line-clamp-3 mb-5 leading-relaxed">
                                {{ $scholarship['description'] }}
                            </p>

                            {{-- Structural Parameter Meta Table Block --}}
                            <div class="space-y-2 bg-gray-50/70 border border-gray-100 rounded-xl p-3.5 mb-6">
                                <div class="flex justify-between items-center text-xs md:text-sm">
                                    <span class="text-gray-400 font-medium">Financial Grant</span>
                                    <span class="font-bold text-gray-800">₱{{ number_format($scholarship['allowance'], 2) }}</span>
                                </div>
                                <div class="flex justify-between items-center text-xs md:text-sm">
                                    <span class="text-gray-400 font-medium">Allocation Threshold</span>
                                    <span class="font-semibold text-gray-700">{{ $scholarship['slots'] }} Verified slots</span>
                                </div>
                                <div class="flex justify-between items-center text-xs md:text-sm">
                                    <span class="text-gray-400 font-medium">Closing Cutoff</span>
                                    <span class="font-bold text-red-600 flex items-center gap-1 text-xs">
                                        ⏱️ {{ $scholarship['deadline'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Action Target Routing --}}
                        <a href="{{ route('scholarships.show', $scholarship['id']) }}"
                            class="block w-full text-center text-sm font-semibold py-2.5 px-4 rounded-xl text-white bg-blue-600 hover:bg-blue-700 shadow-sm shadow-blue-100 transition-colors">
                            View Criteria Details
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Modern Graphic Empty State --}}
            <div class="text-center py-20 bg-white rounded-2xl border-2 border-dashed border-gray-200 max-w-xl mx-auto p-6 shadow-sm">
                <div class="w-16 h-16 rounded-full bg-gray-50 flex items-center justify-center text-3xl mx-auto mb-4 border border-gray-100">
                    📂
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-1">
                    No Registered Tracks Found
                </h3>
                <p class="text-sm text-gray-400 max-w-sm mx-auto leading-relaxed">
                    There are currently no active scholarship systems open or assigned within this structural category selection. Check back later for administrative updates.
                </p>
            </div>
        @endif

    </section>
</div>
