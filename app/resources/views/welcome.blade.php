<div class="flex hidden h-full flex-col overflow-hidden" x-data="{ sidebar: false }">
    {{-- Topbar --}}
    <section class="tablet-lg:mr-3 flex justify-between bg-gray-800 laptop:mr-5">

        {{-- Mobile Menu Toggle --}}
        <div class="tablet-lg:hidden">
            <button class="p-3" x-on:click="sidebar = !sidebar">
                <svg class="h-8 w-8 text-muted" x-show="!sidebar" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 6l16 0"></path>
                    <path d="M4 12l16 0"></path>
                    <path d="M4 18l16 0"></path>
                </svg>
                <svg class="h-8 w-8 text-muted" x-show="sidebar" x-cloak xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M18 6l-12 12"></path>
                    <path d="M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        {{-- Logo --}}
        <div class="tablet-lg:w-64 tablet-lg:justify-center flex items-center">
            <x-logo bgDark textSize="text-xl tablet:text-2xl" iconSize="w-4 h-4" />
        </div>

        {{-- Profile Dropdown --}}
        {{-- Need to persist the property selector to prevent content flash --}}
        @persist('profile-dropdown')
            <div class="relative shrink-0" x-data="{ profile: false }">
                <button class="p-3" x-on:click="profile = !profile">
                    <img class="h-8 w-8" src="https://ui-avatars.com/api/?size=512&rounded=true&bold=true&color=ffffff&background=2563eb&format=svg&name={{ auth()->user()->full_name() }}" alt="">
                </button>
                <div class="absolute right-0 z-20 -mt-1.5 w-48" x-cloak x-show="profile" x-on:click.away="profile = false" x-transition>
                    <div class="mx-3 overflow-hidden rounded-lg border border-gray-200 bg-white text-sm drop-shadow-xl">
                        <nav class="flex flex-col divide-y divide-gray-200">
                            <a class="flex items-center space-x-3 p-2" href="#" wire:navigate.hover>
                                <svg class="h-5 w-5 text-muted" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                    <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                    <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                                </svg>
                                <span>Your profile</span>
                            </a>
                            <a class="flex items-center space-x-3 p-2" href="#" wire:navigate.hover>
                                <svg class="h-5 w-5 text-muted" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                </svg>
                                <span>Settings</span>
                            </a>
                            <a class="flex items-center space-x-3 p-2" href="{{ route('logout') }}" wire:navigate>
                                <svg class="h-5 w-5 text-muted" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M17 7l-10 10"></path>
                                    <path d="M8 7l9 0l0 9"></path>
                                </svg>
                                <span class="text-red-500">Sign out</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        @endpersist
    </section>

    {{-- Main --}}
    <div class="relative flex h-full overflow-hidden">

        {{-- Overlay --}}
        <div class="tablet-lg:!hidden inset-0 z-20 bg-black/50" x-on:click="sidebar = false" :class="sidebar ? 'absolute' : 'hidden'"></div>

        {{-- Sidebar --}}
        <!-- Sidebar -->
        <section class="hide-scrollbar tablet-lg:!static tablet-lg:!block z-30 h-full w-full flex-none overflow-y-auto bg-gray-800 px-3 py-5 tablet:w-64 tablet:pt-0" :class="sidebar ? 'absolute' : 'hidden'" x-cloak>

            <div class="flex flex-col space-y-8">
                {{-- Property Selector --}}
                {{-- Need to persist the property selector to prevent content flash --}}
                @persist('property-selector')
                    <div class="relative" x-data="{ open: false }">
                        {{-- Active Property --}}
                        <button class="group w-full rounded-lg bg-gray-700/50 p-3 text-left" :class="open ? 'bg-primary' : 'bg-gray-700/50'" x-on:click="open = !open">
                            <span class="flex w-full items-center justify-between">
                                <span class="flex min-w-0 items-center justify-between space-x-3">
                                    <img class="h-10 w-10 shrink-0 rounded-full" src="https://i.imgur.com/cgfopKP_d.jpg?maxwidth=520&shape=thumb&fidelity=high" alt="">
                                    <span class="flex min-w-0 flex-1 flex-col justify-end">
                                        <span class="block truncate text-base font-semibold text-white tablet:text-sm">Ohana Burnside</span>
                                        <span class="block truncate text-sm font-medium text-muted-dark tablet:text-xs" :class="open && '!text-blue-300'">ohana-burnside</span>
                                    </span>
                                </span>
                                <svg class="h-8 w-8 shrink-0 text-muted group-hover:text-white tablet:h-5 tablet:w-5" :class="open && 'text-white'" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M8 9l4 -4l4 4"></path>
                                    <path d="M16 15l-4 4l-4 -4"></path>
                                </svg>
                            </span>
                        </button>

                        {{-- Property List --}}
                        <div class="absolute z-10 mt-3 w-full overflow-hidden rounded-md bg-white text-gray-800 drop-shadow-lg" x-show="open" x-transition x-on:click.away="open = false" x-cloak>
                            <div class="flex max-h-[257px] flex-col divide-y overflow-y-auto">
                                <div class="p-3">
                                    <x-forms.text class="py-2 text-sm" placeholder="Search..." wiremodel="test" />
                                </div>
                                <button class="flex w-full items-center justify-between p-3 text-left hover:bg-gray-100">
                                    <span class="flex min-w-0 items-center justify-between space-x-3">
                                        <img class="h-8 w-8 shrink-0 rounded-full" src="https://i.imgur.com/cgfopKP_d.jpg?maxwidth=520&shape=thumb&fidelity=high" alt="">
                                        <span class="flex min-w-0 flex-1 flex-col">
                                            <span class="truncate text-sm font-semibold">Ohana Burnside</span>
                                            <span class="truncate text-xs leading-3 text-muted">Burnside, KY</span>
                                        </span>
                                    </span>
                                    <svg class="h-8 w-8 shrink-0 text-green-500 group-hover:text-white tablet:h-5 tablet:w-5" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l5 5l10 -10"></path>
                                    </svg>
                                </button>
                                <button class="flex w-full items-center justify-between p-3 text-left hover:bg-gray-100">
                                    <span class="flex min-w-0 items-center justify-between space-x-3">
                                        <img class="h-8 w-8 shrink-0 rounded-full" src="https://i.imgur.com/cgfopKP_d.jpg?maxwidth=520&shape=thumb&fidelity=high" alt="">
                                        <span class="flex min-w-0 flex-1 flex-col">
                                            <span class="truncate text-sm font-semibold">Rimfire Retreat</span>
                                            <span class="truncate text-xs leading-3 text-muted">Lexington, KY</span>
                                        </span>
                                    </span>
                                    {{-- <svg class="w-6 h-6 text-green-500 shrink-0 tablet:w-5 tablet:h-5 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                        </svg> --}}
                                </button>

                            </div>
                        </div>
                    </div>
                @endpersist

                {{-- Navigation --}}
                <nav>
                    <ul class="flex flex-col gap-y-3 font-semibold">
                        <li>
                            <a class="{{ request()->routeIs('host.dashboard') ? 'bg-primary text-white' : '' }} group flex items-center justify-start space-x-3 rounded-md px-3 py-2" href="{{ route('host.dashboard') }}" wire:navigate.hover>
                                <svg class="{{ request()->routeIs('host.dashboard') ? 'text-white' : 'text-muted-dark group-hover:text-primary-light' }} tablet-lg:h-6 tablet-lg:w-6 h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 4h6v8h-6z"></path>
                                    <path d="M4 16h6v4h-6z"></path>
                                    <path d="M14 12h6v8h-6z"></path>
                                    <path d="M14 4h6v4h-6z"></path>
                                </svg>
                                <span class="{{ request()->routeIs('host.dashboard') ? '' : 'text-muted group-hover:text-white' }} tablet-lg:text-base text-lg">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a class="{{ request()->routeIs('host.inbox') ? 'bg-primary text-white' : 'hover:bg-gray-700/50' }} group flex items-center justify-start space-x-3 rounded-md px-3 py-2" href="" wire:navigate.hover>
                                <svg class="{{ request()->routeIs('host.inbox') ? '' : 'text-muted-dark group-hover:text-primary-light' }} tablet-lg:h-6 tablet-lg:w-6 h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
                                    <path d="M3 7l9 6l9 -6"></path>
                                </svg>
                                <span class="{{ request()->routeIs('host.inbox') ? '' : 'text-muted-light group-hover:text-white' }} tablet-lg:text-base text-lg">Inbox</span>
                            </a>
                        </li>
                        <li>
                            <a class="{{ request()->routeIs('host.properties') ? 'bg-primary text-white' : 'hover:bg-gray-700/50' }} group flex items-center justify-start space-x-3 rounded-md px-3 py-2" href="/host/properties" wire:navigate.hover>
                                <svg class="{{ request()->routeIs('host.properties') ? '' : 'text-muted-dark group-hover:text-primary-light' }} tablet-lg:h-6 tablet-lg:w-6 h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8"></path>
                                    <path d="M13 7l0 .01"></path>
                                    <path d="M17 7l0 .01"></path>
                                    <path d="M17 11l0 .01"></path>
                                    <path d="M17 15l0 .01"></path>
                                </svg>
                                <span class="{{ request()->routeIs('host.properties') ? '' : 'text-muted-light group-hover:text-white' }} tablet-lg:text-base text-lg">Properties</span>
                            </a>
                        </li>
                        <li>
                            <a class="{{ request()->routeIs('host.guests') ? 'bg-primary text-white' : 'hover:bg-gray-700/50' }} group flex items-center justify-start space-x-3 rounded-md px-3 py-2" href="" wire:navigate.hover>
                                <svg class="{{ request()->routeIs('host.guests') ? '' : 'text-muted-dark group-hover:text-primary-light' }} tablet-lg:h-6 tablet-lg:w-6 h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                </svg>
                                <span class="{{ request()->routeIs('host.guests') ? '' : 'text-muted-light group-hover:text-white' }} tablet-lg:text-base text-lg">Guests</span>
                            </a>
                        </li>
                        <li>
                            <a class="{{ request()->routeIs('host.settings') ? 'bg-primary text-white' : 'hover:bg-gray-700/50' }} group flex items-center justify-start space-x-3 rounded-md px-3 py-2" href="" wire:navigate.hover>
                                <svg class="{{ request()->routeIs('host.settings') ? '' : 'text-muted-dark group-hover:text-primary-light' }} tablet-lg:h-6 tablet-lg:w-6 h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                </svg>
                                <span class="{{ request()->routeIs('host.settings') ? '' : 'text-muted-light group-hover:text-white' }} tablet-lg:text-base text-lg">Settings</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                {{-- Recent Messages --}}
                <div>
                    <div class="text-xs font-bold uppercase leading-6 text-muted">Unread Messages</div>
                    <ul class="mt-3 space-y-3" role="list">
                        <li>
                            <a class="{{ request()->routeIs('host.inbox') ? 'bg-primary text-white' : 'hover:bg-gray-700/50' }} group flex items-center justify-start space-x-3 rounded-md bg-gray-700/50 px-3 py-2" href="">
                                <span class="relative">
                                    <div class="absolute right-0 top-0 -mr-2 -mt-2 h-4 w-4 animate-ping rounded-full bg-red-500"></div>
                                    <div class="absolute right-0 top-0 -mr-2 -mt-2 h-4 w-4 rounded-full bg-red-500"></div>
                                    <span class="shring-0 flex h-8 w-8 items-center justify-center rounded-md border border-white bg-primary text-[0.6rem] text-white">MH</span>
                                </span>
                                <div class="flex min-w-0 flex-col">
                                    <span class="truncate text-sm font-semibold leading-4 text-white">Marc Hershey</span>
                                    <span class="truncate text-xs text-muted">I wanted to thank you guys for the awesome stay! I hope to see you guys soon!</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="{{ request()->routeIs('host.inbox') ? 'bg-primary text-white' : 'hover:bg-gray-700/50' }} group flex items-center justify-start space-x-3 rounded-md px-3 py-2" href="">
                                <span class="relative">
                                    <div class="absolute right-0 top-0 -mr-1 -mt-1 h-3 w-3 animate-ping rounded-full bg-red-500"></div>
                                    <div class="absolute right-0 top-0 -mr-1 -mt-1 h-3 w-3 rounded-full bg-red-500"></div>
                                    <span class="shring-0 flex h-8 w-8 items-center justify-center rounded-md border border-primary bg-gray-900 text-[0.6rem] text-white">MH</span>
                                </span>
                                <div class="flex min-w-0 flex-col">
                                    <span class="truncate text-sm font-semibold leading-4 text-white">Marc Hershey</span>
                                    <span class="truncate text-xs text-muted">I wanted to thank you guys for the awesome stay! I hope to see you guys soon!</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="{{ request()->routeIs('host.inbox') ? 'bg-primary text-white' : 'hover:bg-gray-700/50' }} group flex items-center justify-start space-x-3 rounded-md px-3 py-2" href="">
                                <span class="relative">
                                    {{-- <div class="absolute top-0 right-0 w-3 h-3 -mt-1 -mr-1 bg-red-500 rounded-full animate-ping"></div> --}}
                                    {{-- <div class="absolute top-0 right-0 w-3 h-3 -mt-1 -mr-1 bg-red-500 rounded-full"></div> --}}
                                    <span class="shring-0 flex h-8 w-8 items-center justify-center rounded-md border border-gray-600 bg-gray-900 text-[0.6rem] text-gray-300">MH</span>
                                </span>
                                <div class="flex min-w-0 flex-col">
                                    <span class="truncate text-sm font-semibold leading-4 text-white">Marc Hershey</span>
                                    <span class="truncate text-xs text-muted">I wanted to thank you guys for the awesome stay! I hope to see you guys soon!</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </section>

        {{-- Content --}}
        <div class="page-container">

            {{-- Page Topbar --}}
            <header class="page-header">
                <h1 class="page-title">Page Title</h1>
                @if ($pageActions)
                    <div>
                        {{ $pageActions }}
                    </div>
                @endif
            </header>

            {{-- Content --}}
            <main class="page-padding w-full flex-1 bg-gray-200 py-8">
                {{ $slot }}
            </main>

            {{-- Footer --}}
            <footer class="page-footer">
                Page Footer
            </footer>
        </div>
    </div>
</div>
