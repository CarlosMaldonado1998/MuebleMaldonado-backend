<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Delivery;

class DeliveriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Delivery::truncate();

        $faker = \Faker\Factory::create();

        for($i = 0; $i < 5; $i++ ){
            Delivery::create([
                'title'=>$faker->word,
                'description'=>$faker->paragraph,
                'url' =>$faker->imageUrl($width = 640, $height = 480),
            ]);
        }
    }
}
