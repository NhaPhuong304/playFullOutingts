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
                                    <img class="w-full h-56 object-cover" data-alt="A beautiful sandy beach with turquoise water and waves crashing." src="https://lh3.googleusercontent.com/aida-public/AB6AXuA8pBBnKMDmsEY_DRQ_wi1QNma9jS9anjAOxs-cKgamHidqOPXAmJ-9TTRgg50vToSTOGtTUZ4ouz628IeN0O0etRSFKPsEvCOGStGX43wmRHSyhHBxj3ciWUIAWLV8SQUvfYivgXyWVcok7p1vFgPrhQTt3sOEKnDdMIU30uTQbvUm2ElJtLwHJ5oTjjDkhVonA_SDTmPQz3qr_eu88Slv9FIojhkVyuV2BBG5URmGwpdB8bNOSTqcPnsQnFKcWt60zvLpItunHgk" />
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold mb-2">Beach Day Bonanza</h3>
                                        <p class="text-text-light/80 dark:text-text-dark/80 mb-4">A perfect plan for a sun-soaked day with sandcastle contests, beach volleyball, and a delicious picnic by the waves.</p>
                                        <a class="text-primary font-bold hover:underline" href="#">View Itinerary</a>
                                    </div>
                                </div>
                                <div class="bg-card-light dark:bg-card-dark rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow">
                                    <img class="w-full h-56 object-cover" data-alt="A sunlit forest path with tall green trees and lush foliage." src="https://lh3.googleusercontent.com/aida-public/AB6AXuA8ahfFoUeeSiWYMUmlngC66M67VJzOsvdUtCtLE0mgZETz-d9jtNK_Z_TjriLMZhQMaqyJgNVr-pXFWnFMfxcBMloEUo8m7U8FyNQ981vJtOosqCU2r-lKehy2e6NfuWObsp1t4oqvgZbTKOcFHHZUAzlWhc_Ab5j4vuNFmg8leWC62OaWTJj5Eh1oqnaYpmmAMcJdBTPcgMGiTuoSxUWCqq1CBHZz-Np8VcSYU8pCk8ekKMYdKvidsXRPc51DivRf0uK18tWoMb0" />
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
@endsection
