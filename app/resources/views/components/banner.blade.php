<div>
    @foreach ($banners as $banner)
        <div class="py-4 text-white page-x-padding border-b {{ $banner['style']['bg'] }}">
            <div class="container flex justify-between space-x-2 page-x-padding">
                <a class="flex items-center w-full space-x-4" href="{{ $banner['link'] ?? '#' }}" wire:navigate.hover>
                    <div>
                        <svg class="w-8 h-8 {{ $banner['style']['icon'] }}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                            <path d="M12 8v4" />
                            <path d="M12 16h.01" />
                        </svg>
                    </div>
                    <div class="flex flex-col leading-5">
                        <span class="font-semibold tracking-wide {{ $banner['style']['title'] }}">{{ $banner['title'] }}</span>
                        <span class="text-xs tracking-wide tablet-sm:text-sm {{ $banner['style']['desc'] }}">
                            {!! $banner['description'] !!}
                        </span>
                    </div>
                </a>
                @if (!$banner['hideCloseButton'])
                    <button class="p-3 -m-3 !-mr-4" wire:click="deleteBanner('{{ $banner['id'] }}')">
                        <svg class="w-6 h-6 {{ $banner['style']['close'] }}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
