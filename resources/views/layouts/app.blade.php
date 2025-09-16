<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full antialiased dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#0b0214">

        <title>{{ config('app.name', 'Girls-secrets') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>[x-cloak]{ display:none !important; }</style>
    </head>
    <body class="min-h-screen font-sans text-violet-100 selection:bg-fuchsia-500/30
                 bg-gradient-to-br from-[#0a0214] via-[#0c0520] to-[#06030f]">
        <!-- Décor global -->
        <div aria-hidden="true" class="pointer-events-none fixed inset-0 overflow-hidden">
            <div class="absolute -top-40 -left-40 h-96 w-96 rounded-full bg-fuchsia-700/20 blur-3xl"></div>
            <div class="absolute -bottom-40 -right-40 h-[28rem] w-[28rem] rounded-full bg-purple-700/20 blur-3xl"></div>
        </div>

        <div class="relative min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="sticky top-0 z-40 backdrop-blur supports-[backdrop-filter]:bg-white/5 ring-1 ring-white/10">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="pb-10">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
