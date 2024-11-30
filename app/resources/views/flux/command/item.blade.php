@props([
    'icon' => null,
    'kbd' => null,
])

@php
$classes = Flux::classes()
    ->add('w-full group/item data-[hidden]:hidden h-10 flex items-center px-2 py-1.5 focus:outline-none')
    ->add('rounded-md')
    ->add('text-left text-sm font-medium')
    ->add('text-zinc-800 data-[active]:bg-zinc-100 dark:text-white data-[active]:dark:bg-zinc-600')
    ;
@endphp

<ui-option action {{ $attributes->class($classes) }} data-flux-command-item>
    <?php if ($icon): ?>
        <div class="relative">
            <flux:icon :$icon variant="outline" class="mr-2 size-6 text-zinc-400 dark:text-zinc-400 group-data-[active]/item:text-zinc-800 group-data-[active]/item:dark:text-white" />
        </div>
    <?php endif; ?>

    {{ $slot }}

    <?php if ($kbd): ?>
        <div class="inline-flex ml-auto rounded bg-zinc-800/5 dark:bg-white/10 px-1 py-0.5">
            <span class="font-medium text-xs text-zinc-500 dark:text-zinc-300">{{ $kbd }}</span>
        </div>
    <?php endif; ?>
</ui-option>
