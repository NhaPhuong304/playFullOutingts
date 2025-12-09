<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>PlayFullOutings - Your Guide to Outdoor Fun</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="{{ asset('user/js/layout.js') }}"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#13ec13",
                        "background-light": "#f6f8f6",
                        "background-dark": "#102210",
                        "text-light": "#111811",
                        "text-dark": "#e0f2e0",
                        "card-light": "#ffffff",
                        "card-dark": "#1a381a",
                        "border-light": "#e0f2e0",
                        "border-dark": "#2a502a"
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
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }

        .dropdown-menu {
            position: absolute;
            transform: translateX(-50%);
            opacity: 0;
            pointer-events: none;
            transition: opacity .2s ease;
            z-index: 50;
        }

        .dropdown-open {
            opacity: 1 !important;
            pointer-events: auto !important;
        }

        #games-menu {
            top: 100%;
            left: 100%;
            width: 180px;
            margin-top: 8px;
        }

        #avatar-menu {
            top: 100%;
            left: 100%;
            margin-top: 8px;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
    <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
        <header class="sticky top-0 z-50">
            <nav class="bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md border-b border-border-light dark:border-border-dark">
                <div class="flex items-center justify-between mx-auto max-w-7xl py-3 h-auto">


                    <div class="flex flex-col items-start pl-0 ml-0 leading-tight">
                        <a href="#" class="flex items-center">
                            <img src="{{ asset('user/images/logouser.png') }}"
                                alt="Logo"
                                class="w-20 h-20 object-contain">
                        </a>

                        <div class="text-sm font-bold text-text-light dark:text-text-dark mt-0">
                           <span>{{ number_format(\DB::table('visits')->first()->counter ?? 0) }} visits</span>
                        </div>
                    </div>


                    <div class="hidden md:flex flex-1 justify-center">
                        <ul class="flex items-center gap-x-6 lg:gap-x-8 text-sm font-medium">
                            <li><a class="text-primary" href="{{url('user/dashboard')}}">Home</a></li>

                            <!-- Games Dropdown -->
                            <li class="relative nav-item">
                                <button id="games-button"
                                    class="flex items-center gap-1 hover:text-primary transition-colors">
                                    <a href="{{route('user.game')}}#picnic-title">Games</a>
                                    <span class="material-symbols-outlined text-base">expand_more</span>
                                </button>

                                <div id="games-menu"
                                    class="dropdown-menu absolute left-0 mt-3 w-56 bg-card-light dark:bg-card-dark rounded-lg shadow-xl py-2 border border-border-light dark:border-border-dark">
                                    <a class="block px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary" href="{{route('user.indoorGame')}}#picnic-title">Indoor Games</a>
                                    <a class="block px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary" href="{{route('user.outdoorsGame')}}#picnic-title">Outdoor Games</a>
                                    <a class="block px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary" href="{{route('user.kidsGame')}}#picnic-title">Kids Games</a>
                                    <a class="block px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary" href="{{route('user.malesGame')}}#picnic-title">Male Games</a>
                                    <a class="block px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary" href="{{route('user.femalesGame')}}#picnic-title">Female Games</a>
                                    <a class="block px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary" href="{{route('user.familyGame')}}#picnic-title">Family Games</a>
                                </div>
                            </li>
                            <li><a class="hover:text-primary transition-colors" href="{{ route('user.blog.index') }}">Blogs</a></li>
                            <li><a class="hover:text-primary transition-colors" href="{{route('admin.dashboard')}}">DashBoard</a></li>
                            <li><a class="hover:text-primary transition-colors" href="{{url('user/itinerary')}}">Itinerary</a></li>
                            <li><a class="hover:text-primary transition-colors" href="{{url('user/aboutus')}}">About Us</a></li>
                            <li><a class="hover:text-primary transition-colors" href="{{url('user/contact')}}">Contact Us</a></li>
                        </ul>
                    </div>

                    <div id="header-right" class="flex items-center gap-2">

                        {{-- HIỆN NÚT REGISTER + LOGIN KHI CHƯA LOGIN --}}
                        @if(!Auth::check() || Auth::user() == null)
                        <div id="auth-buttons" class="flex items-center gap-3">
                            <a href="{{ url('register') }}"
                                class="px-4 py-2 rounded-lg bg-primary text-white font-medium hover:bg-primary/90 transition">
                                Đăng ký
                            </a>
                            <a href="{{ url('login') }}"
                                class="px-4 py-2 rounded-lg bg-primary/10 text-primary border border-primary hover:bg-primary/20 transition font-medium">
                                Đăng nhập
                            </a>
                        </div>
                        @endif


                        {{-- HIỆN AVATAR KHI ĐÃ LOGIN --}}
                        @if(Auth::check() && Auth::user() != null)
                        <div id="avatar-dropdown" class="relative">
                            <button id="avatar-button"
                                class="flex items-center justify-center size-12 rounded-full hover:bg-black/5 dark:hover:bg-white/5 transition-colors">
                                <img alt="User avatar" class="w-10 h-10 rounded-full object-cover"
                                    src="{{ Auth::user()->avatar ?? 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}">
                            </button>

                            <div id="avatar-menu"
                                class="dropdown-menu absolute right-0 mt-3 w-56 bg-card-light dark:bg-card-dark rounded-lg shadow-xl py-2 border border-border-light dark:border-border-dark">
                                <a class="flex items-center gap-3 px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary transition"
                                    href="#">
                                    <span class="material-symbols-outlined text-base">account_circle</span>
                                    {{ Auth::user()->name }}
                                </a>
                                <form action="{{ url('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center gap-3 px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary transition w-full text-left">
                                        <span class="material-symbols-outlined text-base">logout</span>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endif

                    </div>



                    <button class="md:hidden text-text-light dark:text-text-dark">
                        <span class="material-symbols-outlined text-2xl" data-icon="menu"></span>
                    </button>
                </div>
            </nav>

        </header>
        <main class="flex-1">

            @yield('content')
        </main>
        <footer class="bg-card-dark text-text-dark">
            <div class="flex justify-center py-10 px-4 sm:px-8 lg:px-10">
                <div class="w-full max-w-7xl">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="text-primary text-2xl">
                                    <span class="material-symbols-outlined" data-icon="nature_people"></span>
                                </div>
                                <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">PlayFullOutings</h2>
                            </div>
                            <p class="text-sm text-text-dark/70">Creating joyful moments, one picnic at a time.</p>
                        </div>
                        <div>
                            <h3 class="font-bold mb-4">Quick Links</h3>
                            <ul class="space-y-2 text-sm">
                                <li><a class="text-text-dark/70 hover:text-primary transition-colors" href="#">Games</a></li>
                                <li><a class="text-text-dark/70 hover:text-primary transition-colors" href="#">Itineraries</a></li>
                                <li><a class="text-text-dark/70 hover:text-primary transition-colors" href="#">About Us</a></li>
                                <li><a class="text-text-dark/70 hover:text-primary transition-colors" href="#">Contact</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-bold mb-4">Follow Us</h3>
                            <div class="flex space-x-4">
                                <a class="text-text-dark/70 hover:text-primary transition-colors" data-alt="Facebook icon" href="#">
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
                                    </svg>
                                </a>
                                <a class="text-text-dark/70 hover:text-primary transition-colors" data-alt="Instagram icon" href="#">
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.85s-.011 3.584-.069 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07s-3.584-.012-4.85-.07c-3.252-.148-4.771-1.691-4.919-4.919-.058-1.265-.069-1.645-.069-4.85s.011-3.584.069-4.85c.149-3.225 1.664-4.771 4.919-4.919 1.266-.057 1.644-.069 4.85-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948s.014 3.667.072 4.947c.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072s3.667-.014 4.947-.072c4.358-.2 6.78-2.618 6.98-6.98.059-1.281.073-1.689.073-4.948s-.014-3.667-.072-4.947c-.2-4.358-2.618-6.78-6.98-6.98-1.281-.059-1.689-.073-4.948-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.162 6.162 6.162 6.162-2.759 6.162-6.162-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4 4 1.79 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44 1.441-.645 1.441-1.44-.645-1.44-1.441-1.44z"></path>
                                    </svg>
                                </a>
                                <a class="text-text-dark/70 hover:text-primary transition-colors" data-alt="Twitter icon" href="#">
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616v.064c0 2.298 1.634 4.212 3.793 4.649-.65.177-1.354.23-2.06.088.607 1.882 2.368 3.256 4.456 3.293-2.078 1.624-4.697 2.586-7.552 2.586-.492 0-.977-.028-1.455-.086 2.684 1.723 5.875 2.73 9.342 2.73 11.21 0 17.348-9.282 17.348-17.345 0-.265-.006-.528-.018-.79A12.394 12.394 0 0 0 24 4.557z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Google Map Section -->
                    <div class="mt-8 mb-6">
                        <h3 class="font-bold mb-4 text-lg">Our Location</h3>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31352.01839768961!2d106.64146637431641!3d10.811135099999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752934c609c5bd%3A0x751f71739b98ebc4!2zQXB0ZWNoIENvbXB1dGVyIEVkdWNhdGlvbiAtIEjhu4cgdGjhu5FuZyDEkMOgbyB04bqhbyBM4bqtcCB0csOsbmggdmnDqm4gUXXhu5FjIHThur8gQXB0ZWNo!5e0!3m2!1svi!2s!4v1764916133942!5m2!1svi!2s" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-lg"></iframe>
                    </div>
                    <div class="border-t border-border-dark mt-8 pt-6 text-center text-sm text-text-dark/50">
                        <p>© 2024 PlayFullOutings. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>
    @include('layouts.user.chat-widget')

</body>

</html>