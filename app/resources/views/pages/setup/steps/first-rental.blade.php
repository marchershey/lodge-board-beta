<section class="card card-padding card-flex" wire:init="load">
    <p>
        Now that everything is setup, let's add your first rental property!
    </p>

    <form class="form-grid" wire:submit.prevent="submit">
        <x-forms.text wiremodel="rental_name" label="Rental Name" desc="Give your rental property a name." />
        <x-forms.text class="capitalize" type="text" wiremodel="rental_street" label="Street Address" placeholder="Street Address" desc="This needs to be the actual address, if you need to give your guests a different address, that can be done later." />
        <x-forms.text class="capitalize" type="text" wiremodel="rental_city" label="City" placeholder="City" />
        <div class="!col-span-8">
            <x-forms.select wiremodel="rental_state" label="State" :options="\App\Helpers\GeographyHelper::getStates()" placeholder="State" />
        </div>
        <div class="!col-span-4">
            <x-forms.text type="tel" wiremodel="rental_zip" label="ZIP Code" placeholder="ZIP Code" />
        </div>
        <div class="form-buttons">
            <button class="button button-full" type="submit">Continue</button>
        </div>
    </form>

</section>
