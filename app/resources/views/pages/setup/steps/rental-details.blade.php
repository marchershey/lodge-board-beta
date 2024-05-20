<section class="card card-padding card-flex" wire:init="load">
    <p>Great! We need a few more details about {{ $rental->name ?? '...' }}.</p>

    <form class="form-grid" wire:submit.prevent="submit">
        <x-forms.text wiremodel="rental_name" label="Rental Name" desc="Give your rental property a name." />
        <x-forms.text class="capitalize" type="text" wiremodel="rental_street" label="Street Address" placeholder="Street Address" desc="This needs to be the actual address, if you need to give your guests a different address, that can be done later." />
        <x-forms.text class="capitalize" type="text" wiremodel="rental_city" label="City" placeholder="City" />
    </form>
</section>
