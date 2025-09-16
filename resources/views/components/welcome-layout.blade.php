@props([
  'title' => config('app.name', 'Girls‑IA'),
  // Afficher les ancres de la home (#features, #gallery) dans la nav
  'anchors' => false,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full antialiased dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <meta name="theme-color" content="#0b0214">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak]{ display:none !important; }</style>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#0a0214] via-[#0c0520] to-[#06030f] text-violet-100 selection:bg-fuchsia-500/30">

    <!-- Décor global (auroras + grille subtile) -->
    <div aria-hidden="true" class="pointer-events-none fixed inset-0 overflow-hidden">
        <div class="aurora -top-40 -left-40"></div>
        <div class="aurora -bottom-40 -right-40"></div>
        <div class="absolute inset-0 opacity-[0.06]
             bg-[linear-gradient(120deg,transparent_0,transparent_95%,rgba(255,255,255,.04)_95%),linear-gradient(#ffffff0f_1px,transparent_1px),linear-gradient(90deg,#ffffff0f_1px,transparent_1px)]
             bg-[size:480px_480px,24px_24px,24px_24px]">
        </div>
    </div>

    <!-- NAVIGATION -->
    <nav
        x-data="{ open:false, scrolled:false }"
        @scroll.window="scrolled = window.scrollY > 10"
        :class="scrolled ? 'backdrop-blur supports-[backdrop-filter]:bg-white/5 ring-1 ring-white/10' : 'bg-transparent'"
        class="fixed inset-x-0 top-0 z-50 transition-colors duration-300">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">

                <!-- Branding -->
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 rounded-full bg-white/5 px-3 py-1.5 ring-1 ring-white/10 hover:shadow-lg hover:shadow-fuchsia-900/20 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                    <div class="h-8 w-8 rounded-lg bg-gradient-to-r from-fuchsia-600 to-purple-600 grid place-items-center">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4M6 20a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                        </svg>
                    </div>
                    <span class="font-semibold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 via-purple-400 to-violet-300">
                        Girls‑IA
                    </span>
                </a>

  

                <!-- Actions -->
                <div class="hidden sm:flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="rounded-xl px-3.5 py-2 text-sm font-semibold text-white
                                  bg-white/5 ring-1 ring-white/10 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                            Tableau de bord
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="rounded-xl px-3.5 py-2 text-sm font-semibold text-violet-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                            Connexion
                        </a>
                        <a href="https://www.girls-ia.com/lp/index.html"
                           class="rounded-xl px-3.5 py-2 text-sm font-semibold text-white
                                  bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500
                                  shadow-lg shadow-fuchsia-900/20 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                            Commencer
                        </a>
                    @endauth
                </div>

                <!-- Mobile toggle -->
                <button @click="open = !open" :aria-expanded="open.toString()"
                        class="lg:hidden rounded-md p-2 text-violet-200 hover:text-white hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                    <span class="sr-only">Ouvrir le menu</span>
                    <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                    </svg>
                    <svg x-cloak x-show="open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-cloak x-show="open" x-transition
             class="lg:hidden border-t border-white/10 bg-white/5 backdrop-blur">
            <div class="mx-auto max-w-7xl px-4 py-4 flex flex-col gap-3">
                <a href="{{ url('/') }}" class="rounded-lg px-3 py-2 text-sm text-violet-200 hover:text-white hover:bg-white/10">Accueil</a>

                @if($anchors)
                    <a href="#features" class="rounded-lg px-3 py-2 text-sm text-violet-200 hover:text-white hover:bg-white/10">Fonctionnalités</a>
                    <a href="#gallery" class="rounded-lg px-3 py-2 text-sm text-violet-200 hover:text-white hover:bg-white/10">Galerie</a>
                @else
                    <a href="{{ Route::has('abo') ? route('abo') : url('/abo') }}" class="rounded-lg px-3 py-2 text-sm text-violet-200 hover:text-white hover:bg-white/10">
                        Gérer mon abonnement
                    </a>
                @endif

                <div class="mt-2 flex gap-2">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="flex-1 rounded-lg px-3 py-2 text-center text-sm font-semibold text-white bg-white/10 ring-1 ring-white/10">Tableau de bord</a>
                    @else
                        <a href="{{ route('login') }}" class="flex-1 rounded-lg px-3 py-2 text-center text-sm font-semibold text-violet-200 hover:text-white hover:bg-white/10">Connexion</a>
                        <a href="https://www.girls-ia.com/lp/index.html" class="flex-1 rounded-lg px-3 py-2 text-center text-sm font-semibold text-white bg-gradient-to-r from-fuchsia-600 to-purple-600">Commencer</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- CONTENU DE LA PAGE -->
    <main>
        {{ $slot }}
    </main>

    <!-- FOOTER -->
    <footer class="py-12 px-4 sm:px-6 lg:px-8 border-t border-white/10 bg-black/20 backdrop-blur mt-12">
        <div class="mx-auto max-w-7xl grid md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="h-9 w-9 rounded-lg bg-gradient-to-r from-fuchsia-600 to-purple-600 grid place-items-center">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4M6 20a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                        </svg>
                    </div>
                    <span class="text-lg font-semibold">Girls‑IA</span>
                </div>
                <p class="text-violet-200/75">La technologie IA au service de votre créativité.</p>
            </div>

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-violet-200/70 mb-4">Liens rapides</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ Route::has('abo') ? route('abo') : url('/abo') }}" class="text-violet-200/75 hover:text-white transition">
                            Gérer mon abonnement
                        </a>
                    </li>
                    <li>
                        <a href="{{ Route::has('contact') ? route('contact') : url('/contact') }}" class="text-violet-200/75 hover:text-white transition">
                            Contact
                        </a>
                    </li>
                    <li><a href="{{ url('/') }}#features" class="text-violet-200/75 hover:text-white transition">Fonctionnalités</a></li>
                    <li><a href="{{ url('/') }}#gallery" class="text-violet-200/75 hover:text-white transition">Galerie</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-violet-200/70 mb-4">Légal</h3>
                <ul class="space-y-3">
                    <li><a href="https://www.girls-ia.com/legals/tc.html" class="text-violet-200/75 hover:text-white transition">CGV</a></li>
                    <li><a href="https://www.girls-ia.com/legals/privacy.html" class="text-violet-200/75 hover:text-white transition">Politique de confidentialité</a></li>
                    <li><a href="https://www.girls-ia.com/legals/legals.html" class="text-violet-200/75 hover:text-white transition">Mentions légales</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold uppercase tracking-wider text-violet-200/70 mb-4">Contact</h3>
                <ul class="space-y-3 text-violet-200/75">
                    <li><a href="mailto:contact@smartmob.fr" class="hover:text-white">contact@smartmob.fr</a></li>
                    <li>+33 1 87 21 13 47</li>
                </ul>
            </div>
        </div>

        <div class="mx-auto max-w-7xl border-t border-white/10 mt-10 pt-6 text-center text-violet-200/70">
            <p>&copy; {{ date('Y') }} Girls‑IA. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html> 