@push('meta')
    <script>
        alert('test')
    </script>
@endpush

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

    {{-- <div class="flex-auto bg-gray-200 dark:bg-gray-800">
        <div class="flex flex-col justify-between h-full py-12 overflow-y-auto">
            <div class="h-full space-y-12">
                <x-logo bgThemeSwitch />
                <div>
                    {{ $slot }}
                </div>
            </div>
            <x-layouts.footer />
        </div>
    </div> --}}
</x-layouts.app>
