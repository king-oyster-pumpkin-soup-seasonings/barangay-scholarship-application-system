@extends('layouts.public', ['title' => 'Forbidden'])

@section('content')
    <div class="min-h-screen bg-[#E5E8EF] dark:bg-[#1B1A1C] flex items-center justify-center p-6">
        <div class="w-full max-w-md rounded-xl bg-white dark:bg-zinc-800 shadow-md border border-gray-100 dark:border-zinc-700 p-8 text-center">
            <div class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-full bg-red-50 text-red-600 dark:bg-red-950/30 dark:text-red-400">
                <span class="text-2xl font-bold">403</span>
            </div>

            <h1 class="text-2xl font-extrabold text-[#33333B] dark:text-white">Access Forbidden</h1>
            <p class="mt-3 text-sm text-[#666] dark:text-zinc-300">
                Your account does not have permission to view this page.
            </p>

            <a href="{{ url()->previous() === url()->current() ? route('home') : url()->previous() }}"
                class="mt-6 inline-flex rounded-lg bg-[#1D74E3] px-4 py-2 text-sm font-semibold text-white hover:bg-[#155ab2]">
                Go Back
            </a>
        </div>
    </div>
@endsection
