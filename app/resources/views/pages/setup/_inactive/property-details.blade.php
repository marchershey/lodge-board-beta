<section class="card card-padding card-flex mx-auto tablet:max-w-lg" wire:init="load">

    <div class="card-header text-center">
        <h1>Property Details</h1>
        <p>
            Let's show off your property to the world!
        </p>
    </div>

    <form class="form-grid">
        <x-forms.text class="capitalize" wiremodel="property.headline" label="Property Headline" desc="This is the headline or title of your property that will be visible to guests on the property's page." />
        <x-forms.textarea wiremodel="property.description" label="Property Description" desc="Within 500 characters, explain what your property has to offer. " />

        <div class="!col-span-6">
            <x-forms.counter wiremodel="guest_count" label="Guest Count" min="1" max="16" />
        </div>
        <div class="!col-span-6">
            <x-forms.counter wiremodel="bed_count" label="Bed Count" min="1" max="16" />
        </div>
        <div class="!col-span-6">
            <x-forms.counter wiremodel="bedroom_count" label="Bedroom Count" min="1" max="16" />
        </div>
        <div class="!col-span-6">
            <x-forms.counter wiremodel="bathroom_count" label="Bathroom Count" min="1" max="16" step="0.5" />
        </div>
    </form>

</section>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('hostSetupPropertyRoomsSpaces', () => ({
                roomModal: false,

                openRoomModal() {
                    this.roomModal = true
                },
                closeRoomModal() {
                    this.roomModal = false
                },

                initAddRoom(room_type) {
                    @this.initAddRoom(room_type)
                    this.openRoomModal()
                },
                async addRoom(room_type) {
                    var success = await @this.addRoom(room_type)
                    if (success) this.closeRoomModal();
                },
                initUpdateRoom(room_type, room_key) {
                    @this.initUpdateRoom(room_type, room_key)
                    this.openRoomModal()
                },
                async updateRoom(room_type, room_key) {
                    var success = await @this.updateRoom(room_type, room_key)
                    if (success) this.closeRoomModal();
                },
                deleteRoom(room_type, room_key) {
                    @this.deleteRoom(room_type, room_key);
                }
            }))
        })
    </script>
@endpush
