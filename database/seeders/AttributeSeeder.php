<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attribute;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create attributes
        Attribute::create([
            'name' => 'Color',
        ]);
        Attribute::create([
            'name' => 'Size',
        ]);
    }
}
