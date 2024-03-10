<div class="card-flex" wire:init="load" x-data="{
    active: 2,
    nextTab() {
        this.active++
    },
    prevTab() {
        this.active--
    }
}" x-on:next-tab="nextTab" x-on:prev-tab="prevTab">

    <div class="card card-padding">
        <div class="card-header">
            <h1>First Rental</h1>
            <p>Now let's add your first rental property.</p>
        </div>
        <div class="card-flex" x-show="active == 1" x-collapse :class="active == 1 ? '!overflow-visible' : 'overflow-hidden'">
            <div class="mt-8 transition delay-150 card-form" :class="active == 1 ? 'opacity-100' : ' opacity-0'">
                <x-forms.text class="capitalize" type="text" wiremodel="rental_name" label="Rental Name" desc="Give this rental property a name." placeholder="Rental Name" />
            </div>
            <div class="flex items-center justify-end space-x-2">
                <button class="button button-wide" type="button" wire:click="nextTab('name')">
                    Next
                </button>
            </div>
        </div>
    </div>

    <div class="card card-padding">
        <div class="card-header">
            <h1>Rental Address</h1>
            <p>This address will be given to guests.</p>
        </div>
        <div class="card-flex" x-ref="div1" x-show="active == 2" x-collapse :class="active == 2 ? '!overflow-visible' : 'overflow-hidden'">
            <div class="mt-8 transition delay-150 card-form" :class="active == 2 ? 'opacity-100' : ' opacity-0'">
                <x-forms.text class="capitalize" type="text" wiremodel="rental_street" label="Street Address" placeholder="Street Address" />
                <x-forms.text class="capitalize" type="text" wiremodel="rental_city" label="City" placeholder="City" />
                <div class="!col-span-8">
                    <x-forms.select wiremodel="rental_state" label="State" :options="\App\Helpers\GeographyHelper::getStates()" placeholder="State" />
                </div>
                <div class="!col-span-4">
                    <x-forms.text type="tel" wiremodel="rental_zip" label="ZIP Code" placeholder="ZIP Code" />
                </div>
            </div>
            <div class="flex items-center justify-between transition delay-150" :class="active == 2 ? 'opacity-100' : ' opacity-0'">
                <button class="button button-wide button-gray" type="button" x-on:click="prevTab">
                    Back
                </button>
                <button class="button button-wide button-primary" type="button" wire:click="nextTab('address')">
                    Next
                </button>
            </div>
        </div>
    </div>

    <div class="card card-padding">
        <div class="card-header">
            <h1>Rental Photos</h1>
            <p>Add some photos to show off your rental.</p>
        </div>
        <div class="card-flex" x-show="active == 3" x-collapse :class="active == 3 ? '!overflow-visible' : 'overflow-hidden'">
            <div class="mt-8 transition delay-150" :class="active == 3 ? 'opacity-100' : ' opacity-0'">
                <div class="card-form" x-data="photosuploader" x-on:livewire-upload-start="isuploading = true" x-on:livewire-upload-finish="isuploading = false, $wire.dispatch('init-sortable')" x-on:livewire-upload-error="isuploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">

                    <div x-show="isuploading">
                        <div class="flex items-center justify-between mb-1">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 animate-spin text-muted-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-50" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <div class="text-sm font-medium">Uploading...</div>
                            </div>
                            <div class="text-sm font-medium" x-text="progress + '%'"></div>
                        </div>
                        <div class="w-full bg-gray-200 rounded h-3.5">
                            <div class="bg-blue-600 h-3.5 rounded w-0" :style="{ width: progress + '%' }"></div>
                        </div>
                    </div>

                    <div x-show="!isuploading">
                        <label class="button-full button button-lg" for="photos-input">
                            <span>Select Photos...</span>
                            <input class="hidden photos-input" id="photos-input" type="file" wire:model="photos" accept="image/jpg, image/jpeg, image/png, image/gif, image/webp" multiple>
                        </label>
                    </div>

                    @if ($photos)
                        <div class="p-4 text-xs bg-gray-100 rounded-lg">
                            <p class="font-semibold">Note:</p>
                            <p>You can reorder the photos by clicking and dragging them in the correct order.</p>
                        </div>
                        <div class="grid grid-cols-3 gap-4 select-none sortable">
                            @foreach ($photos as $photo_key => $photo)
                                <div class="relative first:col-span-full group sortable--item" data-photo-id="{{ $photo_key }}">
                                    <div class="overflow-hidden bg-gray-100 rounded-lg aspect-w-10 aspect-h-7 sortable--handle">
                                        <img class="object-cover pointer-events-none" src="{{ $photo->temporaryUrl() }}" alt="">
                                    </div>
                                    <button class="absolute cursor-pointer group-hover:visible invisible p-1 bg-white rounded-full -top-1.5 -right-2" wire:click="deletePhoto({{ $photo_key }})">
                                        <svg class="w-4 h-4 text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M18 6l-12 12" />
                                            <path d="M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="flex items-center justify-between mt-4 transition delay-150" :class="active == 3 ? 'opacity-100' : ' opacity-0'">
                        <button class="button button-wide button-gray" type="button" x-on:click="prevTab">
                            Back
                        </button>
                        <button class="button button-wide" type="button" @if (!$photos) disabled @endif wire:click="submit">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
