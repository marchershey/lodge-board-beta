<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Listings
            Listings\ListingSeeder::class,
            Listings\ListingTypeSeeder::class,
            Listings\AmenitySeeder::class,
        ]);
    }
}
