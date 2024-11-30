{{-- <section class="mx-auto tablet-sm:max-w-md">
    <h1 class="page-title mb-8 text-center">Create an account</h1>

    <div class="card card-padding">
        <form class="form-grid" wire:submit.prevent="submit">
            <div class="!col-span-6">
                <x-forms.text class="capitalize" wiremodel="first_name" label="First Name" placeholder="First Name" />
            </div>
            <div class="!col-span-6">
                <x-forms.text class="capitalize" wiremodel="last_name" label="Last Name" placeholder="Last Name" />
            </div>
            <x-forms.text type="email" wiremodel="email" label="Email Address" placeholder="Email Address" />
            <x-forms.text type="password" wiremodel="password_confirmation" label="Password" placeholder="Password" desc="Your password must contain at least 8 characters" />
            <x-forms.text type="password" wiremodel="password" label="Confirm Password" placeholder="Password" desc="Retype your password" />
            <x-forms.checkbox wiremodel="terms" label="Terms of Service Agreement" desc="By checking this box, you acknowledge that you have read and agree to our <a class='link' href='#'>Terms of Service</a>, as well as our <a class='link' href='#'>Privacy Policy</a>." />
            <div class="form-buttons">
                <button class="button button-lg button-primary w-full" type="submit">
                    Create Account
                </button>
            </div>
            <div class="text-center">
                Already have an account? <a class="link" href="{{ route('login') }}" wire:navigate.hover>Log in</a>
            </div>
        </form>
    </div>
</section> --}}

<form class="flex-center min-h-full" wire:submit.prevent="submit">
    <flux:card class="mx-auto w-full max-w-lg space-y-6">
        <div>
            <flux:heading size="lg">Create an account</flux:heading>
            <flux:subheading>Fill out the form below to create an account!</flux:subheading>
        </div>

        <div class="space-y-6">
            <div class="grid grid-cols-2 gap-4">
                <flux:input wire:model="first_name" placeholder="John" required label="First name" />
                <flux:input wire:model="last_name" placeholder="Smith" required label="Last name" />
            </div>
            <flux:input type="email" wire:model="email" placeholder="jsmith@email.com" required label="Email address" />
            <flux:input type="password" wire:model="password" placeholder="••••••••" required label="Password" viewable description="Passwords must be at least 8 characters long." />
            <flux:input type="password" wire:model="password_confirmation" placeholder="••••••••" required label="Confirm Password" viewable description="Confirm your password by typing it again." />
            <flux:checkbox wire:model="terms" label="I agree to the terms and conditions" />
        </div>

        <div class="space-y-2">
            <flux:button class="w-full" type="submit" variant="primary">Create account</flux:button>
            <flux:button class="w-full" href="{{ route('login') }}" variant="ghost">Log into an existing account</flux:button>
        </div>
    </flux:card>

</form>
