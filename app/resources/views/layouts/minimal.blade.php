<x-layouts.app title="{{ $title }}">

    <div class="w-full overflow-y-auto bg-gray-200 dark:bg-gray-800">
        <div class="flex flex-col justify-between h-full">
            <div class="flex flex-col py-12 space-y-12">
                <!-- Logo -->
                <x-logo bgThemeSwitch />

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
