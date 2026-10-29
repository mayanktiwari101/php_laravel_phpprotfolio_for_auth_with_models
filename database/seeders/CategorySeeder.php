<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CategoryModal;

class CategorySeeder extends Seeder
{

    public function run(): void
    {
        $dummyImages = [
            [
                'category_name' => 'all',
                'status' => true,
            ],
            [
                'category_name' => 'new',
                'status' => true,
            ],
            [
                'category_name' => 'pro',
                'status' => true,
            ],
            [
                'category_name' => 'free',
                'status' => true
            ]
        ];

        foreach($dummyImages as $image) {
            CategoryModal::create($image);
        }
    }
}
