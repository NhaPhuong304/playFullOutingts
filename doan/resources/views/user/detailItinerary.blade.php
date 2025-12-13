@extends('layouts.user.user')

@section('content')

<body class="bg-background-light dark:bg-background-dark font-display text-charcoal dark:text-off-white">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <div class="flex flex-1 justify-center">
                <div class="layout-content-container flex flex-col w-full">

                    <main class="flex-grow">
                        <div class="px-4 sm:px-10 py-5 pb-16">
                            <div class="mx-auto max-w-7xl">

                                {{-- Breadcrumb --}}
                                <div class="mt-10 mb-8">
                                    <div class="flex flex-wrap gap-2 p-4 bg-white/40 dark:bg-white/10 
                                                backdrop-blur-md rounded-xl border border-border-light/40 
                                                dark:border-white/10 shadow-sm">
                                        <a class="text-primary font-medium hover:underline" href="#">
                                            Itineraries
                                        </a>

                                        <span class="text-charcoal/50 dark:text-off-white/50">/</span>

                                        <span class="text-charcoal dark:text-off-white font-semibold">
                                            {{ $itinerary->name }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Cover Image --}}
                                <div class="w-full h-[480px] rounded-2xl overflow-hidden shadow-xl">
                                    <img class="w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                                        src="{{ $itinerary->image 
                                            ? asset('storage/itineraries/' . $itinerary->image) 
                                            : asset('storage/avatars/no-image.jpg') }}">
                                </div>

                                <div class="mt-10 max-w-4xl mx-auto">

                                    {{-- Title --}}
                                    <h1 class="text-4xl sm:text-5xl font-black leading-tight">
                                        {{ $itinerary->name }}
                                    </h1>

                                    {{-- Description --}}
                                    <div class="mt-10 prose prose-lg dark:prose-invert max-w-none leading-relaxed">
                                        <p>{{ $itinerary->description }}</p>

                                        <h2 class="text-3xl font-bold text-center mt-16 mb-10">
                                            SUGGESTED LOCATIONS
                                        </h2>

@php
    // ✔ Chia cột an toàn tránh lỗi foreach(null)
    $locations = $locations ?? collect();

    $chunks = $locations->chunk(ceil(max($locations->count(), 1) / 2));
    $leftColumn  = $chunks->get(0) ?? collect();
    $rightColumn = $chunks->get(1) ?? collect();
@endphp

<div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

    {{-- LEFT COLUMN --}}
    <div class="space-y-6">
        @foreach($leftColumn as $location)
            <a href="{{ route('user.location.detail', $location->id) }}"
               class="group flex items-center gap-4 p-4 rounded-2xl shadow-md bg-white dark:bg-white/10 
                      border border-border-light/40 dark:border-white/10 
                      hover:scale-[1.03] hover:shadow-xl transition-all duration-300 cursor-pointer">

                <img src="{{ $location->image 
                    ? asset('storage/locations/' . $location->image) 
                    : asset('storage/avatars/no-image.jpg') }}"
                    class="w-24 h-24 object-cover rounded-xl" />

                <div class="flex-1">
                    <h3 class="text-lg font-semibold">{{ $location->name }}</h3>
                    <p class="text-sm opacity-60 line-clamp-2">
                        {{ $location->description }}
                    </p>
                </div>

                <span class="material-symbols-outlined text-primary opacity-0 group-hover:opacity-100 transition">
                    arrow_forward
                </span>
            </a>
        @endforeach
    </div>

    {{-- RIGHT COLUMN --}}
    <div class="space-y-6">
        @foreach($rightColumn as $location)
            <a href="{{ route('user.location.detail', $location->id) }}"
               class="group flex items-center gap-4 p-4 rounded-2xl shadow-md bg-white dark:bg-white/10 
                      border border-border-light/40 dark:border-white/10 
                      hover:scale-[1.03] hover:shadow-xl transition-all duration-300 cursor-pointer">

                <img src="{{ $location->image 
                    ? asset('storage/locations/' . $location->image) 
                    : asset('storage/avatars/no-image.jpg') }}"
                    class="w-24 h-24 object-cover rounded-xl" />

                <div class="flex-1">
                    <h3 class="text-lg font-semibold">{{ $location->name }}</h3>
                    <p class="text-sm opacity-60 line-clamp-2">
                        {{ $location->description }}
                    </p>
                </div>

                <span class="material-symbols-outlined text-primary opacity-0 group-hover:opacity-100 transition">
                    arrow_forward
                </span>
            </a>
        @endforeach
    </div>

</div> {{-- END GRID --}}

                                    </div>
                                </div>

                            </div>
                        </div>
                    </main>

                </div>
            </div>
        </div>
    </div>
</body>

@endsection
