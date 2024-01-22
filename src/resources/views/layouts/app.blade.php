<!DOCTYPE html>
<html class="h-full scroll-smooth overscroll-none" lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="themeMode">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover, user-scalable=no">

    <title>{{ $title . ' - ' . config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <script>
        if (localStorage.theme === "dark" || (!("theme" in localStorage) && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
            console.log('Setting theme mode to "dark"');
            localStorage.theme = "dark"
            document.documentElement.classList.add("dark");
        } else {
            console.log('Setting theme mode to "light"');
            localStorage.theme = "light"
            document.documentElement.classList.remove("dark");
        }
    </script>
</head>

<body class="flex flex-col h-full overflow-hidden bg-gray-800 overscroll-none">
    <!-- Toasts -->
    <livewire:toasts />

    <!-- Main Content -->
    <div class="flex flex-auto overflow-hidden overscroll-none">
        {{ $slot }}
    </div>

    <x-utilities.dev-bar />

    <!-- Livewire Script Config -->
    @livewireScriptConfig

    <!-- Custom Scripts -->
    @stack('scripts')

</body>

</html>
