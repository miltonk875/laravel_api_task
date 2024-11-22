<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder {

    public function run() {
        $products = Product::all();
        $categories = Category::all();
        foreach ($products as $product) {
            foreach ($categories as $category) {
                DB::table('product_category')->insert([
                    'product_id' => $product->id,
                    'category_id' => $category->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
