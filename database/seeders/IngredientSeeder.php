<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // ingredient::factory(30)->create();
       Ingredient::create(['name' => 'Ziemniak', 'amount' => '20']);
       Ingredient::create(['name' => 'Jabłko', 'amount' => '20']);
       Ingredient::create(['name' => 'Pomarańcza', 'amount' => '20']);
       Ingredient::create(['name' => 'Ananas', 'amount' => '20']);
       Ingredient::create(['name' => 'Kiwi', 'amount' => '20']);
       Ingredient::create(['name' => 'Marchewka', 'amount' => '20']);
       
    }
}