@props([
    'direction' => null,
    'sortable' => false,
    'sorted' => false,
    'align' => 'left',
])

@php
$classes = Flux::classes()
    ->add('py-3 px-3 first:pl-0 last:pr-0')
    ->add('text-left text-sm font-medium text-zinc-800 dark:text-white')
    ->add($align === 'right' ? 'group/right-align' : '')
    ;
@endphp

<th {{ $attributes->class($classes) }} data-flux-column>
    <?php if ($sortable): ?>
        <div class="flex group-[]/right-align:justify-end">
            <flux:table.sortable :$sorted :direction="$direction">
                <div>{{ $slot }}</div>
            </flux:table.sortable>
        </div>
    <?php else: ?>
        <div class="flex group-[]/right-align:justify-end">{{ $slot }}</div>
    <?php endif; ?>
</th>
