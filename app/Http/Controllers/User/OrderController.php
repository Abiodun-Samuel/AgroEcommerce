<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Rules\ProductStockPriceRule;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function checkOut(Request $request)
    {
        $cartCollection = \Cart::getContent();
        $cartItems = $cartCollection->sort();
        $cartTotal = \Cart::getTotal();
        return Inertia::render('User/CheckOut', [
            'cartItems' => $cartItems,
            "cartTotal" => $cartTotal
        ]);

    }
    public function createOrder()
    {
        $cartCollection = \Cart::getContent()->toArray();
        $products = Product::select('id', 'stock')
            ->whereIn('id', array_keys($cartCollection))
            ->pluck('stock', 'id');
        foreach ($cartCollection as $cart) {
            if (!isset($products[$cart['id']]) || $products[$cart['id']] < $cart['quantity']) {
                return dd('Error: product not found');
            }
        }
        dd('create order');
        // $cartItems = Product::find(array_keys($cartCollection))->keyBy('id');
    }

    public function trackOrder(Request $request)
    {
        return Inertia::render('Home', [
            // 'canLogin' => Route::has('login'),
            // 'canRegister' => Route::has('register'),
            // 'laravelVersion' => Application::VERSION,
            // 'phpVersion' => PHP_VERSION,

        ]);
    }
}