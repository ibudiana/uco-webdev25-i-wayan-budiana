<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imageFiles = [
            '1748259958.png',
            '1748259971.png',
            '1748260673.png',
            '1748260685.png',
            '1748260731.png',
            '1748260809.png',
            '1748260866.png',
        ];

        for ($productId = 1; $productId <= 30; $productId++) {
            shuffle($imageFiles);
            for ($index = 0; $index < rand(1, 7); $index++) {
                // Create a new ProductImage instance
                ProductImage::create([
                    'product_id' => $productId,
                    'url' => $imageFiles[$index],
                    'is_primary' => $index === 0 ? 1 : 0, // Set the first image as primary
                ]);
            }
        }
    }
}
