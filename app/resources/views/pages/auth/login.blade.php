<form class="flex-center min-h-full" wire:submit.prevent="submit">
    <flux:card class="mx-auto w-full max-w-lg space-y-6">
        <div>
            <flux:heading size="lg">Log in to your account</flux:heading>
            <flux:subheading>Welcome back!</flux:subheading>
        </div>

        <div class="space-y-6">
            <flux:input type="email" wire:model="email" label="Email" placeholder="Your email address" />
            <flux:field>
                <div class="mb-3 flex justify-between">
                    <flux:label>Password</flux:label>
                    <flux:link class="text-sm" href="#" variant="subtle">Forgot password?</flux:link>
                </div>
                <flux:input type="password" wire:model="password" placeholder="Your password" />
                <flux:error name="password" />
            </flux:field>
        </div>

        <div class="space-y-2">
            <flux:button class="w-full" type="submit" variant="primary">Log in</flux:button>
            <flux:button class="w-full" href="{{ route('register') }}" variant="ghost">Sign up for a new account</flux:button>
        </div>
    </flux:card>

</form>

{{-- <div class="mx-auto tablet:max-w-sm">
    <h1 class="font-2xl page-title mb-8 text-center font-semibold">Sign into your account</h1>

    <div class="card card-padding">
        <form class="form-grid" wire:submit.prevent="submit">
            <x-forms.text type="email" wiremodel="email" label="Email Address" placeholder="you@example.com" />
            <x-forms.text type="password" wiremodel="password" label="Password" placeholder="password123" />
            <x-forms.toggle wiremodel="remember" label="Remember me" desc="Enable this to stay signed in forever. Do not enable this unless you're on a private computer." />
            <div class="form-buttons">
                <button class="button button-primary button-lg w-full" type="submit">
                    Sign in
                </button>
            </div>
            <div class="text-center">
                Don't have an account? <a class="link" href="{{ route('register') }}" wire:navigate.hover>Sign up</a>
            </div>
        </form>
    </div>
</div> --}}
