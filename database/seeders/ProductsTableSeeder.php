<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Room;
use App\Models\Category;
use App\Models\Color;

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

         //Asignacion de cuarto a un producto 
         $rooms = Room::all();
         $categories = Category::all();
         foreach ($rooms as $room) {

            //Asignacion de categoria a un producto 
            foreach ( $categories as $category){
                $num_prices= rand(0, 1);
                for ($i = 0; $i < $num_prices; $i++){
                    $product = Product::create([
                        'name'=>$faker->name,
                        'code' =>$faker->numerify('MMA ###'), 
                        'description' =>$faker->paragraph,
                        'warranty'=>$faker->numerify('# años.'),
                        'material' =>$faker->randomElement($array = array ('melamina','madera','MDF')),
                        'delivery_time' =>$faker->numerify('## días laborables.'),
                        'room_id'=> $room->id,
                        'category_id'=> $category->id,
                    ]);

                    $product->colors()->saveMany(
                        $faker->randomElements(
                            array(
                                Color::find(1),
                                Color::find(2),
                                Color::find(3),
                                Color::find(4),
                                Color::find(5),
                            ), $faker->numberBetween(1,5), false
                        )
                    );
                 }
            }  
         }
    }
}
