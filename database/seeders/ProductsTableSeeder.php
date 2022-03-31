<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();

        $faker = \Faker\Factory::create();

        for($i = 0; $i < 10; $i++ ){
            Product::create([
                'name'=>$faker->name,
                'code' =>$faker->numerify('MMA ###'), 
                'description' =>$faker->paragraph,
                'warranty'=>$faker->numerify('# años.'),
                'material' =>$faker->randomElement($array = array ('melamina','madera','MDF')),
                'delivery_time' =>$faker->numerify('## días laborables.'),
            ]);
        }
    }
}
