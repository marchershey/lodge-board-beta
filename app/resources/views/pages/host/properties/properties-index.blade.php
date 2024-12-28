<x-layouts.host>

    <x-slot:page-title>Your Properties</x-slot:page-title>
    <x-slot:page-actions>
        <flux:button href="{{ route('host.properties.new') }}" size="base" icon="plus" variant="ghost" wire:navigate.hover>Add Property</flux:button>
    </x-slot:page-actions>

    <div class="h-full page-content">

        @if ($loading)
            <div class="grid grid-cols-1 gap-6 animate-pulse">
                <div class="bg-gray-300 rounded-xl aspect-square"></div>
                <div class="bg-gray-300 rounded-xl aspect-square"></div>
                <div class="bg-gray-300 rounded-xl aspect-square"></div>
                <div class="bg-gray-300 rounded-xl aspect-square"></div>
                <div class="bg-gray-300/50 rounded-xl aspect-square"></div>
                <div class="bg-gray-300/50 rounded-xl aspect-square"></div>
                <div class="bg-gray-300/50 rounded-xl aspect-square"></div>
                <div class="bg-gray-300/50 rounded-xl aspect-square"></div>
                <div class="bg-gray-300/20 rounded-xl aspect-square"></div>
                <div class="bg-gray-300/20 rounded-xl aspect-square"></div>
                <div class="bg-gray-300/20 rounded-xl aspect-square"></div>
                <div class="bg-gray-300/20 rounded-xl aspect-square"></div>
            </div>
        @else
            @if (count($properties) > 0)
                <ul class="grid grid-cols-1 gap-6 tablet:grid-cols-2 desktop:grid-cols-3">
                    @foreach ($properties as $property)
                        <div>
                            <flux:card class="overflow-hidden group">
                                <a href="{{ route('host.properties.view', $property->slug) }}" wire:navigate.hover>
                                    <li class="relative space-y-6">
                                        <div class="-mx-6 -mt-6 overflow-hidden bg-black cursor-pointer focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                            <img class="group-hover:scale-110 duration-700 group-hover:brightness-125 transition pointer-events-none aspect-[10/7] object-cover" src="/{{ $property->photos()->first()->path }}" alt="">
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <flux:heading class="!mb-0" size="lg">{{ $property->name }}</flux:heading>
                                                <flux:subheading>{{ $property->address_city }}, {{ $property->address_state }}</flux:subheading>
                                            </div>
                                            <div>
                                                <flux:dropdown align="end">
                                                    <flux:button icon="ellipsis-vertical" />

                                                    <flux:menu>
                                                        <flux:menu.item>View</flux:menu.item>

                                                        <flux:menu.separator />

                                                        <flux:menu.submenu heading="Visiblity">
                                                            <flux:menu.radio.group>
                                                                <flux:menu.radio checked>Public</flux:menu.radio>
                                                                <flux:menu.radio>Unlisted</flux:menu.radio>
                                                                <flux:menu.radio>Private</flux:menu.radio>
                                                            </flux:menu.radio.group>
                                                        </flux:menu.submenu>

                                                        <flux:menu.separator />

                                                        <flux:modal.trigger name="archive-property-{{ $property->id }}">
                                                            <flux:menu.item variant="danger">Archive</flux:menu.item>
                                                        </flux:modal.trigger>
                                                    </flux:menu>
                                                </flux:dropdown>
                                            </div>
                                        </div>
                                    </li>
                                </a>
                            </flux:card>

                            <flux:modal class="min-w-[22rem] w-full space-y-6" name="archive-property-{{ $property->id }}">
                                <div class="space-y-2">
                                    <flux:heading size="lg">Archive {{ $property->name }}?</flux:heading>
                                    <flux:subheading class="space-y-4">
                                        <p>Before archiving {{ $property->name }}, please read this to avoid any unexpected consequences.</p>
                                        <flux:badge color="red" size="lg">Unexpected bad things will happen if you don’t read this!</flux:badge>
                                        <ul class="list-disc list-inside">
                                            <li class="font-bold">All active and pending reservations will be <strong class="text-red-500">CANCELLED</strong>.</li>
                                            <li class="font-bold">Guests who have any active or pending reservations will be <strong class="text-red-500">REFUNDED</strong>.</li>
                                            <li>Guests who have any active or pending reservations will be notified via email that their reservation was cancelled.</li>
                                            <li>A list of active and pending reservations for this property is shown below.</li>
                                            <li>You can reactivate this property at any time.</li>
                                        </ul>
                                        <flux:separator></flux:separator>
                                        <div>
                                            <flux:label>Active Reservations</flux:label>
                                            <flux:description>
                                                Good news! It doesn't look like there are any active or pending reservations for this property at this time.
                                            </flux:description>
                                        </div>
                                    </flux:subheading>
                                </div>

                                <div class="flex justify-between gap-2">
                                    <flux:button class="w-full" variant="danger" wire:click="archiveProperty({{ $property->id }})" wire:confirm.prompt="To confirm you want to archive {{ $property->name }}, please type in the name of the property below.\n\nType &quot;{{ $property->name }}&quot; in the box below: (case sensitive)|{{ $property->name }}">I want to archive {{ $property->name }}</flux:button>
                                </div>
                            </flux:modal>
                        </div>
                    @endforeach
                </ul>
            @else
                <div class="flex flex-col mt-20 space-y-6 text-center">
                    <svg class="mx-auto size-24 opacity-20" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M21 12l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h4.7" />
                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2" />
                        <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M20.2 20.2l1.8 1.8" />
                    </svg>
                    <div>
                        <flux:heading size="lg">No properties found</flux:heading>
                        <flux:subheading>Properties will be displayed here after you add them.</flux:subheading>
                    </div>
                </div>
            @endif
        @endif
    </div>

</x-layouts.host>
