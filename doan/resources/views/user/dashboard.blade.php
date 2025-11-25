@extends('layouts.user')

@section('content')
    <h2>Welcome, {{ auth()->user()->name }}</h2>
    <!DOCTYPE html>
<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>PlayFullOutings - Your Guide to Outdoor Fun</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
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
        .group .submenu {
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        .group:hover .submenu {
            display: block;
            opacity: 1;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-text-light dark:text-text-dark">
<div class="relative flex min-h-screen w-full flex-col group/design-root overflow-x-hidden">
<div class="layout-container flex h-full grow flex-col">
<header class="sticky top-0 z-50">
<div class="relative bg-cover bg-center h-48 md:h-64 flex items-start justify-center pt-4" style='background-image: linear-gradient(rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.4) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuD82ok08EdTP1FG4vzfNPedeQwPJxmtF5EbEwVIFhB9xRAqOM1QMZ6Nq5tN0boLDNp3WMrz_WWYNpw1RAj5kxNOUVZR-ONIw8GNVW1v1D2Ovahbugy_w5dpfA2z_BzmljHFw8OtEb7z24O48fRU9QFUt1h9xZ3Z4Zqb-uEGdZB6cXjuaqCegFgvJhNEEB2sAj07WgkmtNYgy6yDVGMJDAtUB7FmLm8T6f8EhIg7HnD_CpmxUrSDXr8bi380UI5zYFNYFleSt7I56DQ");'>
<div class="flex items-center gap-4 text-white bg-black/30 backdrop-blur-sm p-3 rounded-xl">
<div class="text-primary text-3xl">
<span class="material-symbols-outlined" data-icon="nature_people"></span>
</div>
<div class="flex flex-col">
<h2 class="text-xl font-bold leading-tight tracking-[-0.015em]">PlayFullOutings</h2>
<div class="flex items-center gap-1.5 text-xs font-medium">
<span class="material-symbols-outlined text-sm" data-icon="visibility"></span>
<span>1,234,567 visits</span>
</div>
</div>
</div>
</div>
<nav class="bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md border-b border-border-light dark:border-border-dark">
<div class="flex items-center justify-between mx-auto max-w-7xl px-4 sm:px-8 lg:px-10 h-16">
<div class="flex-1 items-center justify-start hidden md:flex">
<ul class="flex items-center gap-x-6 lg:gap-x-8 text-sm font-medium">
<li><a class="text-primary" href="#">Home</a></li>
<li class="relative group">
<a class="hover:text-primary transition-colors flex items-center gap-1" href="#">Games <span class="material-symbols-outlined text-base">expand_more</span></a>
<div class="submenu absolute left-0 mt-4 w-56 bg-card-light dark:bg-card-dark rounded-md shadow-lg py-2 border border-border-light dark:border-border-dark">
<a class="block px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary transition-colors" href="#">Indoor Games</a>
<a class="block px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary transition-colors" href="#">Outdoor Games</a>
<a class="block px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary transition-colors" href="#">Kids Games</a>
<a class="block px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary transition-colors" href="#">Male Games</a>
<a class="block px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary transition-colors" href="#">Female Games</a>
<a class="block px-4 py-2 text-sm hover:bg-primary/10 hover:text-primary transition-colors" href="#">Family Games</a>
</div>
</li>
<li><a class="hover:text-primary transition-colors" href="#">Itinerary</a></li>
<li><a class="hover:text-primary transition-colors" href="#">About Us</a></li>
<li><a class="hover:text-primary transition-colors" href="#">Contact Us</a></li>
</ul>
</div>
<button class="md:hidden text-text-light dark:text-text-dark">
<span class="material-symbols-outlined text-2xl" data-icon="menu"></span>
</button>
</div>
</nav>
</header>
<main class="flex-1">
<div class="flex justify-center py-5 px-4 sm:px-8 lg:px-10">
<div class="flex flex-col w-full max-w-7xl">
<section class="@container py-10 md:py-16">
<div class="flex flex-col gap-6 items-center text-center">
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
<h2 class="text-text-light dark:text-text-dark text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-5 pt-5 text-center md:text-3xl">Find the Perfect Game</h2>
<div class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-4 p-4">
<div class="bg-cover bg-center flex flex-col gap-3 rounded-xl justify-end p-4 aspect-[4/3] group overflow-hidden" data-alt="Kids laughing and playing together in a circle." style='background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuDwqarePJ5zafNB6ZCYPCx8QCcSE9ro4yVc0bMwGKBUmgKnNZr3ngwtcFiwzSONyiCx8pMy8Y2y0HlhCbK-2mWsLL8gR3d1p1j9lZQY7q8-GdMhp-920NPlQ6g1PMHOtK9pdtKjIoXnX4OvUor1ylik97PPG0LhV9x9Erdcqc8wnYNgL7VW6KF-zygntHbLZWMJC1NXjWog6dhUVywLOfoPeJy6EdIPFBYxQ2Ny2SEzPR-u7ual0p1VbZATzDiPn2siQxMQzw5aYLI");'>
<p class="text-white text-base font-bold leading-tight w-4/5 line-clamp-2 translate-y-10 group-hover:translate-y-0 transition-transform duration-300">For Kids</p>
</div>
<div class="bg-cover bg-center flex flex-col gap-3 rounded-xl justify-end p-4 aspect-[4/3] group overflow-hidden" data-alt="People playing frisbee in an open field." style='background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuDBfAbNU8ujJf1Nbm7l8p1ep5NbCN7RkTSGk-c8o0cLGPg_k9RqCIrH0wOFr9VUAoFAs3ROBdYkR55l1Z8vBBSPWNml8sshe5R74MN3V7k6hBpnO-OuhamzlCeX8oxyvReUR7RtGwkiJZmljPqI3r2bMc-x3338K9C_hgaaAbC_BywgDMzNnxo662aDQ3PH27TcBL3A-lzVe4ZaubncsL8aBSJNYfvk3WIvukmodQmIl4W8z9M1b8tG2irYNGfTNzJVlOvUYJkyPjA");'>
<p class="text-white text-base font-bold leading-tight w-4/5 line-clamp-2 translate-y-10 group-hover:translate-y-0 transition-transform duration-300">Active &amp; Energetic</p>
</div>
<div class="bg-cover bg-center flex flex-col gap-3 rounded-xl justify-end p-4 aspect-[4/3] group overflow-hidden" data-alt="Friends sitting on a picnic blanket playing cards." style='background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuBmRMKFCztN8i_8dcaSyLDSdotfQvYs7OvRFwItLQcc26k5UqtkUQLW1Mc8W2xqyIFxa_VRgTkg2WhrynUkyzKlqloecVSdhGF20Aq39oa5Ppy0qO39j5_xxHVPCtPQ-e-z2weS7FWZKYT0hGU3724qhAtsM-6pq4KaZU2NY_fxLOryeHS7lP-rZyTBUgIAz9Ok_4jjBrdU1wIoKrikL5Irzu1ppdNFZ9pUGYgNIynq3vuPqjIc6U8sMiWnlGHsf_CB2owm1aAAagE");'>
<p class="text-white text-base font-bold leading-tight w-4/5 line-clamp-2 translate-y-10 group-hover:translate-y-0 transition-transform duration-300">Relaxed &amp; Casual</p>
</div>
</div>
</section>
<section class="py-12 md:py-20 bg-background-light dark:bg-card-dark rounded-xl">
<div class="px-4">
<h2 class="text-text-light dark:text-text-dark text-[22px] font-bold leading-tight tracking-[-0.015em] pb-8 text-center md:text-3xl">Planning Your Fun is Easy</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
<div class="flex flex-col items-center gap-4">
<div class="flex items-center justify-center size-16 bg-primary/20 rounded-full text-primary">
<span class="material-symbols-outlined text-4xl" data-icon="search"></span>
</div>
<h3 class="text-lg font-bold">1. Browse Games</h3>
<p class="text-sm text-text-light/80 dark:text-text-dark/80">Explore our curated list of games for every occasion and group size.</p>
</div>
<div class="flex flex-col items-center gap-4">
<div class="flex items-center justify-center size-16 bg-primary/20 rounded-full text-primary">
<span class="material-symbols-outlined text-4xl" data-icon="map"></span>
</div>
<h3 class="text-lg font-bold">2. Plan an Outing</h3>
<p class="text-sm text-text-light/80 dark:text-text-dark/80">Get inspired by our simple itineraries for the perfect day out.</p>
</div>
<div class="flex flex-col items-center gap-4">
<div class="flex items-center justify-center size-16 bg-primary/20 rounded-full text-primary">
<span class="material-symbols-outlined text-4xl" data-icon="celebration"></span>
</div>
<h3 class="text-lg font-bold">3. Have Fun!</h3>
<p class="text-sm text-text-light/80 dark:text-text-dark/80">Gather your friends and family and make unforgettable memories.</p>
</div>
</div>
</div>
</section>
<section class="py-12 md:py-20">
<h2 class="text-text-light dark:text-text-dark text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-5 pt-5 text-center md:text-3xl">Get Inspired for Your Next Outing</h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-4">
<div class="bg-card-light dark:bg-card-dark rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow">
<img class="w-full h-56 object-cover" data-alt="A beautiful sandy beach with turquoise water and waves crashing." src="https://lh3.googleusercontent.com/aida-public/AB6AXuA8pBBnKMDmsEY_DRQ_wi1QNma9jS9anjAOxs-cKgamHidqOPXAmJ-9TTRgg50vToSTOGtTUZ4ouz628IeN0O0etRSFKPsEvCOGStGX43wmRHSyhHBxj3ciWUIAWLV8SQUvfYivgXyWVcok7p1vFgPrhQTt3sOEKnDdMIU30uTQbvUm2ElJtLwHJ5oTjjDkhVonA_SDTmPQz3qr_eu88Slv9FIojhkVyuV2BBG5URmGwpdB8bNOSTqcPnsQnFKcWt60zvLpItunHgk"/>
<div class="p-6">
<h3 class="text-xl font-bold mb-2">Beach Day Bonanza</h3>
<p class="text-text-light/80 dark:text-text-dark/80 mb-4">A perfect plan for a sun-soaked day with sandcastle contests, beach volleyball, and a delicious picnic by the waves.</p>
<a class="text-primary font-bold hover:underline" href="#">View Itinerary</a>
</div>
</div>
<div class="bg-card-light dark:bg-card-dark rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow">
<img class="w-full h-56 object-cover" data-alt="A sunlit forest path with tall green trees and lush foliage." src="https://lh3.googleusercontent.com/aida-public/AB6AXuA8ahfFoUeeSiWYMUmlngC66M67VJzOsvdUtCtLE0mgZETz-d9jtNK_Z_TjriLMZhQMaqyJgNVr-pXFWnFMfxcBMloEUo8m7U8FyNQ981vJtOosqCU2r-lKehy2e6NfuWObsp1t4oqvgZbTKOcFHHZUAzlWhc_Ab5j4vuNFmg8leWC62OaWTJj5Eh1oqnaYpmmAMcJdBTPcgMGiTuoSxUWCqq1CBHZz-Np8VcSYU8pCk8ekKMYdKvidsXRPc51DivRf0uK18tWoMb0"/>
<div class="p-6">
<h3 class="text-xl font-bold mb-2">A Lakeside Picnic &amp; Hike</h3>
<p class="text-text-light/80 dark:text-text-dark/80 mb-4">Combine a scenic forest hike with a relaxing picnic by a serene lake. Includes trail suggestions and game ideas for the woods.</p>
<a class="text-primary font-bold hover:underline" href="#">View Itinerary</a>
</div>
</div>
</div>
</section>
</div>
</div>
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
<div class="border-t border-border-dark mt-8 pt-6 text-center text-sm text-text-dark/50">
<p>© 2024 PlayFullOutings. All rights reserved.</p>
</div>
</div>
</div>
</footer>
</div>
</div>

</body></html>
@endsection
