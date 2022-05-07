<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::truncate();

        $faker = \Faker\Factory::create();
        for($i = 0; $i < 5; $i++ ){
            Room::create([
                'name'=>$faker->word,
                'url' =>'Mueble_Maldonado/rooms/room1_t2ndqt',
            ]);
        }
    }
}
