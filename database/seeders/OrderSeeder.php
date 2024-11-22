<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Product;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder {

    public function run() {
        $faker = Faker::create();

        $order1 = Order::create([
                    'grand_total' => 0.00,
                    'shipping_cost' => 100.00,
                    'discount' => 100.00,
                    'user_id' => 1,
        ]);

        $order2 = Order::create([
                    'grand_total' => 0.00,
                    'shipping_cost' => 150.00,
                    'discount' => 0.00,
                    'user_id' => 2,
        ]);

        foreach ([$order1, $order2] as $order) {
            $products = Product::all()->random(4);
            $total = 0;
            foreach ($products as $product) {
                $quantity = $faker->numberBetween(1, 5);
                DB::table('order_details')->insert([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'unit_price' => $product->price,
                    'quantity' => $quantity,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $total += $product->price * $quantity;
            }

            $grand_total = $total + $order->shipping_cost - $order->discount;
            DB::table('orders')->where('id', $order->id)->update([
                'grand_total' => $grand_total,
            ]);
        }
    }
}
