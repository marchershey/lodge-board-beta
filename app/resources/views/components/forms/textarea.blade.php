<div wire:loading.class="pointer-events-none opacity-30" wire:target="load, submit, {{ $wiretarget }}" x-data="{
    content: $wire.entangle('{{ $wiremodel }}') ?? '',
    maxlength: {{ $maxlength }},
    alert() {
        if (content.length >= maxlength * 0.8 && content.length < maxlength)
            return

    }
}">
    <div class="flex items-center justify-between">
        <label class="form-label min-h-[24.5px]" for="{{ $wiremodel }}">
            {{ $label }}
            @if ($required && !$hideAsterisk)
                <span class="text-red-500">*</span>
            @endif
        </label>
        <div class="form-desc" :class="{ 'text-yellow-500': content.length >= maxlength * 0.9 & content.length < maxlength, 'text-red-500': content.length >= maxlength }">
            <span x-text="content.length">0</span> / {{ $maxlength }}
        </div>
    </div>

    {{-- <input class="form-input" id="{{ $wiremodel }}" name="{{ $wiremodel }}" type="{{ $type }}" wire:model.{{ $wiremodeltype }}.trim="{{ $wiremodel }}" x-ref="{{ $wiremodel }}" x-on:focus="{{ $onfocus }}" {{ $attributes->merge(['class' => '']) }} placeholder="{{ $placeholder ?? $label }}" autocomplete="{{ $autocomplete ?? $wiremodel }}" wire:target="load, submit, {{ $wiretarget }}" wire:loading.attr="disabled" @if ($required) required @endif> --}}
    <div class="form-input-container">
        <textarea class="form-input" id="{{ $wiremodel }}" name="{{ $wiremodel }}" x-model="content" @if ($cols) cols="{{ $cols }}" @endif rows="{{ $rows }}" wire:model.{{ $wiremodeltype }}.trim="{{ $wiremodel }}" x-ref="{{ $wiremodel }}" x-on:focus="{{ $onfocus }}" {{ $attributes->merge(['class' => '']) }} placeholder="{{ $placeholder ?? $label }}" autocomplete="{{ $autocomplete ?? $wiremodel }}" wire:target="load, submit, {{ $wiretarget }}" wire:loading.attr="disabled" @if ($required) required @endif></textarea>
    </div>

    <span class="form-desc @error($wiremodel) form-desc-error @enderror">
        {!! empty($errors->first($wiremodel)) ? $desc : $errors->first($wiremodel) !!}
    </span>
</div>
