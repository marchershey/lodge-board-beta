<section class="card card-padding card-flex" x-data="{ value: $wire.entangle('site_url') }" wire:init="load">
    <p class="text-center">
        Awesome {{ Auth::user()->first_name ?? 'NO NAME' }}! Next step, let's get some basic information about your business.
    </p>

    <form class="form-grid" action="">
        <x-forms.text class="capitalize" label="Website / Business Name" wiremodel="site_name" desc="This will be used to identify you to your renters." />
        <x-forms.text class="" label="Website URL" wiremodel="site_url" desc="What URL will your renters use to access your website? Be sure to include the protocol (http / https)." onfocus="value = value || '{{ url('/') }}'" />
        <x-forms.select wiremodel="timezone" label="Default Timezone" desc="This is the timezone that you live in." placeholder="Select a timezone..." :options="\App\Helpers\GeographyHelper::getTimezones()" showKeyAsSelection />
    </form>
</section>

{{-- <section class="card card-padding card-flex" wire:init="load">
    <div class="card-header">
        <h1>Basic Information</h1>
        <p>First, we need the most basic information about your or your business.</p>
    </div>
    <form class="card-form">
        <x-forms.text class="capitalize" type="text" wiremodel="site_name" label="Website / Business Name" desc="This will be used to identify you to your renters." />
        <x-forms.text type="text" wiremodel="site_url" label="Website URL" desc="What URL will your renters use to access your website? Be sure to include the protocol (http / https)." onfocus="value = value || '{{ url('/') }}'" />
        <x-forms.select wiremodel="timezone" label="Default Timezone" desc="This is the timezone that you live in." placeholder="Select a timezone..." :options="\App\Helpers\GeographyHelper::getTimezones()" showKeyAsSelection />
    </form>
    <div>
        <button class="button button-full button-lg" type="submit">Continue</button>
    </div>
</section> --}}
