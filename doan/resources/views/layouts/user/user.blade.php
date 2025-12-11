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

        #navbar.default {
            background-color: rgba(255, 255, 255, 1) !important;
        }

        #navbar.scrolled {
            background-color: rgba(255, 255, 255, 0.25) !important;
            backdrop-filter: blur(18px) !important;
            -webkit-backdrop-filter: blur(18px) !important;
            border-bottom: none !important;
        }

        html.dark #navbar.scrolled {
            background-color: rgba(0, 0, 0, 0.25) !important;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
    <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
        <header class="fixed top-0 left-0 w-full z-50">
            <nav id="navbar" class="fixed top-0 w-full z-50 bg-white">
                <div class="flex items-center justify-between mx-auto max-w-7xl py-3 h-auto">


                    <div class="flex flex-col items-start pl-0 ml-0 leading-tight">
                        <a href="#" class="flex items-center">
                            <img src="{{ asset('user/images/logouser.png') }}"
                                alt="Logo"
                                class="w-20 h-20 object-contain">
                        </a>
                        <!-- cd  -->

                        <div class="text-sm font-bold text-text-light dark:text-text-dark mt-0">


                            <span>{{ number_format(\DB::table('visits')->first()->counter ?? 0) }} visits</span>

                        </div>
                    </div>


                    <div class="hidden md:flex flex-1 justify-center">
                        <ul class="flex items-center gap-x-6 lg:gap-x-8 text-sm font-medium">
                            <li>
                                <a href="{{ url('user/dashboard') }}"
                                    class="{{ Request::is('user/dashboard*') ? 'text-primary' : 'hover:text-primary' }}">
                                    Home
                                </a>
                            </li>


                            <!-- Games Dropdown -->
                            <li class="relative nav-item">
                                <button id="games-button"
                                    class="flex items-center gap-1 {{ Request::is('user/game*') ? 'text-primary' : 'hover:text-primary' }}">
                                    <a href="{{route('user.game')}}">Games</a>
                                    <span class="material-symbols-outlined text-base">expand_more</span>
                                </button>


                                <div id="games-menu"
                                    class="dropdown-menu absolute left-0 mt-3 w-56 bg-card-light dark:bg-card-dark rounded-lg shadow-xl py-2 border border-border-light dark:border-border-dark">

                                    @foreach ($categoriesList as $cat)
                                    <a class="block px-4 py-2 text-sm 
                                            {{ $category && $category->id == $cat->id ? 'bg-primary/20 text-primary font-bold' : '' }} 
                                            hover:bg-primary/10 hover:text-primary"
                                        href="{{ route('games.category', $cat->id) }}#picnic-title">
                                        {{ $cat->name }}
                                    </a>
                                    @endforeach


                                </div>

                            </li>
                            <li>
                                <a href="{{ route('user_shop') }}"
                                    class="{{ Route::currentRouteNamed('user_shop') ? 'text-primary' : 'hover:text-primary' }}">
                                    Shop
                                </a>
                            </li>
                            <a href="{{ route('user.blog.index') }}"
                                class="{{ Route::currentRouteNamed('user.blog.*') ? 'text-primary' : 'hover:text-primary' }}">
                                Blogs
                            </a>
                            </li>


                            <li>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="{{ Request::is('admin/dashboard') ? 'text-primary' : 'hover:text-primary' }}">
                                    DashBoard
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('user/itinerary') }}"
                                    class="{{ Request::is('user/itinerary') ? 'text-primary' : 'hover:text-primary' }}">
                                    Itinerary
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('user/aboutus') }}"
                                    class="{{ Request::is('user/aboutus') ? 'text-primary' : 'hover:text-primary' }}">
                                    About Us
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('user/contact') }}"
                                    class="{{ Request::is('user/contact') ? 'text-primary' : 'hover:text-primary' }}">
                                    Contact Us
                                </a>
                            </li>

                        </ul>
                    </div>

                    <div id="header-right" class="flex items-center gap-2">
                        {{-- CART ICON --}}
                        <a id="cart-icon" href="{{ route('cart_user') }}"
                            class="relative flex items-center justify-center w-12 h-12 rounded-full hover:bg-black/5 dark:hover:bg-white/5 transition">


                            <span class="material-symbols-outlined text-[28px]">
                                shopping_cart
                            </span>

                            @auth
                            @php
                            $cartCount = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity');
                            @endphp

                            @if($cartCount > 0)
                            <span id="cart-count-badge" class="absolute -top-1 -right-1 bg-primary text-white text-[12px] font-bold
w-5 h-5 flex items-center justify-center rounded-full shadow">
                                {{ $cartCount }}
                            </span>

                            @endif
                            @endauth
                        </a>

                        {{-- HIỆN NÚT REGISTER + LOGIN KHI CHƯA LOGIN --}}
                        @if(!Auth::check() || Auth::user() == null)
                        <div id="auth-buttons" class="flex items-center gap-3">
                            <a href="{{ url('register') }}"
                                class="px-4 py-2 rounded-lg bg-primary text-white font-medium hover:bg-primary/90 transition">
                                Sign up
                            </a>
                            <a href="{{ url('login') }}"
                                class="px-4 py-2 rounded-lg bg-primary/10 text-primary border border-primary hover:bg-primary/20 transition font-medium">
                                Sign in
                            </a>
                        </div>
                        @endif


                        @if(Auth::check() && Auth::user() != null)
                        <div id="avatar-dropdown" class="relative">
                            <button id="avatar-button"
                                class="flex items-center justify-center size-12 rounded-full hover:bg-black/5 dark:hover:bg-white/5 transition-colors">
                                <img id="avatarPreview"
                                    class="w-12 h-12 rounded-full object-cover"
                                    src="{{ Auth::user()->photo ? asset('storage/avatars/' . Auth::user()->photo) : asset('storage/avatars/no-image.jpg') }}"
                                    alt="{{ Auth::user()->name }}">
                            </button>

                            <div id="avatar-menu"
                                class="dropdown-menu absolute right-0 mt-3 w-56 bg-card-light dark:bg-card-dark rounded-lg shadow-xl py-2 border border-border-light dark:border-border-dark">
                                <a class="flex items-center gap-3 px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary transition nav-link"
                                    href="{{ route('user.profile') }}">
                                    <span class="material-symbols-outlined text-base">account_circle</span>
                                    {{ Auth::user()->name }}
                                </a>
                                <form action="{{ url('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center gap-3 px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary transition w-full text-left nav-link">
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

        <main class="flex-1 mt-[120px]">


            @yield('content')
        </main>
        <footer class="bg-card-dark text-text-dark">
            <div class="flex justify-center py-6 px-4 sm:px-8 lg:px-10">
                <div class="w-full max-w-7xl">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                        <div class="md:col-span-2">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="text-primary text-2xl">
                                    <span class="material-symbols-outlined" data-icon="nature_people"></span>
                                </div>
                                <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center">
                                    <img src="{{ asset('user/images/logouser.png') }}"
                                        class="w-14 h-14 object-contain rounded-full">
                                </div>
                                <!-- <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">PlayFullOutings</h2> -->
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
                    <div class="mt-6 mb-4">
                        <h3 class="font-bold mb-4 text-lg">Our Location</h3>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31352.01839768961!2d106.64146637431641!3d10.811135099999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752934c609c5bd%3A0x751f71739b98ebc4!2zQXB0ZWNoIENvbXB1dGVyIEVkdWNhdGlvbiAtIEjhu4cgdGjhu5FuZyDEkMOgbyB04bqhbyBM4bqtcCB0csOsbmggdmnDqm4gUXXhu5FjIHThur8gQXB0ZWNo!5e0!3m2!1svi!2s!4v1764916133942!5m2!1svi!2s" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-lg"></iframe>
                    </div>
                    <!-- <div class="border-t border-border-dark mt-8 pt-6 text-center text-sm text-text-dark/50">
                        <p>© 2024 PlayFullOutings. All rights reserved.</p>
                    </div> -->
                </div>
            </div>
        </footer>
    </div>
    </div>
    <div id="zaloModal"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 transition">
    
    <div class="bg-white w-80 p-5 rounded-xl shadow-xl">
        <h2 class="text-lg font-bold mb-3">Chat with us on Zalo</h2>

        <textarea id="zaloMessage"
            class="w-full border border-gray-300 rounded-lg p-2 h-24"
            placeholder="Enter your message..."></textarea>

        <div class="flex justify-end gap-2 mt-3">
            <button id="closeZaloModal"
                class="px-3 py-1 rounded-lg bg-gray-300 hover:bg-gray-400">Close</button>

            <button id="sendZaloMessage"
                class="px-3 py-1 rounded-lg bg-primary text-white hover:bg-primary/90">Send</button>
        </div>
    </div>

</div>



    @include('layouts.user.chat-widget')
    <script>
        window.addEventListener("scroll", function() {
            const header = document.getElementById("main-header");

            if (window.scrollY > 50) {
                header.classList.remove("header-transparent");
                header.classList.remove("absolute");
                header.classList.add("sticky");
                header.classList.add("header-scrolled");
            } else {
                header.classList.add("absolute");
                header.classList.add("header-transparent");
                header.classList.remove("sticky");
                header.classList.remove("header-scrolled");
            }
        });

        window.dispatchEvent(new Event("scroll"));

        function showToast(message, isError = false) {
            const toast = document.createElement("div");
            toast.className = `
            fixed left-1/2 top-20 -translate-x-1/2 z-[500] 
            px-6 py-3 rounded-xl shadow-lg opacity-0 pointer-events-none 
            transition-all duration-500 font-semibold 
        `;
            toast.style.backgroundColor = isError ? "#dc2626" : "#10b981";
            toast.style.color = "white";
            toast.textContent = message;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.opacity = "1";
                toast.style.transform = "translate(-50%, -50%) scale(1.05)";
            }, 10);

            setTimeout(() => {
                toast.style.opacity = "0";
                toast.style.transform = "translate(-50%, -50%) scale(0.9)";
            }, 1800);

            setTimeout(() => toast.remove(), 2400);
        }

        function updateHeaderCartBadge(total) {
            let badge = document.querySelector("#cart-count-badge");
            const cartIcon = document.querySelector("#cart-icon");

            if (!cartIcon) return;

            if (!badge) {
                badge = document.createElement("span");
                badge.id = "cart-count-badge";
                badge.className =
                    "absolute -top-1 -right-1 bg-primary text-white text-[12px] font-bold w-5 h-5 flex items-center justify-center rounded-full shadow";
                cartIcon.appendChild(badge);
            }

            badge.textContent = total;
        }
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".add-to-cart-btn").forEach(btn => {
                btn.addEventListener("click", function(e) {
                    e.preventDefault();

                    let form = this.closest("form");
                    let formData = new FormData(form);
                    let productCard = this.closest(".product-card") ?? this.closest(".rounded-xl");
                    let stock = parseInt(productCard.dataset.stock);
                    let quantity = parseInt(form.querySelector('[name="quantity"]').value);


                    if (quantity > stock) {
                        showToast("⚠ Insufficient stock. Remaining: " + stock, true);
                        return;
                    }

                    fetch("{{ route('cart.add') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": form.querySelector('input[name="_token"]').value,
                                "X-Requested-With": "XMLHttpRequest",
                            },
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            console.log("ADD CART RESPONSE:", data);

                            // ❗Case: Stock không đủ từ server
                            if (data.error === "not_enough_stock") {
                                showToast("⚠ Insufficient stock. Remaining: " + data.available, true);
                                return;
                            }

                            // ✔ Thành công
                            if (data.success) {
                                showToast("Added to cart ✔");
                                updateHeaderCartBadge(data.total);
                            }

                            // ❗Chưa đăng nhập
                            else if (data.error === "unauthenticated") {
                                window.location.href = "{{ url('login') }}";
                            }

                        })
                        .catch(err => console.error(err));
                });
            });
        });
    </script>


    <style>
        @keyframes fade {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade {
            animation: fade .3s ease-out;
        }
    </style>

    <script>
        document.addEventListener("scroll", function() {
            const navbar = document.getElementById("navbar");
            if (window.scrollY > 50) {
                navbar.classList.remove("default");
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.add("default");
                navbar.classList.remove("scrolled");
            }
        });
document.addEventListener("DOMContentLoaded", () => {

    const avatarBtn = document.getElementById("avatar-button");
    const avatarMenu = document.getElementById("avatar-menu");

    if (avatarBtn && avatarMenu) {
        avatarBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            avatarMenu.classList.toggle("dropdown-open");
        });

        // Click ra ngoài để đóng
        document.addEventListener("click", () => {
            avatarMenu.classList.remove("dropdown-open");
        });
    }
});
document.addEventListener("DOMContentLoaded", () => {

    const backToTopBtn = document.getElementById("backToTopBtn");

    // 🟢 Hiện nút khi scroll xuống 200px
    window.addEventListener("scroll", () => {
        if (window.scrollY > 200) {
            backToTopBtn.classList.remove("hidden");
            backToTopBtn.classList.add("flex");
        } else {
            backToTopBtn.classList.add("hidden");
            backToTopBtn.classList.remove("flex");
        }
    });

    // 🟢 Cuộn lên đầu trang khi click
    backToTopBtn.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });

});
    </script>
<button id="backToTopBtn"
    class="hidden fixed bottom-6 left-6 z-50 
           w-12 h-12 rounded-full bg-primary text-white shadow-lg 
           hover:bg-primary/90 transition-all flex items-center justify-center">
    <span class="material-symbols-outlined text-[28px]">arrow_upward</span>
</button>

<div class="fixed bottom-24 right-6 flex flex-col gap-3 z-[60]">

    <!-- MESSENGER -->
    <a href="https://m.me/playfulloutings" target="_blank"
       class="w-12 h-12 bg-[#0084FF] rounded-full shadow-lg flex items-center justify-center hover:scale-110 transition">
        <span class="material-symbols-outlined text-white text-[28px]">chat</span>
    </a>

    <!-- ZALO BUTTON -->
    <button id="openZaloChat"
        class="w-12 h-12 rounded-full bg-blue-500 text-white flex items-center justify-center shadow-lg hover:scale-110 transition">
        <img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Icon_of_Zalo.svg" class="w-7 h-7">
    </button>

</div>

<script>
document.getElementById("openZaloChat").addEventListener("click", () => {
    document.getElementById("zaloModal").classList.remove("hidden");
    document.getElementById("zaloModal").classList.add("flex");
});

document.getElementById("closeZaloModal").addEventListener("click", () => {
    document.getElementById("zaloModal").classList.add("hidden");
    document.getElementById("zaloModal").classList.remove("flex");
});

document.getElementById("sendZaloMessage").addEventListener("click", () => {
    let msg = document.getElementById("zaloMessage").value.trim();

    if (msg === "") {
        alert("Please enter a message!");
        return;
    }

    // ✔ Sau khi gửi xong → đóng modal
    const modal = document.getElementById("zaloModal");
    modal.classList.add("hidden");
    modal.classList.remove("flex");

    // ✔ Xóa nội dung tin nhắn
    document.getElementById("zaloMessage").value = "";

    // (Nếu cần) show thông báo nhỏ
    alert("Message sent!");
});
</script>
</body>

</html>