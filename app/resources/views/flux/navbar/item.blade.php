@aware([ 'variant' ])

@props([
    'iconVariant' => 'outline',
    'iconTrailing' => null,
    'badgeColor' => null,
    'variant' => null,
    'iconDot' => null,
    'badge' => null,
    'icon' => null,
])

@php
// Button should be a square if it has no text contents...
$square ??= $slot->isEmpty();

// Size-up icons in square/icon-only buttons...
$iconClasses = Flux::classes($square ? 'size-5' : 'size-5');

$classes = Flux::classes()
    ->add('px-3 h-8 flex items-center rounded-lg')
    ->add('relative') // This is here for the "active" bar at the bottom to be positioned correctly...
    ->add($square ? '!px-2.5' : '')
    ->add('text-zinc-500 dark:text-white/80 hover:text-zinc-800 hover:dark:text-white')
    ->add('hover:bg-zinc-100 hover:dark:bg-white/10')
    // Styles for when this link is the "current" one...
    ->add(match ($variant) {
        default => [
            'data-[current]:text-zinc-800 data-[current]:dark:text-zinc-100',
            'data-[current]:after:absolute data-[current]:after:-bottom-3 data-[current]:after:inset-x-0 data-[current]:after:h-[2px] data-[current]:after:bg-zinc-800 data-[current]:after:dark:bg-white',
        ]
    })
    ;
@endphp

<flux:button-or-link :attributes="$attributes->class($classes)" data-flux-navbar-items>
    <?php if ($icon): ?>
        <div class="relative">
            <flux:icon :$icon :variant="$iconVariant" class="{!! $iconClasses !!}" />

            <?php if ($iconDot): ?>
                <div class="absolute top-[-2px] right-[-2px]">
                    <div class="size-[6px] rounded-full bg-zinc-500 dark:bg-zinc-400"></div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($slot->isNotEmpty()): ?>
        <div class="{{ $icon ? 'ml-3' : '' }} flex-1 text-sm font-medium leading-none whitespace-nowrap [[data-nav-footer]_&]:hidden [[data-nav-sidebar]_[data-nav-footer]_&]:block" data-content>{{ $slot }}</div>
    <?php endif; ?>

    <?php if ($iconTrailing): ?>
        <flux:icon :icon="$iconTrailing" variant="micro" class="size-4 ml-1" />
    <?php endif; ?>

    <?php if ($badge): ?>
        <flux:navbar.badge :color="$badgeColor" class="ml-2">{{ $badge }}</flux:navbar.badge>
    <?php endif; ?>
</flux:button-or-link>
