@extends('layouts.user')

@section('content')

<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Picnic Games - Game Categories</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#13ec13",
                        "background-light": "#f6f8f6",
                        "background-dark": "#102210",
                        "text-light": "#111811",
                        "text-dark": "#e3f3e3",
                        "subtle-light": "#618961",
                        "subtle-dark": "#8caa8c",
                        "border-light": "#dbe6db",
                        "border-dark": "#2a4b2a"
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
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24;
            font-size: 24px;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
    <div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <div class="px-4 sm:px-8 md:px-20 lg:px-40 flex flex-1 justify-center py-5">
                <div class="layout-content-container flex flex-col w-full max-w-5xl flex-1">
                    <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-border-light dark:border-border-dark px-6 md:px-10 py-4">
                        <div class="flex items-center gap-4">

                            <h2 class="text-text-light dark:text-text-dark text-xl font-bold leading-tight tracking-[-0.015em]">Picnic Games</h2>
                        </div>
                        <nav class="hidden md:flex flex-1 justify-end items-center gap-8">

                            <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-text-light text-sm font-bold leading-normal tracking-[0.015em] hover:opacity-90 transition-opacity">
                                <span class="truncate">Get Started</span>
                            </button>
                        </nav>
                        <button class="md:hidden text-text-light dark:text-text-dark">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                    </header>
                    <main class="flex-grow p-4 sm:p-6 md:p-10">
                        <div class="flex flex-wrap justify-between gap-4 mb-8">
                            <div class="flex min-w-72 flex-col gap-3">
                                <h1 class="text-text-light dark:text-text-dark text-4xl lg:text-5xl font-black leading-tight tracking-[-0.033em]">Find the Perfect Game for Your Picnic</h1>
                                <p class="text-subtle-light dark:text-subtle-dark text-base font-normal leading-normal">Select a category below to get started.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-10">
                            <a href="{{route('user.game')}}">
                                <button class="group flex flex-col items-center gap-2 rounded-lg p-3 transition-all border border-border-light dark:border-border-dark bg-white dark:bg-background-dark/50 hover:border-primary/50">
                                    <div class="flex size-14 items-center justify-center rounded-full bg-primary/10 text-primary">
                                        <span class="material-symbols-outlined !text-3xl">home</span>
                                    </div>
                                    <span class="text-text-light dark:text-text-dark text-sm font-medium leading-normal text-center">Indoor Games</span>
                                </button>
                            </a>
                            <a href="{{route('user.outdoorsGame')}}">
                                <button class="group flex flex-col items-center gap-2 rounded-lg p-3 transition-all border border-transparent hover:border-primary/50 hover:bg-white dark:hover:bg-background-dark/50">
                                    <div class="flex size-14 items-center justify-center rounded-full bg-primary/10 text-primary">
                                        <span class="material-symbols-outlined !text-3xl">sunny</span>
                                    </div>

                                    <span class="text-text-light dark:text-text-dark text-sm font-medium leading-normal text-center">
                                        Outdoor Games</span>
                                </button>
                            </a>
                            <a href="{{route('user.kidsGame')}}">
                                <button class="group flex flex-col items-center gap-2 rounded-lg p-3 transition-all border border-transparent hover:border-primary/50 hover:bg-white dark:hover:bg-background-dark/50">
                                    <div class="flex size-14 items-center justify-center rounded-full bg-primary/10 text-primary">
                                        <span class="material-symbols-outlined !text-3xl">child_care</span>
                                    </div>
                                    <span class="text-text-light dark:text-text-dark text-sm font-medium leading-normal text-center">Games for Kids</span>
                                </button>
                            </a>
                            <a href="{{route('user.malesGame')}}">
                                <button class="group flex flex-col items-center gap-2 rounded-lg p-3 transition-all border border-transparent hover:border-primary/50 hover:bg-white dark:hover:bg-background-dark/50">
                                    <div class="flex size-14 items-center justify-center rounded-full bg-primary/10 text-primary">
                                        <span class="material-symbols-outlined !text-3xl">man</span>
                                    </div>
                                    <span class="text-text-light dark:text-text-dark text-sm font-medium leading-normal text-center">Games for Males</span>
                                </button>
                            </a>
                            <a href="{{route('user.femalesGame')}}">
                                <button class="group flex flex-col items-center gap-2 rounded-lg p-3 transition-all border border-transparent hover:border-primary/50 hover:bg-white dark:hover:bg-background-dark/50">
                                    <div class="flex size-14 items-center justify-center rounded-full bg-primary/10 text-primary">
                                        <span class="material-symbols-outlined !text-3xl">woman</span>
                                    </div>
                                    <span class="text-text-light dark:text-text-dark text-sm font-medium leading-normal text-center">Games for Females</span>
                                </button>
                            </a>
                            <a href="{{route('user.familyGame')}}">
                                <button class="group flex flex-col items-center gap-2 rounded-lg p-3 transition-all border border-transparent hover:border-primary/50 hover:bg-white dark:hover:bg-background-dark/50">
                                    <div class="flex size-14 items-center justify-center rounded-full bg-primary/10 text-primary">
                                        <span class="material-symbols-outlined !text-3xl">family_restroom</span>
                                    </div>
                                    <span class="text-text-light dark:text-text-dark text-sm font-medium leading-normal text-center">Family Games</span>
                                </button>
                            </a>
                        </div>
                        <div class="mt-8" id="game-list">
                            <h2 class="text-2xl font-bold mb-6">Males Games</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div class="group flex flex-col overflow-hidden rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-background-dark/50 transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg">
                                    <div class="aspect-video overflow-hidden">
                                        <img alt="Frisbee Toss" class="h-full w-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDVACgcCWfuvqD88liNJR2TOB6y7Jopwl4U2i2FARDFj5BwolkS2uCDj8WAYWvYhyhQGaQzT1nFpMOmvukOfpLs5_yTLrjAt0fwXii4GgVIMV3vYl2niP7_NLWSY_Q0N_498p8tuCxjtmw_VlgkTA_-LwsF77yWRVffpcgVR02lVeQQWSImyQV87mBhm_UC-IpoR6ek2AawNG9Q2dj43TQ4J6E9vJGcxaS4qABuHaxwmRHmpreH6Vhnj3abdpqTW2QL6K8B-a2O1Y4" />
                                    </div>
                                    <div class="flex flex-col gap-4 p-5 flex-grow">
                                        <h3 class="text-lg font-bold">Frisbee Toss</h3>
                                        <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm text-subtle-light dark:text-subtle-dark">
                                            <div class="flex items-center gap-1.5">
                                                <span class="material-symbols-outlined !text-lg">timer</span>
                                                <span>15-30 min</span>
                                            </div>
                                            <div class="flex items-center gap-1.5">
                                                <span class="material-symbols-outlined !text-lg">signal_cellular_alt</span>
                                                <span>Easy</span>
                                            </div>
                                        </div>
                                        <button class="mt-auto flex w-full items-center justify-center rounded-lg h-10 px-4 bg-primary/10 text-primary text-sm font-bold leading-normal transition-colors hover:bg-primary hover:text-text-light">
                                            View Details
                                        </button>
                                    </div>
                                </div>
                                <div class="group flex flex-col overflow-hidden rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-background-dark/50 transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg">
                                    <div class="aspect-video overflow-hidden">
                                        <img alt="Water Balloon Fight" class="h-full w-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCfguk0njibgxV22reNGyuL2H1VaT71FbEsIzobHW4_9tG8xiwq9N9MQQGfaR_Jgwzw06GUvMRBjVgPwFC-oOyV6wku0VpX96H2PPypLDHQGdwGJ8g9lToyHVOn7IH8Cvoc8VgoL6SiN3MDre1OskICd4yE2JwcLYZ0fQC9_7XESPLrQcstAznbG_9hzg9bxiyzFhRPHpnbBya6852RQqdaWe74e5NtDZszzh_PlThSkZfLMo9pgYsXmjrvio-U2CbhohP0ssXsOk4" />
                                    </div>
                                    <div class="flex flex-col gap-4 p-5 flex-grow">
                                        <h3 class="text-lg font-bold">Water Balloon Fight</h3>
                                        <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm text-subtle-light dark:text-subtle-dark">
                                            <div class="flex items-center gap-1.5">
                                                <span class="material-symbols-outlined !text-lg">timer</span>
                                                <span>20 min</span>
                                            </div>
                                            <div class="flex items-center gap-1.5">
                                                <span class="material-symbols-outlined !text-lg">signal_cellular_alt</span>
                                                <span>Easy</span>
                                            </div>
                                        </div>
                                        <button class="mt-auto flex w-full items-center justify-center rounded-lg h-10 px-4 bg-primary/10 text-primary text-sm font-bold leading-normal transition-colors hover:bg-primary hover:text-text-light">
                                            View Details
                                        </button>
                                    </div>
                                </div>
                                <div class="group flex flex-col overflow-hidden rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-background-dark/50 transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg">
                                    <div class="aspect-video overflow-hidden">
                                        <img alt="Three-Legged Race" class="h-full w-full object-cover transition-transform duration-300 ease-in-out group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD9q9GIP047xp2v5OYesOuRBWmyjAOKxTEq4OjlKGnEKoJ4tGZLVs-n_1qCVk9p2089X85OmTGnVwzzR2JISmIaJvBHLZfafYgiSh9zdjetXUCiwUgO6hs0S6iFxtbkGvE5OVh1mxJzdzbv6L87Uel25S3SQYDieAMaxNtB681i2J7i537hQrlQx8ZdhtGON1JE0lvGhzYe2Z626sz-MrkUealoycPmWSY1trveEaiWAmMslDBmy6aWGQioXsEBwmB1N2NUmQSxRzc" />
                                    </div>
                                    <div class="flex flex-col gap-4 p-5 flex-grow">
                                        <h3 class="text-lg font-bold">Three-Legged Race</h3>
                                        <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm text-subtle-light dark:text-subtle-dark">
                                            <div class="flex items-center gap-1.5">
                                                <span class="material-symbols-outlined !text-lg">timer</span>
                                                <span>10-20 min</span>
                                            </div>
                                            <div class="flex items-center gap-1.5">
                                                <span class="material-symbols-outlined !text-lg">signal_cellular_alt</span>
                                                <span>Medium</span>
                                            </div>
                                        </div>
                                        <button class="mt-auto flex w-full items-center justify-center rounded-lg h-10 px-4 bg-primary/10 text-primary text-sm font-bold leading-normal transition-colors hover:bg-primary hover:text-text-light">
                                            View Details
                                        </button>
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

</html>


@endsection