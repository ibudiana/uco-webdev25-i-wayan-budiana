<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create payment methods
        $paymentMethods = [
            [
                'user_id' => 1,
                'type' => 'Credit Card',
                'is_default' => true
            ],
            [
                'user_id' => 1,
                'type' => 'Cash on Delivery',
                'is_default' => false
            ],
            [
                'user_id' => 1,
                'type' => 'Bank Transfer',
                'is_default' => false
            ],

        ];

        foreach ($paymentMethods as $method) {
            PaymentMethod::create($method);
        }
    }
}
