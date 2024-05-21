<div class="flex items-center justify-between cursor-pointer group" x-data="{ value: $wire.{{ $wiremodel }}.live }" x-id="['{{ $wiremodel }}-toggle-label']">
    <input name="{{ $wiremodel }}-toggle" type="hidden" :value="value">
    <div class="flex flex-col w-full" @click="$refs.toggle.click(); $refs.toggle.focus()">
        <label class="pb-0 form-label @error($wiremodel) form-label-error @enderror" :id="$id('{{ $wiremodel }}-toggle-label')">
            {{ $label }}
        </label>
        @if ($desc)
            <span class="mt-1 leading-4 form-desc">{!! $desc !!}</span>
        @endif
        @error($wiremodel)
            <span class="text-xs text-red-500">{{ $errors->first($wiremodel) }}</span>
        @enderror
    </div>
    <div class="form-toggle">
        <button class="@error($wiremodel) form-toggle-error @enderror" type="button" role="switch" x-ref="toggle" @click="value = ! value" :aria-checked="value" :aria-labelledby="$id('{{ $wiremodel }}-toggle-label')" :class="value ? 'form-toggle-button-active' : ''">
            <span aria-hidden="true" :class="value ? 'translate-x-8 form-toggle-span-active' : 'translate-x-1'"></span>
        </button>
    </div>
</div>
