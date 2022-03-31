<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Price;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Price::truncate();

        $faker = \Faker\Factory::create();

        for($i = 0; $i < 5; $i++ ){
            Price::create([
                'dimension'=>$faker->numerify('## x ## x ## cm'),
                'value'=>$faker->randomFloat($nbMaxDecimals =2, $min = 100, $max = 1000),
            ]);
        }
    }
}
