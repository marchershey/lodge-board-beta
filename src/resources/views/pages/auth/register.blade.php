<div class="mx-auto tablet-sm:max-w-md">
    <h1 class="mb-8 text-center page-title">Create your account</h1>

    <div class="card card-padding">
        <form class="card-form" wire:submit.prevent="submit">
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
            <div>
                <button class="w-full button button-xl button-primary" type="submit">
                    <x-spinner wiretarget="submit" />
                    Create Account
                </button>
            </div>
            <div class="text-center">
                Already have an account? <a class="link" href="{{ route('login') }}" wire:navigate.hover>Log in</a>
            </div>
        </form>
    </div>
</div>
