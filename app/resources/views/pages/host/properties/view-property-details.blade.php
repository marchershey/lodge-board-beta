<div class="space-y-8">
    <flux:card class="space-y-6">
        <div>
            <flux:heading size="lg">Property Name</flux:heading>
            <flux:subheading>The property name will help guests identify this property. Make it memoriable!
            </flux:subheading>
        </div>
        <form class="flex space-x-4" wire:submit.prevent="updateName">
            <flux:input class="max-w-xs capitalize tablet:max-w-sm" wire:dirty.class="!bg-yellow-100" wire:model="name" placeholder="Sunset Cabin" required />
            <flux:button type="submit" wire:dirty wire:target="name">Save</flux:button>
        </form>
        <flux:error name="name" />
    </flux:card>

    <flux:card class="space-y-6">
        <div>
            <flux:heading size="lg">Property Address</flux:heading>
            <flux:subheading>This address will be given to guests, so make sure it's an address that will help
                them find your property.</flux:subheading>
        </div>
        <form class="grid grid-cols-1 gap-4 tablet:grid-cols-6" wire:submit.prevent="updateAddress">
            <div class="tablet:col-span-4 laptop:col-span-4">
                <flux:input wire:model="address.line1" label="Street Address (Line 1)" placeholder="123 Main St" required />
            </div>
            <div class="tablet:col-span-2 laptop:col-span-2">
                <flux:input wire:model="address.line2" label="Street Address (Line 2)" placeholder="Apartment, suite, floor, etc" />
            </div>
            <div class="tablet:col-span-3">
                <flux:input wire:model="address.city" label="City" placeholder="San Francisco" required />
            </div>
            <div class="tablet:col-span-3">
                <flux:select wire:model.change="address.state" label="State" variant="listbox" searchable placeholder="Choose state..." required>
                    @foreach (\App\Helpers\GeographyHelper::getStates() as $key => $value)
                        <flux:option value="{{ $key }}" wire:key="state-{{ $key }}">
                            {{ $value }}</flux:option>
                    @endforeach
                </flux:select>
            </div>
            <div class="tablet:col-span-3">
                <flux:input class="mask-zip" wire:model.blur="address.postal" label="ZIP / Postal Code" placeholder="12345" required />
            </div>
            <div class="tablet:col-span-3">
                <flux:select wire:model.change="address.country" label="Country" variant="listbox" searchable placeholder="Choose country..." required>
                    @foreach (\App\Helpers\GeographyHelper::getCountries() as $key => $value)
                        <flux:option value="{{ $key }}" wire:key="country-{{ $key }}">
                            {{ $value }}</flux:option>
                    @endforeach
                </flux:select>
            </div>
            <div class="flex" wire:dirty wire:target="address">
                <flux:spacer></flux:spacer>
                <flux:button type="submit">Update address</flux:button>
            </div>
        </form>
    </flux:card>
</div>
