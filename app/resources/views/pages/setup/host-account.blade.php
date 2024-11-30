<div class="flex-center min-h-full" wire:init="load">

    <flux:card class="mx-auto w-full max-w-lg space-y-8">
        <div>
            <flux:heading size="xl">Host Account</flux:heading>
            <flux:subheading>Fill out the form below to create a Host account</flux:subheading>
        </div>

        <flux:separator />

        <form class="grid grid-cols-1 gap-8" wire:submit.prevent="submit">

            <div class="grid grid-cols-2 gap-4">
                <flux:input wire:model="first_name" placeholder="John" required badge="Required" label="First name" />
                <flux:input wire:model="last_name" placeholder="Smith" required badge="Required" label="Last name" />
            </div>
            <flux:input type="email" wire:model="email" placeholder="jsmith@email.com" required badge="Required" label="Email address" />
            <flux:input type="password" wire:model="password" placeholder="••••••••" required badge="Required" label="Password" viewable description="Passwords must be at least 8 characters long." />

            <flux:button type="submit" variant="primary">Continue</flux:button>

        </form>

        {{-- <div x-data="{ open: false }">
            <button class="link -m-3 flex w-full items-center space-x-2 p-3 text-sm" @click="open = !open">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    <path d="M12 17l0 .01" />
                    <path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4" />
                </svg>
                <span>What are Host accounts?</span>
            </button>
            <div x-show="open" x-collapse x-cloak>
                <div class="alert alert-general mt-4">
                    <div class="mb-1">
                        <span class="font-bold text-red-500">Host accounts are Admin accounts!</span>
                    </div>
                    <span class="host">Host</span> accounts are granted full access. They have the ability to modify
                    site-wide settings, manage staff & guest accounts (which includes billing information), and make changes to
                    reservations/properties, etc. <span class="font-bold">Host Accounts should be reserved for team members requiring full access.</span>
                    Any team members that only need certain persmissions should be given <span class="staff">Staff</span>
                    accounts, as they can be given specific permissions. You will have the ability to set up
                    <span class="staff">Staff</span> accounts later.
                </div>
            </div>
        </div> --}}

    </flux:card>
</div>
