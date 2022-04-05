<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image; 
use App\Models\Product;

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

        //Asignacion de imagenes ficticias a productos
        $products = Product::all();
        foreach ($products as $product) {
            $num_images= rand(1, 3);
            for ($i = 0; $i < $num_images; $i++){
                $image_name = $faker->image('public/storage/products', 400, 300, null);
                Image::create([
                    'url' =>'images'.$image_name,
                    'product_id'=> $product->id,
                ]);
            }
        }
    }
}
