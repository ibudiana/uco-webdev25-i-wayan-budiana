<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //creat brands
        // $brands = [
        //     ['name' => 'Adidas', 'slug' => 'adidas'],
        //     ['name' => 'Puma', 'slug' => 'puma'],
        //     ['name' => 'Reebok', 'slug' => 'reebok'],
        //     ['name' => 'Under Armour', 'slug' => 'under-armour'],
        //     ['name' => 'New Balance', 'slug' => 'new-balance'],
        // ];
        // foreach ($brands as $brand) {
        //     Brand::create($brand);
        // }
        // Create 10 random brands using the factory
        Brand::factory()->count(10)->create();
    }
}
