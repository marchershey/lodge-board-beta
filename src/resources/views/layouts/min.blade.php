<x-layouts.app title="{{ $title }}">
    <div class="flex-auto bg-gray-200">
        <div class="h-full py-12 space-y-12 overflow-y-auto">
            <!-- Logo -->
            <x-logo bgThemeSwitch />

            <div>
                {{ $slot }}
            </div>

            <x-layouts.footer />
        </div>
    </div>
</x-layouts.app>
