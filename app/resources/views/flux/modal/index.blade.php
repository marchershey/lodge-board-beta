@props([
    'dismissible' => null,
    'closable' => null,
    'trigger' => null,
    'variant' => null,
    'name' => null,
])

@php
$closable ??= $variant === 'bare' ? false : true;

$classes = Flux::classes()
    ->add(match ($variant) {
        default => 'p-6 [:where(&)]:max-w-xl shadow-lg rounded-xl',
        'flyout' => 'fixed m-0 p-8 max-h-dvh min-h-dvh md:[:where(&)]:min-w-[25rem] overflow-y-auto ml-auto',
        'bare' => '',
    })
    ->add(match ($variant) {
        default => 'bg-white dark:bg-zinc-800 border border-transparent dark:border-zinc-700',
        'flyout' => 'bg-white dark:bg-zinc-800 border border-transparent dark:border-zinc-700',
        'bare' => 'bg-transparent',
    });

// Support <flux:modal ... @close="?"> syntax...
if ($attributes['@close'] ?? null) {
    $attributes['wire:close'] = $attributes['@close'];

    unset($attributes['@close']);
}

if ($dismissible === false) {
    $attributes = $attributes->merge(['disable-click-outside' => '']);
}

[ $styleAttributes, $attributes ] = Flux::splitAttributes($attributes, ['class', 'style', 'wire:close', 'x-on:close']);
@endphp

<ui-modal {{ $attributes }} data-flux-modal>
    <?php if ($trigger): ?>
        {{ $trigger }}
    <?php endif; ?>

    <dialog
        wire:ignore.self {{-- This needs to be here because the dialog element adds a "close" attribute that isn't durable... --}}
        {{ $styleAttributes->class($classes) }}
        @if ($name) data-modal="{{ $name }}" @endif
        @if ($variant === 'flyout') data-flux-flyout @endif
        x-data
        @isset($__livewire)
            x-on:modal-show.document="
                if ($event.detail.name === @js($name) && ($event.detail.scope === @js($__livewire->getId()))) $el.showModal();
                if ($event.detail.name === @js($name) && (! $event.detail.scope)) $el.showModal();
            "
            x-on:modal-close.document="
                if ($event.detail.name === @js($name) && ($event.detail.scope === @js($__livewire->getId()))) $el.close();
                if (! $event.detail.name || ($event.detail.name === @js($name) && (! $event.detail.scope))) $el.close();
            "
        @else
            x-on:modal-show.document="if ($event.detail.name === @js($name) && (! $event.detail.scope)) $el.showModal()"
            x-on:modal-close.document="if (! $event.detail.name || ($event.detail.name === @js($name) && (! $event.detail.scope))) $el.close()"
        @endif
    >
        {{ $slot }}

        <?php if ($closable): ?>
            {{-- This "[&[hidden]]:block" hack is here to prevent this element from effecting classes like "space-y-6" --}}
            <div class="absolute top-0 right-0 mt-4 mr-4 [&[hidden]]:block" hidden>
                <flux:modal.close>
                    <flux:button variant="ghost" icon="x-mark" size="sm" alt="Close modal" class="!text-zinc-400 hover:!text-zinc-800 dark:!text-zinc-500 dark:hover:!text-white"></flux:button>
                </flux:modal.close>
            </div>
        <?php endif; ?>
    </dialog>
</ui-modal>
