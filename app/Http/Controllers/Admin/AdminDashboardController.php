<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\SubCategory;
use App\Models\Transaction;
use App\Models\User;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $users = User::paginate(10);
        $products = Product::count();
        $categories = Category::count();
        $subcategories = SubCategory::count();
        $order_count = Order::count();
        $transaction_count = Transaction::count();
        return Inertia::render('Admin/AdminIndex', [
            'users' => $users,
            'order_count' => $order_count,
            'products_count' => $products,
            'categories_count' => $categories,
            'subcategories_count' => $subcategories,
            'transaction_count' => $transaction_count,
        ]);
    }

    public function userDelete(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string',
        ]);
        $user->update([
            'role' => $request->role,
            'is_admin' => $request->role == 'Admin' ? true : false,
        ]);
        return redirect()->back();
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
