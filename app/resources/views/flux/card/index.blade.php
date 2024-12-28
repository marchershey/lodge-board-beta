@php
    $classes = Flux::classes()->add('p-6 rounded-xl')->add('bg-white dark:bg-white/10')->add('border border-zinc-300 dark:border-white/10');
@endphp

<div data-flux-card {{ $attributes->class($classes) }}>
    {{ $slot }}
</div>
