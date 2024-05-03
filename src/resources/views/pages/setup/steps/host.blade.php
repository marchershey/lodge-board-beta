<section class="card card-padding card-flex">
    <div class="flex-col space-y-6">
        <div class="text-gray-500">First's things first, we need to create a <span class="host">Host</span> account.</div>
        <div x-data="{ open: true }">
            <button class="flex items-center p-3 -m-3 space-x-2 text-sm link" @click="open = !open">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    <path d="M12 17l0 .01" />
                    <path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4" />
                </svg>
                <span>What are Host accounts?</span>
            </button>
            <div x-show="open" x-collapse x-cloak>
                <div class="p-4 mt-4 text-sm text-gray-700 bg-gray-100 rounded-lg">
                    <span class="font-bold text-red-500">Host account are granted full administrative access.</span> They have the ability to modify site-wide settings, manage staff & guest accounts (which includes billing information), and make changes to reservations/listings, etc. <span class="font-bold">They should be reserved for team members requiring full access.</span>
                </div>
            </div>
        </div>
    </div>
    {{-- <p class="text-center text-gray-500">Fill out the form below to create a <span class="host">Host</span> account. <button class="link" type="button">What is a Host account?</button></p> --}}
    <form class="card-form">
        <div class="!col-span-6">
            <x-forms.text class="capitalize" wiremodel="first_name" label="Full Name" placeholder="First Name" />
        </div>
        <div class="!col-span-6">
            <x-forms.text class="capitalize" wiremodel="last_name" label="" placeholder="Last Name" />
        </div>
        <x-forms.text type="email" wiremodel="email" label="Email Address" desc="You'll need to confirm this email address in a later step." />
        <x-forms.text type="password" wiremodel="password" label="Password" desc="Passwords must be at least 8 characters long." />
    </form>
    <div class="w-full">
        <button class="button button-full" type="button">Continue</button>
    </div>
</section>
