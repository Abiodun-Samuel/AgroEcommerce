<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cart::create([
            'user_id' => '97dd972a-fcff-4cc1-9ede-f33b0eee28e8',
            'product_id' => '97e4b65e-c565-4862-9dc5-376a1bc74779',
            'product_title' => 'Cart One',
            'product_slug' => 'product slug 1',
            'product_image' => '97e4b65e-c565-4862-9dc5-376a1bc74779',
            'product_price' => 40,
            'product_quantity' => 4,
        ]);
        Cart::create([
            'user_id' => '97dd972a-fcff-4cc1-9ede-f33b0eee28e8',
            'product_id' => '97e4b65e-c565-4862-9dc5-376a1bc74779',
            'product_title' => 'Cart One',
            'product_slug' => 'product slug 1',
            'product_image' => '97e4b65e-c565-4862-9dc5-376a1bc74779',
            'product_price' => 40,
            'product_quantity' => 4,
        ]);
    }
}