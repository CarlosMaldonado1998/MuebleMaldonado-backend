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
            'role'=> User::ROLE_SUPERADMIN,
            ]);
        User::create([
            'name'=> 'Administrador',
            'lastname'=> 'Ayudante',
            'email'=> 'admin1@prueba.com',
            'password'=> $password,
            'cellphone'=> '0987202894',
            'city'=>'Quito' ,
            'role'=> User::ROLE_SUPERADMIN,
        ]);

        for($i = 0; $i < 5; $i++ ){
            User::create([
                'name'=> $faker->firstName,
                'lastname'=> $faker->lastName,
                'email'=> $faker->email,
                'password'=> $password,
                'cellphone'=> '0969055431',
                'city'=>'Quito' ,
                'role'=> User::ROLE_USER,
            ]);
        }
    }
}
