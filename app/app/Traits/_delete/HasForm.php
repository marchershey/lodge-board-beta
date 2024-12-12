<?php

namespace App\Traits\_delete;

trait HasForm
{
    public bool $formDisabled = true;

    public function disableForm(): void {}
}
