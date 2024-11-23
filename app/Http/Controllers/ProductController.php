<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller {

    public function get_category_products($slug, Request $request) {
        // Fetch the category by slug
        $sort = $request->get('sort');

        $category = Category::with('products')->where('slug', $slug)->first();

        if (!$category) {
            return response()->json([
                        'message' => 'Category not found.',
                        'status' => 404,
            ]);
        }

        // Fetch products associated with the category
        $products = $category->products();

        if ($sort == 'best_sell') {
            $result = $products->orders->count();
        }

        if ($sort == 'top_rated') {
            $products->withAvg('reviews', 'rating')->orderBy('rating', 'desc');

        }
        
        // Products By High to low price
        if ($sort == 'price_high_to_low') {
            $products = $products->orderBy('price', 'desc');
        }
        
        // Products By Low to high price
        if ($sort == 'price_low_to_high') {
            $products = $products->orderBy('price', 'asc');
        }
        
        // Get the results
        $products = $products->get();

        return response()->json($products);
    }
}
