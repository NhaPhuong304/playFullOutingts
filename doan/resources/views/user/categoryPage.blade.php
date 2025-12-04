@extends('layouts.user.user')

@section('content')

<div class="px-4 sm:px-8 md:px-20 lg:px-40 py-10">

    @php
        $icons = [
            'Indoor Games'   => 'home',
            'Outdoor Games'  => 'sunny',
            'Kids Games'     => 'child_care',
            'Male Games'     => 'man',
            'Female Games'   => 'woman',
            'Family Games'   => 'family_restroom',
        ];
    @endphp

    <h1 class="text-4xl lg:text-5xl font-black text-text-light dark:text-text-dark mb-6">
        Find the Perfect Game for Your Picnic
    </h1>
    <p class="text-subtle-light dark:text-subtle-dark mb-10">
        Select a category below to get started.
    </p>

    {{-- CATEGORY FILTER LIST --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-12">

        @foreach ($categoriesList as $cat)
        <a href="{{ route('games.category', $cat->id) }}">
            <button class="group flex flex-col items-center gap-2 rounded-lg p-3 border 
                           {{ $category->id == $cat->id ? 'border-primary bg-primary/10' : 'border-transparent' }}
                           hover:border-primary/50 hover:bg-white dark:hover:bg-background-dark/50 transition-all">

                <div class="flex size-14 items-center justify-center rounded-full 
                            {{ $category->id == $cat->id ? 'bg-primary text-white' : 'bg-primary/10 text-primary' }}">
                    <span class="material-symbols-outlined !text-3xl">
                        {{ $icons[$cat->name] ?? 'sports_esports' }}
                    </span>
                </div>

                <span class="text-sm font-medium text-center text-text-light dark:text-text-dark">
                    {{ $cat->name }}
                </span>
            </button>
        </a>
        @endforeach
    </div>

    {{-- GAME LIST OF THIS CATEGORY --}}
    <h2 class="text-2xl font-bold mb-6">
        {{ $category->name }}
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach($games as $game)
        <div
            class="group flex flex-col overflow-hidden rounded-xl border border-border-light dark:border-border-dark
                   bg-white dark:bg-background-dark/50 hover:shadow-lg hover:scale-105 transition-all duration-300">

            {{-- IMAGE --}}
            <div class="aspect-video overflow-hidden">
                <img
                    src="{{ asset('storage/games/images/' . ($game->image ?? 'no-image.jpg')) }}"
                    alt="{{ $game->name }}"
                    class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-110" />
            </div>

            {{-- CONTENT --}}
            <div class="flex flex-col gap-4 p-5 flex-grow">

                <h3 class="text-lg font-bold text-text-light dark:text-text-dark">
                    {{ $game->name }}
                </h3>

                <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm text-subtle-light dark:text-subtle-dark">
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined !text-lg">timer</span>
                        <span>{{ $game->duration ?? 'N/A' }} min</span>
                    </div>

                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined !text-lg">signal_cellular_alt</span>
                        <span>{{ $game->difficulty }}</span>
                    </div>
                </div>

                <a href="{{ route('games.detail', $game->id) }}#detail"
                    class="mt-auto flex justify-center items-center h-10 rounded-lg
                           bg-primary/10 text-primary text-sm font-bold hover:bg-primary hover:text-white transition">
                    View Details
                </a>
            </div>
        </div>
        @endforeach

    </div>

</div>

@endsection
