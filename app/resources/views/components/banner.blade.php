<div class="transition" x-data="{
    hasBanners: $wire.entangle('hasBanners')
}" x-show="hasBanners" x-cloak>

    @foreach ($banners as $banner)
        @php
            switch ($banner['type']) {
                case 'info':
                    $bgcolor = 'bg-primary';
                    $textcolor = 'text-white';
                    break;
                case 'warning':
                    $bgcolor = 'bg-yellow-500';
                    $textcolor = 'text-yellow-900';
                    break;
                case 'error':
                    $bgcolor = 'bg-red-500';
                    $textcolor = 'text-black';
                    break;
            }
        @endphp
        <div class="py-4 text-white page-x-padding {{ $bgcolor }}">
            <div class="flex justify-between space-x-2">
                <div class="{{ $textcolor }}">
                    <a href="{{ $banner['link'] ?? '#' }}" wire:navigate>
                        {!! $banner['content'] !!}
                    </a>
                </div>
                @if (!$banner['hideCloseButton'])
                    <button class="p-3 -m-3 !-mr-4" wire:click="deleteBanner('{{ $banner['id'] }}')">
                        <svg class="w-6 h-6 {{ $textcolor }}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
