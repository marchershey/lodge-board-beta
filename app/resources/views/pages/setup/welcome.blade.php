<div class="flex-center min-h-full">

    <flux:card class="mx-auto w-full max-w-lg space-y-8">
        <div>
            <flux:heading size="xl">Welcome to {{ config('app.name') }}!</flux:heading>
            <flux:subheading>Before we get started, we need to configure your new app!</flux:subheading>
        </div>

        <flux:separator />

        <p>
            To complete the setup, you'll need to do the following:
        </p>

        <ul class="list-inside list-disc font-semibold">
            <li>Create administrator account</li>
            <li>Configure application settings</li>
            <li>Add at least one property</li>
        </ul>

        <p>
            Once you have completed the above steps, you'll be redirected to the dashboard where you can explore the entire application in all it's glory!
        </p>

        <p>
            If you're ready to get started, take a brief moment to review the following documents which outline the guidelines, terms, and
            policies which govern your use of {{ config('app.name') }}.
        </p>

        <ul class="list-inside list-disc">
            <li><span class="link">Terms of Service Agreement</span></li>
            <li><span class="link">Acceptable Use Guidelines</span></li>
            <li><span class="link">Data Privacy Policy</span></li>
            <li><span class="link">Cookie Policy</span></li>
            <li><span class="link">Disclaimers & Limitations of Liability</span></li>
        </ul>

        <p>
            By pressing the <span class="link hover:cursor-default hover:no-underline">Continue</span> button below, you acknowledge that you have read and agree to the terms outlined
            in the above documents.
        </p>

        <p>
            <flux:button class="w-full" wire:click="continue" variant="primary">Continue</flux:button>
        </p>
    </flux:card>
</div>

{{-- <section class="card card-padding card-flex mx-auto tablet:max-w-lg">
    <p>
        <strong class="text-primary">Welcome to {{ config('app.name') }}!</strong> Before we get started with the setup, you'll need to have the following information ready.
    </p>

    <ul class="list-inside list-disc font-semibold">
        <li>Admin account details</li>
        <li>Business name, website URL, & default timezone</li>
        <li>Details of at least one property property (such as name, address, and a few photos)</li>
    </ul>

    <p>
        Once you have the above items, please take a moment to review the following
        documents which outline the rules and regulations governing your use of
        {{ config('app.name') }}.
    </p>

    <ul class="list-inside list-disc">
        <li><span class="link">Acceptable Use Guidelines</span></li>
        <li><span class="link">Terms of Service Agreement</span></li>
        <li><span class="link">Data Privacy Policy</span></li>
        <li><span class="link">Cookie Policy</span></li>
        <li><span class="link">Disclaimers & Limitations of Liability</span></li>
    </ul>

    <p>
        By pressing the <span class="link hover:cursor-default hover:no-underline">Continue</span> button below, you acknowledge that you have read and agree to the terms outlined
        in the above documents.
    </p>

    <form class="form-grid" wire:submit.prevent="continue">
        <div class="form-buttons">
            <button class="button button-full" type="submit" wire:loading.attr="disabled">Continue</button>
        </div>
    </form>
</section> --}}
