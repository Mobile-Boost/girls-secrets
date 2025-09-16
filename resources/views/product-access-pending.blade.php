<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl md:text-3xl font-semibold tracking-tight">
                <span class="gradient-text">Finalisation de votre accès</span>
            </h2>

            <div class="hidden sm:flex items-center gap-2">
                <a href="{{ route('dashboard') }}"
                   class="rounded-xl px-4 py-2 text-sm font-semibold text-violet-200 ring-1 ring-white/10 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                    Aller au tableau de bord
                </a>
                <button type="button"
                        onclick="location.reload();"
                        class="rounded-xl px-4 py-2 text-sm font-semibold text-white
                               bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500
                               shadow-lg shadow-fuchsia-900/20 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                    Rafraîchir
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Message principal --}}
            <div role="status" aria-live="polite"
                 class="rounded-2xl border border-purple-500/20 bg-white/5 backdrop-blur p-6">
                <div class="flex items-start gap-4">
                    <div class="h-10 w-10 shrink-0 rounded-full bg-gradient-to-r from-fuchsia-600 to-purple-600 animate-pulse"></div>

                    <div>
                        <h3 class="text-xl font-semibold">Nous finalisons votre accès…</h3>
                        <p class="mt-1 text-sm text-violet-200/80">
                            Le paiement vient d’être confirmé par votre opérateur.
                            Si la connexion automatique ne s’ouvre pas dans quelques instants,
                            utilisez le lien reçu par SMS ou cliquez sur <em>Rafraîchir</em>.
                        </p>
                        <p class="mt-2 text-xs text-violet-200/60">
                            Astuce : gardez la page ouverte pendant quelques secondes.
                        </p>
                    </div>
                </div>

                {{-- Actions "mobile" --}}
                <div class="mt-4 flex sm:hidden items-center gap-2">
                    <a href="{{ route('dashboard') }}"
                       class="rounded-xl px-3 py-2 text-xs font-semibold text-violet-200 ring-1 ring-white/10 hover:bg-white/10">
                        Tableau de bord
                    </a>
                    <button type="button" onclick="location.reload();"
                            class="rounded-xl px-3 py-2 text-xs font-semibold text-white bg-gradient-to-r from-fuchsia-600 to-purple-600">
                        Rafraîchir
                    </button>
                </div>
            </div>

            {{-- (Optionnel) bloc debug en local --}}
            @env('local')
                <details class="rounded-2xl border border-white/10 bg-black/30 p-4">
                    <summary class="cursor-pointer text-sm font-semibold">Debug (local) – Query Params</summary>
                    <pre class="mt-3 text-xs text-violet-200/80 whitespace-pre-wrap">
{{ print_r(request()->query(), true) }}
                    </pre>
                </details>
            @endenv
        </div>
    </div>

    {{-- Si l'utilisateur est finalement logué côté contrôleur, on redirige directement --}}
    @auth
        <script>window.location.replace(@json(route('dashboard')));</script>
    @endauth

    {{-- Auto-rafraîchissement très léger, une seule fois, pour laisser le temps au webhook d'arriver --}}
    <script>
        (function () {
            if (!sessionStorage.getItem('product_access_autorefresh_done')) {
                sessionStorage.setItem('product_access_autorefresh_done', '1');
                setTimeout(function () { location.reload(); }, 4000);
            }
        })();
    </script>
</x-app-layout>
