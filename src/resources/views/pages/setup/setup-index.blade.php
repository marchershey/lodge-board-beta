<div class="mx-auto tablet-sm:max-w-lg" wire:init="load" x-data="{
    step: $wire.current_step
}">

    {{-- <header class="mb-12 text-center">
        <h1 class="page-title">Welcome to {{ config('app.name') }}</h1>
        <p class="text-gray-500 page-desc">Get started by completing the following steps below.</p>
    </header> --}}

    <div class="w-full" wire:loading.delay>
        <div class="text-center card card-padding">
            <x-spinner color="text-muted" size="w-12 h-12" />
        </div>
    </div>

    <div wire:loading.delay.remove>
        @if ($current_step == 1)
            <div wire:transition.in>
                <section class="text-gray-600 card card-padding card-flex">
                    <p>
                        <strong class="text-primary">Welcome to {{ config('app.name') }}!</strong> Before we get started with the setup, you'll need to have the following information ready.
                    </p>

                    <ul class="font-semibold list-disc list-inside">
                        <li>Admin account details</li>
                        <li>Business name, website URL, & default timezone</li>
                        <li>Details of at least one rental property (such as name, address, and a few photos)</li>
                    </ul>

                    <p>
                        Once you have the above items, please take a moment to review the following
                        documents which outline the rules and regulations governing your use of
                        {{ config('app.name') }}.
                    </p>

                    <ul class="list-disc list-inside">
                        <li><span class="link">Acceptable Use Guidelines</span></li>
                        <li><span class="link">Terms of Service Agreement</span></li>
                        <li><span class="link">Data Privacy Policy</span></li>
                        <li><span class="link">Cookie Policy</span></li>
                        <li><span class="link">Disclaimers & Limitations of Liability</span></li>
                    </ul>

                    {{-- <p>
                        We also have a few documents you might want to save for later to help make your expierence
                        using {{ config('app.name') }} a little better.
                    </p>

                    <ul class="list-disc list-inside">
                        <li><span class="link">Dispute Resolution Procedures</span></li>
                    </ul> --}}

                    <p>
                        By pressing the <span class="link hover:no-underline hover:cursor-default">Continue</span> button below, you acknowledge that you have read and agree to the terms outlined
                        in the above documents.
                    </p>

                    <div>
                        <button class="button button-full" wire:click="nextStep">Continue</button>
                    </div>
                </section>
            </div>
        @endif

        @if ($current_step == 2)
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

        @if ($current_step == 3)
            <div wire:transition.in>
                <livewire:pages.setup.steps.site-config />
            </div>
        @endif

        @if ($current_step == 4)
            <div wire:transition.in>
                <livewire:pages.setup.steps.first-rental />
            </div>
        @endif

        @if ($current_step == 5)
            <div wire:transition.in>
                <livewire:pages.setup.steps.rental-photos />
            </div>
        @endif

        @if ($current_step == 6)
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
