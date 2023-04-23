<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *  ** @return \Inertia\Response
     */
    public function index()
    {
        $orders = Order::latest()->get();
        return Inertia::render('Admin/Order/OrderIndex', [
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     ** @return \Inertia\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show(Order $order)
    {
        return Inertia::render('Admin/Order/OrderDetails', [
            'order' => $order,
        ]);
    }
    public function updateOrder(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|string',
        ]);

        $order->update([
            'order_status' => $request->order_status,
            'delivery_date' => Carbon::now()->timezone('Africa/Lagos'),
        ]);
        return redirect()->back();
    }
    public function updatePayment(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|string',
        ]);

        $order->update([
            'payment_status' => $request->payment_status,
            'payment_date' => Carbon::now()->timezone('Africa/Lagos'),
        ]);
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}