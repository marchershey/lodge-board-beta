<section class="mx-auto card card-padding card-flex tablet-sm:max-w-lg" x-data="{ value: $wire.entangle('site_url') }" wire:init="load">

    <div class="text-center card-header">
        <h1>Adding a Property!</h1>
        <p>
            In the following steps, we'll ask you several questions about your
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

</section>
