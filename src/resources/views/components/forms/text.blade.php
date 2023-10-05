<div>
    @if ($label)
        <label class="form-label @error($wiremodel) form-label-error @enderror" for="{{ $wiremodel }}">{{ $label }}</label>
    @endif
    <input class="form-input @error($wiremodel) form-input-error @enderror {{ $class }}" id="{{ $wiremodel }}" name="{{ $wiremodel }}" type="{{ $type }}" {{ $attributes->merge(['class' => '']) }} wire:model.blur="{{ $wiremodel }}" @if ($placeholder) placeholder="{{ $placeholder }}" @endif autocomplete="{{ $autocomplete ?? $wiremodel }}">

    <div class="h-4 -mb-4">
        @if ($desc || $errors->first($wiremodel))
            <span class="form-desc @error($wiremodel) form-desc-error @enderror">
                {{ empty($errors->first($wiremodel)) ? $desc : $errors->first($wiremodel) }}
            </span>
        @endif
    </div>
</div>
