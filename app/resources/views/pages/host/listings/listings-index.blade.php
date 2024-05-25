<x-layouts.host>

    <x-slot:pageTitle>Your Properties</x-slot:pageTitle>
    <x-slot:pageActions>
        <a class="button button-primary" href="{{ route('host.listings.create') }}" wire:navigate.hover>
            <svg class="icon icon-tabler icons-tabler-outline icon-tabler-plus" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
            </svg>
            Add New Listing
        </a>
    </x-slot:pageActions>

</x-layouts.host>
