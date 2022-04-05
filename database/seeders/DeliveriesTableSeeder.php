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
            $num_categories= rand(1, 3);
            for ($i = 0; $i < $num_categories; $i++){
                $image_name = $faker->image('public/storage/delivered', 400, 300, null);
                Delivery::create([
                    'title'=>$faker->word,
                    'description'=>$faker->paragraph,
                    'url' =>'images'.$image_name,
                    'category_id'=> $category->id,
                ]);
             }
        } 
    }
}
