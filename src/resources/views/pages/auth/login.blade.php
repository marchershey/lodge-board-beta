<form class="card-form">
    <x-forms.text type="email" wiremodel="email" label="Email Address" placeholder="you@example.com" />
    <x-forms.text type="password" wiremodel="password" label="Password" placeholder="password123" />
    <x-forms.toggle wiremodel="remember" label="Stay signed in" desc="Enable this to stay signed in forever" />
    <div>
        <button class="w-full button button-primary">Sign in</button>
    </div>
    <div class="text-center">
        Don't have an account? <a class="link" href="{{ route('register') }}" wire:navigate.hover>Create one</a> instead.
    </div>
</form>
