@extends('layouts.user.user')

@section('content')

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Picnic Playbook - Game Details</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#4CAF50",
                        "background-light": "#FFFFFF",
                        "background-dark": "#102210",
                        "sidebar-light": "#F5F5DC",
                        "sidebar-dark": "#2a3b2a",
                        "text-light-primary": "#333333",
                        "text-light-secondary": "#555555",
                        "text-dark-primary": "#E0E0E0",
                        "text-dark-secondary": "#BDBDBD",
                        "accent": "#FFC107"
                    },
                    fontFamily: {
                        "display": ["Be Vietnam Pro", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
</head>

<body class="font-display bg-background-light dark:bg-background-dark">

    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <main id="detail" class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
                <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
                    <!-- Main Content (Left Column) -->
                     
                    <div class="w-full lg:w-2/3">
                        <div class="flex flex-wrap gap-2 mb-6">
                            <a class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal hover:text-primary" href="{{url('user/dashboard')}}">Home</a>
                            <span class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">/</span>
                            <a class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal hover:text-primary" href="{{url('user/game')}}">Games</a>
                            <span class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium leading-normal">/</span>
                            <span class="text-text-light-primary dark:text-text-dark-primary text-sm font-medium leading-normal">{{$game->name}}</span>
                        </div>
                        <div class="flex flex-wrap justify-between gap-3 mb-6">
                            <h1 class="text-text-light-primary dark:text-text-dark-primary text-4xl lg:text-5xl font-black leading-tight tracking-[-0.033em] min-w-72">{{$game->name}}</h1>
                        </div>

                        <div class="mb-10">
                            @php
                                $video = $game->video_url ?? '';

                                if ($video) {
                                // Nếu là dạng watch?v=
                                if (str_contains($video, "watch?v=")) {
                                    $video = str_replace("watch?v=", "embed/", $video);
                                }

                                // Nếu là dạng youtu.be/xxxx
                                if (str_contains($video, "youtu.be/")) {
                                    $videoId = explode("youtu.be/", $video)[1];
                                    $video = "https://www.youtube.com/embed/" . $videoId;
                                }

                                // Nếu là shorts
                                if (str_contains($video, "shorts/")) {
                                    $videoId = explode("shorts/", $video)[1];
                                    $videoId = explode("?", $videoId)[0];
                                    $video = "https://www.youtube.com/embed/" . $videoId;
                                }

                                // Nếu là youtube.com/live
                                if (str_contains($video, "youtube.com/live/")) {
                                    $videoId = explode("live/", $video)[1];
                                    $videoId = explode("?", $videoId)[0];
                                    $video = "https://www.youtube.com/embed/" . $videoId;
                                }
                                }
                                @endphp

                            @if($video)
                            <div class="mb-10">
                                <iframe class="w-full aspect-video rounded-xl"
                                        src="{{ $video }}"
                                        allowfullscreen>
                                </iframe>
                            </div>
                            @endif

                        </div>

                        <div class="space-y-8 text-text-light-secondary dark:text-text-dark-secondary">
                            <div>
                                <h2 class="text-text-light-primary dark:text-text-dark-primary text-2xl font-bold leading-tight tracking-[-0.015em] pb-3 border-b border-gray-200 dark:border-gray-700 mb-4">Required Materials</h2>
                                <ul class="list-disc list-inside space-y-2">
                                    @foreach($game->materials as $material)
                                        <li>{{ $material->name }}</li>
                                    @endforeach
                                </ul>

                            </div>
                            <div>
                                <h2 class="text-text-light-primary dark:text-text-dark-primary text-2xl font-bold leading-tight tracking-[-0.015em] pb-3 border-b border-gray-200 dark:border-gray-700 mb-4">Game Setup</h2>
                                <ol class="list-decimal list-inside space-y-2">
                                    <li>{{$game->game_setup}}</li>
                                </ol>
                            </div>
                            <div>
                                <h2 class="text-text-light-primary dark:text-text-dark-primary text-2xl font-bold leading-tight tracking-[-0.015em] pb-3 border-b border-gray-200 dark:border-gray-700 mb-4">Rules &amp; Instructions</h2>
                                <ol class="list-decimal list-inside space-y-2">
                                    <li>{{$game->game_rules}}</li>
                                    <li>{{$game->instructions}}</li>
                                    
                                </ol>
                            </div>
                            
                        </div>
                    </div>
                    <!-- Action Sidebar (Right Column) -->
                    <aside class="w-full lg:w-1/3 lg:sticky lg:top-12 h-fit">
                        <div class="bg-sidebar-light dark:bg-sidebar-dark p-6 lg:p-8 rounded-xl space-y-6">
                            <div>
                                <h3 class="text-text-light-primary dark:text-text-dark-primary font-bold text-xl mb-2">About The Game</h3>
                                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm leading-relaxed">{{$game->description}}</p>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-accent text-3xl">groups</span>
                                    <div>

                                        <p class="text-text-light-secondary dark:text-text-dark-secondary text-xs">Players</p>
                                        <p class="text-text-light-primary dark:text-text-dark-primary font-bold">{{$game->players}}</p>

                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-accent text-3xl">timer</span>
                                    <div>
                                        <p class="text-xs">Estimated Time</p>
                                        <p class="font-bold text-text-light-primary dark:text-text-dark-primary">{{ $game->duration ?? 'N/A' }} mins</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-accent text-3xl">signal_cellular_alt</span>
                                    <div>
                                        <p class="text-xs">Difficulty</p>
                                        <p class="font-bold text-text-light-primary dark:text-text-dark-primary">{{ $game->level ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Download -->
                            @if($game->download_file)
                            <div class="border-t border-gray-300 dark:border-gray-600 pt-6">
                                <p class="text-sm text-text-light-secondary dark:text-text-dark-secondary mb-4">
                                    Download our printable guide:
                                </p>
                                <a href="{{ asset($game->download_file) }}" target="_blank" 
                                   class="w-full flex items-center justify-center gap-2 rounded-lg h-12 px-4 bg-primary text-white font-bold hover:bg-green-600 transition-colors">
                                    <span class="material-symbols-outlined">download</span>
                                    <span class="truncate">Download Guide</span>
                                </a>
                            </div>
                            @endif

                        </div>
                    </aside>

                                        <p class="text-text-light-secondary dark:text-text-dark-secondary text-xs">Estimated Time</p>
                                        <p class="text-text-light-primary dark:text-text-dark-primary font-bold">{{$game->duration}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="border-t border-gray-300 dark:border-gray-600 pt-6">
                                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm mb-4">
                                    Want to take these instructions with you? Download our handy printable guide.
                                </p>

                                @if($game->download_file)
                                    <a href="{{ asset('storage/games/files/' . $game->download_file) }}" 
                                    download
                                    class="w-full flex items-center justify-center gap-2 cursor-pointer rounded-lg h-12 px-4 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-green-600 transition-colors">
                                        Download Guide
                                    </a>
                                @else
                                    <div class="w-full h-12 flex items-center justify-center rounded-lg px-4 bg-gray-400 text-white text-base font-bold">
                                        No Guide Available
                                    </div>
                                @endif
                            </div>

                        </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>

@endsection