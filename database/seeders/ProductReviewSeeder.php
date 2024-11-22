<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductReviewSeeder extends Seeder {

    public function run() {
        $faker = Faker::create();

        $products = Product::all();
        $users = User::all();

        for ($i = 0; $i < 10; $i++) {
            DB::table('product_reviews')->insert([
                'product_id' => $products->random()->id,
                'user_id' => $users->random()->id,
                'comment' => $faker->paragraph(),
                'rating' => $faker->numberBetween(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
