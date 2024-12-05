@props([
    'model' => $attributes->whereStartsWith('wire:model')->first(),
    'label' => '',
    'desc' => '',
    'subtext' => '',
    'default' => 0,
    'step' => 1,
    'min' => 0,
    'max' => 99,
])

<div class="select-none" x-data="{
    value: $wire.entangle('{{ $model }}'),
    default: {{ $default }},
    step: {{ $step }},
    min: {{ $min }},
    max: {{ $max }},
    poll: null,
    lastClick: 0,
    init() { this.value = this.value || this.default || this.min },
    add() { this.value = (this.addDisabled) ? (this.value + this.step) : this.value },
    subtract() { this.value = (this.subtractDisabled) ? (this.value - this.step) : this.value },
    addDisabled() { return this.value >= this.max },
    subtractDisabled() { return this.value <= this.min }
}">

    <flux:field>
        @if ($label)
            <flux:label>{{ $label }}</flux:label>
        @endif
        @if ($desc)
            <flux:description>{{ $desc }}</flux:description>
        @endif
        <div class="flex min-w-fit items-center">
            <div class="@error($model) rounded-lg ring-1 ring-red-500 @enderror flex items-center">
                <div :class="subtractDisabled() && 'opacity-20'">
                    <flux:button square icon="minus" variant="filled" x-bind:disabled="subtractDisabled" x-on:click="subtract()" />
                </div>
                <div class="flex-center w-20">
                    <div class="flex flex-col text-center">
                        <span x-text="value">0</span>
                        @if ($subtext)
                            <span class="text-xs text-muted">{{ $subtext }}</span>
                        @endif
                    </div>
                </div>
                <div :class="addDisabled() && 'opacity-20'">
                    <flux:button square icon="plus" variant="filled" x-bind:disabled="addDisabled" x-on:click="add()" />
                </div>
            </div>
        </div>
    </flux:field>
</div>
