<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement([
                'Ananas',
                'Banan',
                'Pomarańcza',
                'Jabłko',
                'Marchewka',
                'Pietruszka',
                'Seler',
                'Ziemniak',
            ]),
            'type_of_measure' => $this->faker->title(),
            'amount' => $this->faker->numberBetween(0,10),
        ];
    }
}
