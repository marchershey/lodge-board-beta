@props(['pageTitle' => false, 'pageActions' => false])

<div class="flex flex-col flex-1" x-data="{ sidebar: false }">
    {{-- Topbar --}}
    <div class="flex-none py-1 shadow-xl">
        <div class="flex justify-between">
            {{-- Menu Button --}}
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
            <div class="flex items-center tablet:min-w-80 tablet:justify-center">
                <a href="{{ route('host.dashboard') }}" wire:navigate>
                    <x-logo bgDark textSize="text-xl tablet-sm:text-2xl" iconSize="w-4 h-4" />
                </a>
            </div>

            {{-- Profile Dropdown --}}
            {{-- Need to persist the profile dropdown to prevent content flash --}}
            @persist('profile-dropdown')
                <div class="relative z-40 shrink-0" x-data="{ profile: false }">
                    <button class="p-3" x-on:click="profile = !profile">
                        <img class="w-8 h-8" src="https://ui-avatars.com/api/?size=512&rounded=true&bold=true&color=ffffff&background=2563eb&format=svg&name={{ auth()->user()->full_name() }}" alt="">
                    </button>
                    <div class="absolute z-40 right-0 w-64 -mt-1.5" x-cloak x-show="profile" x-on:click.away="profile = false" x-transition>
                        <div class="mx-3 overflow-hidden bg-white border border-gray-200 rounded-lg drop-shadow-xl">
                            <nav class="flex flex-col divide-y divide-gray-200">
                                <a class="flex items-center p-2 space-x-3" href="#" wire:navigate.hover>
                                    <svg class="w-5 h-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                        <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                        <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                                    </svg>
                                    <span>Your profile</span>
                                </a>
                                <a class="flex items-center p-2 space-x-3" href="#" wire:navigate.hover>
                                    <svg class="w-5 h-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                    </svg>
                                    <span>Settings</span>
                                </a>
                                <a class="flex items-center p-2 space-x-3" href="{{ route('logout') }}" wire:navigate>
                                    <svg class="w-5 h-5 -ml-0.5 mr-0.5 text-gray-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                                        <path d="M15 12h-12l3 -3" />
                                        <path d="M6 15l-3 -3" />
                                    </svg>
                                    <span class="text-red-500">Sign out</span>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            @endpersist
        </div>
    </div>

    {{-- Container --}}
    <div class="relative flex w-full h-full overflow-hidden bg-gray-800">

        {{-- Mobile Sidebar Overlay --}}
        <div class="absolute inset-0 z-10 animate-in fade-in bg-gray-800/60 tablet:hidden" x-show="sidebar" x-cloak x-on:click="sidebar = false"></div>

        {{-- Sidebar --}}
        <div class="fixed z-20 hidden w-auto h-full -mt-1 duration-500 animate-in slide-in-from-left tablet:animate-none tablet:static tablet:flex tablet:flex-none" :class="sidebar ? '!flex' : 'hidden'">
            <div class="flex flex-col pt-1 space-y-5 bg-gray-800 w-80">

                {{-- Listing Selector --}}
                <div class="relative inline-block px-3" x-data="{ open: false }">
                    <div>
                        <button class="w-full p-2 bg-gray-800 border border-gray-800 rounded-lg group hover:bg-gray-700" id="listings-selector-button" type="button" aria-expanded="false" aria-haspopup="true" x-on:click="open = !open" :class="open ? 'bg-gray-700' : 'bg-gray-800'">
                            <span class="flex items-center justify-between w-full">
                                <span class="flex items-center justify-between min-w-0 space-x-3">
                                    <img class="flex-shrink-0 w-10 h-10 bg-gray-300 rounded-full" src="https://i.imgur.com/wAy4vKv.png" alt="">
                                    <span class="flex flex-col flex-1 min-w-0 text-left">
                                        <span class="text-base font-medium text-white truncate">Ohana Burnside</span>
                                        <span class="text-xs truncate text-muted">Burnside, KY</span>
                                    </span>
                                </span>
                                <svg class="flex-shrink-0 w-5 h-5 text-muted group-hover:text-white" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </button>
                    </div>

                    {{-- Listing List --}}
                    <div class="absolute left-0 right-0 z-10 mx-3 mt-3 overflow-hidden origin-top bg-white divide-y divide-gray-200 rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu-button" tabindex="-1" x-transition x-on:click.away="open = false" x-show="open" x-cloak>
                        <a class="flex w-full px-2 py-3 group hover:bg-muted-lightest" id="listings-selector-button" href="#">
                            <span class="flex items-center justify-between w-full">
                                <span class="flex items-center justify-between min-w-0 space-x-3">
                                    <img class="flex-shrink-0 w-10 h-10 bg-gray-300 rounded-full ring-1 ring-gray-400" src="https://i.imgur.com/wAy4vKv.png" alt="">
                                    <span class="flex flex-col flex-1 min-w-0 text-left">
                                        <span class="text-base font-medium leading-5 truncate">Ohana Burnside</span>
                                        <span class="text-xs truncate text-muted">Burnside, KY</span>
                                    </span>
                                </span>
                                <svg class="flex-shrink-0 w-5 h-5 text-muted group-hover:text-green-600 group-hover:block" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 12l5 5l10 -10" />
                                </svg>
                            </span>
                        </a>
                        <a class="flex w-full px-2 py-3 group hover:bg-muted-lightest" id="listings-selector-button" href="#">
                            <span class="flex items-center justify-between w-full">
                                <span class="flex items-center justify-between min-w-0 space-x-3">
                                    <img class="flex-shrink-0 w-10 h-10 bg-gray-300 rounded-full ring-1 ring-gray-400" src="https://i.imgur.com/wAy4vKv.png" alt="">
                                    <span class="flex flex-col flex-1 min-w-0 text-left">
                                        <span class="text-base font-medium leading-5 truncate">Ohana Burnside</span>
                                        <span class="text-xs truncate text-muted">Burnside, KY</span>
                                    </span>
                                </span>
                                <svg class="flex-shrink-0 hidden w-5 h-5 text-muted-dark group-hover:text-green-600 group-hover:block" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 12l5 5l10 -10" />
                                </svg>
                            </span>
                        </a>
                        <a class="flex w-full px-2 py-3 group hover:bg-muted-lightest" id="listings-selector-button" href="#">
                            <span class="flex items-center justify-between w-full">
                                <span class="flex items-center justify-between min-w-0 space-x-3">
                                    <img class="flex-shrink-0 w-10 h-10 bg-gray-300 rounded-full ring-1 ring-gray-400" src="https://i.imgur.com/wAy4vKv.png" alt="">
                                    <span class="flex flex-col flex-1 min-w-0 text-left">
                                        <span class="text-base font-medium leading-5 truncate">Ohana Burnside</span>
                                        <span class="text-xs truncate text-muted">Burnside, KY</span>
                                    </span>
                                </span>
                                <svg class="flex-shrink-0 hidden w-5 h-5 text-muted-dark group-hover:text-green-600 group-hover:block" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 12l5 5l10 -10" />
                                </svg>
                            </span>
                        </a>
                        <a class="flex w-full px-2 py-2 group hover:bg-muted-lightest" id="listings-selector-button" href="#">
                            <span class="flex items-center justify-between min-w-0 space-x-3">

                                <div class="flex items-center justify-center w-10 h-10">
                                    <div class="flex items-center justify-center w-10 h-10 p-2 bg-gray-100 rounded-full group-hover:bg-primary ring-1 ring-gray-300 group-hover:ring-primary group-hover:shadow-lg">
                                        <svg class="text-gray-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M19 12h2l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h5.5" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2" />
                                            <path d="M16 19h6" />
                                            <path d="M19 16v6" />
                                        </svg>
                                    </div>
                                </div>
                                <span class="flex flex-col flex-1 min-w-0 text-left">
                                    <span class="flex flex-col flex-1 min-w-0 text-left">
                                        <span class="text-base font-medium leading-5 truncate">Add Listing</span>
                                        <span class="text-xs truncate text-muted">Add a new listing property...</span>
                                    </span>
                                    {{-- <span class="text-sm font-medium leading-5 truncate text-muted group-hover:text-primary">Add New Property</span> --}}
                                </span>
                            </span>
                        </a>
                    </div>
                </div>

                {{-- Navigation --}}
                <nav class="flex flex-col flex-1 px-3">
                    <ul class="flex flex-col space-y-2 text-gray-400">
                        <li class="">
                            <a class="flex items-center p-2 space-x-4 bg-gray-800 rounded-lg hover:bg-gray-700 group" href="{{ route('host.dashboard') }}" wire:navigate.hover>
                                <svg class="w-7 h-7 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                                <span class="mt-px text-lg font-medium leading-4 group-hover:text-white">Dashboard</span>
                            </a>
                        </li>
                        <li class="">
                            <a class="flex items-center p-2 space-x-4 bg-gray-800 rounded-lg hover:bg-gray-700 group" href="{{ route('host.dashboard') }}" wire:navigate.hover>
                                <svg class="w-7 h-7 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                    <path d="M16 3v4" />
                                    <path d="M8 3v4" />
                                    <path d="M4 11h16" />
                                    <path d="M11 15h1" />
                                    <path d="M12 15v3" />
                                </svg>
                                <span class="mt-px text-lg font-medium leading-4 group-hover:text-white">Calendar</span>
                            </a>
                        </li>
                        <li class="">
                            <a class="flex items-center p-2 space-x-4 bg-gray-800 rounded-lg hover:bg-gray-700 group" href="{{ route('host.listings.index') }}" wire:navigate.hover>
                                <svg class="w-7 h-7 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8" />
                                    <path d="M13 7l0 .01" />
                                    <path d="M17 7l0 .01" />
                                    <path d="M17 11l0 .01" />
                                    <path d="M17 15l0 .01" />
                                </svg>
                                <span class="mt-px text-lg font-medium leading-4 group-hover:text-white">Listings</span>
                            </a>
                        </li>
                        <li class="">
                            <a class="flex items-center p-2 space-x-4 bg-gray-800 rounded-lg hover:bg-gray-700 group" href="{{ route('host.settings.index') }}" wire:navigate.hover>
                                <svg class="w-7 h-7 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                </svg>
                                <span class="mt-px text-lg font-medium leading-4 group-hover:text-white">Settings</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>

        {{-- Content --}}
        <div class="w-full h-full overflow-hidden bg-gray-800 rounded-none tablet:rounded-tl-2xl">
            <div class="flex flex-col h-full overflow-y-auto bg-gray-200">

                {{-- Banner --}}
                <div class="sticky top-0 z-10 flex-none">
                    <livewire:components.banner location="host" />
                </div>

                {{-- Content Container --}}
                <div class="page-container">
                    <div class="page-header">
                        <div class="container flex items-center justify-between page-x-padding">
                            <h1 class="page-title">{{ $pageTitle }}</h1>
                            <div class="page-actions">
                                {{ $pageActions }}
                            </div>
                        </div>
                    </div>

                    <div class="container relative">
                        {{ $slot }}
                    </div>
                </div>

                {{-- Footer --}}
                <div class="flex-none">
                    <x-layouts.footer />
                </div>
            </div>
        </div>
    </div>
</div>
