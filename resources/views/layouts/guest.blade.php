<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full antialiased dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#0b0214">

        <title>{{ config('app.name', 'Girls-IA') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen font-sans text-violet-100 selection:bg-fuchsia-500/30">
        <div class="relative min-h-screen flex flex-col items-center justify-center p-6
                    bg-gradient-to-br from-[#0a0214] via-[#0c0520] to-[#06030f]">

            <div aria-hidden="true" class="pointer-events-none absolute inset-0 overflow-hidden">
                <div class="absolute -top-40 -left-40 h-96 w-96 rounded-full bg-fuchsia-700/20 blur-3xl"></div>
                <div class="absolute -bottom-32 -right-32 h-[28rem] w-[28rem] rounded-full bg-purple-700/20 blur-3xl"></div>
            </div>

            <div class="relative z-10">
                <a href="/" class="inline-flex items-center gap-2 rounded-full bg-white/5 px-4 py-2
                                   ring-1 ring-white/10 hover:shadow-lg hover:shadow-fuchsia-900/20
                                   focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 via-purple-400 to-violet-300
                                 font-semibold tracking-tight">
                        Girls‑IA
                    </span>
                </a>
            </div>

            <div class="relative z-10 w-full sm:max-w-md mt-8">
                <div class="overflow-hidden rounded-2xl border border-purple-500/20 bg-white/5 backdrop-blur-xl
                            shadow-2xl shadow-fuchsia-900/20">
                    <div class="px-6 py-8 sm:px-8">
                        {{ $slot }}
                    </div>
                </div>

                <p class="mt-6 text-center text-xs text-violet-300/70">
                    © {{ date('Y') }} Girls‑IA — Génération de modèles IA
                </p>
            </div>
        </div>
    </body>
</html>
