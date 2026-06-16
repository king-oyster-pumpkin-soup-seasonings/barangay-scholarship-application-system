<div class="min-h-screen bg-[#E5E8EF] p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#33333B]">Admin Dashboard</h1>
        <p class="text-[#AA9A98] mt-1">Welcome to the admin panel.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-sm text-[#AA9A98] uppercase font-semibold">Pending Verifications</p>
            <p class="text-4xl font-bold text-[#1D74E3] mt-2">{{ $pendingVerifications }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-sm text-[#AA9A98] uppercase font-semibold">Pending Applications</p>
            <p class="text-4xl font-bold text-[#1D74E3] mt-2">{{ $pendingApplications }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-sm text-[#AA9A98] uppercase font-semibold">Total Scholars</p>
            <p class="text-4xl font-bold text-[#1D74E3] mt-2">{{ $totalScholars }}</p>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('admin.verifications') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
            <h2 class="text-lg font-bold text-[#33333B]">Residence Verifications</h2>
            <p class="text-sm text-[#AA9A98] mt-1">Review and process pending residence verification requests.</p>
        </a>
        <a href="{{ route('admin.applications') }}" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
            <h2 class="text-lg font-bold text-[#33333B]">Scholarship Applications</h2>
            <p class="text-sm text-[#AA9A98] mt-1">Review and process pending scholarship applications.</p>
        </a>
    </div>
</div>
