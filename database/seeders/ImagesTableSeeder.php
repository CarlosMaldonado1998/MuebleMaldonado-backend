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
        //Asignacion de imagenes ficticias a productos
        $products = Product::all();
        foreach ($products as $product) {
            $num_images= rand(1, 3);
            for ($i = 0; $i < $num_images; $i++){
                Image::create([
                    'url' =>'Mueble_Maldonado/products/Velador_1_Sin_Fondo_bcidzr',
                    'product_id'=> $product->id,
                ]);
            }
        }
    }
}
