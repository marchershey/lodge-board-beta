<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('setup.completed', false);
        // $this->migrator->add('setup.current_step', 0);
    }
};
