@props([
    'name' => $attributes->whereStartsWith('wire:model')->first(),
    'placeholder' => null,
    'invalid' => null,
    'size' => null,
])

@php
$invalid ??= ($name && $errors->has($name));

$classes = Flux::classes()
    ->add('appearance-none') // Strip the browser's default <select> styles...
    ->add('w-full pl-3 pr-10 block')
    ->add(match ($size) {
        default => 'h-10 py-2 text-sm rounded-lg',
        'sm' => 'h-8 py-1.5 text-sm rounded-md',
        'xs' => 'h-6 text-xs rounded-md',
    })
    ->add('shadow-sm border')
    ->add('bg-white dark:bg-white/10 dark:disabled:bg-white/[9%]')
    ->add('text-zinc-700 dark:text-zinc-300')
    // Make the placeholder match the text color of standard input placeholders...
    ->add('has-[option.placeholder:checked]:text-zinc-400 dark:has-[option.placeholder:checked]:text-zinc-400')
    ->add('disabled:shadow-none')
    ->add($invalid
        ? 'border border-red-500'
        : 'border border-zinc-200 border-b-zinc-300/80 dark:border-white/10'
    )
    ;
@endphp

<select
    {{ $attributes->class($classes) }}
    @if ($invalid) aria-invalid="true" data-invalid @endif
    @isset ($name) name="{{ $name }}" @endisset
    @if (is_numeric($size)) size="{{ $size }}" @endif
    data-flux-control
    data-flux-select-native
    data-flux-group-target
>
    <?php if ($placeholder): ?>
        <option value="" disabled selected class="placeholder">{{ $placeholder }}</option>
    <?php endif; ?>

    {{ $slot }}
</select>
