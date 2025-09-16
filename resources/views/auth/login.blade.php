<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status
        class="mb-4 rounded-lg border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200"
        :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Login -->
        <div>
            <x-input-label for="login" :value="__('Login')" class="text-violet-200" />
            <div class="relative mt-2">
                <!-- icône -->
                <svg aria-hidden="true" class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-violet-300/70"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4.5 20.25a7.5 7.5 0 1115 0" />
                </svg>

                <x-text-input
                    id="login"
                    class="w-full pl-10 bg-black/40 border border-purple-400/30 text-violet-100 placeholder-violet-300/40
                           focus:border-fuchsia-500 focus:ring-2 focus:ring-fuchsia-500/50 rounded-xl"
                    type="text"
                    name="login"
                    :value="old('login')"
                    required
                    autofocus
                    autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('login')" class="mt-2 text-rose-400" />
        </div>

        <!-- Password -->
        <div x-data="{ show: false }">
            <x-input-label for="password" :value="__('Password')" class="text-violet-200" />
            <div class="relative mt-2">
                <!-- icône cadenas -->
                <svg aria-hidden="true" class="pointer-events-none absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-violet-300/70"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0V10.5M5.25 10.5h13.5A1.5 1.5 0 0120.25 12v7.5A1.5 1.5 0 0118.75 21H5.25A1.5 1.5 0 013.75 19.5V12a1.5 1.5 0 011.5-1.5z"/>
                </svg>

                <x-text-input
                    id="password"
                    x-ref="pwd"
                    class="w-full pl-10 pr-12 bg-black/40 border border-purple-400/30 text-violet-100 placeholder-violet-300/40
                           focus:border-fuchsia-500 focus:ring-2 focus:ring-fuchsia-500/50 rounded-xl"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password" />

                <!-- bouton afficher/masquer -->
                <button type="button"
                        @click="show = !show; $refs.pwd.type = show ? 'text' : 'password'"
                        aria-label="Afficher le mot de passe"
                        class="absolute right-3 top-1/2 -translate-y-1/2 rounded-md p-1.5
                               text-violet-300/70 hover:text-violet-100 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12zm9.75 3a3 3 0 100-6 3 3 0 000 6z" />
                    </svg>
                    <svg x-cloak x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 3l18 18M9.88 9.88A3 3 0 0114.12 14.12M6.228 6.228A10.477 10.477 0 0111.998 4.68c4.442 0 8.494 3.042 9.964 7.322a10.47 10.47 0 01-4.327 5.444M7.5 16.5a10.41 10.41 0 004.498 1.822" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-400" />
        </div>

        <!-- Remember + Forgot -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center gap-2 select-none">
                <input id="remember_me" type="checkbox"
                       class="rounded border-purple-400/30 bg-black/40 text-fuchsia-600 focus:ring-fuchsia-500/40"
                       name="remember">
                <span class="text-sm text-violet-300">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="rounded-md px-1 text-sm font-medium text-fuchsia-300 hover:text-fuchsia-200
                          focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Submit -->
        <x-primary-button
            class="w-full justify-center gap-2 rounded-xl border-0
                   bg-gradient-to-r from-fuchsia-600 to-purple-600
                   hover:from-fuchsia-500 hover:to-purple-500
                   focus:ring-2 focus:ring-fuchsia-500/50
                   shadow-lg shadow-fuchsia-900/20">
            <!-- icône entrée -->
            <svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 12H3m0 0l4-4m-4 4l4 4M21 19.5v-15A1.5 1.5 0 0019.5 3H12" />
            </svg>
            {{ __('Log in') }}
        </x-primary-button>
    </form>
</x-guest-layout>
