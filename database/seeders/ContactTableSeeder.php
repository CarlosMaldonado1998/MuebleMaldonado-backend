<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::truncate();

        $faker = \Faker\Factory::create();
            for ($i = 0; $i < 5; $i++){
                Contact::create([
                    'name'=>$faker->name,
                    'email' =>$faker->email,
                    'phone'=> $faker->tollFreePhoneNumber,
                    'description'=>$faker->paragraph,
                    'state' => "Pendiente"
                ]);
            }
    }
}
