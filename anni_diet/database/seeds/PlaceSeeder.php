<?php

use App\Models\Place;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Place::insert([
            ['name' => 'first place'],
            ['name' => 'second place'],
            ['name' => 'third_place'],
        ]);
    }
}
