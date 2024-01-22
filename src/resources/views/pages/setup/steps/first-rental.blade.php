<div>
    <div class="card card-padding card-flex">
        <div class="card-header">
            <h1>First Rental</h1>
            <p>Awesome! We're almost done. Last step is to add your first rental property!</p>
        </div>
        <form class="card-form" wire:submit.prevent="submit">
            <x-forms.text class="capitalize" type="text" wiremodel="rental_name" label="Rental Name" desc="Give this rental property a name." placeholder="Ohana Burnside" />
            <x-forms.text type="text" wiremodel="site_url" label="Website URL" desc="What URL will your renters use to access your website? Be sure to include the protocol (http / https)." placeholder="lodgeboard.com" />
            <div>
                <button class="w-full button button-primary button-xl" type="submit">
                    <x-spinner wiretarget="submit" />
                    Continue
                </button>
            </div>
        </form>
    </div>
</div>
