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
            $image_name = $faker->image('public/storage/rooms', 400, 300, null);
            Room::create([
                'name'=>$faker->word,
                'url' =>'images'.$image_name,
            ]);
        }
    }
}
