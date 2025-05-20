<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariantAttributeValue>
 */
class ProductVariantAttributeValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_variant_id' => $this->faker->numberBetween(1, 10), // sesuaikan jumlah variant kamu
            'attribute_value_id' => $this->faker->numberBetween(1, 10), // sesuaikan jumlah nilai atribut
        ];
    }
}
