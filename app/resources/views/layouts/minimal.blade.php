<x-layouts.app title="{{ $title }}">

    <div class="flex flex-col w-full bg-gray-200">

        {{-- Top Bar --}}
        <div class="flex justify-between py-1 bg-white border-b border-gray-300 page-padding">
            <div class="flex items-center h-[49px]">
                <a href="{{ route('host.dashboard') }}" wire:navigate>
                    <x-logo textSize="text-xl tablet-sm:text-2xl" iconSize="w-4 h-4" />
                </a>
            </div>
            <div class="flex items-center justify-end w-full p-3">
                {{--  --}}
            </div>
        </div>

        {{-- Content --}}
        <div class="h-full overflow-y-auto">

            <div class="flex flex-col h-full space-y-5">
                <div class="h-auto page-padding">
                    {{ $slot }}
                </div>

                {{-- Footer --}}
                <x-layouts.footer />
            </div>
        </div>

    </div>

    @stack('scripts')
</x-layouts.app>
