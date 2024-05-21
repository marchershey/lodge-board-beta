<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SetupSettings extends Settings
{
    public $completed;
    // public $current_step;

    public static function group(): string
    {
        return 'setup';
    }
}
