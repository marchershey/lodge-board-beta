<div class="card-flex" wire:init="load" x-data="{
    active: 3,
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
                {{-- <div class="card-form" x-data="photosuploader" x-on:livewire-upload-start="isuploading = true" x-on:livewire-upload-finish="isuploading = false" x-on:livewire-upload-error="isuploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress"> --}}
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
                        <div class="grid grid-cols-3 gap-4 select-none sortable">
                            @foreach ($photos as $photo_key => $photo)
                                <div class="relative first:col-span-full group sortable--item" data-photo-id="{{ $photo_key }}">
                                    <div class="overflow-hidden bg-gray-100 rounded-lg aspect-w-10 aspect-h-7">
                                        <img class="object-cover pointer-events-none" src="{{ $photo->temporaryUrl() }}" alt="">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- <div class="grid grid-cols-3 gap-4 select-none sortable" tabindex="0">
                        <!--[if BLOCK]><![endif]-->
                        <div class="relative first:col-span-full hover:shadow-lg group sortable--item" data-photo-id="0" tabindex="0">
                            <div class="overflow-hidden bg-gray-100 rounded-lg aspect-w-10 aspect-h-7">
                                <img class="object-cover pointer-events-none" src="http://localhost/livewire/preview-file/UVZ9rKGv1jSC5VtqvMLxF8l27eQi4N-metaMS5qcGc=-.jpg?expires=1709776799&amp;signature=748cee7e56e56fa997ed5e98a8e2844c4ac31cdf2ea01c02ce0f3eea5c789daa" alt="">
                            </div>
                        </div>
                        <div class="relative first:col-span-full hover:shadow-lg group sortable--item" data-photo-id="1" tabindex="0">
                            <div class="overflow-hidden bg-gray-100 rounded-lg aspect-w-10 aspect-h-7">
                                <img class="object-cover pointer-events-none" src="http://localhost/livewire/preview-file/jL1LMrlm8GSVHGnDKYKKQHcZ8IEaXl-metaMi5qcGc=-.jpg?expires=1709776799&amp;signature=7560e90a26b173fd3e0da195d563fd2cc7c61583ea395c0bbcbb6e0cf3a7a652" alt="">
                            </div>
                        </div>
                        <div class="relative first:col-span-full hover:shadow-lg group sortable--item" data-photo-id="2" tabindex="0">
                            <div class="overflow-hidden bg-gray-100 rounded-lg aspect-w-10 aspect-h-7">
                                <img class="object-cover pointer-events-none" src="http://localhost/livewire/preview-file/vmEheLxYKm63pjn01RJ3fgrpzJR2vY-metaMy5qcGc=-.jpg?expires=1709776799&amp;signature=a98afdde27a90d54fad5cc388629730723be1645cb7898411968b9db8d6daefd" alt="">
                            </div>
                        </div>
                        <div class="relative first:col-span-full hover:shadow-lg group sortable--item" data-photo-id="3" tabindex="0">
                            <div class="overflow-hidden bg-gray-100 rounded-lg aspect-w-10 aspect-h-7">
                                <img class="object-cover pointer-events-none" src="http://localhost/livewire/preview-file/zzecOoGE2wt1U9JxRTuqE5kifChyJY-metaNC5qcGc=-.jpg?expires=1709776799&amp;signature=ded1e267bda34109a601f7d44b414c96fb2f99b77271de3d790c417ae02e7a37" alt="">
                            </div>
                        </div>
                        <div class="relative first:col-span-full hover:shadow-lg group sortable--item" data-photo-id="4" tabindex="0">
                            <div class="overflow-hidden bg-gray-100 rounded-lg aspect-w-10 aspect-h-7">
                                <img class="object-cover pointer-events-none" src="http://localhost/livewire/preview-file/JNMC1oF46LwWZRbg2gqdmARuOa1OMe-metaNS5qcGc=-.jpg?expires=1709776799&amp;signature=5c4cf09d82727223cbc4cf3fd8005c93b72f318cbe587983e2575ec5170f14d2" alt="">
                            </div>
                        </div>
                        <div class="relative first:col-span-full hover:shadow-lg group sortable--item" data-photo-id="5" tabindex="0">
                            <div class="overflow-hidden bg-gray-100 rounded-lg aspect-w-10 aspect-h-7">
                                <img class="object-cover pointer-events-none" src="http://localhost/livewire/preview-file/yOqcFpbsf8cgHQA74BAMVNqK0z6HOI-metaNi5qcGc=-.jpg?expires=1709776799&amp;signature=22a518eb6f54b2099ed3d42828225d62dc7b6fdb89d4ff3bce5ec014a871aa4a" alt="">
                            </div>
                        </div>
                        <div class="relative first:col-span-full hover:shadow-lg group sortable--item" data-photo-id="6" tabindex="0">
                            <div class="overflow-hidden bg-gray-100 rounded-lg aspect-w-10 aspect-h-7">
                                <img class="object-cover pointer-events-none" src="http://localhost/livewire/preview-file/F940izFe9nXnQNG9ty1776AnVyVH4b-metaNy5qcGc=-.jpg?expires=1709776799&amp;signature=3027d18295dfd216cbf2020c5502a14a63d1873766c4c9ba5aa1e9574b621678" alt="">
                            </div>
                        </div>
                        <div class="relative first:col-span-full hover:shadow-lg group sortable--item" data-photo-id="7" tabindex="0">
                            <div class="overflow-hidden bg-gray-100 rounded-lg aspect-w-10 aspect-h-7">
                                <img class="object-cover pointer-events-none" src="http://localhost/livewire/preview-file/EvdBRgldHt1fzoYcxeXmwLi0IMHSZx-metaOC5qcGc=-.jpg?expires=1709776799&amp;signature=d935a6165821f851d2a0ac549a0986392cd02f5f70799f182063b078ce2eac9a" alt="">
                            </div>
                        </div>
                        <div class="relative first:col-span-full hover:shadow-lg group sortable--item" data-photo-id="8" tabindex="0">
                            <div class="overflow-hidden bg-gray-100 rounded-lg aspect-w-10 aspect-h-7">
                                <img class="object-cover pointer-events-none" src="http://localhost/livewire/preview-file/bmu6k9omPvwKUD3Q1a2oL28Y77A2MZ-metaOS5qcGc=-.jpg?expires=1709776799&amp;signature=1c80a24715154627ae62faa1311789b6662f44c37afdd5bffcf0df08cd25d304" alt="">
                            </div>
                        </div>
                        <!--[if ENDBLOCK]><![endif]-->
                    </div> --}}

                    <div class="p-4 text-xs bg-gray-100 rounded-lg">
                        <p class="font-medium">Note:</p>
                        <p>You can reorder the photos by clicking and dragging them in the correct order.</p>
                    </div>

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

{{-- @push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {

            Livewire.on('init-sortable-photos', () => {

                // const containerSelector = '.draggable';
                // const containers = document.querySelectorAll(containerSelector);

                // if (containers.length === 0) {
                //     return false;
                // }

                // const sortable = new Sortable(containers, {
                //     draggable: '.draggable--item',
                //     mirror: {
                //         appendTo: containerSelector,
                //         constrainDimensions: true,
                //     },
                // });

                // const draggable = new Sortable(document.querySelectorAll('.draggable'), {
                //     draggable: '.draggable--item',
                //     handle: '.draggable--handle',
                //     classes: {
                //         'mirror': ['opacity-50'],
                //         'draggable:over': ['opacity-0'],
                //         'source:original': ['hidden'],
                //     },
                //     mirror: {
                //         constrainDimensions: true,
                //     },
                //     plugins: [Plugins.SortAnimation],
                //     swapAnimation: {
                //         duration: 200,
                //         easingFunction: "ease-in-out",
                //     },
                // });
                // draggable.on("drag:stopped", (event) => {
                //     @this.reorderUploadedPhotos(
                //         Array.from(document.querySelectorAll('.draggable--item')).map(el => el.dataset.photoId)
                //     )
                // });

            })
        })
        // document.addEventListener('livewire:initialized', () => {
        //     let file = document.querySelector('#photos-input').files[0]
        //     Livewire.upload('photo', file, (uploadedFilename) => {
        //         // Success callback...
        //         console.log('success')
        //     }, () => {
        //         // Error callback...
        //         console.log('error')
        //     }, (event) => {
        //         // Progress callback...
        //         console.log('progress')
        //         // event.detail.progress contains a number between 1 and 100 as the upload progresses
        //     }, () => {
        //         // Cancelled callback...
        //         console.log('cancelled')
        //     })
        // })
    </script>
    <script>
        // function initDraggable() {

        //     const sortable = new Sortable(document.querySelectorAll('.draggable'), {
        //         draggable: '.draggable--item',
        //     });

        //     sortable.on('sortable:start', () => console.log('sortable:start'));
        //     sortable.on('sortable:sort', () => console.log('sortable:sort'));
        //     sortable.on('sortable:sorted', () => console.log('sortable:sorted'));
        //     sortable.on('sortable:stop', () => console.log('sortable:stop'));
        // const draggable = new Sortable(document.querySelectorAll('.draggable'), {
        //     draggable: '.draggable--item',
        //     handle: '.draggable--handle',
        //     classes: {
        //         'mirror': ['opacity-50'],
        //         'draggable:over': ['opacity-0'],
        //         'source:original': ['hidden'],
        //     },
        //     mirror: {
        //         constrainDimensions: true,
        //     },
        //     plugins: [Plugins.SortAnimation],
        //     swapAnimation: {
        //         duration: 200,
        //         easingFunction: "ease-in-out",
        //     },
        // });
        // draggable.on("drag:stopped", (event) => {
        //     @this.reorderUploadedPhotos(
        //         Array.from(document.querySelectorAll('.draggable--item')).map(el => el.dataset.photoId)
        //     )
        // });
        // }

        // window.addEventListener("init-draggable", (event) => {
        //     initDraggable();
        // });
    </script>
@endpush --}}
