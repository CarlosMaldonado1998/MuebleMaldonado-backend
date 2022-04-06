<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

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
        Schema::disableForeignKeyConstraints();
        $this->call(UsersTableSeeder::class);
        $this->call(DeliveriesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(BillsTableSeeder::class);
        $this->call(OrdersTableSeeder::class); 
        $this->call(ImagesTableSeeder::class);
        $this->call(PricesTableSeeder::class);
        $this->call(ContactTableSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}
