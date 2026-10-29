<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GalleryModel;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        
        $dummyImages = [
            [
                'src' => 'https://placehold.co/240x300',
                'alt' => 'justalt1',
                'price' => 122,
                'category_id' => 1,
                'status' => true,
            ],
            [
                'src' => 'https://placehold.co/240x300',
                'alt' => 'justalt2',
                'price' => 123,
                'category_id' => 2,
                'status' => true,
            ],
            [
                'src' => 'https://placehold.co/240x300',
                'alt' => 'justalt3',
                'price' => 942,
                'category_id' => 1,
                'status' => true,
            ]
        ];

        foreach($dummyImages as $requireImage) {
            GalleryModel::create($requireImage);
        }
    }
}
