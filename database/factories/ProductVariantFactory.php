<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 30),
            'sku' => 'SKU-' . $this->faker->unique()->numberBetween(1000, 9999),
            'price' => $this->faker->numberBetween(75000, 500000),
            'stock' => $this->faker->numberBetween(1, 100),
        ];
    }
}
