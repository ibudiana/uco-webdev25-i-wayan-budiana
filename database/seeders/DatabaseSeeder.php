<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Dom\Attr;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Admin User',
        //     'email' => 'ibudiana@student.ciputra.ac.id',
        // ]);

        $this->call([
            CategorySeeder::class,
            BrandSeeder::class,
            AttributeSeeder::class,
            AttributeValueSeeder::class,
            ProductSeeder::class,
            ProductVariantSeeder::class,
            ProductVariantAttributeValueSeeder::class,
            RoleSeeder::class,
            ProductImageSeeder::class,
            BlogPostSeeder::class,
            PaymentMethodSeeder::class,
        ]);
    }
}
