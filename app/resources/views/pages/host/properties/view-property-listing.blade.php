<div class="space-y-6">
    <div>
        <flux:heading size="lg">Property Listing</flux:heading>
        <flux:subheading>The following information will be displayed on the property's listing page
        </flux:subheading>
    </div>

    {{-- Headline & Description --}}
    <flux:input class="max-w-sm capitalize" wire:model.blur="form.listing_headline" label="Listing Headline" placeholder="An amazing summer getaway!" required />
    <div>
        <flux:editor class="ring-black focus-within:ring-2" wire:model.live.debounce.1s="form.listing_description" toolbar="heading | bold italic strike underline | bullet ordered blockquote | link ~ undo redo" label="Listing Description" required />
        <div class="flex items-center justify-between mt-1 text-xs text-right text-muted">
            <div>
                <span :class="{
                    'text-yellow-500': $wire.form.listing_description.length > 2900,
                    '!text-green-600': $wire
                        .form.listing_description.length == 3000,
                    '!text-red-500': $wire.form
                        .listing_description.length > 3000
                }" x-text="$wire.form.listing_description.length">
                    0
                </span>
                <span>
                    / 3,000 (includes HTML)
                </span>
            </div>
            <flux:tooltip content="You can use Markdown Syntax as well!">
                <div class="flex items-center space-x-2 cursor-help">
                    <span>
                        Try using markdown syntax
                    </span>
                    <flux:icon.circle-help class="size-4" />
                </div>
            </flux:tooltip>
        </div>
    </div>

    <flux:separator />

    {{-- Property type --}}
    <div>
        <flux:select class="max-w-72" wire:model.change="form.property_type" label="Type of Property" variant="listbox" searchable placeholder="Select the type of property..." required>
            @foreach (\App\Models\PropertyType::all() as $type)
                <flux:option value="{{ $type['id'] }}" wire:key="country-{{ $type['id'] }}">
                    {{ $type['name'] }}</flux:option>
            @endforeach
        </flux:select>
    </div>

    <flux:separator />

    {{-- Anemities --}}
    <div class="space-y-6">
        <div class="space-y-3">
            <flux:heading>Amenities</flux:heading>
            {{--
                        For some reason, you can't add a red error border/ring around buttons using @error.
                        Come back to this at a later date and try to figure out how to emphasize the button
                        below when there is an error with amenities.
                    --}}
            <div class="flex items-center justify-between space-x-4">

                <flux:button icon="plus" wire:click="openAmenitiesModal">Select amenities</flux:button>

                @if ($form->amenities)
                    <div>
                        <flux:modal.trigger name="clear-amenities-modal">
                            <flux:button class="!text-red-500" icon="trash" size="sm" variant="ghost">Clear all</flux:button>
                        </flux:modal.trigger>
                        <flux:modal class="min-w-[22rem] space-y-6" name="clear-amenities-modal">
                            <flux:heading size="lg">Are you sure?</flux:heading>
                            <flux:subheading>
                                <p>You're about to <span class="font-bold">remove</span> all amenities.</p>
                                <p class="font-bold text-red-500">This action cannot be reversed.</p>
                            </flux:subheading>
                            <div class="flex gap-4">
                                <flux:spacer />
                                <flux:modal.close>
                                    <flux:button variant="ghost">Nevermind</flux:button>
                                </flux:modal.close>
                                <flux:button wire:click="clearAmenities" variant="danger">Yes, I'm sure</flux:button>
                            </div>
                        </flux:modal>
                    </div>
                @endif
            </div>
            <flux:error name="form.amenities" />
            <flux:error name="form.amenities.*" />
            <flux:error name="selected_amenities" />
            <flux:error name="selected_amenities.*" />
        </div>

        {{-- Amenity Badges --}}
        @if (!is_null($form->amenities) && count($form->amenities) > 0)
            <div class="flex flex-wrap gap-2" wire:loading.class="opacity-50 pointer-events-none select-none" wire:target="openAmenitiesModal, saveAmenityChanges, removeAmenity, clearAmenities">
                @foreach ($form->amenities as $amenity)
                    <div wire:key="amenity-{{ $amenity->id }}" wire:loading.remove wire:target="removeAmenity({{ $amenity->id }})">
                        <flux:badge size="sm">
                            {{ $amenity->name }}
                            <flux:badge.close wire:click="removeAmenity({{ $amenity->id }})" />
                        </flux:badge>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Amenities modal --}}
        {{-- <flux:modal class="max-h-[50rem] w-[90%] max-w-sm space-y-6" name="amenities-modal"> --}}
        <flux:modal class="tablet:max-h-[50rem] h-[90%] max-w-md w-[90%] space-y-8" name="amenities-modal">
            <div>
                <flux:legend>Select amenities</flux:legend>
                <flux:subheading class="text-sm">Check all amenities that are available at your property</flux:subheading>
            </div>

            @if ($all_amenities)
                <flux:checkbox.group class="space-y-8" wire:model.change="selected_amenities">
                    @foreach ($all_amenities as $amenity_group)
                        <div class="space-y-3">
                            <flux:label>{{ $amenity_group->name }}</flux:label>
                            <flux:separator />
                            @foreach ($amenity_group->amenities as $amenity)
                                <flux:checkbox value="{{ $amenity->id }}" label="{{ $amenity->name }}" />
                            @endforeach
                        </div>
                    @endforeach
                </flux:checkbox.group>
            @endif

            <div class="flex justify-between mt-20">
                <flux:modal.close>
                    <flux:button variant="subtle">Cancel</flux:button>
                </flux:modal.close>
                <flux:button variant="primary" wire:click="saveAmenityChanges">Save changes</flux:button>
            </div>
        </flux:modal>
    </div>

    <flux:separator />

    {{-- Counts --}}
    <div>
        <div class="grid grid-cols-2 gap-x-4 gap-y-6 tablet:grid-cols-4 desktop:grid-cols-4">
            <flux:counter label="Guest count" subtext="guests" wire:model.change="form.guest_count" min="1" max="16" />
            <flux:counter label="Bed count" subtext="beds" wire:model.change="form.bed_count" min="0" max="99" />
            <flux:counter label="Bedroom count" subtext="bedrooms" wire:model.change="form.bedroom_count" min="0" max="99" />
            <flux:counter label="Bathroom count" subtext="baths" wire:model.change="form.bathroom_count" step="0.5" min="0.0" max="9.5" />
            <div class="col-span-full">
                <flux:error name="form.guest_count" />
                <flux:error name="form.bed_count" />
                <flux:error name="form.bedroom_count" />
                <flux:error name="form.bathroom_count" />
            </div>
        </div>
    </div>
</div>
