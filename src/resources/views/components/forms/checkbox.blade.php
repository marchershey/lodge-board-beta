<div class="form-checkbox-container">
    <input class="form-checkbox @error($wiremodel) form-checkbox-error @enderror" id="{{ $wiremodel }}" name="{{ $wiremodel }}" type="checkbox" aria-describedby="{{ $wiremodel }}-desc" wire:model.live="{{ $wiremodel }}">
    <div class="flex flex-col">
        <label for="{{ $wiremodel }}">
            <span class="mb-0 form-label @error($wiremodel) form-label-error @enderror">{{ $label }}</span>
            <span class="mt-0 form-desc" id="{{ $wiremodel }}-desc">{!! $desc !!}</span>
            @error($wiremodel)
                <span class="text-xs text-red-500">{{ $errors->first($wiremodel) }}</span>
            @enderror
        </label>
    </div>
</div>
