<?php

namespace App\Http\Controllers;

use App\Models\Admin\Product;
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

        if (!$request->isItemArray) {
            $existingItem = \Cart::get($request->id);
            $product = Product::find($request->id);
            if (!is_null($existingItem))
                return redirect()->back()->withErrors(['status' => 'Error']);

            \Cart::add([
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'associatedModel' => $product
            ]);
            return redirect()->back()->with('status', 'Success');
        } else {

            foreach ($request->products as $key => $value) {
                $existingItem = \Cart::get($value['id']);
                $product = Product::find($value['id']);
                if (!is_null($existingItem))
                    return redirect()->back()->withErrors(['status' => $existingItem['name']]);

                \Cart::add([
                    'id' => $value['id'],
                    'name' => $value['name'],
                    'price' => $value['price'],
                    'quantity' => $value['quantity'],
                    'associatedModel' => $product
                ]);
            }
            return redirect()->back()->with('status', 'Success');
        }
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'quantity' => 'required',
        ]);
        \Cart::update(
            $request->id,
            [
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
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
