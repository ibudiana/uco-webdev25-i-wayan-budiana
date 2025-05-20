<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductVariant;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create product variants
        ProductVariant::factory()->count(20)->create();
        // $productVariants = [
        //     [
        //         'product_id' => 1,
        //         'sku' => 'SKU-1',
        //         'price' => 100000,
        //         'stock' => 50,
        //     ],
        //     [
        //         'product_id' => 2,
        //         'sku' => 'SKU-2',
        //         'price' => 200000,
        //         'stock' => 30,
        //     ],
        //     [
        //         'product_id' => 3,
        //         'sku' => 'SKU-3',
        //         'price' => 150000,
        //         'stock' => 20,
        //     ],
        //     [
        //         'product_id' => 4,
        //         'sku' => 'SKU-4',
        //         'price' => 250000,
        //         'stock' => 10,
        //     ],
        //     [
        //         'product_id' => 5,
        //         'sku' => 'SKU-5',
        //         'price' => 300000,
        //         'stock' => 5,
        //     ],
        // ];

        // foreach ($productVariants as $productVariant) {
        //     ProductVariant::create($productVariant);
        // }
    }
}
