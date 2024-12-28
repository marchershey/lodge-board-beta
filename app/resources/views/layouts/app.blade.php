<!DOCTYPE html>
<html class="h-full overscroll-none scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover, user-scalable=no">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @fluxStyles
    {{-- <link href="https://fonts.gstatic.com" rel="preconnect"> --}}
    <link href="https://fonts.bunny.net" rel="preconnect">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <title>{{ $title . ' - ' . config('app.name') }}</title>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('sidebar', {
                open: false,

                toggle() {
                    this.open = !this.open
                    console.log('toggle')
                }
            })
        })
    </script>
</head>

<body class="flex flex-col h-full overflow-hidden antialiased text-gray-600 transition-all duration-500 bg-gray-800 font-default overscroll-none">
    <!-- Toasts -->
    @livewire('toasts')
    {{-- @persist('toast')
        <flux:toast class="!p-2" position="top right" />
    @endpersist --}}

    <!-- Main Content -->
    <div class="relative flex flex-auto overflow-hidden overscroll-none">
        {{ $slot }}
    </div>

    <x-utilities.dev-bar />

    <!-- Livewire Script Config -->
    @livewireScriptConfig
    @fluxScripts

    <!-- Custom Scripts -->
    @stack('scripts')

</body>

</html>
