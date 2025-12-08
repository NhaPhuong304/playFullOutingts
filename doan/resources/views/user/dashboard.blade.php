@extends('layouts.user.user')

@section('content')

<div x-data="slider()" class="relative h-96 md:h-[65vh] overflow-hidden">

    <!-- Banner Images -->
    <template x-for="(banner, index) in banners" :key="index">
        <img
            x-show="current === index"
            x-transition.opacity.duration.700ms
            :src="banner"
            class="absolute inset-0 w-full h-full object-cover object-center select-none pointer-events-none"
            alt="banner">
    </template>

    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/10 to-black/40 pointer-events-none"></div>

    <!-- Prev -->
    <button @click="prev()"
        class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-3 rounded-full">
        ❮
    </button>

    <!-- Next -->
    <button @click="next()"
        class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-3 rounded-full">
        ❯
    </button>

</div>
<div class="flex justify-center py-5 px-4 sm:px-8 lg:px-10">
    <div class="flex flex-col w-full max-w-7xl">
        <section class="@container py-10 md:py-16 -mt-32 md:-mt-40 relative z-10">
            <div class="flex flex-col gap-6 items-center text-center bg-background-light dark:bg-background-dark p-6 md:p-10 rounded-xl shadow-lg">
                <div class="flex flex-col gap-2">
                    <h1 class="text-text-light dark:text-text-dark text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl @[480px]:font-black @[480px]:leading-tight @[480px]:tracking-[-0.033em]">Unleash the Fun on Your Next Picnic</h1>
                    <h2 class="text-text-light/80 dark:text-text-dark/80 text-sm font-normal leading-normal @[480px]:text-base @[480px]:font-normal @[480px]:leading-normal max-w-xl mx-auto">Your ultimate guide to outdoor games and easy-to-plan adventures.</h2>

                </div>
                <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 @[480px]:h-12 @[480px]:px-5 bg-primary text-text-light text-sm font-bold leading-normal tracking-[0.015em] @[480px]:text-base @[480px]:font-bold @[480px]:leading-normal @[480px]:tracking-[0.015em] hover:opacity-90 transition-opacity">
                    <span class="truncate">Explore Games</span>
                </button>
            </div>
        </section>
        <section class="py-12 md:py-20">
            <h2 class="text-text-light dark:text-text-dark text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-5 pt-5 text-center md:text-3xl">
                Find the Perfect Game
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4">

                @foreach ($categories as $cat)
                @foreach ($cat->limited_games as $game)

                <a href="{{ route('user.detailGame', $game->slug) }}#detail"
                    class="relative rounded-xl overflow-hidden aspect-[4/3] group block">

                    {{-- Background Image --}}
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-300 group-hover:scale-110"
                        style='background-image:
                        linear-gradient(0deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0) 100%),
                        url("{{ asset($game->image) }}")'>
                    </div>

                    {{-- Game Name --}}
                    <div class="absolute bottom-3 left-3 right-3">
                        <p class="text-white text-base font-bold leading-tight drop-shadow-md">
                            {{ $cat->name }} - {{ $game->name }}
                        </p>
                    </div>

                </a>

                @endforeach
                @endforeach

            </div>

        </section>

        <section class="py-12 md:py-20">
            <h2 class="text-text-light dark:text-text-dark text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-5 pt-5 text-center md:text-3xl">
                Get Inspired for Your Next Outing
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-4">

                @foreach ($itineraries as $item)
                <div class="bg-card-light dark:bg-card-dark rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow">

                    @php
                    $firstLocation = $item->locations->first();
                    $imageUrl = $firstLocation ? $firstLocation->image : 'https://via.placeholder.com/600x400?text=No+Image';
                    @endphp

                    <img class="w-full h-56 object-cover"
                        src="{{ $imageUrl }}"
                        alt="{{ $item->name }}">

                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">{{ $item->name }}</h3>

                        <p class="text-text-light/80 dark:text-text-dark/80 mb-4">
                            {{ Str::limit($item->description, 120) }}
                        </p>

                        <a class="text-primary font-bold hover:underline" href="#">
                            View Itinerary
                        </a>
                    </div>

                </div>
                @endforeach

            </div>
        </section>


    </div>
</div>
@endsection