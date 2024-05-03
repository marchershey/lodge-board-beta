{{-- <div wire:init="load" wire:loading.class="opacity-50 pointer-events-none" wire:target="submit">
    <header class="text-center">
        <h1 class="page-title">Welcome to {{ config('app.name') }}!</h1>
        <p class="text-gray-500 page-desc">To get started, you need to create a <strong class=\'text-primary\'>Host</strong> account.</p>
    </header>
    <form class="card card-padding card-flex" wire:submit.prevent="submit">
        <div class="card-header">
            <h1>Basic Information</h1>
            <p>First, we need the most basic information about your or your business.</p>
        </div>
        <div class="card-form">
            <x-forms.text class="capitalize" type="text" wiremodel="site_name" label="Website / Business Name" desc="This will be used to identify you to your renters." />
            <x-forms.text type="text" wiremodel="site_url" label="Website URL" desc="What URL will your renters use to access your website? Be sure to include the protocol (http / https)." onfocus="value = value || '{{ url('/') }}'" />
            <x-forms.select wiremodel="timezone" label="Default Timezone" desc="This is the timezone that you live in." placeholder="Select a timezone..." :options="\App\Helpers\GeographyHelper::getTimezones()" showKeyAsSelection />
        </div>
        <div class="flex justify-end">
            <button class="button button-full button-lg" type="submit">Continue</button>
        </div>
    </form>
</div> --}}

<section class="card card-padding card-flex">
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
</section>
