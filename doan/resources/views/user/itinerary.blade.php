@extends('layouts.user.user')

@section('content')

<main class="flex-grow">
    <div class="px-4 sm:px-10 py-5">
        <div class="mx-auto max-w-7xl">

            <div class="mt-8 flex flex-col gap-4">
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    <div class="w-full md:w-1/2 lg:w-2/3">
                        <label class="flex flex-col min-w-40 h-12 w-full">
                            <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                                <div class="text-primary flex border-none bg-white dark:bg-charcoal items-center justify-center pl-4 rounded-l-lg border-r-0">
                                    <span class="material-symbols-outlined">search</span>
                                </div>
                                <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-charcoal dark:text-off-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-none bg-white dark:bg-charcoal h-full placeholder:text-charcoal/60 dark:placeholder:text-off-white/60 px-4 rounded-l-none border-l-0 pl-2 text-base font-normal leading-normal" placeholder="Search by keyword..." value="" />
                            </div>
                        </label>
                    </div>
                    <div class="flex gap-2 flex-wrap justify-start w-full md:w-auto">
                        <div class="flex h-12 shrink-0 cursor-pointer items-center justify-center gap-x-2 rounded-lg bg-primary/20 dark:bg-primary/30 px-4">
                            <p class="text-primary dark:text-off-white text-sm font-medium leading-normal">All</p>
                        </div>
                        <div class="flex h-12 shrink-0 cursor-pointer items-center justify-center gap-x-2 rounded-lg bg-white dark:bg-charcoal px-4">
                            <p class="text-charcoal dark:text-off-white text-sm font-medium leading-normal">Half-Day</p>
                        </div>
                        <div class="flex h-12 shrink-0 cursor-pointer items-center justify-center gap-x-2 rounded-lg bg-white dark:bg-charcoal px-4">
                            <p class="text-charcoal dark:text-off-white text-sm font-medium leading-normal">Full-Day</p>
                        </div>
                        <div class="flex h-12 shrink-0 cursor-pointer items-center justify-center gap-x-2 rounded-lg bg-white dark:bg-charcoal px-4">
                            <p class="text-charcoal dark:text-off-white text-sm font-medium leading-normal">Weekend</p>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2 flex-wrap">
                    <div class="flex h-8 shrink-0 cursor-pointer items-center justify-center gap-x-2 rounded-full bg-white dark:bg-charcoal px-4">
                        <p class="text-charcoal dark:text-off-white text-sm font-medium leading-normal">Park</p>
                    </div>
                    <div class="flex h-8 shrink-0 cursor-pointer items-center justify-center gap-x-2 rounded-full bg-white dark:bg-charcoal px-4">
                        <p class="text-charcoal dark:text-off-white text-sm font-medium leading-normal">Beach</p>
                    </div>
                    <div class="flex h-8 shrink-0 cursor-pointer items-center justify-center gap-x-2 rounded-full bg-white dark:bg-charcoal px-4">
                        <p class="text-charcoal dark:text-off-white text-sm font-medium leading-normal">Mountain</p>
                    </div>
                </div>
            </div>
            <div class="mt-10">
                <div class="flex flex-wrap gap-2 p-4 bg-white/50 dark:bg-charcoal/50 rounded-lg">
                    <a class="text-primary text-base font-medium leading-normal" href="#">Home</a>
                    <span class="text-charcoal/50 dark:text-off-white/50 text-base font-medium leading-normal">/</span>
                    <span class="text-charcoal dark:text-off-white text-base font-medium leading-normal">Itineraries</span>
                </div>
            </div>
            <div class="mt-10">
                <h3 class="text-2xl font-bold text-charcoal dark:text-off-white">Suggested Itineraries</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-6">
                    @foreach ($itineraries as $itinerary)
<div class="bg-white dark:bg-charcoal rounded-xl overflow-hidden shadow-md transition-transform hover:scale-105 hover:shadow-xl flex flex-col">

    {{-- IMAGE --}}
    <img class="w-full h-48 object-cover"
         src="{{ $itinerary->image ? asset('storage/itineraries/' . $itinerary->image) : asset('storage/avatars/no-image.jpg') }}"
         alt="{{ $itinerary->name }}">

    <div class="p-6 flex flex-col flex-grow">

        {{-- TAGS --}}
        <div class="flex gap-2 mb-2">
            <span class="text-xs font-semibold bg-primary/20 text-primary px-2 py-1 rounded-full">
                {{ $itinerary->days }} Days
            </span>

            {{-- IN CASE MANY LOCATIONS --}}
            @foreach($itinerary->locations as $loc)
            <span class="text-xs font-semibold bg-primary/20 text-primary px-2 py-1 rounded-full">
                {{ $loc->name }}
            </span>
            @endforeach
        </div>

        {{-- TITLE --}}
        <h4 class="text-xl font-bold text-charcoal dark:text-off-white">
            {{ $itinerary->name }}
        </h4>

        {{-- SHORT DESCRIPTION --}}
        <p class="text-sm text-charcoal/80 dark:text-off-white/80 mt-2 flex-grow">
            {{ Str::limit($itinerary->description, 120) }}
        </p>

        {{-- VIEW DETAIL BUTTON --}}
        <a href="{{route('user.itinerary.detail', $itinerary->id)}}"
                class="mt-auto flex w-full items-center justify-center rounded-lg h-10 px-4 
                        bg-primary/10 text-primary text-sm font-bold hover:bg-primary hover:text-white transition">
                View Details
            </a>

    </div>
</div>
@endforeach


                </div>
            </div>
            <div class="mt-16">
                <h3 class="text-2xl font-bold text-charcoal dark:text-off-white">Popular Destinations</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mt-6">
                    <div class="relative rounded-xl overflow-hidden group">
                        <img class="w-full h-64 object-cover transition-transform group-hover:scale-110 duration-300" data-alt="Dramatic cliffs and sea stacks of the Jurassic Coast" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAN9CPC4Addz3L95Ok583wGpL9f6dDnmqoOGnjqq0KbwAGkUNlBiqrHic-6D19dEFTa88cvafBPdi4wsTI9h5ikBCFgRomeCwuVxd94W2jbvBDMrahbySR5hyYLage5dIX03z9yMtK_c5LKmFjnrou5qtKaVguFHXFGCPjx4Auxixb5bHhEivMgqBFIGXHQMVRG9JekKPsURFrJT5xcixPeF1Ctn5jGwJoH7eHu85Z6y05LRWA3L2JyKYdVZ1XjUNfE7U4J0ccE970" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-4">
                            <h4 class="text-white text-lg font-bold">Jurassic Coast</h4>
                            <p class="text-white/80 text-sm">Stunning cliffs &amp; fossils</p>
                        </div>
                    </div>
                    <div class="relative rounded-xl overflow-hidden group">
                        <img class="w-full h-64 object-cover transition-transform group-hover:scale-110 duration-300" data-alt="Quaint, honey-colored stone cottages in the Cotswolds" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDXiwgaZRJDaL-PIirD0VHXNoZ5tgcRGrMZQ1Gy-Hi93mK6MRf5JpKMuwqL78qpz8i7UisPChO2J4hrS15QNR2UvndzIFvs3gZ9Jv2F3mIkKyYutHwZ7Pv-VkhKNn3chlgJBuktSXjiP7CyIwZC502hAM3hl3u7hqM7rMMEK15NLroX72py8OyYawjEQfQ-ZdcMD2yvxeiMSaYuxoorkTgnzDYpJtMMepoPSj2Sl5MM-afbUMDVkt1oy11qiwHyrMs4yFeP_StiXlU" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-4">
                            <h4 class="text-white text-lg font-bold">The Cotswolds</h4>
                            <p class="text-white/80 text-sm">Charming villages &amp; hills</p>
                        </div>
                    </div>
                    <div class="relative rounded-xl overflow-hidden group">
                        <img class="w-full h-64 object-cover transition-transform group-hover:scale-110 duration-300" data-alt="A tranquil canal with narrowboats in Cambridge" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBPgjUIiqPnrx9N25O4Y0XDxkjLVprYDAA3lvG31WT2IU1r4SSm_8UurUrsv8TsmClSr3MsE-d7s9YiEKlltA_diE5Ey5r21JwZMDxGHr1JEoOqJ2k1u6Ff3e15G1lDJVsJFHQvIsZt__wfDMjl8kdbKv9wDw4l-2vAxx3-dNKmIUfjRG7VXnxuJqf_8tHwkDa-ZaoO25dV9ZxPdU8Z-y9gEhLD9Uf7VH7YeRqGonSA5oshJgAF3FemmpVFFqdPRmYksOdNdNctlwI" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-4">
                            <h4 class="text-white text-lg font-bold">Cambridge</h4>
                            <p class="text-white/80 text-sm">Punting &amp; riverside picnics</p>
                        </div>
                    </div>
                    <div class="relative rounded-xl overflow-hidden group">
                        <img class="w-full h-64 object-cover transition-transform group-hover:scale-110 duration-300" data-alt="A rugged, beautiful landscape in the Scottish Highlands" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCAtxwmQ4vZFOn1CAhfQ-sIUK3IVZ4fqBFSIReW4MeBkcSrbzWp6TMLq87ZRpjeB_c-UK591I8-pjaGqHLUTqHfSr2nImsQ1vItsHlFQUl-vjs55bdOv5aoGUHtAe9ywFj5zwwCGx5JVzDXjUU9V12_4b5r55i6c-xEDj1FqQZ-jvWtPGLHCK7oJZiHmtr-RKykDYThrciYtCB5fTD8wELEXOPgUZm6HqFiWqkUhKq2HDPqnltjC67bhj7sYV75Eg8a6vnin9pjYzA" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-4">
                            <h4 class="text-white text-lg font-bold">Scottish Highlands</h4>
                            <p class="text-white/80 text-sm">Wild lochs &amp; mountains</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-16 pb-16">
                <h3 class="text-2xl font-bold text-charcoal dark:text-off-white">Games For Your Trip</h3>
                <p class="mt-2 text-charcoal/80 dark:text-off-white/80">Perfect games to pack for any adventure.</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-6">
                    <div class="bg-white dark:bg-charcoal rounded-xl p-6 shadow-md transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-orange-50 dark:hover:bg-gray-700">
                        <div class="flex items-center gap-4">
                            <div class="bg-primary/20 p-3 rounded-full text-primary">
                                <span class="material-symbols-outlined !text-3xl">sports_volleyball</span>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold">Beach Fun</h4>
                                <p class="text-sm text-charcoal/70 dark:text-off-white/70">Frisbee, volleyball</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-charcoal rounded-xl p-6 shadow-md transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-orange-50 dark:hover:bg-gray-700">
                        <div class="flex items-center gap-4">
                            <div class="bg-primary/20 p-3 rounded-full text-primary">
                                <span class="material-symbols-outlined !text-3xl">style</span>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold">Park Classics</h4>
                                <p class="text-sm text-charcoal/70 dark:text-off-white/70">Card games, boules</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-charcoal rounded-xl p-6 shadow-md transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-orange-50 dark:hover:bg-gray-700">
                        <div class="flex items-center gap-4">
                            <div class="bg-primary/20 p-3 rounded-full text-primary">
                                <span class="material-symbols-outlined !text-3xl">map</span>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold">Mountain Adventures</h4>
                                <p class="text-sm text-charcoal/70 dark:text-off-white/70">Scavenger hunt, trivia</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

@endsection