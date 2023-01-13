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
       Product::create(['name' => 'Ziemniak', 'amount' => '20']);
       Product::create(['name' => 'Jabłko', 'amount' => '20']);
       Product::create(['name' => 'Pomarańcza', 'amount' => '20']);
       Product::create(['name' => 'Ananas', 'amount' => '20']);
       Product::create(['name' => 'Kiwi', 'amount' => '20']);
       Product::create(['name' => 'Marchewka', 'amount' => '20']);
       
    }
}