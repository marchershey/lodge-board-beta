<div class="relative w-full bg-white" x-data="{ mobileMenu: false }">

    {{-- Mobile menu --}}
    <section class="full-screen absolute inset-0 z-10 w-full overflow-hidden bg-white" x-show="mobileMenu" x-cloak>
        <button class="absolute right-0 top-0 m-5" x-on:click="mobileMenu = false">
            <svg class="icon h-7 w-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        <div class="flex h-full items-center justify-center">
            <div class="text-dark flex flex-col space-y-8 text-center text-4xl font-bold">
                <a href="#">Home</a>
                <a href="#">Properties</a>
                <a href="#">Contact us</a>
                <a class="text-primary" href="#">Guest Portal</a>
            </div>
        </div>
    </section>

    {{-- Header --}}
    <header class="frontend-container flex-row items-center justify-between space-y-0 p-5">

        {{-- Logo --}}
        <div class="flex-none">
            <span class="text-xl font-bold uppercase">Serrate Properties</span>
        </div>

        {{-- Navigation --}}
        <div>
            <nav class="hide-mobile flex space-x-5 font-semibold">
                <a href="#">Home</a>
                <a href="#">Properties</a>
                <a href="#">Get in touch</a>
                <a class="button inline rounded-full px-8" href="#">Guest Portal</a>
            </nav>
            <div class="show-mobile">
                <button class="flex items-center" x-on:click="mobileMenu = true">
                    <svg class="icon h-7 w-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="4" y1="6" x2="20" y2="6"></line>
                        <line x1="4" y1="12" x2="20" y2="12"></line>
                        <line x1="4" y1="18" x2="20" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>

    </header>

    <div class="frontend-container">

        {{-- Hero section --}}
        <section class="frontend-section">
            <div class="relative h-96 rounded-3xl bg-cover bg-center shadow-xl" style="background-image: url(https://i.imgur.com/Cygaelg.jpeg)">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="flex flex-col items-center justify-center space-y-10 px-5">
                        <h1 class="text-center text-4xl font-bold text-white">Let us host your next vacation</h1>
                        <div class="group flex cursor-pointer items-center justify-center space-x-3 rounded-full bg-white px-6 py-2 shadow-2xl transition hover:scale-110 hover:bg-primary hover:text-white">
                            <svg class="icon h-7 w-7 text-muted group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="10" cy="10" r="7"></circle>
                                <line x1="21" y1="21" x2="15" y2="15"></line>
                            </svg>
                            <span class="text-lg md:font-medium">Where are you going?</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Properties list --}}
        <section class="frontend-section" wire:init="loadProperties">
            <h1 class="frontend-title">Popular Properties</h1>
            <div class="frontend-property-grid">
                @if ($properties)
                    @foreach ($properties as $property)
                        <a href="/property/{{ $property->id }}" wire:key="property-{{ $property->id }}">
                            <div class="flex flex-col space-y-3">
                                <div class="aspect-h-7 aspect-w-10 overflow-hidden rounded-3xl">
                                    <img class="bg-cover bg-center" src="/storage/{{ $property->photos()->first()->path }}" alt="">
                                </div>
                                <div class="flex items-center justify-between">
                                    <h1 class="text-2xl font-medium capitalize">{{ $property->name }}</h1>
                                    <h3 class="text-lg">
                                        ${{ number_format($property->rate, 2) }} <span class="text-muted">/ night</span>
                                    </h3>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    {{-- Loading placeholders --}}
                    <div class="flex animate-pulse flex-col space-y-3">
                        <div class="h-64 w-full rounded-3xl bg-gray-200"></div>
                        <div class="flex justify-between">
                            <div class="h-6 basis-1/2 rounded-3xl bg-gray-200"></div>
                            <div class="h-6 basis-1/4 rounded-3xl bg-gray-200"></div>
                        </div>
                    </div>
                    <div class="flex animate-pulse flex-col space-y-3">
                        <div class="h-64 w-full rounded-3xl bg-gray-200"></div>
                        <div class="flex justify-between">
                            <div class="h-6 basis-1/2 rounded-3xl bg-gray-200"></div>
                            <div class="h-6 basis-1/4 rounded-3xl bg-gray-200"></div>
                        </div>
                    </div>
                    <div class="flex animate-pulse flex-col space-y-3">
                        <div class="h-64 w-full rounded-3xl bg-gray-200"></div>
                        <div class="flex justify-between">
                            <div class="h-6 basis-1/2 rounded-3xl bg-gray-200"></div>
                            <div class="h-6 basis-1/4 rounded-3xl bg-gray-200"></div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>

</div>
