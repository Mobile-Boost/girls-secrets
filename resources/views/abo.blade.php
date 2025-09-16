<x-welcome-layout title="Girls‑IA — Gérer mon abonnement">

    <!-- HERO : Gérer mon abonnement -->
    <section class="relative overflow-hidden pt-28 pb-14 px-4 sm:px-6 lg:px-8">
        <div class="absolute top-1/4 left-10 w-24 h-24 bg-fuchsia-700/20 rounded-full blur-3xl floating"></div>
        <div class="absolute top-1/3 right-20 w-20 h-20 bg-purple-700/30 rounded-full blur-3xl floating" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-1/4 left-1/4 w-28 h-28 bg-violet-700/20 rounded-full blur-3xl floating" style="animation-delay: 4s;"></div>

        <div class="mx-auto max-w-5xl text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-semibold leading-tight tracking-tight">
                Gérer mon <span class="gradient-text">Abonnement</span>
            </h1>
            <p class="mt-4 text-lg md:text-xl text-violet-200/85">
                Accédez à votre espace personnel et gérez votre abonnement en toute simplicité.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                @auth
                    <a href="{{ Route::has('billing.portal') ? route('billing.portal') : (Route::has('billing') ? route('billing') : url('/dashboard')) }}"
                       class="rounded-xl px-6 py-3 text-sm md:text-base font-semibold text-white
                              bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500
                              shadow-lg shadow-fuchsia-900/20 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                        Accéder à mon espace
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="rounded-xl px-6 py-3 text-sm md:text-base font-semibold text-white
                              bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500
                              shadow-lg shadow-fuchsia-900/20 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                        Accéder à mon compte
                    </a>
                @endauth
                <a href="mailto:contact@smartmob.fr"
                   class="rounded-xl px-6 py-3 text-sm md:text-base font-semibold
                          text-violet-200 ring-1 ring-white/10 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                    Besoin d’aide ?
                </a>
            </div>
        </div>
    </section>

    <!-- Section Accès & Informations -->
    <section class="relative py-10 px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Pour vous connecter -->
            <div class="rounded-2xl bg-white/5 backdrop-blur border border-purple-500/20 p-6">
                <div class="mb-4 inline-flex h-10 w-10 items-center justify-center rounded-lg
                            bg-gradient-to-r from-fuchsia-600 to-purple-600 text-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a5 5 0 10-4.546 4.958L10 14h2l1.5 1.5L15 14l1.5 1.5L18 14l1.5 1.5"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold">Pour vous connecter</h3>
                <p class="mt-2 text-violet-200/80">
                    Utilisez les identifiants qui vous ont été communiqués le jour de votre souscription <strong>par SMS</strong>.
                </p>
                <div class="mt-4">
                    @auth
                        <a href="{{ Route::has('billing.portal') ? route('billing.portal') : (Route::has('billing') ? route('billing') : url('/dashboard')) }}"
                           class="inline-flex items-center rounded-xl px-4 py-2 text-sm font-semibold text-white
                                  bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500 shadow-lg shadow-fuchsia-900/20">
                            Accéder à mon espace
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center rounded-xl px-4 py-2 text-sm font-semibold text-white
                                  bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500 shadow-lg shadow-fuchsia-900/20">
                            Accéder à mon compte
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Besoin d'aide / Nous contacter -->
            <div class="rounded-2xl bg-white/5 backdrop-blur border border-purple-500/20 p-6">
                <div class="mb-4 inline-flex h-10 w-10 items-center justify-center rounded-lg
                            bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                        <circle cx="12" cy="12" r="4"></circle>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v4M12 18v4M2 12h4M18 12h4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M19.07 4.93l-2.83 2.83M7.76 16.24l-2.83 2.83"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold">Besoin d’aide ?</h3>
                <p class="mt-2 text-violet-200/80">Contactez‑nous à l’adresse suivante :</p>
                <p class="mt-1">
                    <a href="mailto:contact@smartmob.fr" class="font-medium text-fuchsia-300 hover:text-fuchsia-200">
                        contact@smartmob.fr
                    </a>
                </p>

                <div class="mt-6 border-t border-white/10 pt-4">
                    <h4 class="text-sm font-semibold text-violet-200/80">Nous contacter</h4>
                    <p class="mt-1">
                        Par mail :
                        <a href="mailto:contact@smartmob.fr" class="font-medium text-fuchsia-300 hover:text-fuchsia-200">
                            contact@smartmob.fr
                        </a>
                    </p>
                </div>
            </div>

            <!-- Mon abonnement (statut, crédits, résiliation) -->
            <div class="rounded-2xl bg-white/5 backdrop-blur border border-purple-500/20 p-6">
                <div class="mb-4 inline-flex h-10 w-10 items-center justify-center rounded-lg
                            bg-gradient-to-r from-rose-600 to-pink-600 text-white">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h10M5 19h14" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold">Mon abonnement</h3>

                @auth
                    @php $user = auth()->user(); @endphp

                    <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="rounded-xl bg-black/20 ring-1 ring-white/10 p-4">
                            <p class="text-sm text-violet-200/80">Statut</p>
                            <div class="mt-2 inline-flex items-center gap-2 rounded-full px-2.5 py-1.5 text-xs font-semibold
                                {{ $user->subscribed ? 'bg-emerald-500/10 text-emerald-200 ring-1 ring-emerald-500/20' : 'bg-rose-500/10 text-rose-200 ring-1 ring-rose-500/20' }}">
                                @if($user->subscribed)
                                    <span class="inline-block h-2 w-2 rounded-full bg-emerald-400"></span> Actif
                                @else
                                    <span class="inline-block h-2 w-2 rounded-full bg-rose-400"></span> Inactif
                                @endif
                            </div>
                        </div>

                        <div class="rounded-xl bg-black/20 ring-1 ring-white/10 p-4">
                            <p class="text-sm text-violet-200/80">Crédits IA disponibles</p>
                            <p class="mt-2 text-2xl font-semibold">{{ $user->credit_ia }}</p>
                        </div>
                    </div>

                    <div class="mt-5 flex flex-col sm:flex-row gap-3">
                        @if($user->subscribed)
                            <a href="mailto:contact@smartmob.fr?subject=R%C3%A9siliation%20abonnement%20Girls-IA&body=Bonjour%2C%20je%20souhaite%20r%C3%A9silier%20mon%20abonnement.%20Mon%20identifiant%20est%20{{ urlencode($user->login) }}."
                               class="inline-flex items-center rounded-xl px-5 py-2.5 text-sm font-semibold text-rose-200 ring-1 ring-rose-400/30 hover:bg-rose-500/10">
                                Annuler mon abonnement
                            </a>
                        @endif
                    </div>
                @else
                    <p class="mt-3 text-violet-200/80">Connectez‑vous pour voir votre statut et vos crédits.</p>
                    <div class="mt-4">
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center rounded-xl px-4 py-2 text-sm font-semibold text-white
                                  bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500">
                            Me connecter
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Paiements Internet+ -->
            <div class="rounded-2xl bg-white/5 backdrop-blur border border-purple-500/20 p-6">
                <div class="mb-4 inline-flex h-10 w-10 items-center justify-center rounded-lg
                            bg-gradient-to-r from-emerald-600 to-green-600 text-white">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6.75h3.75a3 3 0 013 3v0a3 3 0 01-3 3H15m-6 0H6.75a3 3 0 01-3-3v0a3 3 0 013-3H9m3 6l-3-3m3 3l3-3"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold">Paiements Internet+</h3>
                <p class="mt-2 text-violet-200/80">Plus d’informations sur :</p>
                <p class="mt-1">
                    <a href="https://www.surmafacture.fr" target="_blank" rel="noopener noreferrer"
                       class="font-medium text-fuchsia-300 hover:text-fuchsia-200 underline underline-offset-4">
                        www.surmafacture.fr
                    </a>
                </p>
            </div>
        </div>
    </section>

    <!-- Aide : pertes d'identifiants & résiliation -->
    <section class="relative py-6 px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl grid md:grid-cols-2 gap-6">
            <!-- Perte identifiants -->
            <div class="group relative rounded-2xl overflow-hidden bg-white/5 backdrop-blur border border-purple-500/20 p-6 sm:p-8">
                <div class="absolute -inset-px opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gradient-to-br from-fuchsia-600/10 to-purple-600/10"></div>
                <div class="relative">
                    <h3 class="text-xl font-semibold">J’ai perdu mes identifiants</h3>
                    <p class="mt-2 text-violet-200/80">
                        Contactez notre support pour récupérer vos accès rapidement.
                    </p>
                    <div class="mt-5">
                        <a href="mailto:contact@smartmob.fr?subject=Perte%20d%27identifiants%20Girls-IA&body=Bonjour%2C%20j%27ai%20perdu%20mes%20identifiants.%20Merci%20de%20m%27aider%20%C3%A0%20les%20r%C3%A9cup%C3%A9rer."
                           class="inline-flex items-center rounded-xl px-5 py-2.5 text-sm font-semibold text-white
                                  bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500
                                  shadow-lg shadow-fuchsia-900/20 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                            Demander de l’aide
                        </a>
                    </div>
                </div>
            </div>

            <!-- Résiliation -->
            <div class="group relative rounded-2xl overflow-hidden bg-white/5 backdrop-blur border border-purple-500/20 p-6 sm:p-8">
                <div class="absolute -inset-px opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gradient-to-br from-fuchsia-600/10 to-purple-600/10"></div>
                <div class="relative">
                    <h3 class="text-xl font-semibold">Je souhaite commencer à utiliser Girls-AI</h3>
                    <p class="mt-2 text-violet-200/80">
                        Gérez votre résiliation directement depuis votre espace.
                    </p>
                    <div class="mt-5">
                        @auth
                            <a href="{{ Route::has('billing.portal') ? route('billing.portal') : (Route::has('billing') ? route('billing') : url('/dashboard')) }}"
                               class="inline-flex items-center rounded-xl px-5 py-2.5 text-sm font-semibold text-white
                                      bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500
                                      shadow-lg shadow-fuchsia-900/20 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                                Accéder à mon espace
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center rounded-xl px-5 py-2.5 text-sm font-semibold text-white
                                      bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500
                                      shadow-lg shadow-fuchsia-900/20 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                                Accéder à mon compte
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Support -->
    <section class="relative py-10 px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl">
            <div class="rounded-2xl bg-white/5 backdrop-blur border border-purple-500/20 p-6 md:p-8">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-3 w-3 rounded-full bg-emerald-400"></span>
                        <p class="text-sm md:text-base font-medium">
                            Support disponible <span class="mx-2">•</span> Lun–Ven 9h–18h
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="mailto:contact@smartmob.fr"
                           class="rounded-lg px-4 py-2 text-sm font-semibold text-violet-200 ring-1 ring-white/10 hover:bg-white/10">
                            contact@smartmob.fr
                        </a>
                        <a href="https://www.surmafacture.fr" target="_blank" rel="noopener noreferrer"
                           class="rounded-lg px-4 py-2 text-sm font-semibold text-white
                                  bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500 shadow-lg shadow-fuchsia-900/20">
                            En savoir + (Internet+)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-welcome-layout>
