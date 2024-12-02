<x-layouts.host>

    <x-slot:pageTitle>Your Properties</x-slot:pageTitle>
    <x-slot:pageActions>
        <flux:button href="{{ route('host.properties.new') }}" size="base" icon="plus" variant="primary" wire:navigate.hover>Add Property</flux:button>
        {{-- <a class="button button-primary" href="{{ route('host.properties.new') }}" wire:navigate.hover>
            <svg class="icon icon-tabler icons-tabler-outline icon-tabler-plus" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
            </svg>
            Add New Property
        </a> --}}
    </x-slot:pageActions>

    <div class="page-content h-full">

        <div class="mt-20 flex flex-col space-y-6 text-center">
            <svg class="size-16 mx-auto text-gray-400/70" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M21 12l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h4.7" />
                <path d="M9 21v-6a2 2 0 0 1 2 -2h2" />
                <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                <path d="M20.2 20.2l1.8 1.8" />
            </svg>

            <div>
                <flux:heading size="xl">No Properties</flux:heading>
                <flux:subheading>Once you add some properties, they will show up here.</flux:subheading>
            </div>
        </div>

    </div>

</x-layouts.host>
