<div wire:init="load">
    <form class="card card-padding card-flex" wire:submit.prevent="submit">
        <div class="card-header">
            <h1>First Rental</h1>
            <p>Now let's add your very first rental.</p>
        </div>
        <div class="card-form">
            <x-forms.text class="capitalize" type="text" wiremodel="rental_name" label="Rental Name" desc="Give this rental property a name." placeholder="Ohana Burnside" />
        </div>
        <div class="card-header">
            <h1>Rental Address</h1>
            <p>This is the address that will be given to guests.</p>
        </div>
        <div class="card-form">
            <x-forms.text class="capitalize" type="text" wiremodel="rental_street" label="Street Address" placeholder="23 S Highland Dr" />
            <x-forms.text class="capitalize" type="text" wiremodel="rental_city" label="City" placeholder="Burnside" />
            <div class="!col-span-8">
                <x-forms.select wiremodel="rental_state" label="State" :options="\App\Helpers\GeographyHelper::getStates()" placeholder="Kentucky" />
            </div>
            <div class="!col-span-4">
                <x-forms.text type="tel" wiremodel="rental_zip" label="Zip" placeholder="42519" />
            </div>
        </div>
        <div>
            <button class="w-full mt-4 button button-primary button-xl" type="submit">
                <x-spinner wiretarget="submit" />
                Continue
            </button>
        </div>
    </form>
</div>
