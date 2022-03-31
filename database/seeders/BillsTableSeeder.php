<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bill;

class BillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bill::truncate();


        $faker = \Faker\Factory::create();

        for($i = 0; $i < 10; $i++ ){
            Bill::create([
                'date' =>$faker-> date('H:i:s', rand(21600,50400)),
                'type_pay'=> $faker->randomElement(['Transferencia', 'Paypal', 'Tarjeta credito']),
                'state'=> 'Pendiente',
                'iva'=>$faker->randomFloat($nbMaxDecimals =2, $min = 0, $max = 0.9),
                'val_iva'=>$faker->randomFloat($nbMaxDecimals =2, $min = 100, $max = 1000),
                'subtotal' =>$faker->randomFloat($nbMaxDecimals =2, $min = 100, $max = 1000),
                'total' =>$faker->randomFloat($nbMaxDecimals =2, $min = 100, $max = 1000),
            ]);
        }
    }
}
