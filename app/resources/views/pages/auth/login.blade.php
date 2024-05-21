<div class="mx-auto tablet-sm:max-w-sm">
    <h1 class="mb-8 font-semibold text-center font-2xl page-title">Sign into your account</h1>

    <div class="card card-padding">
        <form class="form-grid" wire:submit.prevent="submit">
            <x-forms.text type="email" wiremodel="email" label="Email Address" placeholder="you@example.com" />
            <x-forms.text type="password" wiremodel="password" label="Password" placeholder="password123" />
            <x-forms.toggle wiremodel="remember" label="Remember me" desc="Enable this to stay signed in forever. Do not enable this unless you're on a private computer." />
            <div class="form-buttons">
                <button class="w-full button button-primary button-lg" type="submit">
                    Sign in
                </button>
            </div>
            <div class="text-center">
                Don't have an account? <a class="link" href="{{ route('register') }}" wire:navigate.hover>Sign up</a>
            </div>
        </form>
    </div>
</div>
