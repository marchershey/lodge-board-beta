<?php

namespace App\Http\Pages\Setup;

use App\Models\Property;
use App\Models\PropertyPhoto;
use Livewire\Component;
use Livewire\WithFileUploads;

class PropertyPhotos extends Component
{
    use WithFileUploads;

    public $property;
    public $temp_photos = [];
    public $photos = [];

    protected $rules = [
        'photos' => ['required'],
        'photos.*' => ['required', 'image', 'mimes:png,jpeg,jpg,webp', 'max:12288']
    ];

    protected $validationAttributes = [
        //
    ];

    protected $messages = [
        'photos' => [
            'required' => '1'
        ],
        'photos.*' => [
            'required' => '2',
            'string' => 'That :attribute is invalid.',
            'min' => 'The :attribute must be at least :min characters long.',
            'max' => 'The :attribute cannot exceed :max characters long.',
        ]
    ];


    public function render()
    {
        return view('pages.setup.property-photos');
    }

    /**
     * Runs on initial page load, sets the first (and only) property property
     * as the active property
     *
     * @return void
     */
    public function load()
    {
        $this->property = Property::firstOrFail();
    }

    /**
     * Runs when a component has been updated/changed.
     *
     * After validation, if a property is invalid then the user updates the property,
     * reset the property's validation, but do not rerun validation until the user
     * resubmits the form
     *
     * @param string $property
     * @param string $value
     * @return void
     */
    function updated($property, $value): void
    {
        $this->validateOnly($property);
    }

    // When user uploads photos
    /**
     * When the user uploads photos, $temp_photos are cleared and only shows new photos.
     * This takes all photos from $temp_photos and adds them to $photos so when the user
     * uploads more photos, the previous photos are not cleared.
     *
     * @return void
     */
    function updatedTempPhotos(): void
    {
        foreach ($this->temp_photos as $temp_photo) {
            $this->photos[] = $temp_photo;
        }
    }

    /**
     * Runs when the user deletes a specific photo from the photo's grid
     *
     * @param int $key The array key of the photo the user wants to delete
     * @return void
     */
    public function deletePhoto($key): void
    {
        // remove the photo
        unset($this->photos[$key]);

        // reset the array keys to
        $this->photos = array_values($this->photos);
    }

    /**
     * Runs when the user reorders photos.
     *
     * @param array $data
     * @return void
     */
    function updatePhotoOrder(array $data): void
    {
        $this->photos = array_map(fn ($item) => $this->photos[$item['value']], $data);
    }

    /**
     * Runs when the user presses the continue button. Validates the images, saves each
     * photo, grabs the data for each photo and saves that data to the database.
     *
     * @return void
     */
    public function submit(): void
    {
        $this->validate();

        foreach ($this->photos as $order => $photo) {
            $path = $photo->store($this->property->id, 'photos');

            $data = [
                'url' => '/photos/' . $this->property->id . '/' . $photo->hashName(),
                'path' => $path,
                'hashName' => $photo->hashName(),
                'extension' => $photo->extension(),
                'origName' => $photo->getClientOriginalName(),
                'origExtension' => $photo->getClientOriginalExtension(),
                'size' => $photo->getSize(),
                'mime' => $photo->getMimeType(),
                'property_id' => $this->property->id,
                'user_id' => auth()->user()->id,
                'order' => $order,
            ];

            PropertyPhoto::create($data);
        }

        $this->dispatch('next-step');
    }
}
