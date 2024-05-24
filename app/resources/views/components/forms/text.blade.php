<div wire:loading.class="pointer-events-none !opacity-30" wire:target="load, submit, {{ $wiretarget }}">
    <label for="{{ $wiremodel }}">
        <div class="form-label min-h-[24.5px]">
            {{ $label }}
            @if ($required && !$hideAsterisk)
                <span class="text-red-500">*</span>
            @endif
        </div>

        <div class="flex items-center form-input-container">
            @if (isset($before))
                <div {{ $before->attributes->class(['mr-2 flex items-center self-center']) }}>
                    {{ $before ?? null }}
                </div>
            @endif
            <div class="w-full">
                <input id="{{ $wiremodel }}" name="{{ $wiremodel }}" type="{{ $type }}" wire:model.{{ $wiremodeltype }}.trim="{{ $wiremodel }}" x-ref="{{ $wiremodel }}" x-on:focus="{{ $onfocus }}" {{ $attributes->merge(['class' => 'form-input']) }} placeholder="{{ $placeholder ?? $label }}" autocomplete="{{ $autocomplete ?? $wiremodel }}" wire:target="load, submit, {{ $wiretarget }}" wire:loading.attr="disabled" @if ($required) required @endif>
            </div>
            @if (isset($after))
                <div {{ $after->attributes->class(['ml-2 flex items-center self-center']) }}>
                    {{ $after ?? null }}
                </div>
            @endif
        </div>

        <span class="form-desc @error($wiremodel) form-desc-error @enderror">
            {!! empty($errors->first($wiremodel)) ? $desc : $errors->first($wiremodel) !!}
        </span>
    </label>
</div>
