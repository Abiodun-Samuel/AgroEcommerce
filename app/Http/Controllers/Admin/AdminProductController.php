<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    //  * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $products = Product::with('sub_category.category')->orderBy('created_at', 'desc')->get();
        return Inertia::render('Admin/Product/Index', [
            'products' => $products,
        ]);
    }

    /**
    * Show the form for creating a new resource.
    *
    //  * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $categories = Category::with('sub_category')->get();
        return Inertia::render('Admin/Product/ProductCreate', compact('categories'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'product_title' => 'required|string',
            'product_subtitle' => 'required|string',
            'category_id' => 'required|string',
            'subcategory_id' => 'required|string',
            'product_image' => 'required',
            'product_brand' => 'required|string',
            'product_description' => 'required',
            'product_ingredient' => 'required',
            'pack_size' => 'required|string',
            'price' => 'required',
            'discountPrice' => 'required',
            'product_stock' => 'required',
        ]);

        Product::create([
            'title' => $request->product_title,
            'sub_title' => $request->product_subtitle,
            'slug' => Str::slug($request->product_title, '-'),
            'category_id' => $request->category_id,
            'sub_category_id' => $request->subcategory_id,
            'image' => $request->product_image,
            'brands' => $request->product_brand,
            'description' => $request->product_description,
            'ingredients' => $request->product_ingredient,
            'pack_size' => $request->pack_size,
            'price' => $request->price,
            'discount_price' => $request->discountPrice,
            'stock' => $request->product_stock,
        ]);

        return Redirect::route('admin.product.index');
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
    //  * @return \Illuminate\Http\Response
    */
    public function destroy(Product $product)
    {
        $product->delete();
        return Redirect::route('admin.product.index');
    }
}