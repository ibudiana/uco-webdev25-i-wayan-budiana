<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AttributeValue;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contoh attribute_id 1 untuk 'Color'
        $colors = ['Red', 'Blue', 'Green', 'Black', 'White'];
        foreach ($colors as $color) {
            AttributeValue::create([
                'attribute_id' => 1,
                'value' => $color,
            ]);
        }

        // Contoh attribute_id 2 untuk 'Size'
        $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
        foreach ($sizes as $size) {
            AttributeValue::create([
                'attribute_id' => 2,
                'value' => $size,
            ]);
        }
    }
}
