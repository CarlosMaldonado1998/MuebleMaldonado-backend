<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        $faker = \Faker\Factory::create();
        
        for($i = 0; $i < 5; $i++ ){
            Category::create([
                'name'=>$faker->word,
            ]);
        }
    }
}
