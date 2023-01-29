<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    public function cartList()
    {
        $cartCollection = \Cart::getContent();
        $cartCount = $cartCollection->count();
        $cartItems = $cartCollection->sort();
        $cartTotal = \Cart::getTotal();
        return Inertia::render('CartPage', compact('cartItems', 'cartTotal', 'cartCount'));
    }
    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
                'stock' => $request->stock,
                'slug' => $request->slug,
            )
        ]);
        return true;
    }
    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => $request->type == 'inc' ? 1 : -1
            ]
        );
        return redirect()->back();
    }
    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        return redirect()->back();
    }

    public function clearAllCart()
    {
        \Cart::clear();
        return redirect()->back();
    }
}