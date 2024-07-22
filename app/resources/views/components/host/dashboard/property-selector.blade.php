<div wire:init="load">

    <div class="relative mx-3" x-data="{ selectorOpen: true }" x-on:click.away="selectorOpen = false">
        @if ($property)
            <div>
                <button class="flex items-center w-full p-2 space-x-3 rounded-lg hover:bg-gray-700" x-on:click="selectorOpen = !selectorOpen" :class="selectorOpen && '!bg-gray-700'">
                    <span class="bg-cover rounded-full w-9 h-9" style="background-image: url(https://i.imgur.com/wAy4vKv.png)"></span>
                    <span class="flex flex-col flex-1 text-left">
                        <span class="font-semibold text-white">Ohana Burnside</span>
                        <span class="text-xs tracking-wider text-muted">Burnside, KY</span>
                    </span>
                    <span>
                        <svg class="flex-shrink-0 w-5 h-5 text-muted group-hover:text-white" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
            </div>
            <div class="absolute w-full p-2 mt-1 bg-white rounded-lg" x-show="selectorOpen" x-cloak>
                <div class="">
                    @foreach ($properties as $property)
                        <div>
                            asdf
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="flex items-center p-2 mx-3 space-x-3 cursor-wait animate-pulse">
                <div class="flex-shrink-0 bg-gray-700 rounded-full w-9 h-9"></div>
                <div class="flex-col w-full space-y-1 h-[31px] mt-[4px]">
                    <div class="w-2/3 h-4 bg-gray-700 rounded-full"></div>
                    <div class="w-1/3 h-3 bg-gray-700 rounded-full"></div>
                </div>
            </div>
        @endif
    </div>

    {{-- <div class="relative hidden px-3" x-data="{ open: false }">
        <div>
            <button class="w-full p-2 bg-gray-800 border border-gray-800 rounded-lg group hover:bg-gray-700" id="properties-selector-button" type="button" aria-expanded="false" aria-haspopup="true" x-on:click="open = !open" :class="open ? 'bg-gray-700' : 'bg-gray-800'">
                <span class="flex items-center justify-between w-full">
                    <span class="flex items-center justify-between min-w-0 space-x-3">
                        <img class="flex-shrink-0 w-10 h-10 bg-gray-300 rounded-full" src="https://i.imgur.com/wAy4vKv.png" alt="">
                        <span class="flex flex-col flex-1 min-w-0 text-left">
                            <span class="text-base font-medium text-white truncate">Ohana Burnside</span>
                            <span class="text-xs truncate text-muted">Burnside, KY</span>
                        </span>
                    </span>
                    <svg class="flex-shrink-0 w-5 h-5 text-muted group-hover:text-white" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                    </svg>
                </span>
            </button>
        </div>

        <div class="absolute left-0 right-0 z-10 mx-3 mt-3 overflow-hidden origin-top bg-white divide-y divide-gray-200 rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu-button" tabindex="-1" x-transition x-on:click.away="open = false" x-show="open" x-cloak>
            <a class="flex w-full px-2 py-3 group hover:bg-muted-lightest" id="properties-selector-button" href="#">
                <span class="flex items-center justify-between w-full">
                    <span class="flex items-center justify-between min-w-0 space-x-3">
                        <img class="flex-shrink-0 w-10 h-10 bg-gray-300 rounded-full ring-1 ring-gray-400" src="https://i.imgur.com/wAy4vKv.png" alt="">
                        <span class="flex flex-col flex-1 min-w-0 text-left">
                            <span class="text-base font-medium leading-5 truncate">Ohana Burnside</span>
                            <span class="text-xs truncate text-muted">Burnside, KY</span>
                        </span>
                    </span>
                    <svg class="flex-shrink-0 w-5 h-5 text-muted group-hover:text-green-600 group-hover:block" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l5 5l10 -10" />
                    </svg>
                </span>
            </a>
            <a class="flex w-full px-2 py-3 group hover:bg-muted-lightest" id="properties-selector-button" href="#">
                <span class="flex items-center justify-between w-full">
                    <span class="flex items-center justify-between min-w-0 space-x-3">
                        <img class="flex-shrink-0 w-10 h-10 bg-gray-300 rounded-full ring-1 ring-gray-400" src="https://i.imgur.com/wAy4vKv.png" alt="">
                        <span class="flex flex-col flex-1 min-w-0 text-left">
                            <span class="text-base font-medium leading-5 truncate">Ohana Burnside</span>
                            <span class="text-xs truncate text-muted">Burnside, KY</span>
                        </span>
                    </span>
                    <svg class="flex-shrink-0 hidden w-5 h-5 text-muted-dark group-hover:text-green-600 group-hover:block" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l5 5l10 -10" />
                    </svg>
                </span>
            </a>
            <a class="flex w-full px-2 py-3 group hover:bg-muted-lightest" id="properties-selector-button" href="#">
                <span class="flex items-center justify-between w-full">
                    <span class="flex items-center justify-between min-w-0 space-x-3">
                        <img class="flex-shrink-0 w-10 h-10 bg-gray-300 rounded-full ring-1 ring-gray-400" src="https://i.imgur.com/wAy4vKv.png" alt="">
                        <span class="flex flex-col flex-1 min-w-0 text-left">
                            <span class="text-base font-medium leading-5 truncate">Ohana Burnside</span>
                            <span class="text-xs truncate text-muted">Burnside, KY</span>
                        </span>
                    </span>
                    <svg class="flex-shrink-0 hidden w-5 h-5 text-muted-dark group-hover:text-green-600 group-hover:block" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l5 5l10 -10" />
                    </svg>
                </span>
            </a>
            <a class="flex w-full px-2 py-2 group hover:bg-muted-lightest" id="properties-selector-button" href="#">
                <span class="flex items-center justify-between min-w-0 space-x-3">

                    <div class="flex items-center justify-center w-10 h-10">
                        <div class="flex items-center justify-center w-10 h-10 p-2 bg-gray-100 rounded-full group-hover:bg-primary ring-1 ring-gray-300 group-hover:ring-primary group-hover:shadow-lg">
                            <svg class="text-gray-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M19 12h2l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h5.5" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2" />
                                <path d="M16 19h6" />
                                <path d="M19 16v6" />
                            </svg>
                        </div>
                    </div>
                    <span class="flex flex-col flex-1 min-w-0 text-left">
                        <span class="flex flex-col flex-1 min-w-0 text-left">
                            <span class="text-base font-medium leading-5 truncate">Add Property</span>
                            <span class="text-xs truncate text-muted">Add a new property property...</span>
                        </span>
                    </span>
                </span>
            </a>
        </div>
    </div> --}}
</div>
