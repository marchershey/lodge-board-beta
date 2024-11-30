<x-layouts.app title="{{ $title }}">

    <div class="flex w-full flex-col bg-gray-200">

        {{-- Header --}}
        {{-- Fix this stupid shit with hiding header... --}}
        @if ($header ?? true)
            <div class="page-padding flex border-b border-gray-300 bg-white py-1">
                <div class="flex h-[49px] items-center">
                    <a href="{{ route('host.dashboard') }}" wire:navigate>
                        <x-logo textSize="text-xl tablet-sm:text-2xl" iconSize="w-4 h-4" />
                    </a>
                </div>
                {{-- <div class="flex items-center justify-end w-full p-3">
            </div> --}}
            </div>
        @endif

        {{-- Content --}}
        <div class="h-full overflow-y-auto">

            <div class="flex h-full flex-col justify-between space-y-5">
                <div class="page-padding flex-1">
                    {{ $slot }}
                </div>

                {{-- Footer --}}
                <x-layouts.footer />
            </div>
        </div>

    </div>

    @stack('scripts')
</x-layouts.app>
