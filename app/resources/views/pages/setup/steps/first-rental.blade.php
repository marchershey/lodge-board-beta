<div wire:init="load" wire:loading.class="opacity-50 pointer-events-none" wire:target="submit">
    <form class="card card-padding card-flex" wire:submit.prevent="submit">
        <div class="card-header">
            <h1>First Rental</h1>
            <p>Next, let's add your first rental property.</p>
        </div>
        <div class="card-form">
            <x-forms.text wiremodel="rental_name" label="Rental Name" desc="Give your rental property a name." />
            <div class="card-form-space"></div>
            <x-forms.text class="capitalize" type="text" wiremodel="rental_street" label="Street Address" placeholder="Street Address" />
            <x-forms.text class="capitalize" type="text" wiremodel="rental_city" label="City" placeholder="City" />
            <div class="!col-span-8">
                <x-forms.select wiremodel="rental_state" label="State" :options="\App\Helpers\GeographyHelper::getStates()" placeholder="State" />
            </div>
            <div class="!col-span-4">
                <x-forms.text type="tel" wiremodel="rental_zip" label="ZIP Code" placeholder="ZIP Code" />
            </div>
        </div>
        <div class="justify-between space-x-4 card-buttons">
            <button class="button button-full button-lg" type="submit">Continue</button>
        </div>
    </form>

    <div class="card-padding-sm flex-center">
        <button class="font-medium link text-muted-darker" type="button" @click="$dispatch('prev-step')">Go Back</button>
    </div>

</div>
