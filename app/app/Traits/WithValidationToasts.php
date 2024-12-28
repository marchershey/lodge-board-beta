<?php

namespace App\Traits;

use Usernotnull\Toast\Concerns\WireToast;

trait WithValidationToasts
{
    use WireToast;

    public function boot()
    {
        $this->withValidator(function ($validator) {
            $validator->after(function ($validator) {
                foreach ($validator->errors()->all() as $error) {
                    toast()->danger($error, 'Error!')->push();
                }
            });
        });
    }
}
