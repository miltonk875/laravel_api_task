<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller {

    public function get_category_products($slug, Request $request) {
        // Fetch the category by slug
        $sort = $request->get('sort');

        $category = Category::with('products')->where('slug', $slug)->first();

        if (!$category) {
            return response()->json([
                        'message' => 'Category not found',
                            ], 404);
        }

        // Fetch products associated with the category
        $category_products = $category->products();

        if ($sort == 'best_sell') {
            $products = $category_products
                    ->with(['orders' => function ($query) {
                            $query->select('product_id', DB::raw('SUM(unit_price * quantity) as best_sell'))->groupBy('product_id');
                        }])
                    ->get();
        }

        // Products By Top Rated
        if ($sort == 'top_rated') {
            $products = $category_products->withCount(['reviews as average_rating' => function ($query) {
                            $query->select(DB::raw('ROUND(AVG(rating), 1)'));
                        }])
                    ->orderBy('average_rating', 'desc')
                    ->get();
        }

        // Products By High to low price
        if ($sort == 'price_high_to_low') {
            $products = $category_products->orderBy('price', 'desc')->get();
        }

        // Products By Low to high price
        if ($sort == 'price_low_to_high') {
            $products = $category_products->orderBy('price', 'asc')->get();
        }

        return response()->json($products);
    }
}
