<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Star>
 */
class StarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'image' => fake()->image(public_path('images/stars'), 360, 360, null, true, true, null, true, 'jpg'),
            'description' => fake()->paragraphs(4, true)
        ];
    }
}
