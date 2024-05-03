<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class DevSettings extends Settings
{
    public string $notifications;

    public static function group(): string
    {
        return 'dev';
    }
}
