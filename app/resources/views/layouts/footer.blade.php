<div class="flex flex-col py-6 space-y-4 text-center">
    <div class="text-xs text-muted">
        You've found the footer.
    </div>
    @auth
        <div class="text-xs text-muted">
            Signed in as {{ auth()->user()->email }} - <a class="link link-muted" href="{{ route('logout') }}">Sign out</a>
        </div>
    @endauth
</div>
