<div x-data="{ value: $wire.entangle('{{ $wiremodel }}') }" wire:loading.delay.class="pointer-events-none opacity-30" wire:target="load, submit, {{ $wiretarget }}">
    <label class="form-label min-h-[24.5px] @error($wiremodel) form-label-error @enderror" for="{{ $wiremodel }}">{{ $label }}</label>

    <input class="form-input @error($wiremodel) form-input-error @enderror {{ $class }}" id="{{ $wiremodel }}" name="{{ $wiremodel }}" type="{{ $type }}" wire:model.blur="{{ $wiremodel }}" x-ref="inputField" x-on:focus="{{ $onfocus }}" {{ $attributes->merge(['class' => '']) }} placeholder="{{ $placeholder ?? $label }}" autocomplete="{{ $autocomplete ?? $wiremodel }}" wire:target="load, submit, {{ $wiretarget }}" wire:loading.attr="disabled">

    <span class="form-desc @error($wiremodel) form-desc-error @enderror">
        {!! empty($errors->first($wiremodel)) ? $desc : $errors->first($wiremodel) !!}
    </span>
</div>
