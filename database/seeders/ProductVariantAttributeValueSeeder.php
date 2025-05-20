<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductVariantAttributeValue;

class ProductVariantAttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create product variant attribute values
        ProductVariantAttributeValue::factory()->count(20)->create();
        // $productVariantAttributeValues = [
        //     [
        //         'product_variant_id' => 1,
        //         'attribute_value_id' => 1,
        //     ],
        //     [
        //         'product_variant_id' => 1,
        //         'attribute_value_id' => 2,
        //     ],
        //     [
        //         'product_variant_id' => 2,
        //         'attribute_value_id' => 3,
        //     ],
        //     [
        //         'product_variant_id' => 2,
        //         'attribute_value_id' => 4,
        //     ],
        // ];
        // foreach ($productVariantAttributeValues as $productVariantAttributeValue) {
        //     ProductVariantAttributeValue::create($productVariantAttributeValue);
        // }
    }
}
