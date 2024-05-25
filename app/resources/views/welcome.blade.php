<div class="flex flex-col hidden h-full overflow-hidden" x-data="{ sidebar: false }">
    {{-- Topbar --}}
    <section class="flex justify-between bg-gray-800 tablet:mr-3 laptop:mr-5">

        {{-- Mobile Menu Toggle --}}
        <div class="tablet:hidden">
            <button class="p-3" x-on:click="sidebar = !sidebar">
                <svg class="w-8 h-8 text-muted" x-show="!sidebar" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 6l16 0"></path>
                    <path d="M4 12l16 0"></path>
                    <path d="M4 18l16 0"></path>
                </svg>
                <svg class="w-8 h-8 text-muted" x-show="sidebar" x-cloak xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M18 6l-12 12"></path>
                    <path d="M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        {{-- Logo --}}
        <div class="flex items-center tablet:w-64 tablet:justify-center">
            <x-logo bgDark textSize="text-xl tablet-sm:text-2xl" iconSize="w-4 h-4" />
        </div>

        {{-- Profile Dropdown --}}
        {{-- Need to persist the property selector to prevent content flash --}}
        @persist('profile-dropdown')
            <div class="relative shrink-0" x-data="{ profile: false }">
                <button class="p-3" x-on:click="profile = !profile">
                    <img class="w-8 h-8" src="https://ui-avatars.com/api/?size=512&rounded=true&bold=true&color=ffffff&background=2563eb&format=svg&name={{ auth()->user()->full_name() }}" alt="">
                </button>
                <div class="absolute z-20 right-0 w-48 -mt-1.5" x-cloak x-show="profile" x-on:click.away="profile = false" x-transition>
                    <div class="mx-3 overflow-hidden text-sm bg-white border border-gray-200 rounded-lg drop-shadow-xl">
                        <nav class="flex flex-col divide-y divide-gray-200">
                            <a class="flex items-center p-2 space-x-3" href="#" wire:navigate.hover>
                                <svg class="w-5 h-5 text-muted" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                    <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                    <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                                </svg>
                                <span>Your profile</span>
                            </a>
                            <a class="flex items-center p-2 space-x-3" href="#" wire:navigate.hover>
                                <svg class="w-5 h-5 text-muted" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                </svg>
                                <span>Settings</span>
                            </a>
                            <a class="flex items-center p-2 space-x-3" href="{{ route('logout') }}" wire:navigate>
                                <svg class="w-5 h-5 text-muted" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
        <div class="inset-0 z-20 bg-black/50 tablet:!hidden" x-on:click="sidebar = false" :class="sidebar ? 'absolute' : 'hidden'"></div>

        {{-- Sidebar --}}
        <!-- Sidebar -->
        <section class="z-30 flex-none h-full bg-gray-800 w-full tablet-sm:w-64 tablet:!static tablet:!block px-3 py-5 tablet-sm:pt-0 overflow-y-auto hide-scrollbar" :class="sidebar ? 'absolute' : 'hidden'" x-cloak>

            <div class="flex flex-col space-y-8">
                {{-- Property Selector --}}
                {{-- Need to persist the property selector to prevent content flash --}}
                @persist('property-selector')
                    <div class="relative" x-data="{ open: false }">
                        {{-- Active Property --}}
                        <button class="w-full p-3 text-left rounded-lg group bg-gray-700/50" :class="open ? 'bg-primary' : 'bg-gray-700/50'" x-on:click="open = !open">
                            <span class="flex items-center justify-between w-full">
                                <span class="flex items-center justify-between min-w-0 space-x-3">
                                    <img class="w-10 h-10 rounded-full shrink-0" src="https://i.imgur.com/cgfopKP_d.jpg?maxwidth=520&shape=thumb&fidelity=high" alt="">
                                    <span class="flex flex-col justify-end flex-1 min-w-0">
                                        <span class="block text-base font-semibold text-white truncate tablet-sm:text-sm">Ohana Burnside</span>
                                        <span class="block text-sm font-medium truncate tablet-sm:text-xs text-muted-dark" :class="open && '!text-blue-300'">ohana-burnside</span>
                                    </span>
                                </span>
                                <svg class="w-8 h-8 shrink-0 tablet-sm:w-5 tablet-sm:h-5 text-muted group-hover:text-white" :class="open && 'text-white'" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M8 9l4 -4l4 4"></path>
                                    <path d="M16 15l-4 4l-4 -4"></path>
                                </svg>
                            </span>
                        </button>

                        {{-- Property List --}}
                        <div class="absolute z-10 w-full mt-3 overflow-hidden text-gray-800 bg-white rounded-md drop-shadow-lg" x-show="open" x-transition x-on:click.away="open = false" x-cloak>
                            <div class="flex flex-col overflow-y-auto divide-y max-h-[257px]">
                                <div class="p-3">
                                    <x-forms.text class="py-2 text-sm" placeholder="Search..." wiremodel="test" />
                                </div>
                                <button class="flex items-center justify-between w-full p-3 text-left hover:bg-gray-100">
                                    <span class="flex items-center justify-between min-w-0 space-x-3">
                                        <img class="w-8 h-8 rounded-full shrink-0" src="https://i.imgur.com/cgfopKP_d.jpg?maxwidth=520&shape=thumb&fidelity=high" alt="">
                                        <span class="flex flex-col flex-1 min-w-0">
                                            <span class="text-sm font-semibold truncate">Ohana Burnside</span>
                                            <span class="text-xs leading-3 truncate text-muted">Burnside, KY</span>
                                        </span>
                                    </span>
                                    <svg class="w-8 h-8 text-green-500 shrink-0 tablet-sm:w-5 tablet-sm:h-5 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l5 5l10 -10"></path>
                                    </svg>
                                </button>
                                <button class="flex items-center justify-between w-full p-3 text-left hover:bg-gray-100">
                                    <span class="flex items-center justify-between min-w-0 space-x-3">
                                        <img class="w-8 h-8 rounded-full shrink-0" src="https://i.imgur.com/cgfopKP_d.jpg?maxwidth=520&shape=thumb&fidelity=high" alt="">
                                        <span class="flex flex-col flex-1 min-w-0">
                                            <span class="text-sm font-semibold truncate">Rimfire Retreat</span>
                                            <span class="text-xs leading-3 truncate text-muted">Lexington, KY</span>
                                        </span>
                                    </span>
                                    {{-- <svg class="w-6 h-6 text-green-500 shrink-0 tablet-sm:w-5 tablet-sm:h-5 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                    <ul class="flex flex-col font-semibold gap-y-3">
                        <li>
                            <a class="flex items-center justify-start px-3 py-2 space-x-3 rounded-md group {{ request()->routeIs('host.dashboard') ? 'bg-primary text-white' : '' }}" href="{{ route('host.dashboard') }}" wire:navigate.hover>
                                <svg class="w-8 h-8 tablet:w-6 tablet:h-6 {{ request()->routeIs('host.dashboard') ? 'text-white' : 'text-muted-dark group-hover:text-primary-light' }}" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 4h6v8h-6z"></path>
                                    <path d="M4 16h6v4h-6z"></path>
                                    <path d="M14 12h6v8h-6z"></path>
                                    <path d="M14 4h6v4h-6z"></path>
                                </svg>
                                <span class="text-lg tablet:text-base {{ request()->routeIs('host.dashboard') ? '' : 'text-muted group-hover:text-white' }}">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center justify-start px-3 py-2 space-x-3 rounded-md group {{ request()->routeIs('host.inbox') ? 'bg-primary text-white' : 'hover:bg-gray-700/50' }}" href="" wire:navigate.hover>
                                <svg class="w-8 h-8 tablet:w-6 tablet:h-6 {{ request()->routeIs('host.inbox') ? '' : 'text-muted-dark group-hover:text-primary-light' }}" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
                                    <path d="M3 7l9 6l9 -6"></path>
                                </svg>
                                <span class="text-lg tablet:text-base {{ request()->routeIs('host.inbox') ? '' : 'text-muted-light group-hover:text-white' }}">Inbox</span>
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center justify-start px-3 py-2 space-x-3 rounded-md group {{ request()->routeIs('host.properties') ? 'bg-primary text-white' : 'hover:bg-gray-700/50' }}" href="/host/properties" wire:navigate.hover>
                                <svg class="w-8 h-8 tablet:w-6 tablet:h-6 {{ request()->routeIs('host.properties') ? '' : 'text-muted-dark group-hover:text-primary-light' }}" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8"></path>
                                    <path d="M13 7l0 .01"></path>
                                    <path d="M17 7l0 .01"></path>
                                    <path d="M17 11l0 .01"></path>
                                    <path d="M17 15l0 .01"></path>
                                </svg>
                                <span class="text-lg tablet:text-base {{ request()->routeIs('host.properties') ? '' : 'text-muted-light group-hover:text-white' }}">Properties</span>
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center justify-start px-3 py-2 space-x-3 rounded-md group {{ request()->routeIs('host.guests') ? 'bg-primary text-white' : 'hover:bg-gray-700/50' }}" href="" wire:navigate.hover>
                                <svg class="w-8 h-8 tablet:w-6 tablet:h-6 {{ request()->routeIs('host.guests') ? '' : 'text-muted-dark group-hover:text-primary-light' }}" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                </svg>
                                <span class="text-lg tablet:text-base {{ request()->routeIs('host.guests') ? '' : 'text-muted-light group-hover:text-white' }}">Guests</span>
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center justify-start px-3 py-2 space-x-3 rounded-md group {{ request()->routeIs('host.settings') ? 'bg-primary text-white' : 'hover:bg-gray-700/50' }}" href="" wire:navigate.hover>
                                <svg class="w-8 h-8 tablet:w-6 tablet:h-6 {{ request()->routeIs('host.settings') ? '' : 'text-muted-dark group-hover:text-primary-light' }}" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                </svg>
                                <span class="text-lg tablet:text-base {{ request()->routeIs('host.settings') ? '' : 'text-muted-light group-hover:text-white' }}">Settings</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                {{-- Recent Messages --}}
                <div>
                    <div class="text-xs font-bold leading-6 tracking-wide uppercase text-muted">Unread Messages</div>
                    <ul class="mt-3 space-y-3" role="list">
                        <li>
                            <a class="flex items-center justify-start px-3 py-2 space-x-3 rounded-md group bg-gray-700/50 {{ request()->routeIs('host.inbox') ? 'bg-primary text-white' : 'hover:bg-gray-700/50' }}" href="">
                                <span class="relative">
                                    <div class="absolute top-0 right-0 w-4 h-4 -mt-2 -mr-2 bg-red-500 rounded-full animate-ping"></div>
                                    <div class="absolute top-0 right-0 w-4 h-4 -mt-2 -mr-2 bg-red-500 rounded-full"></div>
                                    <span class="flex items-center justify-center w-8 h-8 bg-primary border border-white text-white rounded-md shring-0 text-[0.6rem]">MH</span>
                                </span>
                                <div class="flex flex-col min-w-0">
                                    <span class="text-sm font-semibold leading-4 text-white truncate">Marc Hershey</span>
                                    <span class="text-xs truncate text-muted">I wanted to thank you guys for the awesome stay! I hope to see you guys soon!</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center justify-start px-3 py-2 space-x-3 rounded-md group {{ request()->routeIs('host.inbox') ? 'bg-primary text-white' : 'hover:bg-gray-700/50' }}" href="">
                                <span class="relative">
                                    <div class="absolute top-0 right-0 w-3 h-3 -mt-1 -mr-1 bg-red-500 rounded-full animate-ping"></div>
                                    <div class="absolute top-0 right-0 w-3 h-3 -mt-1 -mr-1 bg-red-500 rounded-full"></div>
                                    <span class="flex items-center justify-center w-8 h-8 bg-gray-900 border text-white border-primary rounded-md shring-0 text-[0.6rem]">MH</span>
                                </span>
                                <div class="flex flex-col min-w-0">
                                    <span class="text-sm font-semibold leading-4 text-white truncate">Marc Hershey</span>
                                    <span class="text-xs truncate text-muted">I wanted to thank you guys for the awesome stay! I hope to see you guys soon!</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center justify-start px-3 py-2 space-x-3 rounded-md group {{ request()->routeIs('host.inbox') ? 'bg-primary text-white' : 'hover:bg-gray-700/50' }}" href="">
                                <span class="relative">
                                    {{-- <div class="absolute top-0 right-0 w-3 h-3 -mt-1 -mr-1 bg-red-500 rounded-full animate-ping"></div> --}}
                                    {{-- <div class="absolute top-0 right-0 w-3 h-3 -mt-1 -mr-1 bg-red-500 rounded-full"></div> --}}
                                    <span class="flex items-center text-gray-300 justify-center w-8 h-8 bg-gray-900 border border-gray-600 rounded-md shring-0 text-[0.6rem]">MH</span>
                                </span>
                                <div class="flex flex-col min-w-0">
                                    <span class="text-sm font-semibold leading-4 text-white truncate">Marc Hershey</span>
                                    <span class="text-xs truncate text-muted">I wanted to thank you guys for the awesome stay! I hope to see you guys soon!</span>
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
            <main class="flex-1 w-full py-8 bg-gray-200 page-padding ">
                {{ $slot }}
            </main>

            {{-- Footer --}}
            <footer class="page-footer">
                Page Footer
            </footer>
        </div>
    </div>
</div>
