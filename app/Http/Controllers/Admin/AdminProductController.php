<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Traits\CloudinaryUpload;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    use CloudinaryUpload;
    /**
    * Display a listing of the resource.
    *
    //  * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $products = Product::with('subcategory.category')->orderBy('created_at', 'desc')->get();
        return Inertia::render('Admin/Product/ProductIndex', [
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
        $categories = Category::with('subcategory')->get();
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
            'product_subtitle' => 'string|nullable',
            'category_id' => 'required|string',
            'subcategory_id' => 'required|string',
            'product_image' => 'required',
            'product_brand' => 'required|string',
            'product_description' => 'string|nullable',
            'product_ingredient' => 'string|nullable',
            'pack_size' => 'required|string',
            'price' => 'required',
            'discountPrice' => 'string|nullable',
            'product_stock' => 'required',
            'folder' => 'required'
        ]);
        $banner_img = $this->uploadImage($request->file('product_image'), $request->folder);
        Product::create([
            'title' => $request->product_title,
            'sub_title' => $request->product_subtitle,
            'slug' => Str::slug($request->product_title . ' ' . $request->pack_size . ' ' . Str::random(8), '-'),
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'image' => $banner_img,
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
    //  * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    //  * @return \Illuminate\Http\Response
    */
    public function edit(Product $product)
    {
        $categories = Category::with('subcategory')->get();
        return Inertia::render('Admin/Product/ProductEdit', compact('product', 'categories'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    //  * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_title' => 'required|string',
            'product_subtitle' => 'string|nullable',
            'category_id' => 'required|string',
            'subcategory_id' => 'required|string',
            'product_image' => 'required',
            'product_brand' => 'required|string',
            'product_description' => 'string|nullable',
            'product_ingredient' => 'string|nullable',
            'pack_size' => 'required|string',
            'price' => 'required',
            'discountPrice' => 'string|nullable',
            'product_stock' => 'required',
            'folder' => 'required'
        ]);
        if ($request->hasFile('product_image')) {
            $val = $this->searchImage($request->product_img_id);
            if ($val['total_count'] >= 1) {
                $this->deleteImage($request->product_img_id);
                $banner_img = $this->uploadImage($request->file('product_image'), $request->folder);
                $product->update([
                    'title' => $request->product_title,
                    'sub_title' => $request->product_subtitle,
                    'slug' => Str::slug($request->product_title . ' ' . $request->pack_size . ' ' . Str::random(8), '-'),
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'image' => $banner_img,
                    'brands' => $request->product_brand,
                    'description' => $request->product_description,
                    'ingredients' => $request->product_ingredient,
                    'pack_size' => $request->pack_size,
                    'price' => $request->price,
                    'discount_price' => $request->discountPrice,
                    'stock' => $request->product_stock,
                ]);
            } else {
                $banner_img = $this->uploadImage($request->file('product_image'), $request->folder);
                $product->update([
                    'title' => $request->product_title,
                    'sub_title' => $request->product_subtitle,
                    'slug' => Str::slug($request->product_title . ' ' . $request->pack_size . ' ' . Str::random(8), '-'),
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'image' => $banner_img,
                    'brands' => $request->product_brand,
                    'description' => $request->product_description,
                    'ingredients' => $request->product_ingredient,
                    'pack_size' => $request->pack_size,
                    'price' => $request->price,
                    'discount_price' => $request->discountPrice,
                    'stock' => $request->product_stock,
                ]);
            }
        } else {
            $product->update([
                'title' => $request->product_title,
                'sub_title' => $request->product_subtitle,
                'slug' => Str::slug($request->product_title . ' ' . $request->pack_size . ' ' . Str::random(8), '-'),
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'image' => $request->product_image,
                'brands' => $request->product_brand,
                'description' => $request->product_description,
                'ingredients' => $request->product_ingredient,
                'pack_size' => $request->pack_size,
                'price' => $request->price,
                'discount_price' => $request->discountPrice,
                'stock' => $request->product_stock,
            ]);
        }
        return Redirect::route('admin.product.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    //  * @return \Illuminate\Http\Response
    */
    public function destroy(Product $product)
    {
        $this->deleteImage(json_decode($product->image)->img_id);
        $product->delete();
        return Redirect::route('admin.product.index');
    }
}