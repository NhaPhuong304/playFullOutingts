@extends('layouts.user.user')

@section('content')

<main class="flex-1 w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
    <div class="flex flex-col gap-8">
        <div class="flex flex-col gap-3 text-center">
            <h1 class="text-4xl md:text-5xl font-black leading-tight tracking-[-0.033em]">Get in Touch</h1>
            <p class="text-base font-normal leading-normal text-gray-500 dark:text-gray-400">Fill out the form below, and we'll get back to you as soon as possible.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16 items-start">
            <div class="w-full flex flex-col gap-6 p-6 md:p-8 bg-card-light dark:bg-card-dark rounded-xl shadow-sm">
                <form class="flex flex-col gap-6">
                    <label class="flex flex-col flex-1">
                        <p class="text-base font-medium leading-normal pb-2">Your Name</p>
                        <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-text-light dark:text-text-dark focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark h-12 placeholder:text-text-placeholder-light dark:placeholder:text-text-placeholder-dark p-3 text-base font-normal leading-normal" placeholder="Enter your full name" type="text" />
                    </label>
                    <label class="flex flex-col flex-1">
                        <p class="text-base font-medium leading-normal pb-2">Your Email</p>
                        <input class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-text-light dark:text-text-dark focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark h-12 placeholder:text-text-placeholder-light dark:placeholder:text-text-placeholder-dark p-3 text-base font-normal leading-normal" placeholder="you@example.com" type="email" />
                    </label>
                    <label class="flex flex-col flex-1">
                        <p class="text-base font-medium leading-normal pb-2">Your Message</p>
                        <textarea class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-text-light dark:text-text-dark focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark min-h-36 placeholder:text-text-placeholder-light dark:placeholder:text-text-placeholder-dark p-3 text-base font-normal leading-normal" placeholder="Write your message here..."></textarea>
                    </label>
                    <button class="flex min-w-[84px] w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-4 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-blue-600 transition-colors">
                        <span class="truncate">Send Message</span>
                    </button>
                </form>
            </div>
            <div class="w-full flex flex-col gap-6">
                <div class="relative w-full h-80 md:h-full rounded-xl overflow-hidden shadow-sm">
                    <img class="w-full h-full object-cover" data-alt="A stylized map showing streets and a pinned location in a park." data-location="Central Park, New York" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBIPTGhk_h79XgaO26elemPqGIEiDTnWPAyzkmFnn2bgXOugQqWeUWuwP3HmZ8_KE60THzpfdKGcfIRSHzX_LoacUvj8K20BEjQEa7KLXnBIz9A6Wqq0iaxyKtQIhzwsnztOA33IV2mjsqz60xAh_pAhChF7wRcKI5YOFDrs18izRS3P0DNYrqYfqcZtirUZEGBDATWvxW3Bt5jA_6OjrA16KUV01nRHAkWPnWq3VT2v4VSJif4IRGg_Vu9tlsiJIYXUqeZ8KV0yko" />
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>
                <div class="p-6 bg-card-light dark:bg-card-dark rounded-xl shadow-sm flex flex-col gap-4">
                    <h3 class="text-lg font-bold">Or Contact Us Directly</h3>
                    <div class="flex flex-col gap-3">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-orange-500 text-xl">location_on</span>
                            <p class="text-sm">Central Park Meeting Point, New York, NY</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-orange-500 text-xl">mail</span>
                            <p class="text-sm">hello@picnicperfect.com</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-orange-500 text-xl">call</span>
                            <p class="text-sm">(555) 123-4567</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

@endsection