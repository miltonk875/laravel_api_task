<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        Category::insert([
            [
                'name' => 'Category One',
                'slug' => 'category-one',
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Category Two',
                'slug' => 'category-two',
                'parent_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Category Three',
                'slug' => 'category-three',
                'parent_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Category Four',
                'slug' => 'category-four',
                'parent_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
