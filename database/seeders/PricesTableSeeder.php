<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Price;
use App\Models\Product;

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

        //Asignacion de precios ficticios a productos
        $products = Product::all();
        foreach ($products as $product) {
            $num_prices= rand(1, 3);
            for ($i = 0; $i < $num_prices; $i++){
                Price::create([
                    'dimension'=>$faker->numerify('## x ## x ## cm'),
                    'value'=>$faker->randomFloat($nbMaxDecimals =2, $min = 100, $max = 1000),
                    'product_id'=> $product->id,
                ]);
            }
        }
    }
}
