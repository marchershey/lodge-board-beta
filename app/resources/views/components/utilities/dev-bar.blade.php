@env('local')
<!-- Development Bar -->

<div class="flex items-center bg-white border-t min-h-8 border-1 z-[999] dark:bg-black" :class="$store.devbar.open ? 'relative' : 'absolute bottom-0'">
    <div class="absolute inset-y-0 bg-black">
        <button class="flex-none block w-full h-full text-white bg-primary/50" @click="$store.devbar.toggle()">
            {{-- Close --}}
            <svg class="w-6 h-6" x-cloak x-show="$store.devbar.open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M14 6l-6 6l6 6v-12" />
            </svg>
            {{-- Open --}}
            <svg class="w-6 h-6" x-cloak x-show="!$store.devbar.open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 18l6 -6l-6 -6v12" />
            </svg>
        </button>
    </div>
    <div class="flex items-center justify-center w-full p-1" x-transition.in x-show="$store.devbar.open">
        <div class="flex items-center justify-center space-x-5 text-xs tablet-sm:text-sm">

            <!-- Theme Switcher -->
            <div class="flex">
                <button x-button @click="changeThemeMode()">
                    <!-- Moon icon -->
                    <svg class="hidden w-4 h-4 dark:block p-0.5" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"></path>
                    </svg>
                    <!-- Sun icon -->
                    <svg class="w-4 h-4 dark:hidden" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M14.828 14.828a4 4 0 1 0 -5.656 -5.656a4 4 0 0 0 5.656 5.656z"></path>
                        <path d="M6.343 17.657l-1.414 1.414"></path>
                        <path d="M6.343 6.343l-1.414 -1.414"></path>
                        <path d="M17.657 6.343l1.414 -1.414"></path>
                        <path d="M17.657 17.657l1.414 1.414"></path>
                        <path d="M4 12h-2"></path>
                        <path d="M12 4v-2"></path>
                        <path d="M20 12h2"></path>
                        <path d="M12 20v2"></path>
                    </svg>
                </button>
            </div>

            <!-- Screen Size -->
            <div class="flex">
                <span class="font-black">size:</span>
                <div class="flex">
                    <span class="block tablet-sm:hidden">mobile</span>
                    <span class="hidden tablet-sm:block tablet:hidden">tablet-sm</span>
                    <span class="hidden tablet:block laptop:hidden">tablet</span>
                    <span class="hidden laptop:block desktop:hidden">laptop</span>
                    <span class="hidden desktop:block">desktop</span>
                    <span class="block sm:hidden">(xs)</span>
                    <span class="hidden sm:block md:hidden">(sm)</span>
                    <span class="hidden md:block lg:hidden">(md)</span>
                    <span class="hidden lg:block xl:hidden">(lg)</span>
                    <span class="hidden xl:block 2xl:hidden">(xl)</span>
                    <span class="hidden 2xl:block">(2xl)</span>
                </div>
            </div>

            <!-- Environment Type -->
            <div class="flex">
                <span class="font-black">env:</span>
                <span>{{ config('app.env') }}</span>
            </div>

            <!-- Build -->
            <div class="flex">
                <span class="font-black">ver:</span>
                <span>{{ config('app.build') }}</span>
            </div>

            <!-- Links -->
            <div class="flex">
                <a class="link" href="{{ route('logout') }}">logout</a>
            </div>
        </div>
    </div>
</div>
@endenv
