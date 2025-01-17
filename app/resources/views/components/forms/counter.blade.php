<div x-data="{
    value: $wire.entangle('{{ $attributes->get('wire:model') }}'),
    step: {{ $step ?? 1 }},
    min: {{ $min ?? 0 }},
    max: {{ $max ?? 99 }},
    add() { this.value = (this.addDisabled) ? (this.value + this.step) : this.value },
    subtract() { this.value = (this.subtractDisabled) ? (this.value - this.step) : this.value },
    addDisabled() { return this.value >= this.max },
    subtractDisabled() { return this.value <= this.min }
}">

    <flux:field>
        @if ($attributes->get('label'))
            <flux:label>{{ $attributes->get('label') }}</flux:label>
        @endif
        @if ($attributes->get('desc'))
            <flux:description>{{ $attributes->get('desc') }}</flux:description>
        @endif
        <flux:input.group>
            <flux:button icon="minus" x-on:click="subtract" />
            <flux:input class="min-w-min max-w-fit" type="number" placeholder="Post title" readonly {{ $attributes->except(['class', 'label']) }} />
            <flux:button icon="plus" x-on:click="add" />
        </flux:input.group>

        <flux:error name="password" />

    </flux:field>
</div>

{{-- <div wire:loading.class="pointer-events-none opacity-30" wire:target="load, submit, {{ $wiretarget }}" x-data="{
    value: $wire.{{ $wiremodel }},
    step: {{ $step }},
    min: {{ $min }},
    max: {{ $max }},
    add() { this.value = (this.addDisabled) ? (this.value + this.step) : this.value },
    subtract() { this.value = (this.subtractDisabled) ? (this.value - this.step) : this.value },
    addDisabled() { return this.value >= this.max },
    subtractDisabled() { return this.value <= this.min }
}">
    <label class="form-label min-h-[24.5px]" for="{{ $wiremodel }}">
        {{ $label }}
        @if ($required && !$hideAsterisk)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <div class="form-counter">
        <input type="tel" type="text" x-model="value">
        <div class="form-counter-buttons">
            <button type="button" wire:loading.attr="disabled" wire:target="load, submit, {{ $wiretarget }}" x-on:click="subtract()" x-bind:disabled="subtractDisabled">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l14 0" />
                </svg>
            </button>
            <button type="button" wire:loading.attr="disabled" wire:target="load, submit, {{ $wiretarget }}" x-on:click="add()" x-bind:disabled="addDisabled">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                </svg>
            </button>
        </div>
    </div>

    <div class="flex hidden items-center space-x-2">
        <button class="input-counter-button" type="button" wire:loading.attr="disabled" wire:target="{{ $wiretarget }}" x-on:click="subtract()" x-bind:disabled="subtractDisabled">
            <svg class="block" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 12l14 0"></path>
            </svg>
        </button>
        <div class="@error($wiremodel) !text-red-500 @enderror w-8 text-center">
            <span class="h-[36px]" wire:loading.class="opacity-30" wire:target="{{ $wiretarget }}" x-text="value">
        </div>
        <button class="input-counter-button" type="button" wire:loading.attr="disabled" wire:target="{{ $wiretarget }}" x-on:click="add()" x-bind:disabled="addDisabled">
            <svg class="icon icon-tabler icon-tabler-plus" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
            </svg>
        </button>
    </div>

    <span class="form-desc @error($wiremodel) form-desc-error @enderror">
        {!! empty($errors->first($wiremodel)) ? $desc : $errors->first($wiremodel) !!}
    </span>
</div> --}}
