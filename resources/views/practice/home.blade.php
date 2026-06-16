@extends('layouts.public', ['title' => 'Home'])

@section('content')
<div class="bg-slate-50 text-slate-800 antialiased font-sans selection:bg-blue-200 selection:text-blue-900">

    {{-- HERO SECTION --}}
    <section class="px-6 pt-32 pb-24 lg:pt-40 lg:pb-32 overflow-hidden bg-gradient-to-br from-[#0f2747] via-[#13396b] to-[#1c3d6a] relative">
        {{-- Subtle background pattern for desktop --}}
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-10 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-16 lg:gap-24 relative z-10">

            {{-- Left Content --}}
            <div class="w-full lg:w-1/2 text-white pb-0">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold mb-8 bg-white/10 text-amber-400 border border-white/20 backdrop-blur-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>
                    SY 2025-2026 Applications Open
                </div>

                {{-- Title --}}
                <h1 style="font-family: 'Playfair Display', serif;" class="text-5xl lg:text-7xl font-extrabold tracking-tight leading-[1.1] mb-6">
                    Scholarships for<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400">Barangay 587</span>
                </h1>

                {{-- Subtext --}}
                <p class="text-lg lg:text-xl mb-8 leading-relaxed max-w-xl text-slate-300 font-light">
                    We pool funding from local government, SK, and partner organizations
                    to support every qualified resident in pursuing their education.
                </p>

                {{-- Tagline --}}
                <p style="font-family: 'Playfair Display', serif;" class="text-2xl font-medium italic mb-10 text-amber-400">
                    "Tayo para sa ating kabataan."
                </p>

                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <a href="{{ route('register') }}"
                       class="w-full sm:w-auto px-8 py-4 rounded-xl font-bold text-base shadow-xl shadow-black/20 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl bg-white text-[#13396b] hover:bg-slate-100 flex items-center justify-center gap-2">
                        Apply for Scholarship
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="{{ route('scholarships.index') }}"
                       class="w-full sm:w-auto px-8 py-4 rounded-xl font-bold text-base text-white transition-all duration-300 hover:bg-white/10 border-2 border-white/20 hover:border-white/40 text-center">
                        Browse Programs
                    </a>
                </div>
            </div>

            {{-- Right Layout Container --}}
            <div class="w-full lg:w-1/2 relative mt-12 lg:mt-0">

                {{-- Slots Badge (Desktop optimized positioning) --}}
                <div class="absolute -top-6 lg:-top-8 -right-4 lg:-right-8 z-20 px-6 py-4 rounded-2xl shadow-2xl text-center bg-white border border-slate-100 transform rotate-3 hover:rotate-0 transition-transform duration-300">
                    <p style="font-family: 'Playfair Display', serif;" class="text-4xl font-black text-orange-600 leading-none mb-1">18</p>
                    <p class="text-xs font-bold uppercase tracking-widest text-slate-400">slots left</p>
                </div>

                {{-- Floating Classroom Image --}}
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-white/10 group">
                    <div class="absolute inset-0 bg-[#0f2747]/20 group-hover:bg-transparent transition duration-500 z-10"></div>
                    <img src="https://images.unsplash.com/photo-1590012314607-cda9d9b699ae?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop"
                         alt="Students in classroom"
                         class="w-full h-[400px] lg:h-[600px] object-cover transform group-hover:scale-105 transition duration-700 ease-out">
                </div>

                {{-- Deadline Floating Card --}}
                <div class="absolute -bottom-6 lg:-bottom-10 -left-4 lg:-left-12 z-20 bg-white rounded-2xl p-6 shadow-2xl border border-slate-100 min-w-[240px] hover:-translate-y-2 transition-transform duration-300">
                    <p class="text-[11px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">Current deadline</p>
                    <p style="font-family: 'Playfair Display', serif;" class="text-2xl font-bold text-slate-900 mb-3">August 31, 2026</p>
                    <div class="flex items-center gap-2 bg-emerald-50 px-3 py-2 rounded-lg w-fit border border-emerald-100">
                        <span class="relative flex h-2.5 w-2.5">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                        </span>
                        <p class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Applications open</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- HOW TO APPLY (Desktop Step Flow Layout) --}}
    <section class="py-24 lg:py-32 px-6 bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 lg:mb-20">
                <p class="text-sm font-bold tracking-widest text-blue-600 uppercase mb-3">
                    Process
                </p>
                <h2 style="font-family: 'Playfair Display', serif;" class="text-4xl lg:text-5xl font-bold text-slate-900">
                    How to Apply
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12 relative">
                {{-- Desktop Connecting Line Background --}}
                <div class="hidden lg:block absolute top-12 left-[10%] right-[10%] h-[2px] bg-slate-100 z-0"></div>

                <div class="relative z-10 bg-white lg:bg-transparent rounded-2xl p-6 lg:p-0 border border-slate-100 lg:border-none shadow-sm lg:shadow-none group hover:-translate-y-1 transition duration-300">
                    <div class="w-20 h-20 bg-slate-50 border-4 border-white shadow-lg rounded-2xl flex items-center justify-center mb-6 text-3xl font-extrabold text-slate-300 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                        01
                    </div>
                    <h3 class="font-bold text-xl text-slate-900 mb-3">Create Account</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Register with your barangay precinct number to officially verify your local residency.
                    </p>
                </div>

                <div class="relative z-10 bg-white lg:bg-transparent rounded-2xl p-6 lg:p-0 border border-slate-100 lg:border-none shadow-sm lg:shadow-none group hover:-translate-y-1 transition duration-300">
                    <div class="w-20 h-20 bg-slate-50 border-4 border-white shadow-lg rounded-2xl flex items-center justify-center mb-6 text-3xl font-extrabold text-slate-300 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                        02
                    </div>
                    <h3 class="font-bold text-xl text-slate-900 mb-3">Complete Profile</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Fill in your comprehensive personal, family background, and academic information.
                    </p>
                </div>

                <div class="relative z-10 bg-white lg:bg-transparent rounded-2xl p-6 lg:p-0 border border-slate-100 lg:border-none shadow-sm lg:shadow-none group hover:-translate-y-1 transition duration-300">
                    <div class="w-20 h-20 bg-slate-50 border-4 border-white shadow-lg rounded-2xl flex items-center justify-center mb-6 text-3xl font-extrabold text-slate-300 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                        03
                    </div>
                    <h3 class="font-bold text-xl text-slate-900 mb-3">Submit Application</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Choose an applicable scholarship program, upload required documents, and submit.
                    </p>
                </div>

                <div class="relative z-10 bg-white lg:bg-transparent rounded-2xl p-6 lg:p-0 border border-slate-100 lg:border-none shadow-sm lg:shadow-none group hover:-translate-y-1 transition duration-300">
                    <div class="w-20 h-20 bg-slate-50 border-4 border-white shadow-lg rounded-2xl flex items-center justify-center mb-6 text-3xl font-extrabold text-slate-300 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                        04
                    </div>
                    <h3 class="font-bold text-xl text-slate-900 mb-3">Receive Award</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Track your status entirely online. Approved scholars are promptly notified via email.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- OPEN PROGRAMS (Dynamic Cards Grid with uniform heights) --}}
    <section class="py-24 lg:py-32 px-6 bg-slate-50">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row items-start md:items-end justify-between mb-12 lg:mb-16 gap-6">
                <div>
                    <p class="text-sm font-bold tracking-widest text-blue-600 uppercase mb-3">
                        Scholarships
                    </p>
                    <h2 style="font-family: 'Playfair Display', serif;" class="text-4xl lg:text-5xl font-bold text-slate-900">
                        Open Programs
                    </h2>
                </div>
                <a href="{{ route('scholarships.index') }}"
                   class="text-base font-bold flex items-center gap-2 text-blue-600 hover:text-blue-800 transition bg-blue-50 px-5 py-2.5 rounded-xl hover:bg-blue-100">
                    View All Programs
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($scholarships as $scholarship)
                <div class="bg-white rounded-3xl p-8 border border-slate-200 hover:border-blue-100 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full group">

                    {{-- Dynamic Badges --}}
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-xs px-3 py-1.5 rounded-lg font-bold uppercase tracking-wider bg-slate-100 text-slate-600">
                            Academic
                        </span>
                        @if($scholarship['status'] === 'available')
                            <span class="text-xs px-3 py-1.5 rounded-lg font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Open Now
                            </span>
                        @elseif($scholarship['status'] === 'full')
                            <span class="text-xs px-3 py-1.5 rounded-lg font-bold uppercase tracking-wider bg-red-50 text-red-700 border border-red-200">
                                Full
                            </span>
                        @else
                            <span class="text-xs px-3 py-1.5 rounded-lg font-bold uppercase tracking-wider bg-slate-100 text-slate-500">
                                Closed
                            </span>
                        @endif
                    </div>

                    <h3 style="font-family: 'Playfair Display', serif;" class="font-extrabold text-2xl text-slate-900 mb-4 group-hover:text-blue-700 transition-colors">
                        {{ $scholarship['title'] }}
                    </h3>

                    <p class="text-base text-slate-500 mb-8 flex-1 leading-relaxed">
                        {{ $scholarship['description'] ?? 'Scholarship program designed to support qualified and determined barangay residents.' }}
                    </p>

                    {{-- Align bottom contents strictly using mt-auto --}}
                    <div class="mt-auto">
                        {{-- Info Cards Block --}}
                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <div class="rounded-2xl p-4 bg-slate-50 border border-slate-100">
                              <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Amount</p>
                              <p class="font-extrabold text-lg text-emerald-600">
                                  ₱{{ number_format($scholarship['allowance'], 0) }}
                              </p>
                              <p class="text-xs text-slate-500 font-medium mt-0.5">per semester</p>
                            </div>
                            <div class="rounded-2xl p-4 bg-slate-50 border border-slate-100">
                              <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Slots Left</p>
                              <p class="font-extrabold text-lg text-slate-900">
                                  {{ $scholarship['slots'] }}<span class="text-sm text-slate-400 font-medium">/20</span>
                              </p>
                              <p class="text-xs text-slate-500 truncate font-medium mt-0.5">Due {{ $scholarship['deadline'] }}</p>
                            </div>
                        </div>

                        <a href="{{ route('scholarships.show', $scholarship['id']) }}"
                           class="flex items-center justify-center gap-2 w-full text-center text-base font-bold py-4 px-6 rounded-xl text-white bg-[#13396b] hover:bg-[#0f2747] hover:shadow-lg transition-all duration-200">
                            Apply Now
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- STATS BANNER (Desktop refined grid with dividers) --}}
    <section class="py-20 lg:py-28 px-6 bg-gradient-to-r from-[#0f2747] to-[#13396b] text-white">
        <div class="max-w-7xl mx-auto grid grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-0 text-center divide-y lg:divide-y-0 lg:divide-x divide-white/10">
            <div class="pt-6 lg:pt-0">
                <p style="font-family: 'Playfair Display', serif;" class="text-5xl lg:text-6xl font-black text-amber-400 mb-2">108</p>
                <p class="text-base lg:text-lg font-bold text-white mb-1">Active Scholars</p>
                <p class="text-sm text-slate-400 font-light tracking-wide">SY 2024-2025</p>
            </div>
            <div class="pt-6 lg:pt-0">
                <p style="font-family: 'Playfair Display', serif;" class="text-5xl lg:text-6xl font-black text-amber-400 mb-2">₱2.8M</p>
                <p class="text-base lg:text-lg font-bold text-white mb-1">Disbursed to Date</p>
                <p class="text-sm text-slate-400 font-light tracking-wide">since 2018</p>
            </div>
            <div class="pt-6 lg:pt-0">
                <p style="font-family: 'Playfair Display', serif;" class="text-5xl lg:text-6xl font-black text-amber-400 mb-2">94%</p>
                <p class="text-base lg:text-lg font-bold text-white mb-1">Graduation Rate</p>
                <p class="text-sm text-slate-400 font-light tracking-wide">among scholars</p>
            </div>
            <div class="pt-6 lg:pt-0">
                <p style="font-family: 'Playfair Display', serif;" class="text-5xl lg:text-6xl font-black text-amber-400 mb-2">12+</p>
                <p class="text-base lg:text-lg font-bold text-white mb-1">Partner Institutions</p>
                <p class="text-sm text-slate-400 font-light tracking-wide">in the city</p>
            </div>
        </div>
    </section>

    {{-- SUCCESS STORIES (Testimonial Block) --}}
    <section class="py-24 lg:py-32 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 lg:mb-20">
                <p class="text-sm font-bold tracking-widest text-blue-600 uppercase mb-3">
                    Success Stories
                </p>
                <h2 style="font-family: 'Playfair Display', serif;" class="text-4xl lg:text-5xl font-bold text-slate-900">
                    Scholars Who Made It
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Story 1 --}}
                <div class="bg-slate-50 border border-slate-100 rounded-3xl p-8 flex flex-col justify-between hover:shadow-xl transition-shadow duration-300 relative overflow-hidden">
                    {{-- Decorative quote icon --}}
                    <svg class="absolute top-6 right-6 w-16 h-16 text-slate-200/50 transform rotate-180" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>

                    <div class="relative z-10">
                        <div class="flex gap-1 mb-6 text-amber-400">
                            @for($i = 0; $i < 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                </svg>
                            @endfor
                        </div>
                        <p class="text-slate-700 text-lg leading-relaxed mb-8 font-serif italic">
                            "The scholarship gave me confidence. I was the first in my family to finish college, and now I am a licensed nurse."
                        </p>
                    </div>
                    <div class="flex items-center gap-4 pt-6 border-t border-slate-200">
                        <img src="https://images.unsplash.com/photo-1633061273472-7c62356c7329?q=80&w=651&auto=format&fit=crop"
                             alt="Aira Mae" class="w-14 h-14 rounded-full object-cover ring-4 ring-white shadow-md">
                        <div>
                            <p class="font-extrabold text-base text-slate-900">Aira Mae Soriano</p>
                            <p class="text-sm font-medium text-slate-500">BS Nursing · 2023 Graduate</p>
                        </div>
                    </div>
                </div>

                {{-- Story 2 --}}
                <div class="bg-slate-50 border border-slate-100 rounded-3xl p-8 flex flex-col justify-between hover:shadow-xl transition-shadow duration-300 relative overflow-hidden">
                    <svg class="absolute top-6 right-6 w-16 h-16 text-slate-200/50 transform rotate-180" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                    <div class="relative z-10">
                        <div class="flex gap-1 mb-6 text-amber-400">
                            @for($i = 0; $i < 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                </svg>
                            @endfor
                        </div>
                        <p class="text-slate-700 text-lg leading-relaxed mb-8 font-serif italic">
                            "Without the scholarship grant, I wouldn't have been able to maintain my enrollment. Today I work as a junior developer."
                        </p>
                    </div>
                    <div class="flex items-center gap-4 pt-6 border-t border-slate-200">
                        <img src="https://images.unsplash.com/photo-1762438135547-bad99d8629c6?q=80&w=686&auto=format&fit=crop"
                             alt="Mark Jayson" class="w-14 h-14 rounded-full object-cover ring-4 ring-white shadow-md">
                        <div>
                            <p class="font-extrabold text-base text-slate-900">Mark Jayson Villanueva</p>
                            <p class="text-sm font-medium text-slate-500">BSIT, PLM · 2022 Graduate</p>
                        </div>
                    </div>
                </div>

                {{-- Story 3 --}}
                <div class="bg-slate-50 border border-slate-100 rounded-3xl p-8 flex flex-col justify-between hover:shadow-xl transition-shadow duration-300 relative overflow-hidden">
                    <svg class="absolute top-6 right-6 w-16 h-16 text-slate-200/50 transform rotate-180" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                    <div class="relative z-10">
                        <div class="flex gap-1 mb-6 text-amber-400">
                            @for($i = 0; $i < 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                                </svg>
                            @endfor
                        </div>
                        <p class="text-slate-700 text-lg leading-relaxed mb-8 font-serif italic">
                            "I thought education stopped after high school. The scholarship changed everything — I'm now running the books for a small business."
                        </p>
                    </div>
                    <div class="flex items-center gap-4 pt-6 border-t border-slate-200">
                        <img src="https://images.unsplash.com/photo-1681567012502-51d0fd46221a?q=80&w=687&auto=format&fit=crop"
                             alt="Cherry Ann" class="w-14 h-14 rounded-full object-cover ring-4 ring-white shadow-md">
                        <div>
                            <p class="font-extrabold text-base text-slate-900">Cherry Ann Ramos</p>
                            <p class="text-sm font-medium text-slate-500">TESDA Bookkeeping · 2024 Completer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ANNOUNCEMENTS (Desktop 2-Column Grid Layout) --}}
    <section class="py-24 lg:py-32 px-6 bg-slate-50/50 border-y border-slate-200">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <p class="text-sm font-bold tracking-widest text-blue-600 uppercase mb-3">
                    Announcements
                </p>
                <h2 style="font-family: 'Playfair Display', serif;" class="text-4xl lg:text-5xl font-bold text-slate-900">
                    Latest Updates
                </h2>
            </div>

            {{-- Desktop optimized grid layout --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                @foreach($announcements as $announcement)
                    <div class="bg-white rounded-2xl p-8 shadow-sm border-l-4 border-blue-600 hover:shadow-md transition-shadow duration-200">
                        <div class="flex flex-col sm:flex-row items-start gap-5">
                            <div class="p-3 rounded-xl bg-blue-50 text-blue-600 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-extrabold text-xl text-slate-900 mb-2">
                                    {{ $announcement['title'] }}
                                </h3>
                                <p class="text-base text-slate-600 leading-relaxed mb-4">
                                    {{ $announcement['body'] }}
                                </p>
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                    </svg>
                                    {{ $announcement['created_at'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA SECTION (Clean Modern Bottom Visual Block) --}}
    <section class="py-28 lg:py-40 px-6 text-center bg-white relative overflow-hidden">
        {{-- Subtle background decoration --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-[400px] bg-blue-50/50 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-3xl mx-auto z-10 relative">
            <h2 style="font-family: 'Playfair Display', serif;" class="text-4xl lg:text-6xl font-bold text-slate-900 mb-6">
                Ready to Start Your Journey?
            </h2>
            <p class="text-lg lg:text-xl text-slate-500 mb-12 leading-relaxed">
                Application period is open until August 31. Give your academic pathway the foundation it truly deserves.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-5">
                <a href="{{ route('register') }}"
                   class="w-full sm:w-auto px-10 py-5 rounded-2xl text-white font-bold text-lg shadow-xl shadow-blue-600/20 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl bg-[#13396b] hover:bg-[#0f2747] flex items-center justify-center gap-2">
                    Create Account Today
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="{{ route('scholarships.index') }}"
                   class="w-full sm:w-auto px-10 py-5 rounded-2xl font-bold text-lg text-slate-700 bg-white border-2 border-slate-200 hover:bg-slate-50 hover:border-slate-300 transition-all duration-200">
                    View All Scholarships
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
