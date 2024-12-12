<?php

namespace Database\Seeders\Properties;

use App\Models\Amenity;
use App\Models\AmenityGroup;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $groups = [
            'General' => [
                'Telephone' => false,
                'Air Conditoning' => true, // primary
                'Heating' => true, // primary
                'Window AC units' => false,
                'Radiant heaters' => false,
                'Electric heaters' => false,
                'Fireplace' => true, // primary
                'Wood stove' => false,
                'Living room' => false,
                'Fitness Room/Equipment' => false,
                'Safe' => false,
                'Garage' => false,
                'Parking' => true, // primary
                'EV Charger' => false,
            ],
            'Entertainment' => [
                'TV' => true, // primary
                'Wireless Internet' => true, // primary
                'Satelite / Cable' => false,
                'Smart TV' => false,
                'DVD Player' => false,
                'VCR Player' => false,
                'Stereo System' => false,
                'Movie Theatre' => false,
                'Game Room' => false,
                'Video Games' => false,
                'Board Games' => false,
                'Books' => false,
                'Pool Table' => false,
                'Foosball Table' => false,
                'Ping Pong Table' => false,
            ],
            'Kitchen and Dining' => [
                'Dining Table' => false,
                'Refrigerator' => false,
                'Toaster' => false,
                'Blender' => false,
                'Dishwasher' => false,
                'Dishes & Utensils' => false,
                'Microwave' => false,
                'Ice Maker' => false,
                'Coffee Maker' => false,
                'Coffee Grinder' => false,
                'Grill' => false,
                'Oven' => false,
                'Stove' => false,
                'Kitchen Island' => false,
                'Kitchenette' => false,
                'Kettle' => false,
                'Pantry Items' => false,
                'Paper Towels' => false,
                'Hand Towels' => false,
            ],
            'Bathroom Essentials' => [
                'Hand soaps' => false,
                'Shampoo & body wash' => false,
                'Toilet Paper' => false,
                'Bath Towels' => false,
                'Hair Dryer' => false,
            ],
            'Bedrooms Essentials' => [
                'Bed Sheets / Linens' => false,
                'Comforters' => false,
                'Pillows' => false,
                'Nightstand' => false,
                'Dresser' => false,
                'Storage Bench / Ottoman' => false,
                'Vanity' => false,
                'Blankets' => false,
                'Throw Blankets' => false,
                'Window Blinds / Coverings' => false,
            ],
            'Office' => [
                'Computer' => false,
                'Computer Monitor' => false,
                'Desk' => false,
                'Desk Chair' => false,
                'Mouse & Keyboard' => false,
                'Printer' => false,
                'Fax Machine' => false,
            ],
            'Clothes & Laundry' => [
                'Washing Machine' => true, // primary
                'Clothes Dryer' => false,
                'Coin Laundry' => false,
                'Iron & Board' => false,
            ],
            'Pool and spa' => [
                'Pool' => true, // primary
                'Outdoor Pool' => false,
                'Indoor Pool' => false,
                'Private Pool' => false,
                'Hot Tub' => true, // primary
                'Heated Pool' => false,
                'Sauna' => false,
                'Communal Pool' => false,
                'Pool Toys & Games' => false,
                'Pool accessories' => false,
                'Beach Chairs' => false,
                'Beach Towels' => false,
            ],
            'Outdoors' => [
                'Lawn / Garden' => false,
                'Outdoor Play Area' => false,
                'Bicycles' => false,
                'Boat' => false,
                'Water Sports Gear' => false,
                'Porch / Veranda' => false,
                'Ski & Snowboard' => false,
                'Tennis' => false,
                'Kayak / Canoe' => false,
                'Outdoor Funiture' => false,
                'Balcony' => false,
                'Deck / Patio' => false,
                'Fire Pit' => true, // primary
                'Golf' => false,
                'Fenced yard' => false,
            ],
            'Kids & Toddler' => [
                'Kids Games' => false,
                'Kids Toys' => false,
                'Kids Books' => false,
                'Kids Utensils' => false,
                'Baby Gate' => false,
                'Baby Monitor' => false,
                'Travel Crib' => false,
            ],
            'Location Details' => [
                'Beach' => false,
                'Golf Course Front' => false,
                'Mountain view' => false,
                'River view' => false,
                'Ski in / Ski out' => false,
                'Waterfront' => false,
                'Downtown' => false,
                'Lake view' => false,
                'Oceanfront' => true, // primary
                'Rural' => false,
                'Village' => false,
            ],
            'Safety Features' => [
                'No Smoking' => true, // primary
                'Exterior Lighting' => false,
                'Deadbolt Locks' => false,
                'Smoke Detectors' => false,
                'Carbon Monoxide Detectors' => false,
                'Fire Extinguishers' => false,
                'First Aid Kit' => false,
            ],
        ];

        foreach ($groups as $name => $amenities) {
            $group_id = AmenityGroup::create(['name' => $name])->id;

            foreach ($amenities as $name => $primary) {
                Amenity::create([
                    'name' => $name,
                    'group_id' => $group_id,
                    'primary' => $primary,
                ]);
            }
        }
    }
}
