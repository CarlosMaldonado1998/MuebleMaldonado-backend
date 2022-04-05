<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bill;
use App\Models\Order;
use App\Models\Product;

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


        //Asignacion de ordenes a las Facturas
        $bills = Bill::all();
        foreach ($bills as $bill) {
                $num_colors= rand(1, 2);
                for ($i = 0; $i < $num_colors; $i++){
                    Order::create([
                        'dimension'=>$faker->numerify('## x ## x ## cm'),
                        'value'=>$faker->randomFloat($nbMaxDecimals =2, $min = 100, $max = 1000),
                        'amount'=>$faker->randomDigit,
                        'user_id'=>$bill->user_id,
                        //Asignación de productos a las ordenes
                        'product_id'=>rand(1, 5),
                        'bill_id'=>$bill->id
                    ]);
                }
             
        }
    }
}
