<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cus_name' => fake()->name(),
            'cusphone_number' => fake()->numerify('###-###-####'),
            'repair_day' => now(),
            'received_day' => now(),
            'phone_name' => fake()->name(),
            'phone_emei' => fake()->numerify('##########'),
            'model' => fake()->name(),
            'note' => fake()->paragraph(),
            'product_id'=>rand(1,10),
        ];
    }
}
