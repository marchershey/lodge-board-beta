<div class="flex-none">
    @foreach ($banners as $banner)
        <div class="page-x-padding {{ $banner['style']['bg'] }} border-b py-4 text-white">
            <div class="container flex justify-between space-x-2 page-x-padding">
                <a class="flex items-center w-full space-x-4" href="{{ $banner['link'] ?? '#' }}" wire:navigate.hover>
                    <div>
                        <svg class="{{ $banner['style']['icon'] }} h-8 w-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                            <path d="M12 8v4" />
                            <path d="M12 16h.01" />
                        </svg>
                    </div>
                    <div class="flex flex-col leading-5">
                        <span class="{{ $banner['style']['title'] }} font-semibold">{{ $banner['title'] }}</span>
                        <span class="{{ $banner['style']['desc'] }} text-xs tablet:text-sm">
                            {!! $banner['description'] !!}
                        </span>
                    </div>
                </a>
                @if (!$banner['hideCloseButton'])
                    <button class="-m-3 !-mr-4 p-3" wire:click="deleteBanner('{{ $banner['id'] }}')">
                        <svg class="{{ $banner['style']['close'] }} h-6 w-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M18 6l-12 12" />
                            <path d="M6 6l12 12" />
                        </svg>
                    </button>
                @endif
            </div>
        </div>
    @endforeach
</div>
