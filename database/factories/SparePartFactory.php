<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SparePart>
 */
class SparePartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'code' => $this->faker->unique()->regexify('[A-Z0-9]{6}'),
            'price' => $this->faker->randomFloat(2, 2, 100000),
            'quantity' => $this->faker->numberBetween(1, 10000),
            'description' => $this->faker->paragraph(),
            'supplier_id' => $this->faker->numberBetween(1, 50),
            'category_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
