<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\SubCategory;
use App\Models\WishList;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomePagesController extends Controller
{
    //Home Page
    public function index()
    {

        $products = Product::paginate(10);
        return Inertia::render('HomePage', compact('products'));
    }
    // Product Page 
    /**
     * Search products
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $request->query
     * @return \Illuminate\Http\Response
     */
    public function searchProducts(Request $request)
    {
        $data = $request->validate([
            'query' => 'string'
        ]);

        $products = Product::where('title', 'like', '%' . $data['query'] . '%')
            ->orWhere('sub_title', 'like', '%' . $data['query'] . '%')
            ->orWhere('description', 'like', '%' . $data['query'] . '%')->get();

        return $products;
    }
    /**
     * Product Page I
     *  Get products by SubCategory Slugs
     *
     *   $request
     * @param  int  $slug
     */
    public function productsBySubcategory($category_slug, $subcategory_slug)
    {
        // Get all products in the selected subcategory
        $products = SubCategory::with('products')->where('slug', $subcategory_slug)->first()->products;
        return Inertia::render('Product/ProductsBySubcategoryPage', compact('products'));
    }

    /**
     * Product Page II
     *  Get All Products 
     *   $request
     * @param 
     */
    public function productPage()
    {
        $products = Product::paginate(10);
        return Inertia::render('Product/ProductsPage', compact('products'));
    }

    public function addToCart(Request $request)
    {
        $cart = $request->session()->get('add-to-cart');

        if (is_null($cart)) {
            $cart = array($request->product);
        } else {
            // $cart = unserialize($cart);
            array_push($cart, $request->product);
        }
        $request->session()->put('add-to-cart', $cart);
        return response()->json(['message' => $request->product['title'] . 'has been added to your cart', 'cart' => $cart]);
    }
    public function getCart(Request $request)
    {
        $cart = $request->session()->get('add-to-cart');
        // dd($cart);
        return response()->json($cart);
    }
}