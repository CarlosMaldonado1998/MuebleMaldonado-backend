<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Room;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        $faker = \Faker\Factory::create();
        
        $rooms = Room::all();
        foreach ( $rooms as $room){
            for($i = 0; $i < 2; $i++ ){
            Category::create([
                'name'=>$faker->word,
                'room_id'=>$room->id
            ]);
        }
        }

        
    }
}
