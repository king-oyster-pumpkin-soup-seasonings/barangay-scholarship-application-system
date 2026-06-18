<div class="min-h-screen bg-[#E5E8EF] dark:bg-[#1B1A1C]">
    <div class="max-w-7xl mx-auto p-8">
        <!-- Enhanced Page Header -->
    <div class="mb-10">
        <h1 class="text-3xl font-extrabold text-[#33333B] dark:text-white tracking-tight">Welcome back, {{ auth()->user()->name }}! ({{ ucfirst(auth()->user()->role) }})</h1>
        <p class="text-[#AA9A98] dark:text-zinc-400 text-sm mt-1.5 font-medium">Here's an overview of the system status and recent applications.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Pending Verifications -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border-t-4 border-transparent hover:border-[#1D74E3] p-6 flex justify-between items-start hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div>
                <p class="text-xs text-[#AA9A98] dark:text-zinc-400 uppercase font-bold tracking-wider">Pending Verifications</p>
                <p class="text-4xl font-extrabold text-[#1D74E3] mt-2">{{ $pendingVerifications }}</p>
            </div>
            <div class="p-2.5 bg-[#1D74E3]/10 rounded-full text-[#1D74E3] shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
        </div>

        <!-- Pending Applications -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border-t-4 border-transparent hover:border-[#1D74E3] p-6 flex justify-between items-start hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div>
                <p class="text-xs text-[#AA9A98] dark:text-zinc-400 uppercase font-bold tracking-wider">Pending Applications</p>
                <p class="text-4xl font-extrabold text-[#1D74E3] mt-2">{{ $pendingApplications }}</p>
            </div>
            <div class="p-2.5 bg-[#1D74E3]/10 rounded-full text-[#1D74E3] shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
        </div>

        <!-- Total Scholars -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border-t-4 border-transparent hover:border-[#1D74E3] p-6 flex justify-between items-start hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div>
                <p class="text-xs text-[#AA9A98] dark:text-zinc-400 uppercase font-bold tracking-wider">Total Scholars</p>
                <p class="text-4xl font-extrabold text-[#1D74E3] mt-2">{{ $totalScholars }}</p>
            </div>
            <div class="p-2.5 bg-[#1D74E3]/10 rounded-full text-[#1D74E3] shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                </svg>
            </div>
        </div>

        <!-- Total Residents -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm border-t-4 border-transparent hover:border-[#1D74E3] p-6 flex justify-between items-start hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div>
                <p class="text-xs text-[#AA9A98] dark:text-zinc-400 uppercase font-bold tracking-wider">Total Residents</p>
                <p class="text-4xl font-extrabold text-[#1D74E3] mt-2">{{ $totalResidents }}</p>
            </div>
            <div class="p-2.5 bg-[#1D74E3]/10 rounded-full text-[#1D74E3] shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="mt-10">
        <h2 class="text-xl font-bold text-[#33333B] dark:text-white mb-4">Latest Scholarship Applications</h2>
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#33333B] text-white">
                        <th class="p-4 font-semibold text-sm uppercase tracking-wider">Applicant</th>
                        <th class="p-4 font-semibold text-sm uppercase tracking-wider">Scholarship</th>
                        <th class="p-4 font-semibold text-sm uppercase tracking-wider">Date Applied</th>
                        <th class="p-4 font-semibold text-sm uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentApplications as $application)
                        <tr class="border-b border-gray-100 dark:border-zinc-700 hover:bg-[#E5E8EF]/50 dark:hover:bg-zinc-700/50 transition duration-150">
                            <td class="p-4">
                                <span class="font-semibold text-[#33333B] dark:text-white text-sm block">{{ $application->user->name }}</span>
                            </td>
                            <td class="p-4 text-sm text-[#33333B] dark:text-zinc-200">
                                {{ $application->scholarship->title }}
                            </td>
                            <td class="p-4 text-xs text-[#AA9A98] dark:text-zinc-400">
                                {{ $application->submitted_at->format('M d, Y h:i A') }}
                            </td>
                            <td class="p-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold 
                                    @if($application->status === 'approved') bg-green-50 text-green-700 dark:bg-green-950/30 dark:text-green-400 
                                    @elseif($application->status === 'rejected') bg-red-50 text-red-700 dark:bg-red-950/30 dark:text-red-400 
                                    @else bg-yellow-50 text-yellow-700 dark:bg-yellow-950/30 dark:text-yellow-400 @endif">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-[#AA9A98] dark:text-zinc-400 text-sm">
                                No recent applications found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
