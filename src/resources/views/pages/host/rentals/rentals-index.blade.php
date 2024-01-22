<x-layouts.host>

    <x-slot:pageTitle>Rentals</x-slot:pageTitle>
    <x-slot:pageActions>
        <button class="button button-primary button-md">Hello</button>
    </x-slot:pageActions>

    {{-- Empty State --}}
    <div class="flex flex-col items-center justify-center h-full">
        <svg class="mx-auto w-36 h-36 text-muted-light" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8" />
            <path d="M13 7l0 .01" />
            <path d="M17 7l0 .01" />
            <path d="M17 11l0 .01" />
            <path d="M17 15l0 .01" />
        </svg>
        <h3 class="page-title">No rentals yet...</h3>
        <p class="mt-3 text-sm text-muted">Get stated by adding your first rental property</p>
        <div class="mt-6">
            <a class="button button-primary" href="{{ route('host.rentals.create') }}">
                <svg class="icon icon-tabler icon-tabler-plus" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                </svg>
                Add Rental
            </a>
        </div>
    </div>

</x-layouts.host>
