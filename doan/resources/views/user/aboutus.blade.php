@extends('layouts.user.user')

@section('content')


<main class="flex-1">
    <div class="px-4 py-16 md:py-24 lg:py-32">
        <div class="mx-auto max-w-4xl">
            <div class="@container">
                <div class="flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat @[480px]:gap-8 @[480px]:rounded-xl items-center justify-center p-8 text-center" data-alt="A sunny park with people enjoying a picnic on a green lawn." style='background-image: linear-gradient(rgba(42, 79, 74, 0.6) 0%, rgba(42, 79, 74, 0.8) 100%), url("https://lh3.googleusercontent.com/aida-public/AB6AXuD4T6QU7Y8WHGwxkvMIyOFN4jxXVf_Pgn10o-zdFrIes_0bH0TeLXfJ1te-wK4Y-q2HlzWeIZ0Ro8VeVpHWQWwDSGQ1DSUMgjAe8cjNDIzOfGi0ziPOoaJukgymInuejws5K2xwp2pkWOatfXDu3y_8k2p3Fu3FkcvmQPGr8Rt9jAyuzlwTMILrEUt8Gxh-F5EZyfcuvkTaNeU54sqWEvaHkmM9p8TiCOOfObyQsXRM7-0tCsE4oNH8GQxbf5uU8gaUu2u2PFtwpRI");'>
                    <div class="flex flex-col gap-4">
                        <h1 class="text-white text-4xl font-black leading-tight tracking-tight @[480px]:text-5xl">Our Mission</h1>
                        <h2 class="text-white text-base font-normal leading-relaxed @[480px]:text-lg max-w-2xl">We believe in the power of play and the beauty of nature. Our mission is to inspire people to step outside, connect with each other, and create lasting memories through fun, accessible activities.</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-4 py-16 md:py-24">
        <div class="mx-auto max-w-5xl">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold leading-tight tracking-tight md:text-4xl">Meet the Development Team</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-12 p-4">
                <div class="flex flex-col gap-4 text-center items-center">
                    <div class="w-40 h-40">
                        <div class="w-full h-full bg-center bg-no-repeat aspect-square bg-cover rounded-full" data-alt="Headshot of Alex Chen, a smiling individual with short dark hair." style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAE52g2imgqexU2xs6dTT8I34GOPz-kZawuEwjeDDUXJ08I3SFV-fC3mqvYXXjf-UqHyVgQ0PK_OU8c0FwCKy3_J0GH27-b6WJzR5byopErFnkSGiqsKDeZwY1WR5DxMl-YtEg5zXJQB3z6iswSRhzI9oAFN0aGBH2T1tT2yUKahQNC81b91hZr33hmEb3kp48mKUKl5TV9afUUF11Tq6k9QcRtvH4Cqw1L3cxNaYGk6l9x2qIy3P1Fg4leH2W-3vXyqjCEEwt6QvI");'></div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-lg font-bold">Alex Chen</p>
                        <p class="text-secondary text-sm font-medium">Lead Designer</p>
                        <p class="text-sm font-normal leading-relaxed text-text-light/80 dark:text-text-dark/80 mt-2">Alex is the creative mind behind our user experience, ensuring every interaction is delightful and intuitive.</p>
                    </div>
                </div>
                <div class="flex flex-col gap-4 text-center items-center">
                    <div class="w-40 h-40">
                        <div class="w-full h-full bg-center bg-no-repeat aspect-square bg-cover rounded-full" data-alt="Headshot of Maria Garcia, a woman with long wavy hair, smiling warmly." style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCNqzxfzhi-Nvi2q6Rv5fqJ07h3YcokVxKLtG5w0hqLXYIcKaE8C_pXDWjVGr9fWMPX4J_jv7a8BOyCAaoWV_Y25yyPptyoZVt-n3ybVI7LhZ0zPkAdpSqCDmEpWzyJWz8ah0PnaOFgz2StuX29cEFeuWTobOOKejZ3ygpSxnkIDgmS2fIKm_jh54f0V9yhFD9sYOCQO8gwvTy0htFI8UDSqvJ0BflYlSK-sobRnJYwK4ewtRnWGi11-R53xPbr0QtygrlGKFylDZM");'></div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-lg font-bold">Maria Garcia</p>
                        <p class="text-secondary text-sm font-medium">Content Strategist</p>
                        <p class="text-sm font-normal leading-relaxed text-text-light/80 dark:text-text-dark/80 mt-2">Maria crafts all the engaging game guides and travel itineraries you'll find on our site.</p>
                    </div>
                </div>
                <div class="flex flex-col gap-4 text-center items-center">
                    <div class="w-40 h-40">
                        <div class="w-full h-full bg-center bg-no-repeat aspect-square bg-cover rounded-full" data-alt="Headshot of David Smith, a person with glasses and a beard, looking thoughtfully at the camera." style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAwNmtHdmtDMBgJo_VqkrFijJpMtkX7o9N5R0fg-5MRow-P1GAZXsiau6-PZHQSWLXU4AbKUBUmpthWWcGiRUoVkNfQ0dnVia9z_i3odO--H__txAgg5RkpCkyYJxSLR-LN9TMzqiQEGna6IEohDrIu6dT-XyRcV0wpULwyAiimOhNh0BFny8gWRF3h0aXmt5msmqdQRHK3QhslI-E-MRmjPqPttQMEIfBtxuFWwyQlPk_ptHNe-7vOGbYmiAMlUrUf88dKQG40s-M");'></div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-lg font-bold">David Smith</p>
                        <p class="text-secondary text-sm font-medium">Lead Developer</p>
                        <p class="text-sm font-normal leading-relaxed text-text-light/80 dark:text-text-dark/80 mt-2">David is the technical wizard who brought our vision to life, building a seamless and robust platform.</p>
                    </div>
                </div>
                <div class="flex flex-col gap-4 text-center items-center">
                    <div class="w-40 h-40">
                        <div class="w-full h-full bg-center bg-no-repeat aspect-square bg-cover rounded-full" data-alt="Headshot of Sarah Johnson, a woman with blonde hair, smiling at the camera." style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDiBWwOSgHitDp3cH30bHCepNzBJQbcu1RPtKqTn83Wj4xZeCZdPPesfVdwe1WnHLXaK8bKAxEyDA-HMjcsQ6hISJiWOnYIrQS8RnTpEhYXPe0SaycKo7jMmLx9V4On4pMss2p_bnJF-q-wa9Dh5itLXMyxp9z01BTahrZOu2Xq7150HGsQMemTDj86rxj5VI7_NlS9joZrJcaZl5PahGgVLTU2PCqh5PTBSzqmeGbg3FahkvyoGk31xRJHlN5nJINwkPFr7-ssnQQ");'></div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-lg font-bold">Sarah Johnson</p>
                        <p class="text-secondary text-sm font-medium">Marketing Lead</p>
                        <p class="text-sm font-normal leading-relaxed text-text-light/80 dark:text-text-dark/80 mt-2">Sarah spreads the word about PlayFullOutings, connecting with our community and sharing our passion for play.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-4 py-16 md:py-24 bg-background-light dark:bg-black/10">
        <div class="mx-auto max-w-4xl">
            <div class="flex flex-col items-center justify-center gap-6 text-center">
                <h1 class="text-3xl font-bold tracking-tight @[480px]:text-4xl @[480px]:font-black">Ready to Play?</h1>
                <p class="text-base font-normal leading-relaxed max-w-xl">Start your next adventure with our collection of games and itineraries designed for unforgettable outings.</p>
                <div class="flex flex-wrap gap-4 justify-center mt-4">

                    <a href="{{ route('user.game') }}"
                        class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden 
          rounded-xl h-12 px-6 bg-orange-300 text-white font-bold 
          hover:bg-orange-500 transition-colors">
                        Explore Picnic Games
                    </a>



                    <a href="{{ route('user.itinerary') }}"
                        class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden 
               rounded-xl h-12 px-6 bg-gray-200 dark:bg-border-dark text-text-light 
               dark:text-text-dark text-base font-bold leading-normal tracking-wide 
               hover:bg-gray-300 dark:hover:bg-opacity-80 transition-colors">
                        <span class="truncate">Discover Itineraries</span>
                    </a>

                </div>

            </div>
        </div>
    </div>
</main>

@endsection