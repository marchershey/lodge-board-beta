<!DOCTYPE html>
<html class="h-full scroll-smooth overscroll-none" lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="themeMode">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover, user-scalable=no">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link href="https://fonts.gstatic.com" rel="preconnect">

    <title>{{ $title . ' - ' . config('app.name') }}</title>
</head>

<body class="flex flex-col h-full overflow-hidden antialiased text-gray-600 bg-gray-800 overscroll-none font-default">
    <!-- Toasts -->
    <livewire:toasts />

    <!-- Main Content -->
    <div class="relative flex flex-auto overflow-hidden overscroll-none">
        {{ $slot }}
    </div>

    <x-utilities.dev-bar />

    <!-- Livewire Script Config -->
    @livewireScriptConfig

    <!-- Custom Scripts -->
    @stack('scripts')

</body>

</html>
