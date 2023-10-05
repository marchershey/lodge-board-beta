<div class="form-checkbox-container">
    <input class="form-checkbox" id="{{ $wiremodel }}" name="{{ $wiremodel }}" type="checkbox" aria-describedby="{{ $wiremodel }}-desc" wire:model="{{ $wiremodel }}">
    <label for="{{ $wiremodel }}">
        <span class="mb-0 form-label">{{ $label }}</span>
        <span class="mt-0 leading-4 form-desc" id="{{ $wiremodel }}-desc">{!! $desc !!}</span>
    </label>
</div>
