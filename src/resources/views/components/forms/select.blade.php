<div>
    @if ($label)
        <label class="form-label @error($wiremodel) form-label-error @enderror" for="{{ $wiremodel }}">{{ $label }}</label>
    @endif

    <div class="relative" x-data="{
        focused: false,
        selected: @entangle($wiremodel),
        updatedSelected($value) {
            this.selected = $value
            this.focused = false
            $refs.button.focus()
        }
    }" x-on:click.away="focused = false" x-init="$watch('selected', value => @this.$refresh())">
        <button class="text-left form-input group @error($wiremodel) form-input-error @enderror" type="button" x-ref="button" x-on:click="focused = !focused">
            <span class="truncate" :class="selected ? '' : 'text-muted'" x-text="selected || '{{ $placeholder ?? 'test' }}'"></span>
            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" aria-hidden="true" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                </svg>
            </span>
        </button>

        <div class="absolute z-10 w-full mt-1 overflow-y-auto bg-white rounded-lg shadow-xl ring-1 ring-gray-900/10 max-h-60" x-show="focused" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="divide-y">
                @foreach ($options as $value => $text)
                    <a class="flex justify-between p-2 cursor-pointer focus:outline-none focus:bg-gray-100 group hover:bg-gray-100" href="#" x-on:click="updatedSelected('{{ $value }}')">
                        <span class="block pr-6 truncate" :class="selected === '{{ $value }}' && 'font-medium'">{{ $text }}</span>
                        <div class="flex items-center w-6" :class="selected === '{{ $value }}' ? '' : 'hidden group-hover:block group-focus:block'">
                            <svg class="w-6 h-6" :class="selected === '{{ $value }}' ? 'text-primary' : 'text-muted'" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
        <span class="-mb-2 form-desc @error($wiremodel) form-desc-error @enderror">
            {!! empty($errors->first($wiremodel)) ? $desc : $errors->first($wiremodel) !!}
        </span>
    @endif

</div>

@push('scripts')
    <script>
        alert('tst')
    </script>
@endpush

{{-- <div>
    @if ($label)
        <label class="form-label @error($wiremodel) form-label-error @enderror" for="{{ $wiremodel }}">{{ $label }}</label>
    @endif

    <select class="form-select @error($wiremodel) form-input-error @enderror {{ $class }}" id="{{ $wiremodel }}" name="{{ $wiremodel }}" wire:model.blur="{{ $wiremodel }}">
        @if ($placeholder)
            <option value="" disabled>{{ $placeholder }}</option>
        @endif
        @if ($options)
            @foreach ($options as $value => $text)
                <option value="{{ $value }}">{{ $text }}</option>
            @endforeach
        @endif
    </select>

    @if ($desc || $errors->first($wiremodel))
        <span class="-mb-2 form-desc @error($wiremodel) form-desc-error @enderror">
            {!! empty($errors->first($wiremodel)) ? $desc : $errors->first($wiremodel) !!}
        </span>
    @endif
</div> --}}

{{-- <div class="w-full max-w-xs" wire:ignore x-data="{
    query: @entangle('query').live,
    selected: @entangle('selected'),
    frameworks: [{
            id: 1,
            name: 'Laravel',
            disabled: false,
        },
        {
            id: 2,
            name: 'Ruby on Rails',
            disabled: false,
        },
        {
            id: 3,
            name: 'Django',
            disabled: false,
        },
        {
            id: 4,
            name: 'Express',
            disabled: false,
        },
        {
            id: 5,
            name: 'Phoenix',
            disabled: false,
        },
        {
            id: 6,
            name: 'Adonis',
            disabled: false,
        },
        {
            id: 7,
            name: 'NextJS',
            disabled: false,
        },
    ],
    get filteredFrameworks() {
        return this.query === '' ?
            this.frameworks :
            this.frameworks.filter((framework) => {
                return framework.name.toLowerCase().includes(this.query.toLowerCase())
            })
    },
}">

    <div>
        {{ $query }}
    </div>

    <div>
        {{ $selected }}
    </div>
    <div x-combobox x-model="selected">
        <div class="relative mt-1 rounded-md focus-within:ring-2 focus-within:ring-blue-500">
            <div class="flex items-center justify-between gap-2 w-full bg-white pl-5 pr-3 py-2.5 rounded-md shadow">
                <input class="p-0 border-none focus:outline-none focus:ring-0" x-combobox:input :display-value="framework => framework.name" @change="query = $event.target.value; console.log($event.target.value)" placeholder="Search..." />
                <button class="absolute inset-y-0 right-0 flex items-center pr-2" x-combobox:button>
                    <!-- Heroicons up/down -->
                    <svg class="w-5 h-5 text-gray-500 shrink-0" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>

            <div class="absolute left-0 z-10 w-full max-w-xs mt-2 overflow-auto origin-top-right bg-white border border-gray-200 rounded-md shadow-md outline-none max-h-60" x-combobox:options x-cloak x-transition.out.opacity>
                <ul class="divide-y divide-gray-100">
                    <template x-for="framework in filteredFrameworks" :key="framework.id" hidden>
                        <li class="flex items-center justify-between w-full gap-2 px-4 py-2 text-sm cursor-default" x-combobox:option :value="framework" :disabled="framework.disabled" :class="{
                            'bg-cyan-500/10 text-gray-900': $comboboxOption.isActive,
                            'text-gray-600': !$comboboxOption.isActive,
                            'opacity-50 cursor-not-allowed': $comboboxOption.isDisabled,
                        }">
                            <span x-text="framework.name"></span>

                            <span class="font-bold text-cyan-600" x-show="$comboboxOption.isSelected">&check;</span>
                        </li>
                    </template>
                </ul>

                <p class="px-4 py-2 text-sm text-gray-600" x-show="filteredFrameworks.length == 0">No frameworks match your query.</p>
            </div>
        </div>
    </div>
</div> --}}

{{-- <div x-data="{ active: false }">
@if ($label)
    <label class="form-label @error($wiremodel) form-label-error @enderror" for="{{ $wiremodel }}">{{ $label }}</label>
@endif

<select class="form-input @error($wiremodel) form-input-error @enderror {{ $class }}" id="{{ $wiremodel }}" name="{{ $wiremodel }}" {{ $attributes->merge(['class' => '']) }} wire:model.blur="{{ $wiremodel }}">
    <option selected hidden>Select an option...</option>
    @foreach ($options as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
</select>

@if ($desc || $errors->first($wiremodel))
    <span class="-mb-2 form-desc @error($wiremodel) form-desc-error @enderror">
        {!! empty($errors->first($wiremodel)) ? $desc : $errors->first($wiremodel) !!}
    </span>
@endif
</div> --}}
