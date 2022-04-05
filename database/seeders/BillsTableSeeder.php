<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bill;
use App\Models\User;

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

        //Asignacion de usuarios ficticios a facturas
        $users = User::all();
        foreach ($users as $user) {
            $num_prices= rand(0, 1);
            for ($i = 0; $i < $num_prices; $i++){
                Bill::create([
                    'date' =>$faker-> dateTime($max = 'now', $timezone = null),
                    'type_pay'=> $faker->randomElement(['Transferencia', 'Paypal', 'Tarjeta credito']),
                    'state'=> 'Pendiente',
                    'iva'=>$faker->randomFloat($nbMaxDecimals =2, $min = 0, $max = 0.9),
                    'val_iva'=>$faker->randomFloat($nbMaxDecimals =2, $min = 100, $max = 1000),
                    'subtotal' =>$faker->randomFloat($nbMaxDecimals =2, $min = 100, $max = 1000),
                    'total' =>$faker->randomFloat($nbMaxDecimals =2, $min = 100, $max = 1000),
                    'user_id'=> $user->id,
                ]);
            }
        }
    }
}
