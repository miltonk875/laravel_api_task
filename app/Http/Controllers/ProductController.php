<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller {

    public function get_category_products($slug, Request $request) {
        // Fetch the category by slug
        $category = Category::with('products')->where('slug', $slug)->first();

        if (!$category) {
            return response()->json([
                        'message' => 'Category not found.',
                        'status' => 404,
            ]);
        }

        // Fetch products associated with the category
        $products = $category->products();
        // Apply sorting based on query parameter
        $sort = $request->get('sort');
        if ($sort == 'best_sell') {
            $result = $products->orders->count();
        } elseif ($sort == 'top_rated') {
            $result = '';
        } elseif ($sort == 'price_high_to_low') {
            $result = '';
        } elseif ($sort == 'price_low_to_high') {
            $result = '';
        } else {
            $result = '';
        }

        // Paginate or get the results
        $products = $products->get();

        return response()->json($products);
    }
}
