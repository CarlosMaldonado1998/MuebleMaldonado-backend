<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image; 

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::truncate();

        $faker = \Faker\Factory::create();

        for($i = 0; $i < 5; $i++ ){
            Image::create([
                'url' =>$faker->imageUrl($width = 640, $height = 480),
            ]);
        }
    }
}
