<div>
    <div class="card card-padding card-flex">
        <div class="card-header">
            <h1>Basic Information</h1>
            <p>First, we need the most basic information about your or your business.</p>
        </div>
        <form class="card-form" wire:submit.prevent="submit">
            <x-forms.text class="capitalize" type="text" wiremodel="site_name" label="Website / Business Name" desc="This will be used to identify you to your renters." placeholder="LodgeBoard" />
            {{-- 
                Website URL Input
                The 'onfocus' sets the value of the input to the resolved url if a value has not been set.
            --}}
            <x-forms.text type="text" wiremodel="site_url" label="Website URL" desc="What URL will your renters use to access your website? Be sure to include the protocol (http / https)." placeholder="https://lodgeboard.com" onfocus="value = value || '{{ url('/') }}'" />
            <x-forms.select wiremodel="timezone" label="Default Timezone" desc="This is the timezone that you live in." placeholder="Select a timezone..." :options="$timezone_list" />
            <div>
                <button class="w-full button button-primary button-xl" type="submit">
                    <x-spinner wiretarget="submit" />
                    Continue
                </button>
            </div>
        </form>
    </div>
</div>
