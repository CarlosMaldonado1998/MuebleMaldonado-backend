<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::truncate();

        $faker = \Faker\Factory::create();

        for($i = 0; $i < 5; $i++ ){
            Order::create([
                'dimension'=>$faker->numerify('## x ## x ## cm'),
                'value'=>$faker->randomFloat($nbMaxDecimals =2, $min = 100, $max = 1000),
                'amount'=>$faker->randomDigit,
            ]);
        }

    }
}
