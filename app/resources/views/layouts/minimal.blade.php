<x-layouts.app title="{{ $title }}">

    <div class="flex flex-col w-full bg-gray-200">

        {{-- Top Bar --}}
        <div class="flex justify-between py-1 bg-white border-b border-gray-300">
            <div class="flex items-center tablet:min-w-80 tablet:justify-center h-[49px]">
                <a href="{{ route('host.dashboard') }}" wire:navigate>
                    <x-logo textSize="text-xl tablet-sm:text-2xl" iconSize="w-4 h-4" />
                </a>
            </div>
            <div class="flex items-center justify-end w-full p-3">
                <div>
                    asdf
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="h-full">
            Content content content
        </div>

        {{-- Footer --}}
        <x-layouts.footer />

    </div>

    <div class="hidden w-full overflow-y-auto bg-gray-200 dark:bg-gray-800">
        <div class="flex flex-col justify-between h-full">
            {{-- Top Bar --}}
            <div class="flex items-center w-full">
                <div class="flex items-center tablet:min-w-80 tablet:justify-center">
                    <a href="{{ route('host.dashboard') }}" wire:navigate>
                        <x-logo bgDark textSize="text-xl tablet-sm:text-2xl" iconSize="w-4 h-4" />
                    </a>
                </div>
            </div>

            {{-- Content --}}
            <div class="flex flex-col space-y-12">
                <!-- Logo -->

                <!-- Layout.Min Content -->
                <div>
                    {{ $slot }}
                </div>
            </div>

            <!-- Footer -->
            <x-layouts.footer />
        </div>
    </div>
    @stack('scripts')
</x-layouts.app>
