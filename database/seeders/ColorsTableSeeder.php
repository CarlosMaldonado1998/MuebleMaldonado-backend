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
                Color::create([
                    'name'=>$faker->colorName,
                    'url' =>'Mueble_Maldonado/colors/Gales_lc3cd8',
                ]);
            }
    }
}
