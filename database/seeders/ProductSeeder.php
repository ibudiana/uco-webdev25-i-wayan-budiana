<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create 20 products
        Product::factory()->count(20)->create();
        // $products = [
        //     [
        //         'name' => 'Product 1',
        //         'slug' => 'product-1',
        //         'description' => 'Description for product 1',
        //         'price' => 100000,
        //         'stock' => 50,
        //         'category_id' => 1,
        //         'brand_id' => 1,
        //     ],
        //     [
        //         'name' => 'Product 2',
        //         'slug' => 'product-2',
        //         'description' => 'Description for product 2',
        //         'price' => 200000,
        //         'stock' => 30,
        //         'category_id' => 2,
        //         'brand_id' => 2,
        //     ],
        //     [
        //         'name' => 'Product 3',
        //         'slug' => 'product-3',
        //         'description' => 'Description for product 3',
        //         'price' => 150000,
        //         'stock' => 20,
        //         'category_id' => 3,
        //         'brand_id' => 3,
        //     ],
        //     [
        //         'name' => 'Product 4',
        //         'slug' => 'product-4',
        //         'description' => 'Description for product 4',
        //         'price' => 250000,
        //         'stock' => 10,
        //         'category_id' => 4,
        //         'brand_id' => 4,
        //     ],
        //     [
        //         'name' => 'Product 5',
        //         'slug' => 'product-5',
        //         'description' => 'Description for product 5',
        //         'price' => 300000,
        //         'stock' => 5,
        //         'category_id' => 5,
        //         'brand_id' => 5,
        //     ],
        //     [
        //         'name' => 'Product 6',
        //         'slug' => 'product-6',
        //         'description' => 'Description for product 6',
        //         'price' => 120000,
        //         'stock' => 40,
        //         'category_id' => 1,
        //         'brand_id' => 2,
        //     ],
        //     [
        //         'name' => 'Product 7',
        //         'slug' => 'product-7',
        //         'description' => 'Description for product 7',
        //         'price' => 220000,
        //         'stock' => 25,
        //         'category_id' => 2,
        //         'brand_id' => 3,
        //     ],
        //     [
        //         'name' => 'Product 8',
        //         'slug' => 'product-8',
        //         'description' => 'Description for product 8',
        //         'price' => 180000,
        //         'stock' => 15,
        //         'category_id' => 3,
        //         'brand_id' => 4,
        //     ],
        //     [
        //         'name' => 'Product 9',
        //         'slug' => 'product-9',
        //         'description' => 'Description for product 9',
        //         'price' => 280000,
        //         'stock' => 8,
        //         'category_id' => 4,
        //         'brand_id' => 5,
        //     ],
        //     [
        //         'name' => 'Product 10',
        //         'slug' => 'product-10',
        //         'description' => 'Description for product 10',
        //         'price' => 350000,
        //         'stock' => 3,
        //         'category_id' => 5,
        //         'brand_id' => 1,
        //     ],
        //     [
        //         'name' => 'Product 11',
        //         'slug' => 'product-11',
        //         'description' => 'Description for product 11',
        //         'price' => 130000,
        //         'stock' => 45,
        //         'category_id' => 1,
        //         'brand_id' => 2,
        //     ],
        //     [
        //         'name' => 'Product 12',
        //         'slug' => 'product-12',
        //         'description' => 'Description for product 12',
        //         'price' => 230000,
        //         'stock' => 28,
        //         'category_id' => 2,
        //         'brand_id' => 3,
        //     ],
        //     [
        //         'name' => 'Product 13',
        //         'slug' => 'product-13',
        //         'description' => 'Description for product 13',
        //         'price' => 190000,
        //         'stock' => 18,
        //         'category_id' => 3,
        //         'brand_id' => 4,
        //     ],
        //     [
        //         'name' => 'Product 14',
        //         'slug' => 'product-14',
        //         'description' => 'Description for product 14',
        //         'price' => 290000,
        //         'stock' => 12,
        //         'category_id' => 4,
        //         'brand_id' => 5,
        //     ],
        //     [
        //         'name' => 'Product 15',
        //         'slug' => 'product-15',
        //         'description' => 'Description for product 15',
        //         'price' => 400000,
        //         'stock' => 2,
        //         'category_id' => 5,
        //         'brand_id' => 1,
        //     ],
        //     [
        //         'name' => 'Product 16',
        //         'slug' => 'product-16',
        //         'description' => 'Description for product 16',
        //         'price' => 140000,
        //         'stock' => 35,
        //         'category_id' => 1,
        //         'brand_id' => 2,
        //     ],
        //     [
        //         'name' => 'Product 17',
        //         'slug' => 'product-17',
        //         'description' => 'Description for product 17',
        //         'price' => 240,
        //         'stock' => 22,
        //         'category_id' => 2,
        //         'brand_id' => 3,
        //     ],
        //     [
        //         'name' => 'Product 18',
        //         'slug' => 'product-18',
        //         'description' => 'Description for product 18',
        //         'price' => 200000,
        //         'stock' => 14,
        //         'category_id' => 3,
        //         'brand_id' => 4,
        //     ],
        //     [
        //         'name' => 'Product 19',
        //         'slug' => 'product-19',
        //         'description' => 'Description for product 19',
        //         'price' => 300000,
        //         'stock' => 6,
        //         'category_id' => 4,
        //         'brand_id' => 5,
        //     ],
        //     [
        //         'name' => 'Product 20',
        //         'slug' => 'product-20',
        //         'description' => 'Description for product 20',
        //         'price' => 450000,
        //         'stock' => 1,
        //         'category_id' => 5,
        //         'brand_id' => 1,
        //     ],
        // ];

        // foreach ($products as $product) {
        //     Product::create($product);
        // }
    }
}
