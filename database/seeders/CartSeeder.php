<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cartData = [
            [
                'title' => 'Spring and summershoes',
                'price' => 20,
                'quantity' => 3,
                'total' => 60,
                'discount_percentage' => 8.71,
                'discounted_price' => 55
            ],
            [
                'title' => 'Winter',
                'price' => 30,
                'quantity' => 2,
                'total' => 60,
                'discount_percentage' => 5.5,
                'discounted_price' => 28.5
            ]
        ];

        Cart::insert($cartData);
    }
}
