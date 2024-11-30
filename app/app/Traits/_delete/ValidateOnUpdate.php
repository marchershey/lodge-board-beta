<?php

namespace App\Traits\_delete;

use Livewire\Component;

trait ValidateOnUpdate
{
    /**
     * Runs when a component has been updated/changed only when value is not null.
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
        $this->resetValidation($property);
        // This validates the property, ONLY if it isn't null.
        if ($value) {
            $this->validateOnly($property);
        }

        $this->validateOnly($property);
    }
}
