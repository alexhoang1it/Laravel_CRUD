<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productData = [
            [
                'cart_id' => 1,
                'title' => 'iPhone 9',
                'description' => 'An apple mobile which is nothing like apple',
                'price' => 549,
                'discount_percentage' => 12.96,
                'rating' => 4.69,
                'stock' => 94,
                'brand' => 'Apple'
            ],
            [
                'cart_id' => 2,
                'title' => 'Samsung Galaxy S21',
                'description' => 'Powerful Android smartphone',
                'price' => 799,
                'discount_percentage' => 10.5,
                'rating' => 4.8,
                'stock' => 120,
                'brand' => 'Samsung'
            ],
        ];

        Product::insert($productData);
    }
}
