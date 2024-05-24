<section class="mx-auto card card-padding card-flex tablet-sm:max-w-lg" wire:init="load">

    <div class="text-center card-header">
        <h1>Add Your First Listing</h1>
        <p>
            Awesome! Next step is to add a listing property.
        </p>
    </div>

    <form class="form-grid" wire:submit.prevent="submit">
        <x-forms.text class="capitalize" wiremodel="listing_name" label="Listing Name" desc="Give this listing property a name to help identify it to your guests." />
        {{-- <x-forms.select wiremodel="listing_type" label="Listing Type" :options="\App\Models\ListingType::pluck('name', 'id')->toArray()" placeholder="Select a type..." desc="This will help guests understand what type of property this listing is." /> --}}
        <div></div>
        <x-forms.text class="capitalize" wiremodel="listing_street" label="Street Address" />
        <x-forms.text class="capitalize" wiremodel="listing_city" label="City" />
        <div class="!col-span-8">
            <x-forms.select wiremodel="listing_state" label="State" :options="\App\Helpers\GeographyHelper::getStates()" placeholder="Select a state..." />
        </div>
        <div class="!col-span-4">
            <x-forms.text type="tel" wiremodel="listing_zip" label="ZIP Code" placeholder="ZIP Code" />
        </div>
        <div class="form-buttons">
            <button class="button button-full" type="submit" wire:loading.attr="disabled" wire:target="load">Continue</button>
        </div>
    </form>

</section>
