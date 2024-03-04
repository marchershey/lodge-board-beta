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
                <button class="button button-wide button-primary" type="button" wire:click="nextTab('name')">
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
                    Previous
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
                <div class="card-form" x-data="photosuploader" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">

                    <div>
                        <label class="button-full button button-lg" for="photos">
                            <span>Select Photos...</span>
                            <input class="hidden" id="photos" type="file" wire:model="photos" accept="image/jpg, image/jpeg, image/png, image/gif" multiple>
                        </label>
                    </div>

                    <div x-show="uploading">
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

                    {{-- <div class="flex">
                        <ul class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8" role="list">
                            @for ($i = 0; $i < 9; $i++)
                                <li class="relative" wire:key="{{ $i }}" draggable="true">
                                    <div class="block w-full overflow-hidden bg-gray-100 rounded-lg group aspect-h-7 aspect-w-10 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                        <img class="object-cover pointer-events-none group-hover:opacity-75" src="https://images.unsplash.com/photo-1582053433976-25c00369fc93?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=512&amp;q=80" alt="">
                                        <button class="absolute inset-0 focus:outline-none" type="button">
                                            <span class="sr-only">View details for IMG_4985.HEIC</span>
                                        </button>
                                    </div>
                                    <p class="block mt-2 text-sm font-medium text-gray-900 truncate pointer-events-none">{{ rand(111, 9999) }}</p>
                                    <p class="block text-sm font-medium text-gray-500 pointer-events-none">3.9 MB</p>
                                </li>
                            @endfor
                        </ul>
                    </div> --}}

                    <div class="grid hidden grid-cols-3 gap-4 select-none draggable" wire:ignore>
                        @for ($i = 0; $i < 9; $i++)
                            <div class="relative draggable--item hover:scale-110 hover:shadow-lg group">
                                <div class="overflow-hidden transition bg-gray-100 rounded-lg shadow-black aspect-w-10 aspect-h-7 focus-within:ring-2 focus-within:ring-black focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                    <img class="object-cover pointer-events-none group-hover:opacity-50" src="https://i.imgur.com/wAy4vKv.png" alt="">
                                </div>
                                <button class="absolute inset-0 items-center justify-center hidden group-hover:flex">
                                    <div class="p-1 bg-white rounded-full cursor-move">
                                        <svg class="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M18 9l3 3l-3 3" />
                                            <path d="M15 12h6" />
                                            <path d="M6 9l-3 3l3 3" />
                                            <path d="M3 12h6" />
                                            <path d="M9 18l3 3l3 -3" />
                                            <path d="M12 15v6" />
                                            <path d="M15 6l-3 -3l-3 3" />
                                            <path d="M12 3v6" />
                                        </svg>
                                    </div>
                                </button>
                                <button class="draggable--handle absolute cursor-pointer hidden p-0.5 bg-red-500 text-white rounded-full group-hover:block -top-1 -right-1.5">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 6l-12 12" />
                                        <path d="M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        @endfor
                    </div>

                    {{-- <div class="grid hidden grid-cols-3 gap-4 select-none draggable">
                        <div class="relative hover:scale-110 hover:shadow-lg group">
                            <div class="overflow-hidden transition bg-gray-100 rounded-lg shadow-black aspect-w-10 aspect-h-7 focus-within:ring-2 focus-within:ring-black focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                <img class="object-cover pointer-events-none group-hover:opacity-50" src="https://i.imgur.com/wAy4vKv.png" alt="">
                            </div>
                            <div class="absolute inset-0 items-center justify-center hidden group-hover:flex">
                                <div class="p-1 bg-white rounded-full cursor-move">
                                    <svg class="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 9l3 3l-3 3" />
                                        <path d="M15 12h6" />
                                        <path d="M6 9l-3 3l3 3" />
                                        <path d="M3 12h6" />
                                        <path d="M9 18l3 3l3 -3" />
                                        <path d="M12 15v6" />
                                        <path d="M15 6l-3 -3l-3 3" />
                                        <path d="M12 3v6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="absolute cursor-pointer hidden p-0.5 bg-red-500 text-white rounded-full group-hover:block -top-1 -right-1.5">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>
                            </div>
                        </div>

                        <div class="relative hover:scale-110 hover:shadow-lg group">
                            <div class="overflow-hidden transition bg-gray-100 rounded-lg shadow-black aspect-w-10 aspect-h-7 focus-within:ring-2 focus-within:ring-black focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                <img class="object-cover pointer-events-none group-hover:opacity-50" src="https://i.imgur.com/Ln0Ap0k.png" alt="">
                            </div>
                            <div class="absolute inset-0 items-center justify-center hidden group-hover:flex">
                                <div class="p-1 bg-white rounded-full cursor-move">
                                    <svg class="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 9l3 3l-3 3" />
                                        <path d="M15 12h6" />
                                        <path d="M6 9l-3 3l3 3" />
                                        <path d="M3 12h6" />
                                        <path d="M9 18l3 3l3 -3" />
                                        <path d="M12 15v6" />
                                        <path d="M15 6l-3 -3l-3 3" />
                                        <path d="M12 3v6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="absolute cursor-pointer hidden p-0.5 bg-red-500 text-white rounded-full group-hover:block -top-1 -right-1.5">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>
                            </div>
                        </div>

                        <div class="relative hover:scale-110 hover:shadow-lg group">
                            <div class="overflow-hidden transition bg-gray-100 rounded-lg shadow-black aspect-w-10 aspect-h-7 focus-within:ring-2 focus-within:ring-black focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                <img class="object-cover pointer-events-none group-hover:opacity-50" src="https://i.imgur.com/ikY2Afj.png" alt="">
                            </div>
                            <div class="absolute inset-0 items-center justify-center hidden group-hover:flex">
                                <div class="p-1 bg-white rounded-full cursor-move">
                                    <svg class="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 9l3 3l-3 3" />
                                        <path d="M15 12h6" />
                                        <path d="M6 9l-3 3l3 3" />
                                        <path d="M3 12h6" />
                                        <path d="M9 18l3 3l3 -3" />
                                        <path d="M12 15v6" />
                                        <path d="M15 6l-3 -3l-3 3" />
                                        <path d="M12 3v6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="absolute cursor-pointer hidden p-0.5 bg-red-500 text-white rounded-full group-hover:block -top-1 -right-1.5">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>
                            </div>
                        </div>

                        <div class="relative hover:scale-110 hover:shadow-lg group">
                            <div class="overflow-hidden transition bg-gray-100 rounded-lg shadow-black aspect-w-10 aspect-h-7 focus-within:ring-2 focus-within:ring-black focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                <img class="object-cover pointer-events-none group-hover:opacity-50" src="https://i.imgur.com/E9CNLLq.png" alt="">
                            </div>
                            <div class="absolute inset-0 items-center justify-center hidden group-hover:flex">
                                <div class="p-1 bg-white rounded-full cursor-move">
                                    <svg class="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 9l3 3l-3 3" />
                                        <path d="M15 12h6" />
                                        <path d="M6 9l-3 3l3 3" />
                                        <path d="M3 12h6" />
                                        <path d="M9 18l3 3l3 -3" />
                                        <path d="M12 15v6" />
                                        <path d="M15 6l-3 -3l-3 3" />
                                        <path d="M12 3v6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="absolute cursor-pointer hidden p-0.5 bg-red-500 text-white rounded-full group-hover:block -top-1 -right-1.5">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>
                            </div>
                        </div>

                        <div class="relative hover:scale-110 hover:shadow-lg group">
                            <div class="overflow-hidden transition bg-gray-100 rounded-lg shadow-black aspect-w-10 aspect-h-7 focus-within:ring-2 focus-within:ring-black focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                <img class="object-cover pointer-events-none group-hover:opacity-50" src="https://i.imgur.com/Gn1zp5M.png" alt="">
                            </div>
                            <div class="absolute inset-0 items-center justify-center hidden group-hover:flex">
                                <div class="p-1 bg-white rounded-full cursor-move">
                                    <svg class="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 9l3 3l-3 3" />
                                        <path d="M15 12h6" />
                                        <path d="M6 9l-3 3l3 3" />
                                        <path d="M3 12h6" />
                                        <path d="M9 18l3 3l3 -3" />
                                        <path d="M12 15v6" />
                                        <path d="M15 6l-3 -3l-3 3" />
                                        <path d="M12 3v6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="absolute cursor-pointer hidden p-0.5 bg-red-500 text-white rounded-full group-hover:block -top-1 -right-1.5">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>
                            </div>
                        </div>

                        <div class="relative hover:scale-110 hover:shadow-lg group">
                            <div class="overflow-hidden transition bg-gray-100 rounded-lg shadow-black aspect-w-10 aspect-h-7 focus-within:ring-2 focus-within:ring-black focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                <img class="object-cover pointer-events-none group-hover:opacity-50" src="https://i.imgur.com/QGUSeop.png" alt="">
                            </div>
                            <div class="absolute inset-0 items-center justify-center hidden group-hover:flex">
                                <div class="p-1 bg-white rounded-full cursor-move">
                                    <svg class="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 9l3 3l-3 3" />
                                        <path d="M15 12h6" />
                                        <path d="M6 9l-3 3l3 3" />
                                        <path d="M3 12h6" />
                                        <path d="M9 18l3 3l3 -3" />
                                        <path d="M12 15v6" />
                                        <path d="M15 6l-3 -3l-3 3" />
                                        <path d="M12 3v6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="absolute cursor-pointer hidden p-0.5 bg-red-500 text-white rounded-full group-hover:block -top-1 -right-1.5">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>
                            </div>
                        </div>

                        <div class="relative hover:scale-110 hover:shadow-lg group">
                            <div class="overflow-hidden transition bg-gray-100 rounded-lg shadow-black aspect-w-10 aspect-h-7 focus-within:ring-2 focus-within:ring-black focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                <img class="object-cover pointer-events-none group-hover:opacity-50" src="https://i.imgur.com/p5GB5VD.png" alt="">
                            </div>
                            <div class="absolute inset-0 items-center justify-center hidden group-hover:flex">
                                <div class="p-1 bg-white rounded-full cursor-move">
                                    <svg class="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 9l3 3l-3 3" />
                                        <path d="M15 12h6" />
                                        <path d="M6 9l-3 3l3 3" />
                                        <path d="M3 12h6" />
                                        <path d="M9 18l3 3l3 -3" />
                                        <path d="M12 15v6" />
                                        <path d="M15 6l-3 -3l-3 3" />
                                        <path d="M12 3v6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="absolute cursor-pointer hidden p-0.5 bg-red-500 text-white rounded-full group-hover:block -top-1 -right-1.5">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>
                            </div>
                        </div>

                        <div class="relative hover:scale-110 hover:shadow-lg group">
                            <div class="overflow-hidden transition bg-gray-100 rounded-lg shadow-black aspect-w-10 aspect-h-7 focus-within:ring-2 focus-within:ring-black focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                <img class="object-cover pointer-events-none group-hover:opacity-50" src="https://i.imgur.com/MIxfzXx.png" alt="">
                            </div>
                            <div class="absolute inset-0 items-center justify-center hidden group-hover:flex">
                                <div class="p-1 bg-white rounded-full cursor-move">
                                    <svg class="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 9l3 3l-3 3" />
                                        <path d="M15 12h6" />
                                        <path d="M6 9l-3 3l3 3" />
                                        <path d="M3 12h6" />
                                        <path d="M9 18l3 3l3 -3" />
                                        <path d="M12 15v6" />
                                        <path d="M15 6l-3 -3l-3 3" />
                                        <path d="M12 3v6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="absolute cursor-pointer hidden p-0.5 bg-red-500 text-white rounded-full group-hover:block -top-1 -right-1.5">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>
                            </div>
                        </div>

                        <div class="relative hover:scale-110 hover:shadow-lg group">
                            <div class="overflow-hidden transition bg-gray-100 rounded-lg shadow-black aspect-w-10 aspect-h-7 focus-within:ring-2 focus-within:ring-black focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                <img class="object-cover pointer-events-none group-hover:opacity-50" src="https://i.imgur.com/DEertti.jpg" alt="">
                            </div>
                            <div class="absolute inset-0 items-center justify-center hidden group-hover:flex">
                                <div class="p-1 bg-white rounded-full cursor-move">
                                    <svg class="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 9l3 3l-3 3" />
                                        <path d="M15 12h6" />
                                        <path d="M6 9l-3 3l3 3" />
                                        <path d="M3 12h6" />
                                        <path d="M9 18l3 3l3 -3" />
                                        <path d="M12 15v6" />
                                        <path d="M15 6l-3 -3l-3 3" />
                                        <path d="M12 3v6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="absolute cursor-pointer hidden p-0.5 bg-red-500 text-white rounded-full group-hover:block -top-1 -right-1.5">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>
                            </div>
                        </div>

                        <!--[if ENDBLOCK]><![endif]-->
                    </div> --}}

                    @if ($photos)
                        <div>
                            <div class="grid grid-cols-3 gap-4 select-none draggable" wire:draggable>
                                @foreach ($photos as $photo_key => $photo)
                                    <div class="overflow-hidden bg-gray-100 rounded-lg shadow-lg select-none draggable--item aspect-w-10 aspect-h-7 focus-within:ring-2 focus-within:ring-black focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                                        <img class="object-cover pointer-events-none group-hover:opacity-75" src="{{ $photo->temporaryUrl() }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="flex items-center justify-between transition delay-150" :class="active == 3 ? 'opacity-100' : ' opacity-0'">
                        <button class="button button-wide button-gray" type="button" x-on:click="prevTab">
                            Previous
                        </button>
                        <button class="button button-wide button-primary" type="button" disabled wire:click="nextTab('address')">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@script
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Runs immediately after Livewire has finished initializing
            // on the page...

        })
    </script>
@endscript

{{-- @push('scripts')
    <script>
        function initDraggable() {

            let file = Livewire.el.querySelector('input[type="file"]').files[0]
            Livewire.upload('photo', file, (uploadedFilename) => {
                // Success callback...
                console.log('success')
            }, () => {
                // Error callback...
                console.log('error')
            }, (event) => {
                // Progress callback...
                console.log('progress')
                // event.detail.progress contains a number between 1 and 100 as the upload progresses
            }, () => {
                // Cancelled callback...
                console.log('cancelled')
            })

            const sortable = new Sortable(document.querySelectorAll('.draggable'), {
                draggable: '.draggable--item',
            });

            sortable.on('sortable:start', () => console.log('sortable:start'));
            sortable.on('sortable:sort', () => console.log('sortable:sort'));
            sortable.on('sortable:sorted', () => console.log('sortable:sorted'));
            sortable.on('sortable:stop', () => console.log('sortable:stop'));
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
        }

        window.addEventListener("init-draggable", (event) => {
            initDraggable();
        });
    </script>
@endpush --}}
