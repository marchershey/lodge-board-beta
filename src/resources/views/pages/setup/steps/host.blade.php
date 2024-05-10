<section class="card card-padding card-flex">

    <p class="text-center">
        First's things first, we need to create a <span class="host">Host</span> account.
        Please note that this will be the account you will be signed into during setup.
    </p>

    <div x-data="{ open: false }">
        <button class="flex items-center justify-center w-full p-3 -m-3 space-x-2 text-sm link" @click="open = !open">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                <path d="M12 17l0 .01" />
                <path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4" />
            </svg>
            <span>What are Host accounts?</span>
        </button>
        <div x-show="open" x-collapse x-cloak>
            <div class="mt-4 alert alert-general">
                <span class="font-bold text-red-500">Host accounts are Admin accounts.</span>
                They are granted full administrative access. They have the ability to modify
                site-wide settings, manage staff & guest accounts (which includes billing information),
                and make changes to reservations/listings, etc.
                <span class="font-bold">Host Accounts should be reserved for team members requiring full access.</span>
                Any team members that only need certain persmissions should be given <span class="staff">Staff</span>
                accounts, as they can be given specific permissions.
            </div>
        </div>
    </div>

    <form class="form-grid" wire:submit.prevent="submit">
        <div class="!col-span-6">
            <x-forms.text class="capitalize" wiremodel="first_name" label="Full Name" placeholder="First Name" />
        </div>
        <div class="!col-span-6">
            <x-forms.text class="capitalize" wiremodel="last_name" label="" placeholder="Last Name" hideAsterisk />
        </div>
        <div class="col-span-full">

        </div>
        <x-forms.text type="email" wiremodel="email" label="Email Address" desc="You'll need to confirm this email address in a later step." />
        <x-forms.text type="password" wiremodel="password" label="Password" desc="Passwords must be at least 8 characters long." />

        <div class="form-buttons">
            <button class="button button-full" type="submit">Continue</button>
        </div>
    </form>

</section>
