<?php

namespace App\Http\Pages\Host\Properties;

use App\Livewire\Forms\HostPropertyForm;
use App\Models\Amenity;
use App\Models\AmenityGroup;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

#[Layout('layouts.app', ['title' => 'Add Property'])]
class NewProperty extends Component
{
    use WireToast, WithFileUploads;

    public HostPropertyForm $form;
    public $all_amenities;

    #[Validate([
        'selected_amenities' => 'nullable|array',
        'selected_amenities.*' => 'required|integer|min:0|max:9999',
    ])]
    public $selected_amenities = [];

    #[Validate([
        'temp_photos' => 'nullable|array',
        'temp_photos.*' => 'image|mimes:jpg,jpeg,png,webp,bmp|extensions:jpg,jpeg,png,webp,bmp|max:10240'
    ], as: [
        'temp_photos' => 'selected photos',
        'temp_photos.*' => 'selected photo',
    ])]
    public $temp_photos;

    /**
     * Runs on page load
     *
     * @return View
     */
    function render(): View
    {
        return view('pages.host.properties.new-property');
    }

    /**
     * Runs on page load, after page rendered
     *
     * @return void
     */
    function load(): void
    {
        //
    }

    /**
     * Runs when user clicks the "reset" form button at the bottom of the page.
     * Resets the form and closes the reset confirmation modal
     *
     * @return void
     */
    function reload(): void
    {
        // Reset the entire form
        $this->form->reset();

        // Close the reset modal
        $this->modal('reset-confirm-modal')->close();
    }

    /**
     * Open Amenities Modal
     * Runs when the user attempts to open the amenities modal
     *
     * - Pulls all amenity groups with associated amenenites
     * - Clears selected amenities
     * - Loops through each existing amenities, adds to the selected amenities
     * -
     *
     * @return void
     */
    function openAmenitiesModal(): void
    {
        // Loading the amenity groups with associated amenities from database
        $this->all_amenities = AmenityGroup::with('amenities')->get();

        // Reset the selected amenities
        $this->selected_amenities = [];

        // Add existing selected amenities to the
        foreach ($this->form->amenities as $amenity) {
            $this->selected_amenities[] = $amenity->id;
        }

        if ($this->selected_amenities) {
            dd($this->selected_amenities);
        }


        // Close amenities modal
        $this->modal('amenities-modal')->show();
    }

    /**
     * Save Amenities Changes
     *
     * Runs when the user presses the "save changes" button on the amenities modal
     *
     *
     * @return void
     */
    public function saveAmenityChanges(): void
    {
        // Clear out existing amenities
        $this->form->reset('amenities');

        // Set variable for flatMap
        $selected_amenities = $this->selected_amenities;

        // Validate amenities
        $this->validateOnly('selected_amenities');

        // Filters through the amenities groups, then each amenity, checks if amenity id exists
        $new_amenities = $this->all_amenities->flatMap(function ($amenity_group) use ($selected_amenities) {
            return $amenity_group->amenities->filter(function ($amenity) use ($selected_amenities) {
                return in_array($amenity->id, $selected_amenities);
            });
        });

        // Adds each amenity to the form
        foreach ($new_amenities as $new_amenity) {
            $this->form->amenities[] = $new_amenity;
        }

        // Closes amenities modal
        $this->modal('amenities-modal')->close();
    }

    /**
     * Remove Amenity
     * Removes an amenity from the existing amenities.
     *
     * @param string $amenity_id
     * @return void
     */
    public function removeAmenity(string $amenity_id): void
    {
        $new_amenities = collect($this->form->amenities)->filter(function ($amenity) use ($amenity_id) {
            return $amenity->id != $amenity_id;
        });

        $this->form->reset('amenities');

        foreach ($new_amenities as $amenity) {
            $this->form->amenities[] = $amenity;
        }
    }

    /**
     * Add new fee
     * Adds a new fee to the fees array
     *
     * @return void
     */
    public function addFee(): void
    {
        array_push($this->form->fees, [
            'name' => '',
            'amount' => '',
            'type' => 'fixed',
        ]);
    }

    /**
     * Remove fee
     * Removes fee by fee array key from the fees array
     *
     * @param integer $fee_key - The array key of the fee the user wants removed
     * @return void
     */
    public function removeFee(int $fee_key): void
    {
        unset($this->form->fees[$fee_key]);
    }

    /**
     * Photos
     * When the user uploads photos, $temp_photos are cleared and only shows new photos.
     * This takes all photos from $temp_photos and adds them to $photos so when the user
     * uploads more photos, the previous photos are not cleared.
     *
     * @param array $temp_photos - an array of photos uploaded via livewire not uploaded yet
     * @return void
     */
    function updatedTempPhotos(): void
    {
        // Validate temp photos
        $this->validateOnly('temp_photos.*');

        // Loop through each temp photo, adding it to the form
        foreach ($this->temp_photos as $selected_photo) {
            $this->form->photos[] = $selected_photo;
        }

        // Clear temp photos
        // This is primarily to remove the "# selected files" from the file input
        $this->temp_photos = [];
    }

    /**
     * Runs when the user deletes a specific photo from the photo's grid, then re-indexs
     * the array
     *
     * @param int $photos_array_key - The array key of the photo the user wants to remove
     * @return void
     */
    public function removePhoto($photos_array_key): void
    {
        // Unset the photo from the form's photo array
        unset($this->form->photos[$photos_array_key]);

        // Re-index the array
        $this->form->photos = array_values($this->form->photos);
        // Why? When you have an array [1,2,3,4] and you delete key 3, the array
        // will now look like [1,2,4], then you can re-index so it looks like [1,2,3]
    }

    /**
     * Runs when the user reorders photos.
     * Most of the magic happens with wire:sortable, but this rearranges the photos based on
     * a new order specified in the $photo_order_data, given by wire:sortable.
     *
     * https://github.com/livewire/sortable
     *
     * @param array $photo_order_data -
     * @return void
     */
    function updatePhotoOrder(array $photo_order_data): void
    {
        // Reorder photos based on the order given in $photo_order_data
        $this->form->photos = array_map(fn($item) => $this->form->photos[$item['value']], $photo_order_data);
    }

    /**
     * Submit
     */
    public function submit(): void
    {
        $this->dispatch('console', $this->form);
        // Validate the form
        $this->validate();
    }
}
