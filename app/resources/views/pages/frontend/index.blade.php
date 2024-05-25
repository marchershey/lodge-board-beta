<div class="relative w-full bg-white" x-data="{ mobileMenu: false }">

    {{-- Mobile menu --}}
    <section class="absolute inset-0 z-10 w-full overflow-hidden bg-white full-screen" x-show="mobileMenu" x-cloak>
        <button class="absolute top-0 right-0 m-5" x-on:click="mobileMenu = false">
            <svg class="icon h-7 w-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        <div class="flex items-center justify-center h-full">
            <div class="flex flex-col space-y-8 text-4xl font-bold text-center text-dark">
                <a href="#">Home</a>
                <a href="#">Properties</a>
                <a href="#">Contact us</a>
                <a class="text-primary" href="#">Guest Portal</a>
            </div>
        </div>
    </section>

    {{-- Header --}}
    <header class="flex-row items-center justify-between p-5 space-y-0 frontend-container">

        {{-- Logo --}}
        <div class="flex-none">
            <span class="text-xl font-bold uppercase">Serrate Properties</span>
        </div>

        {{-- Navigation --}}
        <div>
            <nav class="flex space-x-5 font-semibold hide-mobile">
                <a href="#">Home</a>
                <a href="#">Properties</a>
                <a href="#">Get in touch</a>
                <a class="inline px-8 rounded-full button" href="#">Guest Portal</a>
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
            <div class="relative bg-center bg-cover shadow-xl h-96 rounded-3xl" style="background-image: url(https://i.imgur.com/Cygaelg.jpeg)">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="flex flex-col items-center justify-center px-5 space-y-10">
                        <h1 class="text-4xl font-bold text-center text-white">Let us host your next vacation</h1>
                        <div class="flex items-center justify-center px-6 py-2 space-x-3 transition bg-white rounded-full shadow-2xl cursor-pointer hover:bg-primary group hover:scale-110 hover:text-white">
                            <svg class="icon text-muted h-7 w-7 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                        <a href="/property/{{ $property->id }}">
                            <div class="flex flex-col space-y-3">
                                <div class="overflow-hidden aspect-w-10 aspect-h-7 rounded-3xl">
                                    <img class="bg-center bg-cover" src="/storage/{{ $property->photos()->first()->path }}" alt="">
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
                    <div class="flex flex-col space-y-3 animate-pulse">
                        <div class="w-full h-64 bg-gray-200 rounded-3xl"></div>
                        <div class="flex justify-between">
                            <div class="h-6 bg-gray-200 basis-1/2 rounded-3xl"></div>
                            <div class="h-6 bg-gray-200 basis-1/4 rounded-3xl"></div>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-3 animate-pulse">
                        <div class="w-full h-64 bg-gray-200 rounded-3xl"></div>
                        <div class="flex justify-between">
                            <div class="h-6 bg-gray-200 basis-1/2 rounded-3xl"></div>
                            <div class="h-6 bg-gray-200 basis-1/4 rounded-3xl"></div>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-3 animate-pulse">
                        <div class="w-full h-64 bg-gray-200 rounded-3xl"></div>
                        <div class="flex justify-between">
                            <div class="h-6 bg-gray-200 basis-1/2 rounded-3xl"></div>
                            <div class="h-6 bg-gray-200 basis-1/4 rounded-3xl"></div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>

</div>
