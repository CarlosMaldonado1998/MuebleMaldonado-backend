<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Delivery;
use App\Models\Category;

class DeliveriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Delivery::truncate();

        $faker = \Faker\Factory::create();

        //Asignacion de categoria ficticia a productos entregados
        $categories = Category::all();
        foreach ( $categories as $category){
                Delivery::create([
                    'title'=>$faker->word,
                    'description'=>$faker->paragraph,
                    'url' =>'Mueble_Maldonado/delivered/delivered1_lfqv7k',
                    'category_id'=> $category->id,
                ]);  
        } 
    }
}
