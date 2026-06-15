""
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Barangay Scholarship System' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen" style="background-color: #E5E8EF; color: #1B1A1C;">

    {{-- NAVIGATION BAR --}}
    <nav style="background-color: #1D74E3;" class="shadow-md">
        <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">

            {{-- Logo / System Name --}}
            <a href="{{ route('home') }}" class="text-white font-bold text-lg tracking-wide hover:opacity-80">
                Barangay Scholarship System
            </a>

            {{-- Navigation Links --}}
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}"
                    class="text-white text-sm hover:opacity-75 {{ request()->routeIs('home') ? 'font-bold underline' : '' }}">
                    Home
                </a>
                <a href="{{ route('scholarships.index') }}"
                    class="text-white text-sm hover:opacity-75 {{ request()->routeIs('scholarships.*') ? 'font-bold underline' : '' }}">
                    Scholarships
                </a>
                <a href="{{ route('about') }}"
                    class="text-white text-sm hover:opacity-75 {{ request()->routeIs('about') ? 'font-bold underline' : '' }}">
                    About
                </a>
                <a href="{{ route('faqs') }}"
                    class="text-white text-sm hover:opacity-75 {{ request()->routeIs('faqs') ? 'font-bold underline' : '' }}">
                    FAQs
                </a>
                <a href="{{ route('contact') }}"
                    class="text-white text-sm hover:opacity-75 {{ request()->routeIs('contact') ? 'font-bold underline' : '' }}">
                    Contact
                </a>

                {{-- Login / Register Buttons --}}
                <a href="{{ route('login') }}"
                    class="text-white text-sm border border-white px-3 py-1 rounded hover:bg-white hover:text-blue-600 transition">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="text-sm bg-white px-3 py-1 rounded font-semibold hover:opacity-90 transition"
                    style="color: #1D74E3;">
                    Register
                </a>
            </div>

        </div>
    </nav>

    {{-- PAGE CONTENT --}}
    <main>
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    <footer style="background-color: #33333B; color: #AA9A98;" class="mt-16 py-8">
        <div class="max-w-6xl mx-auto px-4 text-center text-sm">
            <p>© {{ date('Y') }} Barangay Scholarship Application System. All rights reserved.</p>
        </div>
    </footer>

    @livewireScripts
</body>

</html>
