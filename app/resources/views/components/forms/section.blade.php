@props(['heading', 'subheading', 'size' => 'full'])

<flux:card {{ $attributes->class(['space-y-6', 'w-full', 'mx-auto'])->merge(['class' => 'max-w-' . $size]) }}>
    <div>
        <flux:heading size="lg">{{ $heading }}</flux:heading>
        <flux:subheading>{{ $subheading }}</flux:subheading>
    </div>
    <flux:separator />
    <div>
        asdf
    </div>
</flux:card>

{{-- <div class="form-section">
    <div class="form-section-details">
        <h2 class="form-section-header">{{ $header }}</h2>
        <p class="form-section-desc">{{ $desc }}</p>
    </div>

    <div class="form-section-content">
        <div>
            {{ $slot }}
        </div>
    </div>
</div> --}}
