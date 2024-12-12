<?php

namespace Database\Seeders\Properties;

use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Apartment',
            'Barn',
            'Bed & Breakfast',
            'Boat',
            'Building',
            'Bungalow',
            'Cabin',
            'Campground',
            'Caravan',
            'Castle',
            'Chalet',
            'Country House',
            'Condo',
            'Corporate Apartment',
            'Cottage',
            'Estate',
            'Farmhouse',
            'Hotel',
            'House',
            'House Boat',
            'Lodge',
            'Mobile Home',
            'Recreational Vehicle',
            'Resort',
            'Studio',
            'Suite',
            'Tower',
            'Townhome',
            'Villa',
            'Yacht',
        ];

        foreach ($types as $type) {
            \App\Models\PropertyType::create(['name' => $type]);
        }
    }
}
