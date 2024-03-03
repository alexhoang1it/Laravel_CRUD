<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'product_id' => 1,
                'image_id' => 1,
            ],
            [
                'product_id' => 1,
                'image_id' => 2,
            ],
            [
                'product_id' => 1,
                'image_id' => 3,
            ],
            [
                'product_id' => 2,
                'image_id' => 4,
            ],
            [
                'product_id' => 2,
                'image_id' => 5,
            ],
            [
                'product_id' => 2,
                'image_id' => 6,
            ]
        ];

        ProductImage::insert($data);
    }
}
