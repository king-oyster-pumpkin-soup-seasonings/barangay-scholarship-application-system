<div>
    {{-- HERO --}}
    <section style="background-color: #1D74E3;" class="py-16 px-4 text-center text-white">
        <h1 class="text-4xl font-bold mb-4">Scholarships</h1>
        <p class="text-lg opacity-90 max-w-2xl mx-auto">
            Browse all available scholarship programs offered by the barangay.
        </p>
    </section>

    {{-- FILTER TABS + CARDS --}}
    <section class="max-w-6xl mx-auto px-4 py-12">

        {{-- Filter Tabs --}}
        <div class="flex gap-2 mb-8">
            <button wire:click="$set('filter', 'available')"
                class="px-5 py-2 rounded-full text-sm font-semibold transition"
                style="{{ $filter === 'available' ? 'background-color: #1D74E3; color: white;' : 'background-color: white; color: #AA9A98;' }}">
                Available
            </button>
            <button wire:click="$set('filter', 'full')" class="px-5 py-2 rounded-full text-sm font-semibold transition"
                style="{{ $filter === 'full' ? 'background-color: #1D74E3; color: white;' : 'background-color: white; color: #AA9A98;' }}">
                Full
            </button>
            <button wire:click="$set('filter', 'unavailable')"
                class="px-5 py-2 rounded-full text-sm font-semibold transition"
                style="{{ $filter === 'unavailable' ? 'background-color: #1D74E3; color: white;' : 'background-color: white; color: #AA9A98;' }}">
                Unavailable
            </button>
        </div>

        {{-- Scholarship Cards --}}
        @if (count($scholarships) > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($scholarships as $scholarship)
                    <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">

                        {{-- Status Badge --}}
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

                        {{-- Title --}}
                        <h3 class="font-semibold text-lg mt-3 mb-2" style="color: #33333B;">
                            {{ $scholarship['title'] }}
                        </h3>

                        {{-- Description --}}
                        <p class="text-sm mb-3" style="color: #AA9A98;">
                            {{ $scholarship['description'] }}
                        </p>

                        {{-- Details --}}
                        <p class="text-sm mb-1" style="color: #AA9A98;">
                            💰 ₱{{ number_format($scholarship['allowance'], 2) }} allowance
                        </p>
                        <p class="text-sm mb-1" style="color: #AA9A98;">
                            👥 {{ $scholarship['slots'] }} slots available
                        </p>
                        <p class="text-sm mb-4" style="color: #AA9A98;">
                            📅 Deadline: {{ $scholarship['deadline'] }}
                        </p>

                        {{-- View Details Button --}}
                        <a href="{{ route('scholarships.show', $scholarship['id']) }}"
                            class="block text-center text-sm font-semibold py-2 px-4 rounded-lg text-white transition hover:opacity-90"
                            style="background-color: #1D74E3;">
                            View Details
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Empty State --}}
            <div class="text-center py-20">
                <div class="text-5xl mb-4">🎓</div>
                <h3 class="text-xl font-semibold mb-2" style="color: #33333B;">
                    No scholarships found
                </h3>
                <p class="text-sm" style="color: #AA9A98;">
                    There are no scholarships in this category right now.
                </p>
            </div>
        @endif

    </section>
</div>
