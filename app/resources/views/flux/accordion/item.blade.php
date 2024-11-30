@props([
    'transition' => false,
    'disabled' => false,
    'expanded' => false,
    'heading' => null,
])

@php
$classes = Flux::classes()
    ->add('block pt-4 first:pt-0 pb-4 last:pb-0')
    ->add('border-b last:border-b-0 border-zinc-800/10 dark:border-white/10')
    ;
@endphp

<ui-disclosure
    {{ $attributes->class($classes) }}
    x-data="{ open: @json($expanded) }"
    x-model.self="open"
    data-flux-accordion-item
>
    <?php if ($heading): ?>
        <flux:accordion.heading>{{ $heading }}</flux:accordion.heading>

        <flux:accordion.content>{{ $slot }}</flux:accordion.content>
    <?php else: ?>
        {{ $slot }}
    <?php endif; ?>
</ui-disclosure>
