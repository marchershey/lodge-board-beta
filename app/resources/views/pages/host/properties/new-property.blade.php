<x-layouts.host>

    <x-slot:pageTitle>Add New Property</x-slot:pageTitle>
    <x-slot:pageActions>
        <flux:button href="{{ route('host.properties.index') }}" size="base" icon="undo-2" variant="ghost" wire:navigate.hover>Go Back</flux:button>
    </x-slot:pageActions>

    <div class="page-content" wire:init="load">

        <div class="form-container">
            <x-forms.section>
                <x-slot:header>Basic Information</x-slot:header>
                <x-slot:desc>The basic information about your property</x-slot:desc>
                <div class="space-y-10">
                    <flux:input class="max-w-sm capitalize" wire:model="property.name" label="Property Name" placeholder="Sunset Cabin" description="This will be used to help guests identify this property." />
                    <flux:fieldset class="space-y-4">
                        <flux:input class="max-w-sm capitalize" wire:model="property.address.line_1" label="Street Address" placeholder="123 Main St" />
                        <flux:input class="max-w-sm capitalize" wire:model="property.address.line_2" placeholder="Address line 2 (optional)" />
                        <div class="grid grid-cols-2 gap-x-4 gap-y-4">
                            <flux:input class="capitalize" wire:model="property.address.city" label="City" placeholder="San Francisco" />
                            <flux:select wire:model="property.address.state" label="State" variant="listbox" searchable placeholder="Choose state...">
                                @foreach (\App\Helpers\GeographyHelper::getStates() as $key => $value)
                                    <flux:option value="{{ $key }}" wire:key="state-{{ $key }}">{{ $value }}</flux:option>
                                @endforeach
                            </flux:select>
                            <flux:input mask="$99.99" wire:model="property.address.postal" label="Postal / Zip code" placeholder="12345" />
                            <flux:select wire:model="property.address.country" label="Country" variant="listbox" searchable placeholder="Choose country...">
                                @foreach (\App\Helpers\GeographyHelper::getCountries() as $key => $value)
                                    <flux:option value="{{ $key }}" wire:key="country-{{ $key }}">{{ $value }}</flux:option>
                                @endforeach
                            </flux:select>
                        </div>
                    </flux:fieldset>
                </div>
            </x-forms.section>

            <x-forms.section>
                <x-slot:header>Property Listing</x-slot:header>
                <x-slot:desc>This is the information that will be displayed on the listing page</x-slot:desc>
                <div class="space-y-10">
                    <flux:fieldset>
                        <flux:input class="max-w-sm capitalize" wire:model="property.listing.headline" label="Listing Headline" placeholder="An amazing summer getaway!" />
                        <flux:editor wire:model.live.debounce="property.listing.description" toolbar="heading | bold italic underline strike | bullet ordered blockquote | link | align ~ undo redo" label="Listing Description" />
                        <div class="text-right text-xs text-muted">
                            @if ($property['listing']['description'])
                                <span :class="{ 'text-yellow-500': $wire.property.listing.description.length > 1900, '!text-green-600': $wire.property.listing.description.length == 2000, '!text-red-500': $wire.property.listing.description.length > 2000 }" x-text="$wire.property.listing.description.length">0</span> / 2,000
                            @else
                                <span>0 / 2,000</span>
                            @endif

                            <span>(Including HTML)</span>
                        </div>
                    </flux:fieldset>

                    {{-- <flux:fieldset> --}}
                    {{-- <div class="max-w-sm"> --}}
                    {{-- <x-forms.counter label="test" wire:model="property.name" /> --}}
                    <div class="grid grid-cols-2 gap-x-4 gap-y-6 tablet-sm:grid-cols-4 tablet:grid-cols-2 desktop:grid-cols-4">
                        <flux:counter label="Guest count" subtext="guests" wire:model="property.listing.guests" />
                        <flux:counter label="Bedroom count" subtext="bedrooms" wire:model="property.listing.bedrooms" />
                        <flux:counter label="Bed count" subtext="beds" wire:model="property.listing.beds" />
                        <flux:counter label="Bathroom count" subtext="baths" wire:model="property.listing.bathrooms" step="0.5" />
                        <div class="col-span-full">
                            <flux:error name="property.listing.guests" />
                            <flux:error name="property.listing.bedrooms" />
                            <flux:error name="property.listing.beds" />
                            <flux:error name="property.listing.bathrooms" />
                        </div>
                    </div>
                    {{-- </div> --}}
                    {{-- </flux:fieldset> --}}

                    <flux:fieldset class="space-y-4">

                        <div class="space-y-2">
                            <flux:heading>Amenities</flux:heading>
                            <flux:button icon="plus" wire:click="openAmenitiesModal">Select amenities</flux:button>
                            <flux:error name="property.listing.amenities" />
                            <flux:error name="property.listing.amenities.*" />
                        </div>

                        <div class="flex flex-wrap gap-x-4 gap-y-2">
                            @if (isset($property['listing']['amenities']))
                                @foreach ($property['listing']['amenities'] as $amenity)
                                    <div wire:key="amenity-{{ $amenity['id'] }}" wire:loading.remove wire:target="removeAmenity({{ $amenity['id'] }})">
                                        <flux:badge size="lg" variant="pill">
                                            {{ $amenity['name'] }}
                                            <flux:badge.close wire:click="removeAmenity({{ $amenity['id'] }})" />
                                        </flux:badge>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <flux:modal class="w-[90%] space-y-6 tablet-sm:w-[500px]" name="amenities-modal">
                            <div>
                                <flux:legend size="xl">Select amenities</flux:legend>
                                <flux:subheading>Select all of the amenities that your property includes</flux:subheading>
                            </div>

                            <flux:checkbox.group class="columns-2 space-y-6" wire:model="pending_amenities">
                                @foreach ($amenities as $group)
                                    <div class="break-inside-avoid space-y-2" wire:key="amenities-group-{{ $group->id }}">
                                        <div>{{ $group->name }}</div>
                                        <div class="space-y-1">
                                            @foreach ($group->amenities as $amenity)
                                                <flux:checkbox value="{{ $amenity['id'] }}" wire:key="amenity-checkbox-{{ $amenity['id'] }}" label="{{ $amenity['name'] }}" />
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </flux:checkbox.group>

                            <div class="flex">
                                <flux:spacer />
                                <flux:button variant="primary" wire:click="updateAmenities">Save changes</flux:button>
                            </div>
                        </flux:modal>
                    </flux:fieldset>
                </div>
            </x-forms.section>

            <x-forms.section>
                <x-slot:header>Rates & Fees</x-slot:header>
                <x-slot:desc>The information about the amount to charge per night, as well as taxes and fees.</x-slot:desc>
                <div class="grid grid-cols-12 gap-4">

                    <div class="col-span-6 tablet-sm:col-span-3">
                        <flux:input class="col-span-6" wire:model="property.rates.base" icon="dollar-sign" label="Nightly Rate" placeholder="00.00" x-mask:dynamic="$money($input)" />
                    </div>
                    <div class="col-span-6 tablet-sm:col-span-3">
                        <flux:input class="col-span-6" wire:model="property.rates.tax" iconTrailing="percent" label="Tax Rate" mask="99" placeholder="00" />
                    </div>
                    <div class="col-span-full tablet-sm:col-span-3 tablet-sm:col-start-10 tablet:col-span-4 tablet:col-start-9">
                        <flux:button class="tablet-sm:label-space w-full" wire:click="addFee" icon="plus">Add fee</flux:button>
                    </div>

                    @if (isset($property['rates']['fees']))
                        @foreach ($property['rates']['fees'] as $key => $fee)
                            <flux:separator class="col-span-full" />
                            <div class="col-span-full grid grid-cols-12 gap-4" wire:key="fee-{{ $key }}" wire:target="removeFee({{ $key }})">
                                <div class="col-span-6 tablet-sm:col-span-4 tablet:col-span-6 desktop:col-span-4">
                                    <flux:input wire:model="property.rates.fees.{{ $key }}.name" label="Fee name" placeholder="Cleaning fee" wire:loading.attr="disabled" wire:target="removeFee({{ $key }})" />
                                </div>
                                <div class="col-span-6 tablet-sm:col-span-3 tablet:col-span-6 desktop:col-span-3" wire:loading.class="pointer-events-none opacity-50" wire:target="property.rates.fees.{{ $key }}.type">
                                    @if ($property['rates']['fees'][$key]['type'] == 'fixed')
                                        <flux:input class="" wire:model="property.rates.fees.{{ $key }}.amount" label="Fee amount" badge="$" icon="dollar-sign" x-mask:dynamic="$money($input)" placeholder="00.00" wire:loading.attr="disabled" wire:target="removeFee({{ $key }})" />
                                    @else
                                        <flux:input class="" wire:model="property.rates.fees.{{ $key }}.amount" label="Fee amount" badge="%" iconTrailing="percent" mask="99" placeholder="00" wire:loading.attr="disabled" wire:target="removeFee({{ $key }}), property.rates.fees.{{ $key }}.type" />
                                    @endif
                                </div>
                                <div class="col-span-6 tablet-sm:col-span-4 tablet:col-span-6 desktop:col-span-4 desktop:justify-center">
                                    <flux:radio.group wire:model.live="property.rates.fees.{{ $key }}.type" label="Fee type" variant="segmented" tooltip="test">
                                        <flux:radio value="fixed" icon="dollar-sign" tooltip="Fixed fee" wire:loading.attr="disabled" wire:target="removeFee({{ $key }})" />
                                        <flux:radio value="percent" icon="percent" tooltip="Percentage fee" wire:loading.attr="disabled" wire:target="removeFee({{ $key }})" />
                                    </flux:radio.group>
                                </div>
                                <div class="label-space col-span-6 flex items-center justify-end tablet-sm:col-span-1 tablet:col-span-6 desktop:col-span-1">
                                    <flux:button variant="subtle" wire:target="removeFee({{ $key }})" wire:click="removeFee({{ $key }})">
                                        <flux:icon.x class="size-5" />
                                        <span class="tablet-sm:hidden tablet:block desktop:hidden">Remove fee</span>
                                    </flux:button>
                                    {{-- <flux:button class="label-space tablet-sm:hidden tablet:flex desktop:hidden" wire:target="removeFee({{ $key }})" wire:click="removeFee({{ $key }})" icon="trash-2" variant="filled">Delete fee</flux:button>
                                <flux:button class="label-space hidden tablet-sm:flex tablet:hidden desktop:flex" wire:target="removeFee({{ $key }})" wire:click="removeFee({{ $key }})" icon="x" variant="subtle"></flux:button> --}}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </x-forms.section>

            <x-forms.section>
                <x-slot:header>Photos</x-slot:header>
                <x-slot:desc>Show off your property by adding as many photos as possible</x-slot:desc>
                <div class="space-y-10" x-data="photosuploader">

                    <div class="space-y-2">
                        <flux:input type="file" wire:model.live="temp_photos" label="Add photos" accept="image/jpg, image/jpeg, image/png, image/webp" multiple x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false, progress = 0, $wire.dispatch('init-sortable')" x-on:livewire-upload-error="uploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress" />

                        <div>
                            <span>property.photos</span>
                            <flux:error name="property.photos" />
                        </div>
                        <div>
                            <span>property.photos.*</span>
                            <flux:error name="property.photos.*" />
                        </div>
                        <div>
                            <span>temp_photos</span>
                            <flux:error name="temp_photos" />
                        </div>
                        <div>
                            <span>temp_photos.*</span>
                            <flux:error name="temp_photos.*" />
                        </div>

                        <div class="flex flex-col space-y-2" x-show="uploading">
                            <div class="mt-5 flex justify-between">
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
                    </div>

                    @if (isset($property['photos']) && $property['photos'] != null)
                        <div class="relative grid select-none grid-cols-4 gap-4" wire:sortable="updatePhotoOrder" wire:sortable.options="{ animation: 150, dragoverBubble: true }" wire:loading.delay.class="pointer-events-none" wire:target="updatePhotoOrder">
                            @foreach ($property['photos'] as $photo_key => $photo)
                                <div class="group relative first:col-span-2 first:row-span-2" wire:loading.class="opacity-10" wire:target="deletePhoto({{ $photo_key }})" wire:key="photo-{{ $photo_key }}" wire:sortable.item="{{ $photo_key }}">
                                    <div class="aspect-h-7 aspect-w-10 block h-full w-full cursor-grab overflow-hidden rounded-lg bg-gray-100 shadow-lg ring-1 ring-inset ring-black/20">
                                        <img class="object-cover" src="{{ $photo->temporaryUrl() }}" alt="" wire:sortable.handle>
                                    </div>
                                    <button class="invisible absolute -right-2 -top-1.5 cursor-pointer rounded-full bg-white p-1 group-hover:visible" type="button" wire:confirm="Are you sure you want to delete this post?" wire:click="deletePhoto({{ $photo_key }})">
                                        <svg class="h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M18 6l-12 12" />
                                            <path d="M6 6l12 12" />
                                        </svg>
                                    </button>
                                    <div>
                                        Error ({{ $photo_key }}):
                                        @error('property.photos.' . $photo_key)
                                            there was an error
                                        @enderror
                                        <flux:error name="property.photos.{{ $photo_key }}" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <flux:accordion class="alert-general alert p-5" transition>
                            <flux:accordion.item class="border-b-0">
                                <flux:accordion.heading>
                                    <div class="flex space-x-3">
                                        <flux:icon.info class="size-5 text-muted" />
                                        <div>
                                            <span>Hint:</span> <span class="font-normal text-muted">Adding, removing, and reordering photos...</span>
                                        </div>
                                    </div>
                                </flux:accordion.heading>

                                <flux:accordion.content>
                                    You can reorder the photos by dragging them to a new position. The first photo will be your header photo. To delete a photo, hover over it and press the <flux:icon.x-circle class="inline" />. You may also add more photos by pressing the "Choose files" button and selecting the additional photos you would like to add.
                                </flux:accordion.content>
                            </flux:accordion.item>
                        </flux:accordion>
                    @endif
                </div>
            </x-forms.section>

            <x-forms.section>
                <x-slot:header>Options</x-slot:header>
                <x-slot:desc>Customize your experience by changing the following options</x-slot:desc>

                <div class="space-y-10">
                    <flux:fieldset>
                        <flux:legend>Listing Visiblity</flux:legend>
                        <flux:radio.group wire:model="property.options.visibility">
                            <flux:radio value="private" label="Private" description="Private listings can only be viewed by hosts. The listing will be hidden from the front page. Requires hosts to manually book reservations." />
                            <flux:radio value="hidden" label="Hidden" description="Hidden listings can only be seen by guests who have the link. The listing will be hidden from the front page. Allows guests to book reservations, if they have the direct link." />
                            <flux:radio value="public" label="Public" description="Public listings will be visible on the front page. Allows guests to book reservations." />
                        </flux:radio.group>
                    </flux:fieldset>

                    <flux:separator />

                    <div class="flex w-full items-center justify-between">
                        <flux:modal.trigger name="reset-modal">
                            <flux:button class="!text-red-500" variant="subtle">Reset</flux:button>
                        </flux:modal.trigger>

                        <flux:modal class="min-w-[22rem] space-y-6" name="reset-modal">
                            <div>
                                <flux:heading size="lg">Reset form?</flux:heading>

                                <flux:subheading class="space-y-4">
                                    <p>You're about to reset this entire form. All information, including amenities and photos will be lost. </p>
                                    <p class="font-semibold">This action cannot be reversed.</p>
                                </flux:subheading>
                            </div>

                            <div class="flex gap-2">
                                <flux:spacer />

                                <flux:modal.close>
                                    <flux:button variant="ghost">Nevermind</flux:button>
                                </flux:modal.close>

                                <flux:button variant="danger" wire:click="reload()">Reset form</flux:button>
                            </div>
                        </flux:modal>
                        <flux:button variant="primary" wire:click="submit">Save Property</flux:button>

                    </div>
                </div>
            </x-forms.section>
        </div>

    </div>

</x-layouts.host>
