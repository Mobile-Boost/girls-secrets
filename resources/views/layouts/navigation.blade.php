<nav x-data="{ open: false, scrolled:false }"
     @scroll.window="scrolled = window.scrollY > 10"
     :class="scrolled ? 'backdrop-blur supports-[backdrop-filter]:bg-white/5 ring-1 ring-white/10' : 'bg-transparent'"
     class="border-b border-transparent">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-full bg-white/5 px-3 py-1.5 ring-1 ring-white/10 hover:shadow-lg hover:shadow-fuchsia-900/20">
                        <span class="hidden sm:inline font-semibold text-transparent bg-clip-text bg-gradient-to-r from-fuchsia-400 via-purple-400 to-violet-300">
                            Girls‑IA
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex items-center gap-6">
                    <a href="{{ route('dashboard') }}"
                       class="text-sm font-medium text-violet-200 hover:text-white {{ request()->routeIs('dashboard') ? 'underline underline-offset-4 decoration-fuchsia-500/60' : '' }}">
                        Dashboard
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md
                                       text-violet-200 bg-white/5 ring-1 ring-white/10 hover:bg-white/10 focus:outline-none">
                            <div class="ms-1">
                                <svg class="h-4 w-4 text-violet-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.188l3.71-3.957a.75.75 0 111.1 1.02l-4.25 4.53a.75.75 0 01-1.1 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-violet-200 hover:text-white hover:bg-white/10 focus:outline-none focus:bg-white/10 focus:text-white transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 8h16M4 16h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-white/10 bg-white/5 backdrop-blur">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}"
               class="block px-4 py-2 text-sm font-medium text-violet-200 hover:text-white hover:bg-white/10 {{ request()->routeIs('dashboard') ? 'bg-white/10' : '' }}">
                Dashboard
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-white/10">
            <div class="px-4">
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="block px-4 py-2 text-sm font-medium text-violet-200 hover:text-white hover:bg-white/10">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
