<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Barangay Scholarship System' }}</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,800;1,400;1,700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen" style="background-color: #E5E8EF; color: #1B1A1C; font-family: 'Inter', sans-serif;">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b sticky top-0 z-50" style="border-color: #F0EDE8;">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex items-center justify-between h-18 py-4">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-sm"
                         style="background-color: #1D74E3;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold text-base leading-tight" style="color: #33333B; font-family: 'Playfair Display', serif;">
                            BRGY 587 Iskolar iApply
                        </div>
                        <div class="text-xs leading-tight" style="color: #AA9A98;">
                            Brgy. Scholarship System
                        </div>
                    </div>
                </a>

                {{-- Nav Links - Center --}}
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all
                       {{ request()->routeIs('home') ? 'font-semibold' : 'hover:bg-gray-50' }}"
                       style="{{ request()->routeIs('home') ? 'color: #1D74E3; background-color: #EBF3FF;' : 'color: #33333B;' }}">
                        Home
                    </a>
                    <a href="{{ route('scholarships.index') }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all
                       {{ request()->routeIs('scholarships.*') ? 'font-semibold' : 'hover:bg-gray-50' }}"
                       style="{{ request()->routeIs('scholarships.*') ? 'color: #1D74E3; background-color: #EBF3FF;' : 'color: #33333B;' }}">
                        Scholarships
                    </a>
                    <a href="{{ route('about') }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all
                       {{ request()->routeIs('about') ? 'font-semibold' : 'hover:bg-gray-50' }}"
                       style="{{ request()->routeIs('about') ? 'color: #1D74E3; background-color: #EBF3FF;' : 'color: #33333B;' }}">
                        About
                    </a>
                    <a href="{{ route('faqs') }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all
                       {{ request()->routeIs('faqs') ? 'font-semibold' : 'hover:bg-gray-50' }}"
                       style="{{ request()->routeIs('faqs') ? 'color: #1D74E3; background-color: #EBF3FF;' : 'color: #33333B;' }}">
                        FAQ
                    </a>
                    <a href="{{ route('contact') }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all
                       {{ request()->routeIs('contact') ? 'font-semibold' : 'hover:bg-gray-50' }}"
                       style="{{ request()->routeIs('contact') ? 'color: #1D74E3; background-color: #EBF3FF;' : 'color: #33333B;' }}">
                        Contact
                    </a>
                </div>

                {{-- Auth Buttons --}}
                <div class="flex items-center gap-3">
                    @auth
                        @php
                            $dashboardRoute = in_array(auth()->user()->role, ['admin', 'superadmin'], true)
                                ? route('admin.dashboard')
                                : route('dashboard');
                        @endphp

                        <a href="{{ $dashboardRoute }}"
                           class="hidden md:flex items-center gap-1.5 text-sm font-medium hover:opacity-70 transition-opacity"
                           style="color: #33333B;">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="flex items-center gap-1.5 text-sm font-semibold px-4 py-2.5 rounded-lg text-white transition hover:opacity-90 shadow-sm"
                                    style="background-color: #1D74E3;">
                                Log out
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="hidden md:flex items-center gap-1.5 text-sm font-medium hover:opacity-70 transition-opacity"
                           style="color: #33333B;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                            </svg>
                            Sign In
                        </a>
                        <a href="{{ route('register') }}"
                           class="flex items-center gap-1.5 text-sm font-semibold px-4 py-2.5 rounded-lg text-white transition hover:opacity-90 shadow-sm"
                           style="background-color: #1D74E3;">
                            Register
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    {{-- PAGE CONTENT --}}
    <main>
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer style="background-color: #03162e;" class="text-white">
        <div class="max-w-6xl mx-auto px-6 pt-16 pb-8">

            {{-- Main Footer Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">

                {{-- Column 1 — Brand --}}
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                             style="background-color: rgba(255,255,255,0.15);">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>
                        </div>
                        <div>
                            <div class="font-bold text-base leading-tight" style="font-family: 'Playfair Display', serif;">
                                BRGY 587 Iskolar iApply
                            </div>
                            <div class="text-xs leading-tight" style="color: rgba(255,255,255,0.6); font-family: 'Courier New', monospace;">
                                Scholarship Pooling System
                            </div>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed mb-3" style="color: rgba(255,255,255,0.75);">
                        Empowering the youth of our barangay through accessible, transparent scholarship programs.
                    </p>
                    <p class="text-sm italic font-medium" style="color: rgba(255,255,255,0.5);">
                        Tayo para sa ating kabataan.
                    </p>
                </div>

                {{-- Column 2 — Navigation --}}
                <div>
                    <h4 class="text-xs font-semibold tracking-widest uppercase mb-5"
                        style="color: rgba(255,255,255,0.5);">
                        Navigation
                    </h4>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('home') }}"
                               class="text-sm flex items-center gap-2 transition-opacity hover:opacity-100"
                               style="color: rgba(255,255,255,0.75);">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('scholarships.index') }}"
                               class="text-sm flex items-center gap-2 transition-opacity hover:opacity-100"
                               style="color: rgba(255,255,255,0.75);">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                                Scholarships
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}"
                               class="text-sm flex items-center gap-2 transition-opacity hover:opacity-100"
                               style="color: rgba(255,255,255,0.75);">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                                About
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('faqs') }}"
                               class="text-sm flex items-center gap-2 transition-opacity hover:opacity-100"
                               style="color: rgba(255,255,255,0.75);">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                                FAQ
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}"
                               class="text-sm flex items-center gap-2 transition-opacity hover:opacity-100"
                               style="color: rgba(255,255,255,0.75);">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3.5 h-3.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Column 3 — Contact --}}
                <div>
                    <h4 class="text-xs font-semibold tracking-widest uppercase mb-5"
                        style="color: rgba(255,255,255,0.5);">
                        Contact
                    </h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mt-0.5 flex-shrink-0" style="color: rgba(255,255,255,0.6);">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <span class="text-sm" style="color: rgba(255,255,255,0.75);">
                                123 Barangay Ave., Brgy. San Isidro, Quezon City
                            </span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 flex-shrink-0" style="color: rgba(255,255,255,0.6);">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                            <span class="text-sm" style="color: rgba(255,255,255,0.75);">
                                (02) 8-555-1234
                            </span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 flex-shrink-0" style="color: rgba(255,255,255,0.6);">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                            <span class="text-sm" style="color: rgba(255,255,255,0.75);">
                                scholarship@barangay.gov.ph
                            </span>
                        </li>
                    </ul>

                    {{-- Office Hours --}}
                    <div class="mt-6 p-4 rounded-xl" style="background-color: rgba(255,255,255,0.1);">
                        <p class="text-xs font-semibold mb-2" style="color: rgba(255,255,255,0.6);">
                            OFFICE HOURS
                        </p>
                        <p class="text-xs" style="color: rgba(255,255,255,0.75);">
                            Mon–Fri: 8:00 AM – 5:00 PM
                        </p>
                        <p class="text-xs mt-1" style="color: rgba(255,255,255,0.75);">
                            Saturday: 9:00 AM – 12:00 PM
                        </p>
                    </div>
                </div>

            </div>

            {{-- Divider --}}
            <div class="border-t pt-8" style="border-color: rgba(255,255,255,0.15);">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-xs" style="color: rgba(255,255,255,0.5);">
                        © {{ date('Y') }} Barangay Scholarship Application System. All rights reserved.
                    </p>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('faqs') }}"
                           class="text-xs hover:opacity-100 transition-opacity"
                           style="color: rgba(255,255,255,0.5);">
                            FAQ
                        </a>
                        <a href="{{ route('contact') }}"
                           class="text-xs hover:opacity-100 transition-opacity"
                           style="color: rgba(255,255,255,0.5);">
                            Contact
                        </a>
                        <a href="{{ route('about') }}"
                           class="text-xs hover:opacity-100 transition-opacity"
                           style="color: rgba(255,255,255,0.5);">
                            About
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </footer>

    <x-accessibility-widget />

    @livewireScripts
</body>
</html>
