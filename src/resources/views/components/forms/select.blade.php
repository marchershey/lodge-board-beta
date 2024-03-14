{{-- <div>
    @if ($label)
        <label class="form-label @error($wiremodel) form-label-error @enderror" for="{{ $wiremodel }}">{{ $label }}</label>
    @endif

    <div class="relative" x-data="{
        open: false,
        selectedKey: @entangle($wiremodel),
        selectedValue: '',
        updatedSelected($key, $value) {
            this.selectedKey = $key
            this.selectedValue = $value
            this.open = false
            $refs.button.focus()
        }
    }" x-on:click.away="open = false" x-init="() => {
        $watch('selectedKey', value => {
            if (value) {
                this.selectedValue = $refs['option' + value].textContent;
            }
        });
        @this.$refresh();
    }">
        <button class="text-left form-input group @error($wiremodel) form-input-error @enderror" type="button" x-ref="button" x-on:click="open = !open">
            <span class="block mr-4 truncate" :class="selectedKey ? '' : 'text-muted-light'" x-text="{{ $showKeyAsSelection ? 'selectedKey' : 'selectedValue' }} || '{{ $placeholder }}'"></span>
            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                </svg>
            </span>
        </button>

        <span x-text="selectedKey"></span>

        <div class="absolute z-10 min-w-full mt-1 overflow-y-auto bg-white rounded-lg shadow-xl max-w-72 ring-1 ring-gray-900/10 max-h-60" x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="divide-y">
                @foreach ($options as $key => $value)
                    <a class="flex justify-between p-2 cursor-pointer focus:outline-none focus:bg-primary hover:text-white focus:text-white group hover:bg-primary" href="#" x-on:click="updatedSelected('{{ $key }}', '{{ $value }}')">
                        <span class="block text-sm truncate" :class="selectedKey === '{{ $key }}' && 'font-medium'">{!! $value !!}</span>
                        <div class="flex items-center w-5" :class="selectedKey === '{{ $key }}' ? '' : 'hidden group-hover:block group-focus:block'">
                            <svg class="w-5 h-5 text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l5 5l10 -10" />
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    @if ($desc || $errors->first($wiremodel))
        <span class="form-desc @error($wiremodel) form-desc-error @enderror">
            {!! empty($errors->first($wiremodel)) ? $desc : $errors->first($wiremodel) !!}
        </span>
    @endif

</div> --}}

<div x-data="{ value: @entangle($wiremodel) }">
    @if ($label)
        <label class="form-label @error($wiremodel) form-label-error @enderror" for="{{ $wiremodel }}">{{ $label }}</label>
    @endif

    {{-- <input class="form-input @error($wiremodel) form-input-error @enderror {{ $class }}" id="{{ $wiremodel }}" name="{{ $wiremodel }}" type="{{ $type }}" wire:model.blur="{{ $wiremodel }}" x-ref="inputField" x-on:focus="{{ $onfocus }}" {{ $attributes->merge(['class' => '']) }} @if ($placeholder) placeholder="{{ $placeholder }}" @endif autocomplete="{{ $autocomplete ?? $wiremodel }}"> --}}
    <select class="form-input" id="" name="" wire:model="{{ $wiremodel }}">
        <option value="">Select a {{ $wiremodel }}...</option>
        @foreach ($options as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>

    @if ($desc || $errors->first($wiremodel))
        <span class="form-desc @error($wiremodel) form-desc-error @enderror">
            {!! empty($errors->first($wiremodel)) ? $desc : $errors->first($wiremodel) !!}
        </span>
    @endif
</div>
