<x-layouts.host size="sm">

    <x-slot:page-title>Add New Property</x-slot:page-title>
    <x-slot:page-actions>
        <flux:button href="{{ route('host.properties.index') }}" size="base" icon="undo-2" variant="ghost" wire:navigate.hover>Go Back</flux:button>
    </x-slot:page-actions>

    <div class="space-y-10" wire:init="load">

        {{-- Basic information --}}
        <flux:card class="space-y-6">

            {{-- Property Name --}}
            <div class="space-y-4">
                <div>
                    <flux:heading size="lg">Property Name</flux:heading>
                    <flux:subheading>The property name will help guests identify this property. Make it memoriable!
                    </flux:subheading>
                </div>
                <flux:input class="max-w-sm capitalize" wire:model.blur="form.name" placeholder="Sunset Cabin" required />
                <flux:error name="form.name" />
            </div>

            <flux:separator />

            {{-- Property Address --}}
            <div class="space-y-4">
                <div>
                    <flux:heading size="lg">Property Address</flux:heading>
                    <flux:subheading>This address will be given to guests, so make sure it's an address that will help
                        them find your property.</flux:subheading>
                </div>
                <div class="grid grid-cols-1 gap-4 tablet:grid-cols-6">
                    <div class="tablet:col-span-4 laptop:col-span-4">
                        <flux:input wire:model.blur="form.address_line1" label="Street Address (Line 1)" placeholder="123 Main St" required />
                    </div>
                    <div class="tablet:col-span-2 laptop:col-span-2">
                        <flux:input wire:model.blur="form.address_line2" label="Street Address (Line 2)" placeholder="Apartment, suite, floor, etc" />
                    </div>
                    <div class="tablet:col-span-3">
                        <flux:input wire:model.blur="form.address_city" label="City" placeholder="San Francisco" required />
                    </div>
                    <div class="tablet:col-span-3">
                        <flux:select wire:model.change="form.address_state" label="State" variant="listbox" searchable placeholder="Choose state..." required>
                            @foreach (\App\Helpers\GeographyHelper::getStates() as $key => $value)
                                <flux:option value="{{ $key }}" wire:key="state-{{ $key }}">
                                    {{ $value }}</flux:option>
                            @endforeach
                        </flux:select>
                    </div>
                    <div class="tablet:col-span-3">
                        <flux:input mask="99999" wire:model.blur="form.address_postal" label="ZIP / Postal Code" placeholder="12345" required />
                    </div>
                    <div class="tablet:col-span-3">
                        <flux:select wire:model.change="form.address_country" label="Country" variant="listbox" searchable placeholder="Choose country..." required>
                            @foreach (\App\Helpers\GeographyHelper::getCountries() as $key => $value)
                                <flux:option value="{{ $key }}" wire:key="country-{{ $key }}">
                                    {{ $value }}</flux:option>
                            @endforeach
                        </flux:select>
                    </div>
                </div>
            </div>
        </flux:card>

        {{-- Property Listings --}}
        <flux:card class="space-y-6 overflow-y-hidden">
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
        </flux:card>

        {{-- Rates & Fees --}}
        <flux:card class="space-y-6">
            <div>
                <flux:heading size="lg">Rates & Fees</flux:heading>
                <flux:subheading>The information about the amount to charge per night, as well as taxes and fees</flux:subheading>
            </div>

            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-6 tablet:col-span-3">
                    <flux:input class="col-span-6" @click="$event.target.select()" wire:model.blur="form.base_rate" icon="dollar-sign" label="Base Rate" badge="per night" placeholder="000.00" x-mask:dynamic="$money($input, '.', '')" />
                </div>
                <div class="col-span-6 tablet:col-span-3">
                    <flux:input class="col-span-6" @click="$event.target.select()" wire:model.blur="form.tax_rate" iconTrailing="percent" label="Tax Rate" mask="99" placeholder="00" />
                </div>
                <div class="col-span-full tablet:col-span-3 tablet:col-start-10">
                    <flux:button class="w-full tablet:label-space" wire:click="addFee" icon="plus">Add fee
                    </flux:button>
                </div>
                <flux:error class="col-span-full" name="form.fees" />

                {{-- Fees grid --}}
                @if (isset($form->fees))
                    @foreach ($form->fees as $key => $fee)
                        <div class="grid grid-cols-12 gap-4 col-span-full" wire:key="fee-{{ $key }}" wire:loading.remove wire:target="removeFee({{ $key }})">
                            <flux:separator class="col-span-full" />
                            <div class="col-span-6 tablet:col-span-4 desktop:col-span-4">
                                <flux:label class="mb-3">Fee name</flux:label>
                                <flux:input wire:model.blur="form.fees.{{ $key }}.name" placeholder="Cleaning fee" />
                            </div>
                            <div class="col-span-6 tablet:col-span-3 desktop:col-span-3" wire:loading.class="opacity-50 pointer-events-none" wire:target="form.fees.{{ $key }}.type">
                                <flux:label class="mb-3">Fee amount</flux:label>
                                @if ($fee['type'] == 'fixed')
                                    <flux:input wire:model.blur="form.fees.{{ $key }}.amount" @click="$event.target.select()" icon="dollar-sign" x-mask:dynamic="$money($input, '.', '', 2)" placeholder="00.00" />
                                @else
                                    <flux:input wire:model.blur="form.fees.{{ $key }}.amount" @click="$event.target.select()" iconTrailing="percent" mask="99" placeholder="00" wire:loading.attr="disabled" wire:target="removeFee({{ $key }}), form.fees.{{ $key }}.type" />
                                @endif
                            </div>
                            <div class="col-span-10 tablet:col-span-4 desktop:col-span-4 desktop:justify-center">
                                <flux:field>
                                    <flux:label>Fee type</flux:label>
                                    <flux:tooltip class="inline-block" content='Choose a flat fee or a fee based on a percentage of the total cost'>
                                        <flux:icon.circle-help class="size-4 text-muted" />
                                    </flux:tooltip>

                                    <flux:radio.group wire:model.live="form.fees.{{ $key }}.type" variant="segmented">
                                        <flux:radio value="fixed" icon="dollar-sign" />
                                        <flux:radio value="variable" icon="percent" />
                                    </flux:radio.group>

                                    <flux:error name="email" />
                                </flux:field>
                            </div>
                            <div class="flex items-center justify-end col-span-2 label-space tablet:col-span-1 desktop:col-span-1">
                                <flux:button variant="subtle" wire:target="removeFee({{ $key }})" wire:click="removeFee({{ $key }})">
                                    <div class="flex items-center space-x-2">
                                        <flux:icon.trash-2 class="size-5" />
                                    </div>
                                </flux:button>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </flux:card>

        {{-- Photos --}}
        <flux:card class="space-y-6" x-data="photosuploader">
            <div>
                <flux:heading size="lg">Photos</flux:heading>
                <flux:subheading>Show off your property by adding as many photos as possible</flux:subheading>
            </div>

            <div class="space-y-4" x-show="!uploading">
                <div class="space-y-4">
                    <flux:label>Add Photos</flux:label>
                    <flux:input type="file" wire:model.live="temp_photos" accept="image/jpg, image/jpeg, image/png, image/webp, image/bmp" multiple x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false, progress = 0, $wire.dispatch('init-sortable')" x-on:livewire-upload-error="uploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress" />
                </div>

                <div>
                    <flux:error name="form.photos" />
                    <flux:error name="form.photos.*" />
                    <flux:error name="temp_photos" />
                    <flux:error name="temp_photos.*" />
                </div>
            </div>

            <div class="flex flex-col space-y-2" x-show="uploading">
                <div class="flex justify-between">
                    <div class="flex items-center space-x-2">
                        <flux:icon.loading class="size-5 text-muted"></flux:icon.loading>
                        <flux:heading>Uploading photos...</flux:heading>
                    </div>
                    <div>
                        <div class="text-sm font-medium" x-text="progress + '%'"></div>
                    </div>
                </div>
                <div>
                    <div class="h-3.5 w-full rounded bg-gray-200">
                        <div class="h-3.5 w-0 rounded bg-blue-600" :style="{ width: progress + '%' }"></div>
                    </div>
                </div>
            </div>

            @if ($form->photos != null)
                <div class="relative grid grid-cols-3 gap-4 select-none tablet:grid-cols-4" wire:sortable="updatePhotoOrder" wire:sortable.options="{ animation: 150, dragoverBubble: true }" wire:loading.delay.class="opacity-50 pointer-events-none" wire:target="updatePhotoOrder">
                    @foreach ($form->photos as $photo_key => $photo)
                        <div class="relative overflow-hidden rounded-lg group first:col-span-2 first:row-span-2" wire:loading.class="opacity-50" wire:target="removePhoto({{ $photo_key }})" wire:key="photo-{{ $photo_key }}" wire:sortable.item="{{ $photo_key }}">
                            <div class="block object-center w-full h-full overflow-hidden transition bg-gray-100 rounded-lg shadow-lg aspect-h-7 aspect-w-10 cursor-grab ring-1 ring-inset ring-black/20 hover:scale-110">
                                <img class="object-cover pointer-events-none" src="{{ $photo->temporaryUrl() }}" alt="">
                            </div>
                            <button class="absolute invisible -right-2 -top-1.5 cursor-pointer rounded-full bg-white p-1 group-hover:visible" type="button" wire:confirm="Are you sure you want to delete this photo?" wire:click="removePhoto({{ $photo_key }})">
                                <svg class="w-5 h-5 text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
                <flux:accordion class="p-5 alert-general alert" transition>
                    <flux:accordion.item class="border-b-0">
                        <flux:accordion.heading>
                            <div class="flex space-x-3">
                                <flux:icon.info class="size-5 text-muted" />
                                <div>
                                    <span>Hint:</span> <span class="font-normal text-muted">Adding, removing, and
                                        reordering photos...</span>
                                </div>
                            </div>
                        </flux:accordion.heading>

                        <flux:accordion.content>
                            You can reorder the photos by dragging them to a new position. The first photo will be your
                            header photo. To delete a photo, hover over it and press the <flux:icon.x-circle class="inline" />. You may also add more photos by pressing the "Choose files" button
                            and selecting the additional photos you would like to add.
                        </flux:accordion.content>
                    </flux:accordion.item>
                </flux:accordion>
            @endif
        </flux:card>

        {{-- Options --}}
        <flux:card class="space-y-6">
            <div>
                <flux:heading size="lg">Options</flux:heading>
                <flux:subheading>Set the visibility, duration requirements, and other settings</flux:subheading>
            </div>

            <flux:field>
                <flux:label>Website URL</flux:label>
                <flux:input.group>
                    <flux:input.group.prefix>{{ settings()->site_url }}/</flux:input.group.prefix>
                    <flux:input id="slug" wire:model.blur="form.slug" placeholder="lodge-board" x-mask:dynamic="slugify" readonly />
                </flux:input.group>
                <flux:description class="text-sm">The URL is auto-generated from the name.</flux:description>
                <flux:error name="form.slug" />
            </flux:field>

            <flux:input class="color-input w-auto max-w-[100px]" type="color" label="Calendar Color" wire:model.blur="form.calendar_color" />

            <flux:separator />

            <div class="space-y-4">
                <div>
                    <flux:heading size="lg">Stay Duration</flux:heading>
                    <flux:subheading>Set minimum and maximum night requirements for your bookings</flux:subheading>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <flux:counter label="Minimum nights" subtext="nights" wire:model.change="form.duration_min" min="1" max="30" default="1" />
                    <flux:counter label="Maximum nights" subtext="nights" wire:model.change="form.duration_max" min="1" max="30" default="14" />
                </div>
            </div>

            <flux:separator />

            <div class="space-y-4">
                <div>
                    <flux:heading size="lg">Listing Visiblity</flux:heading>
                    <flux:subheading>Adjust the visibility settings for this listing.</flux:subheading>
                </div>
                <flux:radio.group wire:model.change="form.visibility">
                    <flux:radio value="private" label="Private" description="Only Hosts can view the listing. Requires Hosts to manually book reservations." />
                    <flux:radio value="unlisted" label="Unlisted" description="The listing is not publicly searchable or viewable on the front page, but can be accessed via a direct link." />
                    <flux:radio value="public" label="Public" description="The listing is publicly searchable and visible to everyone." />
                </flux:radio.group>
                <flux:error name="form.visibility" />
            </div>

        </flux:card>

        {{-- Buttons --}}
        <div class="flex items-center justify-between pb-10">
            <div>
                <flux:modal.trigger name="reset-confirm-modal">
                    <flux:button variant="subtle">Reset</flux:button>
                </flux:modal.trigger>

                <flux:modal class="min-w-[22rem] space-y-6" name="reset-confirm-modal">
                    <flux:heading size="lg">Are you sure?</flux:heading>
                    <flux:subheading>
                        <p>You're about to <span class="font-bold">reset</span> this entire form.</p>
                        <p class="font-bold text-red-500">This action cannot be reversed.</p>
                    </flux:subheading>
                    <div class="flex gap-4">
                        <flux:spacer />
                        <flux:modal.close>
                            <flux:button variant="ghost">Nevermind</flux:button>
                        </flux:modal.close>
                        <flux:button wire:click="reload" variant="danger">Yes, I'm sure</flux:button>
                    </div>
                </flux:modal>
            </div>
            <flux:button wire:click="submit" variant="primary" icon="house-plus">Save Property</flux:button>
        </div>
    </div>

</x-layouts.host>
