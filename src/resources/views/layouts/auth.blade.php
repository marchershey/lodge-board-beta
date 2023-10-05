<x-layouts.app title="{{ $title }}">

    <div class="flex flex-col justify-center py-12 space-y-12 tablet:py-24">

        <div class="mx-auto">
            <x-logo dark />
        </div>

        <div class="mx-auto">
            <h1 class="text-2xl font-bold">{{ $text }}</h1>
        </div>

        <div class="sm:w-full tablet:mx-auto tablet:max-w-screen-phone">
            <div class="card-container">
                <div class="card card-padding">
                    {{ $slot }}
                </div>
            </div>
        </div>

    </div>

</x-layouts.app>
