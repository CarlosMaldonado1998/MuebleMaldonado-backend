<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::truncate();

        $faker = \Faker\Factory::create();

        for($i = 0; $i < 5; $i++ ){
            Color::create([
                'name'=>$faker->colorName,
                'url' =>$faker->imageUrl($width = 640, $height = 480),
            ]);
        }
    }
}
