<div wire:loading.delay.class="pointer-events-none opacity-30" wire:target="load, submit, {{ $wiretarget }}">
    <label class="form-label min-h-[24.5px] @error($wiremodel) form-label-error @enderror" for="{{ $wiremodel }}">
        {{ $label }}
        @if ($required && !$hideAsterisk)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <input class="form-input {{ $class }}" id="{{ $wiremodel }}" name="{{ $wiremodel }}" type="{{ $type }}" wire:model.blur="{{ $wiremodel }}" x-ref="{{ $wiremodel }}" x-on:focus="{{ $onfocus }}" {{ $attributes->merge(['class' => '']) }} placeholder="{{ $placeholder ?? $label }}" autocomplete="{{ $autocomplete ?? $wiremodel }}" wire:target="load, submit, {{ $wiretarget }}" wire:loading.attr="disabled" @if ($required) required @endif>

    <span class="form-desc @error($wiremodel) form-desc-error @enderror">
        {!! empty($errors->first($wiremodel)) ? $desc : $errors->first($wiremodel) !!}
    </span>
</div>
