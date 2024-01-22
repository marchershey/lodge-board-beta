<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // General Information
        $this->migrator->add('general.site_name', 'LodgeBoard');
        $this->migrator->add('general.site_url', 'https://lodgeboard.com');
        $this->migrator->add('general.timezone', 'UTC');

        // Active States
        $this->migrator->add('general.site_active', true);
        $this->migrator->add('general.reservation_active', true);
        $this->migrator->add('general.registration_active', true);
    }
};
