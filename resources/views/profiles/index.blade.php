<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-white">
            {{ __('Tous les profils') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-2xl bg-white/5 backdrop-blur border border-purple-500/20">
                <div class="p-6 text-violet-200">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($profiles as $profile)
                            <a href="{{ route('profiles.show', $profile) }}" class="block">
                                <div class="bg-white/5 border border-purple-500/20 rounded-xl overflow-hidden hover:shadow-xl hover:shadow-fuchsia-900/10 transition">
                                    @if(isset($profile->photos[0]))
                                        <img src="{{ $profile->photos[0] }}" alt="{{ $profile->name }}" class="w-full aspect-[4/3] object-cover">
                                    @else
                                        <div class="w-full aspect-[4/3] bg-gradient-to-br from-purple-900 to-fuchsia-900 grid place-items-center">
                                            <span class="text-white/70">Pas de photo</span>
                                        </div>
                                    @endif
                                    <div class="p-4">
                                        <h4 class="font-semibold text-lg">{{ $profile->name }}</h4>
                                        @if($profile->description)
                                            <p class="text-violet-200/80 text-sm mt-1">{{ Str::limit($profile->description, 64) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>