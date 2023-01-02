<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Product::factory(30)->create();
       Product::create(['name' => 'Ziemniak']);
       Product::create(['name' => 'Jabłko']);
       Product::create(['name' => 'Pomarańcza']);
       Product::create(['name' => 'Ananas']);
       Product::create(['name' => 'Kiwi']);
       Product::create(['name' => 'Marchewka']);
    }
}