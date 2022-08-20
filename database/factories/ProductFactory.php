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
    public function definition()
    {
        return [
            'product_name' => fake()->name(),
            'img' => '',
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 1, 10000),
            'version_id' => rand(1,10),
            'service_id' => rand(1,10),
        ];
    }
}
