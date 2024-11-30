<div class="max-w-5xl mx-auto tablet-sm:page-padding">
    <div class="flex flex-col items-center space-y-5 tablet-sm:flex-row tablet-sm:space-x-6">
        <div class="flex flex-col flex-1 max-w-sm text-center tablet-sm:max-w-full page-padding tablet-sm:text-left">
            <span class="text-base font-bold uppercase text-primary">Step 1</span>
            <h1 class="text-3xl font-semibold text-gray-800">The Basics</h1>
            <p class="text-sm text-muted tablet:text-base">Share basic details like name, location, guest capacity, and what makes your property special.</p>
        </div>
        <div class="flex flex-col w-full space-y-3 tablet-sm:w-auto">
            <form class="tablet-sm:max-w-lg card card-padding card-flex !space-y-10" wire:submit.prevent="save">

                <div class="form-grid">
                    <div class="tablet-sm:!col-span-6 tablet:!col-span-full laptop:!col-span-9">
                        <x-forms.text class="capitalize" wiremodel="details.name" label="Property Name" desc="Introduce your property to guests with a memorable name." />
                    </div>
                    <div></div>
                    <div></div>
                    <div class="tablet-sm:!col-span-8 tablet:!col-span-full laptop:!col-span-8">
                        <x-forms.text class="capitalize" wiremodel="details.address.street" label="Street Address" />
                    </div>
                    <div class="tablet-sm:!col-span-5 tablet:!col-span-full laptop:!col-span-5">
                        <x-forms.text class="capitalize" wiremodel="details.address.city" label="City" />
                    </div>
                    <div class="tablet-sm:!col-span-5 tablet:!col-span-full laptop:!col-span-5">
                        <x-forms.select wiremodel="details.address.state" label="State" :options="\App\Helpers\GeographyHelper::getStates()" placeholder="Select a state..." />
                    </div>
                    <div class="tablet-sm:!col-span-2 tablet:!col-span-full laptop:!col-span-2">
                        <x-forms.text class="zip-code" type="tel" wiremodel="details.address.zip" label="Zip" placeholder="Zip" />
                    </div>
                </div>
                <div class="flex justify-between">
                    <button class="button button-link text-muted-darker" type="button" wire:click="end">Save & Exit</button>
                    <button class="button button-wide" type="submit">Continue</button>
                </div>
            </form>
            <div class="text-xs italic text-center text-muted">
                At any time you can hit the "Save and Exit" button to come back and finish later.
            </div>
        </div>
    </div>
</div>
