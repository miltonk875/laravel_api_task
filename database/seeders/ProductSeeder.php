<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder {

    public function run() {

        Product::insert([
            [
                'name' => 'Product One',
                'slug' => 'product-one',
                'price' => 950.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product Two',
                'slug' => 'herbal-essences',
                'price' => 1400.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product Three',
                'slug' => 'product-three',
                'price' => 2000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product Four',
                'slug' => 'product-four',
                'price' => 2500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
