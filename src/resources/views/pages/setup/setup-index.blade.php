<div class="mx-auto tablet-sm:max-w-md" wire:init="load" x-data="{
    step: $wire.entangle('current_step'),
    page_desc: $wire.entangle('page_desc')
}">

    <header class="mb-12 text-center">
        <h1 class="page-title">Welcome to {{ config('app.name') }}!</h1>
        <p class="text-gray-500 page-desc">Get started by completing the following steps below.</p>
    </header>

    <div class="w-full" wire:loading.delay>
        <div class="text-center card card-padding">
            <x-spinner color="text-muted" size="w-12 h-12" />
        </div>
    </div>

    <div wire:loading.delay.remove>
        @if ($current_step == 1)
            <div wire:transition.in>
                <livewire:pages.setup.steps.host-account />
            </div>
            {{-- <div></div>

            <div class="card card-padding card-flex">
                <div class="card-header">
                    <h1>Application Setup</h1>
                    <p class="mt-4">Welcome to {{ config('app.name') }}. We're so excited to have you onboard! It appears you're the first visitor to you personal {{ config('app.name') }}, so we're assuming you'll be the Administrator. If that's not the case, please contact your Adminstrator to setup your LodgeBoard.</p>
                    <p class="mt-4">Before we get into it, we need some basic information from you about your business. When you're ready to begin, simply click "Continue"</p>
                </div>
                <div class="flex justify-end">
                    <button class="button button-lg button-full" @click="$dispatch('next-step')">Continue</button>
                </div>
            </div> --}}
        @endif

        @if ($current_step == 2)
            <div wire:transition.in>
                <livewire:pages.setup.steps.site-config />
            </div>
        @endif

        @if ($current_step == 3)
            <div wire:transition.in>
                <livewire:pages.setup.steps.first-rental />
            </div>
        @endif

        @if ($current_step == 4)
            <div wire:transition.in>
                <livewire:pages.setup.steps.rental-photos />
            </div>
        @endif

        @if ($current_step == 5)
            <div wire:transition.in>
                <livewire:pages.setup.steps.rental-details />
            </div>
        @endif

        {{-- <div x-cloak x-show="step == 1">
            <div class="card card-padding card-flex">
                <div class="card-header">
                    <h1>Application Setup</h1>
                    <p class="mt-4">Welcome to {{ config('app.name') }}. We're so excited to have you onboard! It appears you're the first visitor to you personal {{ config('app.name') }}, so we're assuming you'll be the Administrator. If that's not the case, please contact your Adminstrator to setup your LodgeBoard.</p>
                    <p class="mt-4">Before we get into it, we need some basic information from you about your business. When you're ready to begin, simply click "Continue"</p>
                </div>
                <div class="flex justify-end">
                    <button class="button button-lg button-full" @click="$dispatch('next-step')">Continue</button>
                </div>
            </div>
        </div> --}}

        {{-- Site configuration --}}
        {{-- <div x-cloak x-show="step == 2">
            <livewire:pages.setup.steps.site-config />
        </div> --}}

        {{-- First Rental --}}
        {{-- <div x-cloak x-show="step == 3">
            <livewire:pages.setup.steps.first-rental />
        </div> --}}

        {{-- Rental Photos --}}
        {{-- <div x-cloak x-show="step == 4">
            <livewire:pages.setup.steps.rental-photos />
        </div> --}}

        {{-- Rental Rates --}}
        {{-- <div x-cloak x-show="step == 5">
            <livewire:pages.setup.steps.rental-details />
        </div> --}}

        @if (app()->isLocal())
            <div class="flex justify-between mt-8">
                <button class="button button-xs button-gray" @click="$dispatch('prev-step')">Back</button>
                <button class="button button-xs button-gray" @click="$dispatch('next-step')">Next</button>
            </div>
        @endif
    </div>
</div>
