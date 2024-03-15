<div x-data="{ value: @entangle($wiremodel) }">
    @if ($label)
        <label class="form-label @error($wiremodel) form-label-error @enderror" for="{{ $wiremodel }}">{{ $label }}</label>
    @endif

    <input class="form-input @error($wiremodel) form-input-error @enderror {{ $class }}" id="{{ $wiremodel }}" name="{{ $wiremodel }}" type="{{ $type }}" wire:model.blur="{{ $wiremodel }}" x-ref="inputField" x-on:focus="{{ $onfocus }}" {{ $attributes->merge(['class' => '']) }} placeholder="{{ $placeholder ?? $label }}" autocomplete="{{ $autocomplete ?? $wiremodel }}">

    @if ($desc || $errors->first($wiremodel))
        <span class="form-desc @error($wiremodel) form-desc-error @enderror">
            {!! empty($errors->first($wiremodel)) ? $desc : $errors->first($wiremodel) !!}
        </span>
    @endif
</div>
