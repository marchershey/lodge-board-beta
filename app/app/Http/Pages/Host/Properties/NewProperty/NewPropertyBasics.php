<?php

namespace App\Http\Pages\Host\Properties\NewProperty;

use App\Models\Property;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

#[Layout('layouts.minimal', ['title' => 'The Basics'])]
class NewPropertyBasics extends Component
{
    use WireToast;

    public $property;
    public $details = [];

    protected $rules = [
        'details' => [
            'name' => ['required'],
            'address' => [
                'street' => ['required'],
            ]
        ],
    ];

    // protected $validationAttributes = [
    //     'property' => [
    //         'name' => 'Property Name',
    //         'address' => [
    //             'street' => 'Street Address',
    //             'city' => 'City',
    //             'State' => 'State',
    //             'zip' => 'ZIP Code',
    //         ],
    //     ],
    // ];

    // protected $messages = [
    //     'property' => [
    //         'name' => [
    //             'required' => 'Blah',
    //         ],
    //     ],
    // ];

    public function render()
    {
        return view('pages.host.properties.new-property.new-property-basics');
    }

    public function mount(Property $property)
    {
        $this->property = $property;
    }

    function save(): void
    {
        $this->validate();
        toast()->success('all good!')->push();
        //
    }

    function end(): void
    {
        //
    }
}
