{{-- <div>
    <div class="relative mx-3" wire:init="load" x-data="{ open: false }" x-on:click.away="open = false">
        @if ($properties && $property)
        @else
            <div class="flex animate-pulse cursor-wait items-center space-x-3 p-2" wire:key="property-selector-loading-1">
                <div class="h-9 w-9 flex-shrink-0 rounded-full bg-gray-700"></div>
                <div class="mt-[4px] h-[31px] w-full flex-col space-y-1">
                    <div class="h-4 w-2/3 rounded-full bg-gray-700"></div>
                    <div class="h-3 w-1/3 rounded-full bg-gray-700"></div>
                </div>
            </div>
        @endif
    </div>
</div> --}}

<div>
    <div wire:key="property-selector" wire:init="load" x-data="{ selectorOpen: false }" x-on:click.away="selectorOpen = false">
        <div class="relative mx-3">
            @if (!$loading)
                @if ($properties && $property)
                    <div>Blank</div>
                @else
                    <div class="flex items-center space-x-3 p-2" wire:key="property-selector-loading-2">
                        <div class="h-9 w-9 flex-shrink-0 rounded-full bg-gray-700"></div>
                        <div class="mt-[4px] h-[31px] w-full flex-col space-y-1">
                            <div class="h-4 w-2/3 rounded-full bg-gray-700"></div>
                            <div class="h-3 w-1/3 rounded-full bg-gray-700"></div>
                        </div>
                    </div>
                @endif
            @else
                <div class="flex animate-pulse cursor-wait items-center space-x-3 p-2" wire:key="property-selector-loading-1">
                    <div class="h-9 w-9 flex-shrink-0 rounded-full bg-gray-700"></div>
                    <div class="mt-[4px] h-[31px] w-full flex-col space-y-1">
                        <div class="h-4 w-2/3 rounded-full bg-gray-700"></div>
                        <div class="h-3 w-1/3 rounded-full bg-gray-700"></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- <div wire:init="load">
        <div class="relative mx-3" x-data="{ selectorOpen: false }" x-on:click.away="selectorOpen = false">
            @if ($property)
                <div>
                    <button class="flex w-full items-center space-x-3 rounded-lg p-2 hover:bg-gray-700" x-on:click="selectorOpen = !selectorOpen" :class="selectorOpen && '!bg-gray-700'">
                        <span class="h-9 w-9 rounded-full bg-cover" style="background-image: url(https://i.imgur.com/wAy4vKv.png)"></span>
                        <span class="flex flex-1 flex-col text-left">
                            <span class="font-semibold text-white">Ohana Burnside</span>
                            <span class="text-xs tracking-wider text-muted">Burnside, KY</span>
                        </span>
                        <span>
                            <svg class="h-5 w-5 flex-shrink-0 text-muted group-hover:text-white" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                </div>
                <div class="absolute mt-1 w-full rounded-lg bg-white p-2" x-show="selectorOpen" x-cloak>
                    <div class="">
                        @foreach ($properties as $property)
                            <div>
                                asdf
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="flex animate-pulse cursor-wait items-center space-x-3 p-2">
                    <div class="h-9 w-9 flex-shrink-0 rounded-full bg-gray-700"></div>
                    <div class="mt-[4px] h-[31px] w-full flex-col space-y-1">
                        <div class="h-4 w-2/3 rounded-full bg-gray-700"></div>
                        <div class="h-3 w-1/3 rounded-full bg-gray-700"></div>
                    </div>
                </div>
            @endif
        </div>
    </div> --}}
