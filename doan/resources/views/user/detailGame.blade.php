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
                            <span class="text-text-light-primary dark:text-text-dark-primary text-sm font-medium leading-normal">Spoon Race</span>
                        </div>
                        <div class="flex flex-wrap justify-between gap-3 mb-6">
                            <h1 class="text-text-light-primary dark:text-text-dark-primary text-4xl lg:text-5xl font-black leading-tight tracking-[-0.033em] min-w-72">Spoon Race Challenge</h1>
                        </div>
                        <div class="mb-10">
                            <div class="relative flex items-center justify-center bg-gray-900 bg-cover bg-center aspect-video rounded-xl" data-alt="A group of people happily playing the spoon race game in a sunny park." style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAbKU3ru4N0LvlWSorW_ARKhdGN2miitrtDWYc5qX8tF-gWNY-SXV9MkqjlNEiynv509ev6USCSHu8FhkHV8GgGLJoDG2xlvK94YgGxf6fSYBQWuHzIk5pQ0qbMTMLYn0HPcAdJSiqBBHQlGw2dLCeWgmRRF7eiLdoGU6lWy6WsblRuoOhACtAcqKpVH0zuJJxKTrir9hxrT2-cTdYgF5BT72Pz43s3yjr_AD7zN0L8o9_kTNfrhL1mwHFB16Q88ccAC3hDISGebIQ");'>
                                <button class="flex shrink-0 items-center justify-center rounded-full size-16 bg-black/50 text-white hover:bg-black/70 transition-colors">
                                    <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">play_arrow</span>
                                </button>
                                <div class="absolute inset-x-0 bottom-0 px-4 py-3">
                                    <div class="flex h-4 items-center justify-center">
                                        <div class="h-1 flex-1 rounded-full bg-white"></div>
                                        <div class="relative">
                                            <div class="absolute -left-2 -top-2 size-4 rounded-full bg-white"></div>
                                        </div>
                                        <div class="h-1 flex-1 rounded-full bg-white opacity-40"></div>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <p class="text-white text-xs font-medium leading-normal tracking-[0.015em]">0:37</p>
                                        <p class="text-white text-xs font-medium leading-normal tracking-[0.015em]">2:23</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-8 text-text-light-secondary dark:text-text-dark-secondary">
                            <div>
                                <h2 class="text-text-light-primary dark:text-text-dark-primary text-2xl font-bold leading-tight tracking-[-0.015em] pb-3 border-b border-gray-200 dark:border-gray-700 mb-4">Required Materials</h2>
                                <ul class="list-disc list-inside space-y-2">
                                    <li>Spoons (one per player)</li>
                                    <li>Eggs or small potatoes (one per player)</li>
                                    <li>Cones or markers for start and finish lines</li>
                                </ul>
                            </div>
                            <div>
                                <h2 class="text-text-light-primary dark:text-text-dark-primary text-2xl font-bold leading-tight tracking-[-0.015em] pb-3 border-b border-gray-200 dark:border-gray-700 mb-4">Game Setup</h2>
                                <ol class="list-decimal list-inside space-y-2">
                                    <li>Set up a start line and a finish line about 20-30 feet apart.</li>
                                    <li>If playing in teams, have players form equal lines behind the start line.</li>
                                    <li>Give each player at the front of the line a spoon and an egg.</li>
                                </ol>
                            </div>
                            <div>
                                <h2 class="text-text-light-primary dark:text-text-dark-primary text-2xl font-bold leading-tight tracking-[-0.015em] pb-3 border-b border-gray-200 dark:border-gray-700 mb-4">Rules &amp; Instructions</h2>
                                <ol class="list-decimal list-inside space-y-2">
                                    <li>Players must balance the egg on their spoon.</li>
                                    <li>On "Go!", the first player from each team walks or runs to the finish line and back.</li>
                                    <li>They must not touch the egg with their hands. If the egg drops, they must pick it up, return to the start line, and begin again.</li>
                                    <li>Once a player returns, they pass the spoon and egg to the next person in their line.</li>
                                    <li>The first team to have all its players complete the race wins.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- Action Sidebar (Right Column) -->
                    <aside class="w-full lg:w-1/3 lg:sticky lg:top-12 h-fit">
                        <div class="bg-sidebar-light dark:bg-sidebar-dark p-6 lg:p-8 rounded-xl space-y-6">
                            <div>
                                <h3 class="text-text-light-primary dark:text-text-dark-primary font-bold text-xl mb-2">About The Game</h3>
                                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm leading-relaxed">A classic test of balance and speed! Players race while balancing an egg on a spoon, making for hilarious and suspenseful fun for all ages.</p>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-accent text-3xl">groups</span>
                                    <div>
                                        <p class="text-text-light-secondary dark:text-text-dark-secondary text-xs">Players</p>
                                        <p class="text-text-light-primary dark:text-text-dark-primary font-bold">4 - 10 Players</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="material-symbols-outlined text-accent text-3xl">timer</span>
                                    <div>
                                        <p class="text-text-light-secondary dark:text-text-dark-secondary text-xs">Estimated Time</p>
                                        <p class="text-text-light-primary dark:text-text-dark-primary font-bold">15 - 20 mins</p>
                                    </div>
                                </div>
                            </div>
                            <div class="border-t border-gray-300 dark:border-gray-600 pt-6">
                                <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm mb-4">Want to take these instructions with you? Download our handy printable guide.</p>
                                <button class="w-full flex items-center justify-center gap-2 cursor-pointer rounded-lg h-12 px-4 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-green-600 transition-colors">
                                    <span class="material-symbols-outlined">download</span>
                                    <span class="truncate">Download Printable Guide</span>
                                </button>
                            </div>
                        </div>
                    </aside>
                </div>
            </main>
        </div>
    </div>
</body>

</html>

@endsection