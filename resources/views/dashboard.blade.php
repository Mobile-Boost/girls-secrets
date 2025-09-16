<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl md:text-3xl font-semibold tracking-tight">
                <span class="gradient-text">Tableau de bord</span>
            </h2>

            <div class="hidden sm:flex items-center gap-2">
                <a href="{{ route('dashboard') }}"
                    class="rounded-xl px-4 py-2 text-sm font-semibold text-violet-200 ring-1 ring-white/10 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                    Rafraîchir
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Flash success --}}
            @if(session('success'))
            <div role="alert" aria-live="polite"
                class="rounded-xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-emerald-200">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            {{-- Carte : informations utilisateur --}}
            <div class="relative overflow-hidden rounded-2xl bg-white/5 backdrop-blur border border-purple-500/20">
                <div class="px-6 py-6 sm:px-8 sm:py-8">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <h3 class="text-xl md:text-2xl font-semibold">Bienvenue {{ $user->login }} !</h3>
                            <p class="mt-1 text-sm text-violet-200/80">Heureux de vous revoir sur Girls‑Secrets.</p>
                        </div>

                        {{-- Quick actions mobile --}}
                        <div class="flex sm:hidden items-center gap-2">
                            <a href="{{ route('dashboard') }}"
                                class="rounded-xl px-3 py-2 text-xs font-semibold text-violet-200 ring-1 ring-white/10 hover:bg-white/10">
                                Rafraîchir
                            </a>
                        </div>
                    </div>

                    {{-- Stat cards --}}
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        {{-- Abonnement --}}
                        <div class="rounded-xl bg-black/30 ring-1 ring-white/10 p-4">
                            <p class="text-sm text-violet-200/70">Statut d’abonnement</p>
                            <div class="mt-2 inline-flex items-center gap-2 rounded-full px-2.5 py-1.5 text-xs font-semibold
                                        {{ $user->subscribed ? 'bg-emerald-500/10 text-emerald-200 ring-1 ring-emerald-500/20' : 'bg-rose-500/10 text-rose-200 ring-1 ring-rose-500/20' }}">
                                @if($user->subscribed)
                                <span class="inline-block h-2 w-2 rounded-full bg-emerald-400"></span> Actif
                                @else
                                <span class="inline-block h-2 w-2 rounded-full bg-rose-400"></span> Inactif
                                @endif
                            </div>

                            <div class="mt-3 flex flex-wrap gap-2">
                                @unless($user->subscribed)
                                    <a href="{{ Route::has('billing') ? route('billing') : '#' }}"
                                        class="inline-flex items-center rounded-lg px-3 py-2 text-xs font-semibold text-white
                                                  bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500
                                                  shadow-lg shadow-fuchsia-900/20 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                                        Activer mon abonnement
                                    </a>
                                @endunless

                                <a href="{{ Route::has('billing.portal') ? route('billing.portal') : (Route::has('billing') ? route('billing') : url('/abonnement')) }}"
                                   class="inline-flex items-center rounded-lg px-3 py-2 text-xs font-semibold text-violet-200 ring-1 ring-white/10 hover:bg-white/10">
                                    Gérer mon abonnement
                                </a>
                            </div>
                        </div>

                        {{-- Crédits --}}
                        <div class="rounded-xl bg-black/30 ring-1 ring-white/10 p-4">
                            <p class="text-sm text-violet-200/70">Crédits IA disponibles</p>
                            <div class="mt-2 flex items-end justify-between">
                                <p class="text-2xl font-semibold">{{ $user->credit_ia }}</p>
                                @php
                                $maxCredits = $user->credit_ia_max ?? 100;
                                $pct = (int) min(100, max(0, round(($user->credit_ia / max(1, $maxCredits)) * 100)));
                                @endphp
                                <span class="text-xs text-violet-200/60">{{ $pct }}%</span>
                            </div>
                            <div class="mt-3 h-2 rounded-full bg-white/10 overflow-hidden">
                                <div class="h-full rounded-full bg-gradient-to-r from-fuchsia-600 to-purple-600" style="width: {{ $pct }}%"></div>
                            </div>

                            @if($user->credit_ia < max(10, (int)($maxCredits * 0.1)))
                                <a href="{{ Route::has('credits.topup') ? route('credits.topup') : '#' }}"
                                class="mt-3 inline-block text-xs font-semibold text-fuchsia-300 hover:text-fuchsia-200">
                                Recharger mes crédits →
                                </a>
                                @endif
                        </div>

                        {{-- Ancienneté --}}
                        <div class="rounded-xl bg-black/30 ring-1 ring-white/10 p-4">
                            <p class="text-sm text-violet-200/70">Membre depuis</p>
                            <p class="mt-2 text-2xl font-semibold">{{ $user->created_at->format('d/m/Y') }}</p>
                            <p class="text-xs text-violet-200/60 mt-1">Merci d’être avec nous 💜</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Profils disponibles --}}
            <div class="relative overflow-hidden rounded-2xl bg-white/5 backdrop-blur border border-purple-500/20">
                <div class="px-6 py-6 sm:px-8 sm:py-8">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl md:text-2xl font-semibold">Profils disponibles cette semaine</h3>
                        <a href="{{ route('dashboard') }}"
                            class="hidden sm:inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold text-violet-200 ring-1 ring-white/10 hover:bg-white/10">
                            Tout voir
                        </a>
                    </div>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-5">
                        @foreach($profiles as $profile)
                        <a href="{{ route('profiles.show', $profile) }}" class="group block rounded-2xl overflow-hidden ring-1 ring-purple-500/20 bg-black/30 hover:ring-fuchsia-500/30 transition-all duration-300">
                            <div class="relative aspect-[4/3] overflow-hidden">
                                @if(isset($profile->photos[0]))
                                <img src="{{ $profile->photos[0] }}" alt="{{ $profile->name }}"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                <div class="h-full w-full grid place-items-center bg-gradient-to-br from-purple-900 to-fuchsia-900">
                                    <svg class="h-10 w-10 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2 1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                @endif

                                <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent opacity-80"></div>
                            </div>

                            <div class="p-4">
                                <h4 class="font-semibold text-lg">{{ $profile->name }}</h4>
                                @if($profile->description)
                                <p class="mt-1 text-sm text-violet-200/75">{{ \Illuminate\Support\Str::limit($profile->description, 80) }}</p>
                                @endif
                            </div>
                        </a>
                        @endforeach
                    </div>

                    @if(! count($profiles))
                    <p class="mt-4 text-sm text-violet-200/70">Aucun profil disponible pour le moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>