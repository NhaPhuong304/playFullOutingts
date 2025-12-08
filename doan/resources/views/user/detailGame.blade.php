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
    <div class="relative flex min-h-screen flex-col overflow-x-hidden">
        <div class="layout-container flex flex-col grow">
            <main class="flex-1 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
                
                <!-- Breadcrumbs -->
                <nav class="flex flex-wrap gap-2 mb-6 text-sm text-text-light-secondary dark:text-text-dark-secondary">
                    <a href="{{ url('user/dashboard') }}" class="hover:text-primary">Home</a>
                    <span>/</span>
                    <a href="{{ url('user/game') }}" class="hover:text-primary">Games</a>
                    <span>/</span>
                    <span class="text-text-light-primary dark:text-text-dark-primary">{{ $game->name }}</span>
                </nav>

                <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">

                    <!-- Main Content -->
                    <div class="w-full lg:w-2/3 space-y-8">

                        <!-- Game Title -->
                        <h1 class="text-4xl lg:text-5xl font-black text-text-light-primary dark:text-text-dark-primary leading-tight">
                            {{ $game->name }}
                        </h1>

                        <!-- Game Banner / Video -->
                        <div class="relative aspect-video rounded-xl overflow-hidden">
                            @if($game->video_url)
                                <iframe class="w-full h-full rounded-xl" src="{{ $game->video_url }}" frameborder="0" allowfullscreen></iframe>
                            @else
                                <img src="{{ $game->image }}" alt="{{ $game->name }}" class="w-full h-full object-cover">
                            @endif
                        </div>


                        <!-- Sections -->
                        <div class="space-y-8 text-text-light-secondary dark:text-text-dark-secondary">

                            <!-- Materials -->
                            <div>
                                <h2 class="text-2xl font-bold text-text-light-primary dark:text-text-dark-primary border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                                    Required Materials
                                </h2>
                                <ul class="list-disc list-inside space-y-2">
                                    @foreach(explode(',', $game->materials ?? '') as $material)
                                        <li>{{ $material }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Setup -->
                            <div>
                                <h2 class="text-2xl font-bold text-text-light-primary dark:text-text-dark-primary border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                                    Game Setup
                                </h2>
                                <ol class="list-decimal list-inside space-y-2">
                                    @foreach(explode("\n", $game->setup ?? '') as $step)
                                        <li>{{ $step }}</li>
                                    @endforeach
                                </ol>
                            </div>

                            <!-- Rules -->
                            <div>
                                <h2 class="text-2xl font-bold text-text-light-primary dark:text-text-dark-primary border-b border-gray-200 dark:border-gray-700 pb-2 mb-4">
                                    Rules & Instructions
                                </h2>
                                <ol class="list-decimal list-inside space-y-2">
                                    @foreach(explode("\n", $game->instructions ?? '') as $rule)
                                        <li>{{ $rule }}</li>
                                    @endforeach
                                </ol>
                            </div>

                        </div>
                    </div>

                    <!-- Sidebar -->
                    <aside class="w-full lg:w-1/3 lg:sticky lg:top-12 space-y-6">
                        <div class="bg-sidebar-light dark:bg-sidebar-dark p-6 lg:p-8 rounded-xl space-y-6">

                            <!-- About -->
                            <div>
                                <h3 class="text-xl font-bold text-text-light-primary dark:text-text-dark-primary mb-2">About The Game</h3>
                                <p class="text-sm text-text-light-secondary dark:text-text-dark-secondary leading-relaxed">
                                    {{ $game->description ?? 'No description available.' }}
                                </p>
                            </div>

                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-accent text-3xl">groups</span>
                                    <div>
                                        <p class="text-xs">Players</p>
                                        <p class="font-bold text-text-light-primary dark:text-text-dark-primary">{{ $game->players ?? 'N/A' }}</p>
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

                </div>
            </main>
        </div>
    </div>
</body>


</html>

@endsection