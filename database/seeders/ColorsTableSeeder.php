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
            for ($i = 0; $i < 10; $i++){
                $image_name = $faker->image('public/storage/colors', 400, 300, null);
                Color::create([
                    'name'=>$faker->colorName,
                    'url' =>'images'.$image_name,
                ]);
            }
    }
}
