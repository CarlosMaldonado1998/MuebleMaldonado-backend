<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $password = Hash::make('123123');

        $faker = \Faker\Factory::create();

        User::create([
            'name'=> 'Administrador',
            'lastname'=> 'General',
            'email'=> 'admin@prueba.com',
            'password'=> $password,
            'cellphone'=> '0987202894',
            'city'=>'Quito' ,
            'address'=>'Pisulli'
            ]);

        for($i = 0; $i < 10; $i++ ){
            User::create([
                'name'=> $faker->firstName,
                'lastname'=> $faker->lastName,
                'email'=> $faker->email,
                'password'=> $password,
                'cellphone'=> '0969055431',
                'city'=>$faker->city ,
                'address'=>$faker->address,
            ]);
        }
    }
}
