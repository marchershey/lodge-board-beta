<section class="card card-padding card-flex" wire:init="load" x-data="photosuploader">

    <p>
        Looks great! Now add some photos to show off your property.
    </p>

    {{-- Show the "select photos" button only if no photos are uploaded --}}
    @if (!$photos)
        <label class="button-full button" for="photos-input">
            <span>Select Photos...</span>
            <input class="photos-input hidden" id="photos-input" type="file" x-on:change="photosCount = $event.target.files.length" wire:model="temp_photos" accept="image/jpg, image/jpeg, image/png, image/webp" multiple>
        </label>
    @endif

    @if ($photos)
        <div class="relative grid select-none grid-cols-2 gap-4" wire:sortable="updatePhotoOrder" wire:sortable.options="{ animation: 150, dragoverBubble: true }" wire:loading.delay.class="pointer-events-none" wire:target="updatePhotoOrder">
            @foreach ($photos as $photo_key => $photo)
                <div class="group relative first:col-span-full" wire:loading.remove wire:target="deletePhoto({{ $photo_key }})" wire:key="photo-{{ $photo_key }}" wire:sortable.item="{{ $photo_key }}">
                    <div class="aspect-h-7 aspect-w-10 block h-full w-full cursor-grab overflow-hidden rounded-lg bg-gray-100 shadow-lg">
                        <img class="object-cover" src="{{ $photo->temporaryUrl() }}" alt="" wire:sortable.handle>
                    </div>
                    <button class="invisible absolute -right-2 -top-1.5 cursor-pointer rounded-full bg-white p-1 group-hover:visible" type="button" wire:confirm="Are you sure you want to delete this post?" wire:click="deletePhoto({{ $photo_key }})">
                        <svg class="h-4 w-4 text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M18 6l-12 12" />
                            <path d="M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endforeach

            <template x-for="i in photosCount">
                <div class="aspect-h-7 aspect-w-10 h-full w-full animate-pulse rounded-lg border bg-gray-100" x-show="uploading"></div>
            </template>

            <label class="group aspect-h-7 aspect-w-10 block h-full w-full transform cursor-pointer rounded-lg border bg-gray-200/50 text-muted duration-300 hover:shadow-lg" for="photos-input">
                <div class="flex-col-center h-full w-full space-y-1">
                    <svg class="h-12 w-12 group-hover:text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M15 8h.01" />
                        <path d="M12.5 21h-6.5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v6.5" />
                        <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l3.5 3.5" />
                        <path d="M14 14l1 -1c.679 -.653 1.473 -.829 2.214 -.526" />
                        <path d="M19 22v-6" />
                        <path d="M22 19l-3 -3l-3 3" />
                    </svg>
                    <span class="group-hover:text-primary-darker text-xs">Add more photos</span>
                </div>
                <input class="photos-input hidden" id="photos-input" type="file" x-on:change="photosCount = $event.target.files.length" wire:model="temp_photos" accept="image/jpg, image/jpeg, image/png, image/webp" multiple>

            </label>
        </div>

        <div class="rounded-lg border bg-gray-100 p-4">
            <p class="text-base font-bold italic text-primary">Note:</p>
            <p class="text-sm leading-4"><span class="font-medium">The first photo is your header photo.</span> You can also reorder the photos by dragging them in your preferred order.</p>
        </div>
    @endif

    {{-- Only show if photos are uploaded --}}
    @if ($photos)
        <div class="form-buttons">
            <button class="button button-full" type="button" wire:click="submit">Continue</button>
        </div>
    @endif

    {{-- ----------------------------------- --}}
    <hr>

    {{-- <div class="hidden" wire:init="load" wire:loading.class="opacity-50 pointer-events-none" wire:target="submit">
        <form class="card card-padding card-flex" wire:submit.prevent="submit">
            <div class="card-header">
                <h1>Property Photos</h1>
                <p>Next thing, add a few photos to show off the property.</p>
            </div>
            <div class="card-flex" x-data="photosuploader" x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false, progress = 0, $wire.dispatch('init-sortable')" x-on:livewire-upload-error="uploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress, console.log($event.detail)">

                @if (!$photos)
                    <label class="button-full button button-lg" for="photos-input">
                        <span>Select Photos...</span>
                        <input class="hidden photos-input" id="photos-input" type="file" x-on:change="photosCount = $event.target.files.length" wire:model="temp_photos" accept="image/jpg, image/jpeg, image/png, image/webp" multiple>
                    </label>
                @endif

                @if ($errors->first('photos'))
                    {{ $errors->first('photos') }}
                @endif

                @if ($temp_photos)
                    <div class="relative grid grid-cols-2 gap-4 select-none" wire:sortable="updatePhotoOrder" wire:sortable.options="{ animation: 150, dragoverBubble: true }" wire:loading.delay.class="pointer-events-none" wire:target="updatePhotoOrder">
                        @foreach ($photos as $photo_key => $photo)
                            <div class="relative first:col-span-full group" wire:loading.remove wire:target="deletePhoto({{ $photo_key }})" wire:key="photo-{{ $photo_key }}" wire:sortable.item="{{ $photo_key }}">
                                <div class="block w-full h-full overflow-hidden bg-gray-100 rounded-lg shadow-lg cursor-grab aspect-w-10 aspect-h-7">
                                    <img class="object-cover" src="{{ $photo->temporaryUrl() }}" alt="" wire:sortable.handle>
                                </div>
                                <button class="absolute cursor-pointer group-hover:visible invisible p-1 bg-white rounded-full -top-1.5 -right-2" type="button" wire:confirm="Are you sure you want to delete this post?" wire:click="deletePhoto({{ $photo_key }})">
                                    <svg class="w-4 h-4 text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 6l-12 12" />
                                        <path d="M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach

                        <template x-for="i in photosCount">
                            <div class="w-full h-full bg-gray-100 border rounded-lg aspect-w-10 aspect-h-7 animate-pulse" x-show="uploading"></div>
                        </template>

                        <label class="block w-full h-full duration-300 transform border rounded-lg cursor-pointer bg-gray-200/50 aspect-w-10 aspect-h-7 group text-muted hover:shadow-lg" for="photos-input">
                            <div class="w-full h-full space-y-1 flex-col-center">
                                <svg class="w-12 h-12 group-hover:text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M15 8h.01" />
                                    <path d="M12.5 21h-6.5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v6.5" />
                                    <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l3.5 3.5" />
                                    <path d="M14 14l1 -1c.679 -.653 1.473 -.829 2.214 -.526" />
                                    <path d="M19 22v-6" />
                                    <path d="M22 19l-3 -3l-3 3" />
                                </svg>
                                <span class="text-xs group-hover:text-primary-darker">Add more photos</span>
                            </div>
                            <input class="hidden photos-input" id="photos-input" type="file" x-on:change="photosCount = $event.target.files.length" wire:model="temp_photos" accept="image/jpg, image/jpeg, image/png, image/webp" multiple>

                        </label>
                    </div>

                    <div class="p-4 bg-gray-100 border rounded-lg">
                        <p class="text-base italic font-bold text-primary">Note:</p>
                        <p class="text-sm leading-4"><span class="font-medium">The first photo is your header photo.</span> You can also reorder the photos by dragging them in your preferred order.</p>
                    </div>
                @endif

                <div class="z-[5000] fixed inset-x-0 bottom-0 w-full p-8" x-show="uploading">
                    <div class="max-w-md p-4 mx-auto bg-white rounded-lg">
                        <div class="flex items-center justify-between mb-1">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 animate-spin text-muted-dark" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-50" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <div class="text-sm font-medium">Uploading Photos...</div>
                            </div>
                            <div class="text-sm font-medium" x-text="progress + '%'"></div>
                        </div>
                        <div class="w-full bg-gray-200 rounded h-3.5">
                            <div class="bg-blue-600 h-3.5 rounded w-0" :style="{ width: progress + '%' }"></div>
                        </div>
                    </div>
                </div>

            </div>

            @if ($photos)
                <div class="flex justify-end">
                    <button class="button button-full button-lg" type="submit">Continue</button>
                </div>
            @endif

        </form>

        <div class="card-padding-sm flex-center">
            <button class="font-medium link text-muted-darker" type="button" @click="$dispatch('prev-step')">Go Back</button>
        </div>
    </div> --}}
</section>
