<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create categories
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics'],
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Home & Garden', 'slug' => 'home-garden'],
            ['name' => 'Sports', 'slug' => 'sports'],
            ['name' => 'Toys', 'slug' => 'toys'],
        ];
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
