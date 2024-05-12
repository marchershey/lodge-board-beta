<section class="card card-padding card-flex" x-data="{ value: $wire.entangle('site_url') }" wire:init="load">

    <p>
        Welcome aboard, <span class="font-bold">{{ Auth::user()->first_name ?? 'NO NAME' }}!</span> Next step, let's collect some basic information regarding your company.
    </p>

    <form class="form-grid" wire:submit.prevent="submit">
        <x-forms.text class="capitalize" label="Website / Business Name" wiremodel="site_name" desc="This will be used to identify you to your renters." />
        <x-forms.text class="" label="Website URL" wiremodel="site_url" desc="What URL will your renters use to access your website? Be sure to include the protocol (http / https)." onfocus="value = value || '{{ url('/') }}'" />
        <x-forms.select wiremodel="timezone" label="Default Timezone" desc="This is the timezone that you live in." placeholder="Select a timezone..." :options="\App\Helpers\GeographyHelper::getTimezones()" showKeyAsSelection />
        <div class="form-buttons">
            <button class="button button-full" type="submit">Continue</button>
        </div>
    </form>

</section>
