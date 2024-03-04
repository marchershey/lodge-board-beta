<div class="form-checkbox-container group">
    <input class="peer form-checkbox @error($wiremodel) form-checkbox-error @enderror" id="{{ $wiremodel }}" name="{{ $wiremodel }}" type="checkbox" aria-describedby="{{ $wiremodel }}-desc" wire:model.live="{{ $wiremodel }}">
    <div class="flex flex-col cursor-pointer">
        <label class="cursor-pointer" for="{{ $wiremodel }}">
            <span class="mb-0 pb-0 form-label @error($wiremodel) form-label-error @enderror">{{ $label }}</span>
            <span class="mt-0 form-desc" id="{{ $wiremodel }}-desc">{!! $desc !!}</span>
            @error($wiremodel)
                <span class="mt-4 form-desc form-label-error">{{ $errors->first($wiremodel) }}</span>
            @enderror
        </label>
    </div>
</div>
