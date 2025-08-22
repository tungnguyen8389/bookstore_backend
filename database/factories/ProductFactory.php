<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'cover_image' => fake()->imageUrl(640, 480, 'books'),
            'price' => fake()->randomFloat(2, 10, 500),
            'description' => fake()->text(),
            'stock' => fake()->numberBetween(0, 100),
        ];
    }
}
