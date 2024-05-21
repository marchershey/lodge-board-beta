<section class="mx-auto card card-padding card-flex tablet-sm:max-w-lg">
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

    <p>
        By pressing the <span class="link hover:no-underline hover:cursor-default">Continue</span> button below, you acknowledge that you have read and agree to the terms outlined
        in the above documents.
    </p>

    <form class="form-grid" wire:submit.prevent="continue">
        <div class="form-buttons">
            <button class="button button-full" type="submit" wire:loading.attr="disabled">Continue</button>
        </div>
    </form>
</section>
