<div class="flex items-center justify-between cursor-pointer group" x-data="{ value: @entangle($wiremodel) }" x-id="['{{ $wiremodel }}-toggle-label']">
    <input name="{{ $wiremodel }}-toggle" type="hidden" :value="value">
    <div class="flex flex-col w-full" @click="$refs.toggle.click(); $refs.toggle.focus()">
        <label class="pb-0 form-label" :id="$id('{{ $wiremodel }}-toggle-label')">
            {{ $label }}
        </label>
        @if ($desc)
            <span class="mt-0 form-desc">{!! $desc !!}</span>
        @endif
    </div>
    <div class="form-toggle">
        <button type="button" role="switch" x-ref="toggle" @click="value = ! value" :aria-checked="value" :aria-labelledby="$id('{{ $wiremodel }}-toggle-label')" :class="value ? 'form-toggle-button-active' : ''">
            <span aria-hidden="true" :class="value ? 'translate-x-8 form-toggle-span-active' : 'translate-x-1'"></span>
        </button>
        {{-- <button x-ref="toggle" @click="value = ! value" type="button" role="switch" :aria-checked="value" :aria-labelledby="$id('{{ $wiremodel }}-toggle-label')" :class="value ? 'bg-primary' : 'bg-gray-100 dark:bg-gray-900'">
            <span :class="value ? 'translate-x-8 bg-white' : 'translate-x-1 bg-white dark:bg-gray-700'" aria-hidden="true"></span>
        </button> --}}
    </div>
</div>
