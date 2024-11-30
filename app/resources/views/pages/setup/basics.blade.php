{{-- <section class="card card-padding card-flex mx-auto tablet-sm:max-w-lg" x-data="{ value: $wire.entangle('site_url') }" wire:init="load">

    <div class="card-header text-center">
        <h1>General Site Information</h1>
        <p>
            Now, let's collect some basic information about your business.
        </p>
    </div>

    <form class="form-grid" wire:submit.prevent="submit">
        <x-forms.text class="capitalize" label="Website / Business Name" wiremodel="site_name" desc="This will be used to identify you to your renters." />
        <x-forms.text class="" label="Website URL" wiremodel="site_url" desc="This is the URL of this installation of {{ config('app.name') }}." onfocus="value = value || '{{ url('/') }}'" />
        <x-forms.select wiremodel="timezone" label="Default Timezone" desc="This is the timezone that you live in." :options="\App\Helpers\GeographyHelper::getTimezones()" showKeyAsSelection />
        <div class="form-buttons">
            <button class="button button-full" type="submit" wire:loading.attr="disabled" wire:target="load">Continue</button>
        </div>
    </form>

</section> --}}

<div class="flex-center min-h-full" wire:init="load" x-data="{ value: $wire.entangle('site_url').live }">

    <flux:card class="mx-auto w-full max-w-lg space-y-8">
        <div>
            <flux:heading size="xl">App Settings</flux:heading>
            <flux:subheading>Fill out the form below to continue</flux:subheading>
        </div>

        <flux:separator />

        <form class="grid grid-cols-1 gap-8" wire:submit.prevent="submit">
            <flux:input wire:model="site_name" badge="Required" label="Website / Business name" description="This will be used to identify you to your renters." placeholder="Smith Rentals" required />
            <flux:input wire:model.blur="site_url" badge="Required" label="Website URL" description="This is the URL of this installation of {{ config('app.name') }}." placeholder="https://domain.com" required x-on:focus="value = value || '{{ url('/') }}'" />

            <flux:field>
                <flux:label>Default Timezone</flux:label>

                <flux:description>This is the timezone in which times & dates will be displayed to you.</flux:description>

                <flux:select wire:model="timezone" variant="listbox" searchable placeholder="Select a timezone...">
                    @foreach (\App\Helpers\GeographyHelper::getTimezones() as $key => $text)
                        <flux:option value="{{ $key }}">
                            {{ $text }}
                        </flux:option>
                    @endforeach
                </flux:select>

                <flux:error name="username" />
            </flux:field>

            <flux:button type="submit" variant="primary">Continue</flux:button>
        </form>
    </flux:card>
</div>
