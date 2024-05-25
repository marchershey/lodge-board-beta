<div class="max-w-5xl mx-auto tablet-sm:page-padding" wire:transition.in>
    <div class="flex flex-col items-center space-y-5 tablet-sm:flex-row tablet-sm:space-x-6">
        <div class="flex flex-col flex-1 text-center page-padding tablet-sm:text-left">
            <h1 class="text-3xl font-semibold text-gray-800 tablet:text-4xl">Let's add that property!</h1>
            <p class="text-base text-muted tablet:text-lg">Turn your property into an unforgettable stay!</p>
        </div>
        <div class="flex flex-col space-y-3">
            <form class="w-full tablet-sm:max-w-lg card card-padding card-flex !space-y-10" wire:submit.prevent="start">
                <div class="flex flex-col space-y-8">
                    <div class="grid grid-cols-12">
                        <div class="col-span-2 whitespace-nowrap">
                            <span class="text-lg font-semibold text-primary">Step 1</span>
                        </div>
                        <div class="flex flex-col col-span-10">
                            <span class="text-lg font-semibold">The Basics</span>
                            <span class="text-sm text-muted">Share basic details like name, location, guest capacity, and what makes your property special.</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-12">
                        <div class="col-span-2 whitespace-nowrap">
                            <span class="text-lg font-semibold text-primary">Step 2</span>
                        </div>
                        <div class='flex flex-col col-span-10'>
                            <span class="text-lg font-semibold">Showcase the place</span>
                            <span class="text-sm text-muted">Upload high-quality photos that capture the essence of your property. We recommend including at least 5 photos to give guests a clear idea of what to expect.</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-12">
                        <div class="col-span-2 whitespace-nowrap">
                            <span class="text-lg font-semibold text-primary">Step 3</span>
                        </div>
                        <div class='flex flex-col col-span-10'>
                            <span class="text-lg font-semibold">Set your availability and price</span>
                            <span class="text-sm text-muted">Choose the dates you'd like to rent your property and establish a competitive nightly rate.</span>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between">
                    <a class="text-muted button button-link" href="{{ route('host.properties.index') }}" wire:navigate.hover>Go Back</a>
                    <button class="button button-wide" type="submit">Get Started</button>
                </div>
            </form>
            <div class="text-xs italic text-center text-muted">
                At any time you can hit the "Save and Exit" button to come back and finish later.
            </div>
        </div>
    </div>
</div>
