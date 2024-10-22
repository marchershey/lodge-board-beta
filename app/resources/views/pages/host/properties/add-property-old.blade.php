<x-layouts.host>

    <x-slot:pageTitle>Add New Property</x-slot:pageTitle>
    <div class="page-content" wire:init="load">
        <form class="form-container" wire:submit.prevent="submit">

            <x-forms.section>

                {{-- Basic Information --}}
                <x-slot:header>Basic Information</x-slot:header>
                <x-slot:desc>The basic information about your property</x-slot:desc>
                <div class="form-grid">
                    <div class="tablet-sm:!col-span-6 tablet:!col-span-full laptop:!col-span-6">
                        <x-forms.text class="capitalize" wiremodel="name" label="Property Name" />
                    </div>
                    <div class="tablet-sm:!col-span-8 tablet:!col-span-full laptop:!col-span-8">
                        <x-forms.text class="capitalize" wiremodel="address.street" label="Street Address" />
                    </div>
                    <div class="tablet-sm:!col-span-5 tablet:!col-span-full laptop:!col-span-5">
                        <x-forms.text class="capitalize" wiremodel="address.city" label="City" />
                    </div>
                    <div class="tablet-sm:!col-span-5 tablet:!col-span-full laptop:!col-span-5">
                        <x-forms.select wiremodel="address.state" label="State" :options="\App\Helpers\GeographyHelper::getStates()" placeholder="Select a state..." />
                    </div>
                    <div class="tablet-sm:!col-span-2 tablet:!col-span-full laptop:!col-span-2">
                        <x-forms.text class="zip-code" type="tel" wiremodel="address.zip" label="Zip" placeholder="Zip" />
                    </div>
                </div>
            </x-forms.section>

            {{-- Property Information --}}
            <x-forms.section>
                <x-slot:header>Property Information</x-slot:header>
                <x-slot:desc>The key information that is displayed to guests on the property page.</x-slot:desc>

                <div class="form-grid">
                    <div class="tablet-sm:!col-span-6 tablet:!col-span-full laptop:!col-span-6">
                        <x-forms.text class="capitalize" wiremodel="propertyyyyyyyyyyy_headline" label="Property Headline" />
                    </div>
                    <div class="tablet-sm:!col-span-10 tablet:!col-span-full laptop:!col-span-10">
                        <x-forms.textarea class="capitalize" maxlength="500" wiremodel="property_description" label="Property Description" desc="Max Characters: 500" />
                    </div>
                </div>
            </x-forms.section>

            {{-- Pricing Information --}}
            <x-forms.section>
                <x-slot:header>Pricing Information</x-slot:header>
                <x-slot:desc>The information about the amount to charge per night, as well as taxes and fees.</x-slot:desc>

                <div class="form-grid">
                    {{-- Nightly Rate --}}
                    <div class="!col-span-6 tablet-sm:!col-span-4 tablet:!col-span-6 desktop:!col-span-3">
                        <x-forms.text class="money" wiremodel="base_rate" label="Nightly Rate" placeholder="0.00">
                            <x-slot:before class="text-muted">
                                <svg class="w-4 h-4 icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2">
                                    </path>
                                    <path d="M12 3v3m0 12v3"></path>
                                </svg>
                            </x-slot:before>
                            <x-slot:after class="text-muted">USD</x-slot:after>
                        </x-forms.text>
                    </div>
                    {{-- Tax Rate --}}
                    <div class="!col-span-6 tablet-sm:!col-span-4 tablet:!col-span-6 desktop:!col-span-3">
                        <x-forms.text class="money" wiremodel="tax_rate" label="Tax Rate" placeholder="0">
                            <x-slot:after class="text-muted">
                                <svg class="w-4 h-4 icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="17" cy="17" r="1"></circle>
                                    <circle cx="7" cy="7" r="1"></circle>
                                    <line x1="6" y1="18" x2="18" y2="6"></line>
                                </svg>
                            </x-slot:after>
                        </x-forms.text>
                    </div>
                    <div class="!col-span-full tablet-sm:!col-span-4 tablet:pt-0 tablet:!col-span-full tablet-sm:pt-[25px] desktop:!col-span-6 desktop:pt-[25px] flex justify-end">
                        <button class="button button-full desktop:w-auto button-gray" type="button" wire:click="addAdditionalFee()">Add additional fees</button>
                    </div>

                    {{-- Fees --}}
                    @if ($fees)
                        @foreach ($fees as $key => $fee)
                            <hr class="!col-span-full">
                            <div class="!col-span-full form-grid" wire:key="fee-{{ $key }}">
                                {{-- Fee Name --}}
                                <div class="!col-span-6 tablet-sm:!col-span-4 tablet:!col-span-6 desktop:!col-span-4">
                                    <x-forms.text class="capitalize" wiremodel="fees.{{ $key }}.name" label="Fee Name" />
                                </div>

                                {{-- Fee Amount --}}
                                <div class="!col-span-6 tablet-sm:!col-span-3 tablet:!col-span-6 desktop:!col-span-3">
                                    <x-forms.text class="money" wiremodel="fees.{{ $key }}.amount" label="Fee Amount" placeholder="0.00">
                                        @if ($fees[$key]['type'] == 'fixed')
                                            <x-slot:before class="text-muted">
                                                <svg class="w-4 h-4 icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2">
                                                    </path>
                                                    <path d="M12 3v3m0 12v3"></path>
                                                </svg>
                                            </x-slot:before>
                                            <x-slot:after class="text-muted"><span>USD</span></x-slot:after>
                                        @else
                                            <x-slot:after class="text-muted">
                                                <svg class="w-4 h-4 icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <circle cx="17" cy="17" r="1"></circle>
                                                    <circle cx="7" cy="7" r="1"></circle>
                                                    <line x1="6" y1="18" x2="18" y2="6"></line>
                                                </svg>
                                            </x-slot:after>
                                        @endif
                                    </x-forms.text>
                                </div>

                                {{-- Fee Type Selector --}}
                                <div class="!col-span-6 tablet-sm:!col-span-4 tablet:pt-0 tablet:!col-span-6 desktop:!col-span-4 flex tablet-sm:justify-center desktop:justify-center tablet:justify-start">
                                    <div x-data="{
                                        value: $wire.entangle('fees.{{ $key }}.type').live,
                                        select(option) { this.value = option },
                                        selected(option) { return this.value == option }
                                    }">
                                        <div class="form-label min-h-[24.5px]">
                                            Fee Type
                                        </div>
                                        <div class="h-[35px] bg-gray-100 rounded-lg flex overflow-hidden has-border">
                                            <button class="px-4 py-2 text-sm" type="button" :class="{ 'bg-primary text-white': selected('fixed') }" x-on:click="select('fixed')">Fixed</button>
                                            <button class="px-4 py-2 text-sm" type="button" :class="{ 'bg-primary text-white': selected('percent') }" x-on:click="select('percent')">Percent</button>
                                        </div>
                                    </div>
                                </div>

                                {{-- Delete Fee --}}
                                <div class="!col-span-6 tablet-sm:!col-span-1 tablet-sm:pt-[27px] tablet:!col-span-6 tablet:pt-0 desktop:!col-span-1 desktop:pt-[27px] flex justify-end">
                                    {{-- Button --}}
                                    <div class="">
                                        <button class="h-auto button button-xs button-gray" type="button" wire:click="removeAdditionalFee({{ $key }})">
                                            <span>
                                                <svg class="icon tablet-sm:!m-0 tablet:!-ml-1 tablet:!mr-2 desktop:!m-0 icon-tabler icons-tabler-outline icon-tabler-trash" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </span>
                                            <span class="mt-1 tablet-sm:hidden tablet:block desktop:hidden ">
                                                Delete Fee
                                            </span>
                                        </button>
                                    </div>
                                    {{-- Icon --}}
                                    <div class="hidden">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </x-forms.section>

            {{-- Amenities --}}
            <x-forms.section>
                <x-slot:header>Amenities</x-slot:header>
                <x-slot:desc>Add all of the amenities that your property has to offer, such as a pool, tennis table, garage, etc.</x-slot:desc>

                <div>
                    @foreach ($amenities as $key => $group)
                        <div>
                            {{ $group['name'] }}
                        </div>
                    @endforeach
                </div>
            </x-forms.section>

        </form>
    </div>

    <div class="hidden space-y-10 divide-y divide-gray-900/10">
        <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
            <div class="px-4 sm:px-0">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Profile</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be careful what you share.</p>
            </div>

            <form class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                <div class="px-4 py-6 sm:p-8">
                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label class="block text-sm font-medium leading-6 text-gray-900" for="website">Website</label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <span class="flex items-center pl-3 text-gray-500 select-none sm:text-sm">http://</span>
                                    <input class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" id="website" name="website" type="text" placeholder="www.example.com">
                                </div>
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900" for="about">About</label>
                            <div class="mt-2">
                                <textarea class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" id="about" name="about" rows="3"></textarea>
                            </div>
                            <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about yourself.</p>
                        </div>

                        <div class="col-span-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900" for="photo">Photo</label>
                            <div class="flex items-center mt-2 gap-x-3">
                                <svg class="w-12 h-12 text-gray-300" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                                </svg>
                                <button class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" type="button">Change</button>
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900" for="cover-photo">Cover photo</label>
                            <div class="flex justify-center px-6 py-10 mt-2 border border-dashed rounded-lg border-gray-900/25">
                                <div class="text-center">
                                    <svg class="w-12 h-12 mx-auto text-gray-300" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                    </svg>
                                    <div class="flex mt-4 text-sm leading-6 text-gray-600">
                                        <label class="relative font-semibold text-indigo-600 bg-white rounded-md cursor-pointer focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500" for="file-upload">
                                            <span>Upload a file</span>
                                            <input class="sr-only" id="file-upload" name="file-upload" type="file">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end px-4 py-4 border-t gap-x-6 border-gray-900/10 sm:px-8">
                    <button class="text-sm font-semibold leading-6 text-gray-900" type="button">Cancel</button>
                    <button class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" type="submit">Save</button>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 pt-10 gap-x-8 gap-y-8 md:grid-cols-3">
            <div class="px-4 sm:px-0">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can receive mail.</p>
            </div>

            <form class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                <div class="px-4 py-6 sm:p-8">
                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label class="block text-sm font-medium leading-6 text-gray-900" for="first-name">First name</label>
                            <div class="mt-2">
                                <input class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" id="first-name" name="first-name" type="text" autocomplete="given-name">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label class="block text-sm font-medium leading-6 text-gray-900" for="last-name">Last name</label>
                            <div class="mt-2">
                                <input class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" id="last-name" name="last-name" type="text" autocomplete="family-name">
                            </div>
                        </div>

                        <div class="sm:col-span-4">
                            <label class="block text-sm font-medium leading-6 text-gray-900" for="email">Email address</label>
                            <div class="mt-2">
                                <input class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" id="email" name="email" type="email" autocomplete="email">
                            </div>
                        </div>

                        <div class="sm:col-span-4">
                            <label class="block text-sm font-medium leading-6 text-gray-900" for="country">Country</label>
                            <div class="mt-2">
                                <select class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" id="country" name="country" autocomplete="country-name">
                                    <option>United States</option>
                                    <option>Canada</option>
                                    <option>Mexico</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label class="block text-sm font-medium leading-6 text-gray-900" for="street-address">Street address</label>
                            <div class="mt-2">
                                <input class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" id="street-address" name="street-address" type="text" autocomplete="street-address">
                            </div>
                        </div>

                        <div class="sm:col-span-2 sm:col-start-1">
                            <label class="block text-sm font-medium leading-6 text-gray-900" for="city">City</label>
                            <div class="mt-2">
                                <input class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" id="city" name="city" type="text" autocomplete="address-level2">
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900" for="region">State / Province</label>
                            <div class="mt-2">
                                <input class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" id="region" name="region" type="text" autocomplete="address-level1">
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium leading-6 text-gray-900" for="postal-code">ZIP / Postal code</label>
                            <div class="mt-2">
                                <input class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" id="postal-code" name="postal-code" type="text" autocomplete="postal-code">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end px-4 py-4 border-t gap-x-6 border-gray-900/10 sm:px-8">
                    <button class="text-sm font-semibold leading-6 text-gray-900" type="button">Cancel</button>
                    <button class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" type="submit">Save</button>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 pt-10 gap-x-8 gap-y-8 md:grid-cols-3">
            <div class="px-4 sm:px-0">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Notifications</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">We'll always let you know about important changes, but you pick what else you want to hear about.</p>
            </div>

            <form class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
                <div class="px-4 py-6 sm:p-8">
                    <div class="max-w-2xl space-y-10">
                        <fieldset>
                            <legend class="text-sm font-semibold leading-6 text-gray-900">By Email</legend>
                            <div class="mt-6 space-y-6">
                                <div class="relative flex gap-x-3">
                                    <div class="flex items-center h-6">
                                        <input class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-600" id="comments" name="comments" type="checkbox">
                                    </div>
                                    <div class="text-sm leading-6">
                                        <label class="font-medium text-gray-900" for="comments">Comments</label>
                                        <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p>
                                    </div>
                                </div>
                                <div class="relative flex gap-x-3">
                                    <div class="flex items-center h-6">
                                        <input class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-600" id="candidates" name="candidates" type="checkbox">
                                    </div>
                                    <div class="text-sm leading-6">
                                        <label class="font-medium text-gray-900" for="candidates">Candidates</label>
                                        <p class="text-gray-500">Get notified when a candidate applies for a job.</p>
                                    </div>
                                </div>
                                <div class="relative flex gap-x-3">
                                    <div class="flex items-center h-6">
                                        <input class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-600" id="offers" name="offers" type="checkbox">
                                    </div>
                                    <div class="text-sm leading-6">
                                        <label class="font-medium text-gray-900" for="offers">Offers</label>
                                        <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="text-sm font-semibold leading-6 text-gray-900">Push Notifications</legend>
                            <p class="mt-1 text-sm leading-6 text-gray-600">These are delivered via SMS to your mobile phone.</p>
                            <div class="mt-6 space-y-6">
                                <div class="flex items-center gap-x-3">
                                    <input class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-600" id="push-everything" name="push-notifications" type="radio">
                                    <label class="block text-sm font-medium leading-6 text-gray-900" for="push-everything">Everything</label>
                                </div>
                                <div class="flex items-center gap-x-3">
                                    <input class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-600" id="push-email" name="push-notifications" type="radio">
                                    <label class="block text-sm font-medium leading-6 text-gray-900" for="push-email">Same as email</label>
                                </div>
                                <div class="flex items-center gap-x-3">
                                    <input class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-600" id="push-nothing" name="push-notifications" type="radio">
                                    <label class="block text-sm font-medium leading-6 text-gray-900" for="push-nothing">No push notifications</label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="flex items-center justify-end px-4 py-4 border-t gap-x-6 border-gray-900/10 sm:px-8">
                    <button class="text-sm font-semibold leading-6 text-gray-900" type="button">Cancel</button>
                    <button class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.host>
