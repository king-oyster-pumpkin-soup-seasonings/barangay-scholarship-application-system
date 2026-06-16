<div class="min-h-screen bg-[#E5E8EF] p-8">
    <!-- Enhanced Page Header -->
    <div class="mb-10">
        <h1 class="text-3xl font-extrabold text-[#33333B] tracking-tight">Admin Dashboard</h1>
        <p class="text-[#AA9A98] text-sm mt-1.5 font-medium">Welcome to the admin panel. Manage systems and review pending applications.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <!-- Pending Verifications -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 flex justify-between items-start">
            <div>
                <p class="text-xs text-[#AA9A98] uppercase font-bold tracking-wider">Pending Verifications</p>
                <p class="text-4xl font-extrabold text-[#1D74E3] mt-2">{{ $pendingVerifications }}</p>
            </div>
            <div class="p-2.5 bg-[#1D74E3]/10 rounded-lg text-[#1D74E3] shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
        </div>

        <!-- Pending Applications -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 flex justify-between items-start">
            <div>
                <p class="text-xs text-[#AA9A98] uppercase font-bold tracking-wider">Pending Applications</p>
                <p class="text-4xl font-extrabold text-[#1D74E3] mt-2">{{ $pendingApplications }}</p>
            </div>
            <div class="p-2.5 bg-[#1D74E3]/10 rounded-lg text-[#1D74E3] shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
        </div>

        <!-- Total Scholars -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 flex justify-between items-start">
            <div>
                <p class="text-xs text-[#AA9A98] uppercase font-bold tracking-wider">Total Scholars</p>
                <p class="text-4xl font-extrabold text-[#1D74E3] mt-2">{{ $totalScholars }}</p>
            </div>
            <div class="p-2.5 bg-[#1D74E3]/10 rounded-lg text-[#1D74E3] shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Residence Verifications Card -->
        <a href="{{ route('admin.verifications') }}" class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 hover:-translate-y-1 hover:shadow-md hover:border-[#1D74E3]/30 transition duration-200 ease-in-out group flex justify-between items-center">
            <div class="pr-4">
                <h2 class="text-lg font-bold text-[#33333B] group-hover:text-[#1D74E3] transition duration-150">Residence Verifications</h2>
                <p class="text-sm text-[#AA9A98] mt-1.5 font-medium leading-relaxed">Review and process pending residence verification requests.</p>
            </div>
            <div class="flex-shrink-0">
                <span class="inline-flex items-center text-xs font-bold bg-[#1D74E3]/10 text-[#1D74E3] group-hover:bg-[#1D74E3] group-hover:text-white px-3.5 py-2 rounded-lg transition duration-150">
                    Review Now &rarr;
                </span>
            </div>
        </a>

        <!-- Scholarship Applications Card -->
        <a href="{{ route('admin.applications') }}" class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 hover:-translate-y-1 hover:shadow-md hover:border-[#1D74E3]/30 transition duration-200 ease-in-out group flex justify-between items-center">
            <div class="pr-4">
                <h2 class="text-lg font-bold text-[#33333B] group-hover:text-[#1D74E3] transition duration-150">Scholarship Applications</h2>
                <p class="text-sm text-[#AA9A98] mt-1.5 font-medium leading-relaxed">Review and process pending scholarship applications.</p>
            </div>
            <div class="flex-shrink-0">
                <span class="inline-flex items-center text-xs font-bold bg-[#1D74E3]/10 text-[#1D74E3] group-hover:bg-[#1D74E3] group-hover:text-white px-3.5 py-2 rounded-lg transition duration-150">
                    Review Now &rarr;
                </span>
            </div>
        </a>
    </div>
</div>
