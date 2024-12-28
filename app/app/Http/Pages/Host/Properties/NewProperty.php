<?php

namespace App\Http\Pages\Host\Properties;

use App\Forms\HostPropertyForm;
use App\Models\AmenityGroup;
use App\Models\Property;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
        'temp_photos.*' => 'image|mimetypes:image/jpeg,image/jpg,image/png,image/webp,image/bmp|mimes:jpg,jpeg,png,webp,bmp|extensions:jpg,jpeg,png,webp,bmp|max:12288',
    ], message: [
        'temp_photos.*.image' => 'Only image files are permitted for upload.',
        'temp_photos.*.max' => 'Uploaded images can not exceed a max file size of 12MB.',
        'temp_photos.*.mimes' => '1Images must be in a common image format. (e.g., jpeg, jpg, png, webp, and bmp)',
        'temp_photos.*.extensions' => '2Images must be in a common image format. (e.g., jpeg, jpg, png, webp, and bmp)',
    ], as: [
        'temp_photos' => 'selected photos',
        'temp_photos.*' => 'selected photo',
    ], attribute: [
        'temp_photos' => 'selected photos',
        'temp_photos.*' => 'selected photo',
    ])]
    public $temp_photos = [];

    /**
     * Runs on page load
     */
    public function render(): View
    {
        return view('pages.host.properties.new-property');
    }

    /**
     * Runs on page load, after page rendered
     */
    public function load(): void
    {
        $this->form->loadDevData();
    }

    /**
     * Runs when user clicks the "reset" form button at the bottom of the page.
     * Resets the form and closes the reset confirmation modal
     */
    public function reload(): void
    {
        // Reset the entire form
        $this->form->reset();

        // Close the reset modal
        $this->modal('reset-confirm-modal')->close();
    }

    /**
     * Property name updated hook
     *
     * When the user updates the property name, we need to generate a slug for it.
     * We also need to capitalize the value.
     */
    public function updatedFormName(string $value): void
    {
        // Generate property url slug
        $this->form->slug = Property::generateSlug($value);

        // Capitalize value
        $this->form->name = ucwords($this->form->name);
    }

    /**
     * Open Amenities Modal
     * Runs when the user attempts to open the amenities modal
     *
     * - Pulls all amenity groups with associated amenenites
     * - Clears selected amenities
     * - Loops through each existing amenities, adds to the selected amenities
     */
    public function openAmenitiesModal(): void
    {
        // Loading the amenity groups with associated amenities from database
        $this->all_amenities = AmenityGroup::with('amenities')->get();

        // Reset the selected amenities
        $this->selected_amenities = [];

        // Add existing selected amenities to the
        foreach ($this->form->amenities as $amenity) {
            $this->selected_amenities[] = $amenity->id;
        }

        // if ($this->selected_amenities) {
        //     dd($this->selected_amenities);
        // }

        // Close amenities modal
        $this->modal('amenities-modal')->show();
    }

    /**
     * Save Amenities Changes
     *
     * Runs when the user presses the "save changes" button on the amenities modal
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
     *
     * Removes an amenity from the existing amenities.
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
     * Clear amenities
     *
     * Clears all the selected amenities
     */
    public function clearAmenities(): void
    {
        // Clear out all amenities
        $this->form->amenities = [];

        // Close the clear amenities modal
        $this->modal('clear-amenities-modal')->close();
    }

    /**
     * Add fee
     *
     * Adds a new empty fee to the fees array
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
     * @param  int  $fee_key  - The array key of the fee the user wants removed
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
     * @param  array  $temp_photos  - an array of photos uploaded via livewire not uploaded yet
     */
    public function updatedTempPhotos(): void
    {
        // Validate temp photos
        $this->validateOnly('temp_photos');
        $this->validateOnly('temp_photos.*');

        // Loop through each temp photo, adding it to the form
        foreach ($this->temp_photos as $selected_photo) {
            $this->form->photos[] = $selected_photo;
        }

        $this->validateOnly('photos');
        $this->validateOnly('photos.*');

        // Clear temp photos
        // This is primarily to remove the "# selected files" from the file input
        $this->temp_photos = [];
    }

    /**
     * Runs when the user deletes a specific photo from the photo's grid, then re-indexs
     * the array
     *
     * @param  int  $photos_array_key  - The array key of the photo the user wants to remove
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
     * Using wotzebra/livewire-sortablejs for sorting instead of livewire/sortable
     * https://github.com/wotzebra/livewire-sortablejs
     *
     * @param  array  $photo_order_data  -
     */
    public function updatePhotoOrder(array $photo_order_data): void
    {
        // Reorder photos based on the order given in $photo_order_data
        $this->form->photos = array_map(fn($item) => $this->form->photos[$item['value']], $photo_order_data);
    }

    /**
     * Submit
     */
    public function submit()
    {
        // Save property
        try {
            // code...
            $property = $this->form->saveProperty();
        } catch (\Throwable $th) {
            toast()->danger('There was an issue saving the property.')->push();

            return;
        }

        toast()->success($property->name . ' was successfully added!')->pushOnNextPage();

        return $this->redirect(route('host.properties.index'), navigate: true);
    }
}
