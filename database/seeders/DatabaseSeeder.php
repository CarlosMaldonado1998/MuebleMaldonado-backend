<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UsersTableSeeder::class);
        $this->call(DeliveriesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(PricesTableSeeder::class);
        $this->call(BillsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
    }
}
