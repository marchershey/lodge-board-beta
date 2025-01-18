<x-layouts.host>

    <div>
        <x-slot:page-title>
            <div class="flex items-center space-x-4">
                {{-- <div class="w-8 h-8 overflow-hidden bg-gray-100 rounded-lg">
                    <img class="object-cover aspect-square" src="/{{ $property->photos()->first()->path }}" alt="">
                </div> --}}
                <div class="flex flex-col">
                    <span>
                        {{ $property->name }}
                    </span>
                </div>
            </div>
        </x-slot:page-title>
        <x-slot:page-actions>
            <flux:button href="{{ route('host.properties.index') }}" size="base" icon="undo-2" variant="ghost" wire:navigate.hover>Go Back</flux:button>
        </x-slot:page-actions>

        <div>
            <flux:tab.group>
                <div class="p-4 overflow-hidden rounded-xl card">
                    <flux:tabs class="overflow-x-auto overflow-y-hidden hide-scrollbar" wire:model.live="tab">
                        <flux:tab class="px-2" name="overview" icon="chart-column">Overview</flux:tab>
                        <flux:tab class="px-2" name="details" icon="map-pin-house">Details</flux:tab>
                        <flux:tab class="px-2" name="listing" icon="panels-top-left">Listing</flux:tab>
                        <flux:tab class="px-2" name="rates" icon="banknotes">Rates & Fees</flux:tab>
                        <flux:tab class="px-2" name="photos" icon="photo">Photos</flux:tab>
                        <flux:tab class="px-2" name="settings" icon="cog">Settings</flux:tab>
                    </flux:tabs>
                </div>

                <flux:tab.panel name="overview">

                    <div class="text-center">
                        Nothing to see here yet.
                    </div>

                </flux:tab.panel>
                <flux:tab.panel name="details">
                    <livewire:pages.host.properties.view-property-details :property="$property" @property-updated="$refresh" />
                </flux:tab.panel>
                <flux:tab.panel name="listing">
                    <livewire:pages.host.properties.view-property-listing :property="$property" @property-updated="$refresh" />
                </flux:tab.panel>
                <flux:tab.panel name="rates">
                    <flux:card>rates</flux:card>
                </flux:tab.panel>
                <flux:tab.panel name="photos">
                    <flux:card>photos</flux:card>
                </flux:tab.panel>
                <flux:tab.panel name="settings">
                    <flux:card>settings</flux:card>
                </flux:tab.panel>
            </flux:tab.group>
        </div>
    </div>

</x-layouts.host>
