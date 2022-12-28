<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $userIDs = User::pluck('id');

        return [
            'title' => $this->faker->title(),
            'description' => $this->faker->paragraph(),
            'author_id' => $userIDs->random(),
            'description' => $this->faker->paragraph(),
            'image_path' => $this->faker->filePath(),
            'yt_link' => $this->faker->url(),
        ];
    }
}
