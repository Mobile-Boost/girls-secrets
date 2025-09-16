<x-welcome-layout title="Girls‑IA — Génération d’images IA" anchors="true">

    <!-- HERO -->
    <section class="relative overflow-hidden pt-28 pb-20 px-4 sm:px-6 lg:px-8">
        <div class="absolute top-1/4 left-10 w-24 h-24 bg-fuchsia-700/20 rounded-full blur-3xl floating"></div>
        <div class="absolute top-1/3 right-20 w-20 h-20 bg-purple-700/30 rounded-full blur-3xl floating" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-1/4 left-1/4 w-28 h-28 bg-violet-700/20 rounded-full blur-3xl floating" style="animation-delay: 4s;"></div>

        <div class="mx-auto max-w-7xl grid lg:grid-cols-[1.1fr,1fr] items-center gap-12">
            <div class="relative z-10 space-y-6">
                <h1 class="text-4xl md:text-6xl font-semibold leading-tight tracking-tight">
                    Créez des images <span class="gradient-text">sensuelles</span> avec l’IA
                </h1>
                <p class="text-lg md:text-xl text-violet-200/80">
                    Transformez vos idées en visuels élégants et de haute qualité grâce à nos modèles IA optimisés.
                </p>

                <div class="flex flex-col sm:flex-row gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="w-full sm:w-auto rounded-xl px-6 py-3 text-sm md:text-base font-semibold text-white
                                  bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500
                                  shadow-lg shadow-fuchsia-900/20 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                            Créer maintenant
                        </a>
                    @else
                        <a href="https://www.girls-ia.com/lp/index.html"
                           class="w-full sm:w-auto rounded-xl px-6 py-3 text-sm md:text-base font-semibold text-white
                                  bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500
                                  shadow-lg shadow-fuchsia-900/20 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                            Commencer
                        </a>
                        <a href="{{ route('login') }}"
                           class="w-full sm:w-auto rounded-xl px-6 py-3 text-sm md:text-base font-semibold
                                  text-violet-200 ring-1 ring-white/10 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                            Se connecter
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Slider -->
            <div class="relative z-10 h-[26rem] sm:h-[28rem] lg:h-[30rem] rounded-2xl overflow-hidden neon-shadow">
                <div class="absolute inset-0 pointer-events-none ring-1 ring-purple-500/20 rounded-2xl"></div>
                <div class="slider-wrapper h-full">
                    <div class="slider-container h-full flex" id="sliderContainer">
                        <div class="slider-item min-w-full h-full">
                            <div class="w-full h-full bg-gradient-to-br from-purple-900 to-fuchsia-900 grid place-items-center">
                                <svg class="h-24 w-24 text-fuchsia-300/80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="slider-item min-w-full h-full">
                            <div class="w-full h-full bg-gradient-to-br from-indigo-900 to-purple-900 grid place-items-center">
                                <svg class="h-24 w-24 text-purple-300/80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="slider-item min-w-full h-full">
                            <div class="w-full h-full bg-gradient-to-br from-fuchsia-900 to-rose-900 grid place-items-center">
                                <svg class="h-24 w-24 text-rose-300/80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Dots -->
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                        <button class="slider-dot w-2.5 h-2.5 rounded-full bg-white/20 active-dot" data-index="0" aria-label="Slide 1"></button>
                        <button class="slider-dot w-2.5 h-2.5 rounded-full bg-white/20" data-index="1" aria-label="Slide 2"></button>
                        <button class="slider-dot w-2.5 h-2.5 rounded-full bg-white/20" data-index="2" aria-label="Slide 3"></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works -->
    <section class="relative py-16 px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-6xl">
            <div class="grid md:grid-cols-3 gap-6">
                @php $steps = ['Décrivez','Ajustez','Générez']; @endphp
                @foreach ($steps as $i => $s)
                <div class="rounded-2xl bg-white/5 backdrop-blur border border-purple-500/20 p-6">
                    <div class="mb-4 inline-flex h-10 w-10 items-center justify-center rounded-full
                                bg-gradient-to-r from-fuchsia-600 to-purple-600 text-white font-semibold">
                        {{ $i+1 }}
                    </div>
                    <h4 class="text-lg font-semibold mb-1">{{ $s }}</h4>
                    <p class="text-sm text-violet-200/80">
                        @if ($i==0) Expliquez le rendu souhaité : style, ambiance, détails.
                        @elseif ($i==1) Modifiez paramètres, seed, guidance, taille, etc.
                        @else Lancez la génération et téléchargez en HD. @endif
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Features (HTML pur) -->
    <section id="features" class="relative py-20 px-4 sm:px-6 lg:px-8">
      <div class="mx-auto max-w-7xl">
        <div class="text-center mb-14">
          <h2 class="text-3xl md:text-4xl font-semibold mb-3">
            Fonctionnalités <span class="gradient-text">exclusives</span>
          </h2>
          <p class="text-lg text-violet-200/80">Pourquoi notre solution IA est différente</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- cartes 1..6 (identiques à ta dernière version) -->
          <!-- 1 -->
          <div class="group relative rounded-2xl overflow-hidden bg-white/5 backdrop-blur border border-purple-500/20 p-6 sm:p-8 card-hover">
            <div class="absolute -inset-px opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gradient-to-br from-fuchsia-600/10 to-purple-600/10"></div>
            <div class="relative">
              <div class="mb-5 h-14 w-14 rounded-xl bg-gradient-to-r from-fuchsia-600 to-purple-600 grid place-items-center ring-1 ring-white/10">
                <svg aria-hidden="true" class="h-7 w-7 text-white/95" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
              </div>
              <h3 class="text-xl font-semibold mb-2">IA avancée</h3>
              <p class="text-violet-200/80">Génère des images réalistes et cohérentes de haute qualité.</p>
            </div>
          </div>
          <!-- 2 -->
          <div class="group relative rounded-2xl overflow-hidden bg-white/5 backdrop-blur border border-purple-500/20 p-6 sm:p-8 card-hover">
            <div class="absolute -inset-px opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gradient-to-br from-indigo-600/10 to-cyan-600/10"></div>
            <div class="relative">
              <div class="mb-5 h-14 w-14 rounded-xl bg-gradient-to-r from-indigo-600 to-cyan-600 grid place-items-center ring-1 ring-white/10">
                <svg aria-hidden="true" class="h-7 w-7 text-white/95" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                </svg>
              </div>
              <h3 class="text-xl font-semibold mb-2">Personnalisation</h3>
              <p class="text-violet-200/80">Choisissez style, pose, ambiance, vêtements et bien plus.</p>
            </div>
          </div>
          <!-- 3 -->
          <div class="group relative rounded-2xl overflow-hidden bg-white/5 backdrop-blur border border-purple-500/20 p-6 sm:p-8 card-hover">
            <div class="absolute -inset-px opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gradient-to-br from-emerald-600/10 to-green-600/10"></div>
            <div class="relative">
              <div class="mb-5 h-14 w-14 rounded-xl bg-gradient-to-r from-emerald-600 to-green-600 grid place-items-center ring-1 ring-white/10">
                <svg aria-hidden="true" class="h-7 w-7 text-white/95" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
              </div>
              <h3 class="text-xl font-semibold mb-2">Ultra‑rapide</h3>
              <p class="text-violet-200/80">Obtenez vos visuels en quelques secondes seulement.</p>
            </div>
          </div>
          <!-- 4 -->
          <div class="group relative rounded-2xl overflow-hidden bg-white/5 backdrop-blur border border-purple-500/20 p-6 sm:p-8 card-hover">
            <div class="absolute -inset-px opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gradient-to-br from-yellow-600/10 to-orange-600/10"></div>
            <div class="relative">
              <div class="mb-5 h-14 w-14 rounded-xl bg-gradient-to-r from-yellow-600 to-orange-600 grid place-items-center ring-1 ring-white/10">
                <svg aria-hidden="true" class="h-7 w-7 text-white/95" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
              </div>
              <h3 class="text-xl font-semibold mb-2">Confidentialité</h3>
              <p class="text-violet-200/80">Vos créations restent privées et sécurisées.</p>
            </div>
          </div>
          <!-- 5 -->
          <div class="group relative rounded-2xl overflow-hidden bg-white/5 backdrop-blur border border-purple-500/20 p-6 sm:p-8 card-hover">
            <div class="absolute -inset-px opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gradient-to-br from-rose-600/10 to-pink-600/10"></div>
            <div class="relative">
              <div class="mb-5 h-14 w-14 rounded-xl bg-gradient-to-r from-rose-600 to-pink-600 grid place-items-center ring-1 ring-white/10">
                <svg aria-hidden="true" class="h-7 w-7 text-white/95" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
              </div>
              <h3 class="text-xl font-semibold mb-2">Style personnalisé</h3>
              <p class="text-violet-200/80">Entraînez un style qui correspond à vos préférences.</p>
            </div>
          </div>
          <!-- 6 -->
          <div class="group relative rounded-2xl overflow-hidden bg-white/5 backdrop-blur border border-purple-500/20 p-6 sm:p-8 card-hover">
            <div class="absolute -inset-px opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-gradient-to-br from-indigo-600/10 to-purple-600/10"></div>
            <div class="relative">
              <div class="mb-5 h-14 w-14 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 grid place-items-center ring-1 ring-white/10">
                <svg aria-hidden="true" class="h-7 w-7 text-white/95" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 004 0z"/>
                </svg>
              </div>
              <h3 class="text-xl font-semibold mb-2">Support 24/7</h3>
              <p class="text-violet-200/80">Notre équipe vous accompagne à tout moment.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Gallery -->
    <section id="gallery" class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="text-center mb-14">
                <h2 class="text-3xl md:text-4xl font-semibold mb-3">Galerie de <span class="gradient-text">créations</span></h2>
                <p class="text-lg text-violet-200/80">Un aperçu de ce que vous pouvez produire</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach (range(1,6) as $g)
                <div class="group relative h-72 rounded-2xl overflow-hidden neon-shadow bg-gradient-to-br
                            {{ ['from-purple-900 to-fuchsia-900','from-indigo-900 to-purple-900','from-fuchsia-900 to-rose-900'][$g % 3] }}">
                    <div class="absolute inset-0 ring-1 ring-purple-500/20 rounded-2xl"></div>
                    <div class="absolute inset-0 grid place-items-center">
                        <svg class="h-16 w-16 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity grid place-items-center">
                        <p class="text-base font-semibold">Exemple de création {{ $g }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            @auth
            <div class="text-center mt-12">
                <a href="{{ url('/dashboard') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-xl px-6 py-3 font-semibold text-white
                          bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500
                          shadow-lg shadow-fuchsia-900/20 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                    Voir plus de créations
                </a>
            </div>
            @endauth
        </div>
    </section>

    <!-- CTA finale -->
    <section class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl text-center">
            <div class="rounded-2xl bg-white/5 backdrop-blur border border-purple-500/20 p-8 md:p-10">
                <h2 class="text-3xl md:text-4xl font-semibold mb-4">Prêt à créer des images <span class="gradient-text">sensuelles</span> avec l’IA ?</h2>
                <p class="text-lg text-violet-200/85 mb-8">Rejoignez Girls‑IA et générez des images uniques en quelques minutes.</p>

                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="rounded-xl px-8 py-4 text-lg font-semibold text-white
                              bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500
                              shadow-lg shadow-fuchsia-900/20 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                        Commencer à créer
                    </a>
                @else
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="{{ route('login') }}"
                           class="rounded-xl px-8 py-4 text-lg font-semibold text-violet-200 ring-1 ring-white/10 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                            Se connecter
                        </a>
                        <a href="https://www.girls-ia.com/lp/index.html"
                           class="rounded-xl px-8 py-4 text-lg font-semibold text-white
                                  bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500
                                  shadow-lg shadow-fuchsia-900/20 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                            Commencer
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </section>

</x-welcome-layout>
