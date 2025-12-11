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
                                    <div class="flex flex-wrap gap-2 p-4 bg-white/40 dark:bg-white/10 backdrop-blur-md rounded-xl border border-border-light/40 dark:border-white/10 shadow-sm">
                                        <a class="text-primary font-medium hover:underline" href="#">Itineraries</a>
                                        <span class="text-charcoal/50 dark:text-off-white/50">/</span>
                                        <span class="text-charcoal dark:text-off-white font-semibold">Coastal Escape in Brighton</span>
                                    </div>
                                </div>

                                {{-- Cover Image --}}
                                <div class="w-full h-[480px] rounded-2xl overflow-hidden shadow-xl">
                                    <img class="w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBgVCYxYQsehMfYcF76-Q3jIKnuvxLaeqzHPVLfSSZx745GKa4KpkBKSEWPex4XfDR0G9w_fDoFYD8GiYjUTElYk37rRGwiOBm6Hpu13yVYin8c6us8qqp0P8hTdZINd8-ozTZ3oAHeea65bPPMAoXQ1DYcYVpNtI4ZuwVmTblaL-fQ605Py6kTicR8Pr0kuJVIX8wsQuTF6OMSrhuoqa-_-Ua5cdw-ifdIEQ0Vwx66D-oSjQqWdjaZiXhi9yEmoSGrdo_bzGS_lj0" />
                                </div>

                                <div class="mt-10 max-w-4xl mx-auto">

                                    {{-- Title --}}
                                    <h1 class="text-4xl sm:text-5xl font-black text-charcoal dark:text-off-white leading-tight">
                                        Coastal Escape in Brighton
                                    </h1>


                                    {{-- Content --}}
                                    <div class="mt-10 prose prose-lg dark:prose-invert max-w-none text-charcoal/80 dark:text-off-white/80 leading-relaxed">

                                        {{-- ORIGINAL CONTENT GIỮ NGUYÊN --}}
                                        <p>
                                            Embark on a delightful full-day trip to Brighton, a vibrant coastal city known for its iconic pier,
                                            pebble beach, and bohemian vibe. This itinerary is perfect for those looking to escape the hustle and bustle
                                            and enjoy a classic British seaside experience.
                                        </p>

                                        <p>
                                            Start your day with a stroll along the famous Brighton Palace Pier. Enjoy the traditional arcade games,
                                            thrilling rides, and stunning views of the coastline. Afterward, find a comfortable spot on the iconic
                                            pebble beach. Lay down your picnic blanket, unpack your treats, and soak up the sun while listening to the
                                            calming sound of the waves. It's the perfect setting for a relaxing lunch.
                                        </p>

                                        <p>
                                            In the afternoon, wander through The Lanes, a charming maze of narrow alleyways filled with antique shops,
                                            independent boutiques, and quaint cafes. Discover unique souvenirs and enjoy the historic atmosphere.
                                            As the day winds down, head back to the beachfront to watch the sunset paint the sky with beautiful colors,
                                            providing a perfect end to your coastal escape.
                                        </p>


                                        <h2 class="text-3xl font-bold text-charcoal dark:text-off-white text-center mt-16 mb-10">
                                            SUGGESTED LOCATION
                                        </h2>


                                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                                            {{-- LEFT COLUMN --}}
                                            <div class="space-y-6">

                                                <div class="flex items-center gap-4 p-4 rounded-2xl shadow-md bg-white dark:bg-white/10 
            border border-border-light/40 dark:border-white/10">
                                                    <img src="https://images.unsplash.com/photo-1516117172878-fd2c41f4a759"
                                                        class="w-24 h-24 object-cover rounded-xl" />
                                                    <div>
                                                        <h3 class="text-lg font-semibold">Brighton Beach</h3>
                                                        <p class="text-sm opacity-60">Bãi biển nổi tiếng với sỏi đặc trưng.</p>
                                                    </div>
                                                </div>

                                                <div class="flex items-center gap-4 p-4 rounded-2xl shadow-md bg-white dark:bg-white/10 
            border border-border-light/40 dark:border-white/10">
                                                    <img src="https://images.unsplash.com/photo-1521295121783-8a321d551ad2"
                                                        class="w-24 h-24 object-cover rounded-xl" />
                                                    <div>
                                                        <h3 class="text-lg font-semibold">The Lanes</h3>
                                                        <p class="text-sm opacity-60">Phố cổ mua sắm độc đáo nhất Brighton.</p>
                                                    </div>
                                                </div>

                                                <div class="flex items-center gap-4 p-4 rounded-2xl shadow-md bg-white dark:bg-white/10 
            border border-border-light/40 dark:border-white/10">
                                                    <img src="https://images.unsplash.com/photo-1533090161767-e6ffed986c88"
                                                        class="w-24 h-24 object-cover rounded-xl" />
                                                    <div>
                                                        <h3 class="text-lg font-semibold">Devil's Dyke</h3>
                                                        <p class="text-sm opacity-60">Địa điểm hiking nổi tiếng với view đồi núi.</p>
                                                    </div>
                                                </div>

                                            </div>

                                            {{-- RIGHT COLUMN (DUPLICATE OR OTHER SUGGESTED LOCATIONS) --}}
                                            <div class="space-y-6">

                                                <div class="flex items-center gap-4 p-4 rounded-2xl shadow-md bg-white dark:bg-white/10 
            border border-border-light/40 dark:border-white/10">
                                                    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e"
                                                        class="w-24 h-24 object-cover rounded-xl" />
                                                    <div>
                                                        <h3 class="text-lg font-semibold">Saltdean Beach</h3>
                                                        <p class="text-sm opacity-60">Khu vực biển yên tĩnh, ít đông người.</p>
                                                    </div>
                                                </div>

                                                <div class="flex items-center gap-4 p-4 rounded-2xl shadow-md bg-white dark:bg-white/10 
            border border-border-light/40 dark:border-white/10">
                                                    <img src="https://images.unsplash.com/photo-1470770841072-f978cf4d019e"
                                                        class="w-24 h-24 object-cover rounded-xl" />
                                                    <div>
                                                        <h3 class="text-lg font-semibold">Preston Park</h3>
                                                        <p class="text-sm opacity-60">Công viên lớn nhất Brighton.</p>
                                                    </div>
                                                </div>

                                                <div class="flex items-center gap-4 p-4 rounded-2xl shadow-md bg-white dark:bg-white/10 
            border border-border-light/40 dark:border-white/10">
                                                    <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e"
                                                        class="w-24 h-24 object-cover rounded-xl" />
                                                    <div>
                                                        <h3 class="text-lg font-semibold">Stanmer Park</h3>
                                                        <p class="text-sm opacity-60">Địa điểm lý tưởng cho picnic & trekking.</p>
                                                    </div>
                                                </div>

                                            </div>

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