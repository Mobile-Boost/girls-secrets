<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $profile->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-2xl bg-white/5 backdrop-blur border border-purple-500/20">
                <div class="p-6 text-violet-200">
                    <div class="flex items-start justify-between mb-4">
                        <h1 class="text-3xl font-bold text-white">{{ $profile->name }}</h1>
                        <a href="{{ route('profiles.index') }}" class="inline-flex items-center rounded-lg px-3 py-2 text-sm font-semibold text-gray-700 ring-1 ring-gray-300 hover:bg-gray-100">
                            Fermer
                        </a>
                    </div>
                    
                    
                    @if($profile->description)
                        <p class="text-lg text-violet-200/80 mb-6">{{ $profile->description }}</p>
                    @endif

                    @php
                        $photos = $profile->photos ?? [];
                        $count = isset($unlockedPhotos) ? max(0, (int) $unlockedPhotos) : count($photos);
                        $hasLocked = $count < count($photos);
                    @endphp

                    @if($hasLocked)
                        <div class="mb-4 rounded-xl ring-1 ring-fuchsia-500/40 bg-black/60 p-4 text-white">
                            @if(isset($todayUnlock) && $todayUnlock)
                                Une nouvelle photo est disponible aujourd’hui 🎉
                            @elseif(isset($lastUnlockDate) && isset($daysUntilNext))
                                Vous avez débloqué une photo le {{ $lastUnlockDate }}. Revenez dans {{ $daysUntilNext }} jour{{ $daysUntilNext > 1 ? 's' : '' }} pour en débloquer une nouvelle.
                            @else
                                Revenez bientôt pour débloquer une nouvelle photo.
                            @endif
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach(array_slice($photos, 0, $count) as $photo)
                            <button type="button" class="group relative w-full rounded-lg overflow-hidden photo-trigger" data-full="{{ $photo }}">
                                <img src="{{ $photo }}" alt="{{ $profile->name }}" class="w-full h-full object-cover">
                                <div class="pointer-events-none absolute inset-0 opacity-0 group-hover:opacity-100 transition bg-black/20"></div>
                            </button>
                        @endforeach
                    </div>

                    <!-- Modal viewer -->
                    <div id="photoModal" class="hidden fixed inset-0 z-50 bg-black/70 p-4">
                        <div class="mx-auto max-w-5xl h-full grid place-items-center">
                            <div class="relative w-full">
                                <img id="photoModalImg" src="" alt="{{ $profile->name }}" class="w-full rounded-lg shadow-2xl">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>