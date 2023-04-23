<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\NewOrderMail;
use App\Models\Admin\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;


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
    public function createOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'payment_option' => 'required|string',
            'delivery_option' => 'required|string',
            'order_status' => 'required|string',
            'payment_status' => 'required|string',
        ]);

        $cartCollection = \Cart::getContent()->toArray();
        $orderItems = array();
        $products = Product::select('id', 'stock')
            ->whereIn('id', array_keys($cartCollection))
            ->pluck('stock', 'id');
        foreach ($cartCollection as $cart) {
            if (!isset($products[$cart['id']]) || $products[$cart['id']] < $cart['quantity']) {
                return dd('Error:' . $cart['name'] . '  product not found');
            }
            $orderItem = array(
                "id" => $cart['id'],
                "title" => $cart['associatedModel']['title'] . '(' . $cart['associatedModel']['pack_size'] . ')',
                "quantity" => $cart['quantity'],
                "price" => $cart['price'],
                "image" => $cart['associatedModel']['image'],
                "slug" => $cart['associatedModel']['slug'],
            );
            array_push($orderItems, $orderItem);
        }
        $id = '';
        try {
            DB::transaction(function () use ($cartCollection, $request, $orderItems) {
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'total_price' => 0,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'order_items' => json_encode($orderItems),
                    'payment_option' => $request->payment_option,
                    'delivery_option' => $request->delivery_option,
                    'order_status' => $request->order_status,
                    'payment_status' => $request->payment_status,
                ]);
                foreach ($cartCollection as $cart) {
                    $order->products()->attach($cart['id'], [
                        'stock' => $cart['quantity'],
                        'price' => $cart['price']
                    ]);
                    $order->increment('total_price', $cart['quantity'] * $cart['price']);
                    Product::find($cart['id'])->decrement('stock', $cart['quantity']);
                }
                $id = $order->id;
                //empty the cart
                \Cart::clear();
                $orderData = [
                    'id' => $order->id,
                    'name' => $order->name,
                    'email' => $order->email,
                    'url' => route('admin.order.show', $order->id)
                ];
                // Mail::to('abiodunsamyemi@gmail.com')->send(new NewOrderMail($orderData));
                Mail::to('contact@superoagrobase.com')->send(new NewOrderMail($orderData));
                // return redirect()->route('user.order.show', $order->id);
            });
        } catch (\Exception $exception) {
            // redirect()->route('user.order.index');
            return redirect()->back();
        }
        return redirect()->route('user.order.index');
    }
    public function showOrder(Order $order)
    {
        return Inertia::render('User/UserOrderShow', [
            'order' => $order,
        ]);
    }
}