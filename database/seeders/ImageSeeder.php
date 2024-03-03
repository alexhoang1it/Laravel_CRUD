<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imageData = [
            [
                'type' => 1,
                'link' => 'https://cdn.dummyjson.com/images/1.jpg',
            ],
            [
                'type' => 2,
                'link' => 'https://cdn.dummyjson.com/images/2.jpg',
            ],
            [
                'type' => 2,
                'link' => 'https://cdn.dummyjson.com/images/3.jpg',
            ],
            [
                'type' => 1,
                'link' => 'https://cdn.dummyjson.com/images/4.jpg',
            ],
            [
                'type' => 2,
                'link' => 'https://cdn.dummyjson.com/images/5.jpg',
            ],
        ];

        Image::insert($imageData);
    }
}
