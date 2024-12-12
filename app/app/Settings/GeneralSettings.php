<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;
    public string $site_url;
    public string $timezone;
    public bool $site_active;
    public bool $reservation_active;
    public bool $registration_active;

    public static function group(): string
    {
        return 'general';
    }

    // public static function casts(): array
    // {
    //     return [
    //         'timezone' => DateTimeZoneCast::class
    //     ];
    // }
}
