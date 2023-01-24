<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
// use App\Models\Admin\Setting;
use App\Models\Admin\Promotion;
use App\Models\Admin\Subcategory;
use App\Models\Review;
use App\Models\WishList;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomePagesController extends Controller
{
    //Home Page
    public function index()
    {
        $promotions = Promotion::get();
        $products = Product::with('reviews.user')->latest()->paginate(15);
        return Inertia::render('HomePage', compact('products', 'promotions'));
    }
    /**
     * Search products
     *  $request->query
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
     * Product Page 
     * Get products by SubCategory Slugs 
     * Get All Products 
     * Get products by filter parameters
     */
    public function products(Request $request, SubCategory $subcategory)
    {
        $all_products = $request->query('all_products');
        $value = $request->query('query');

        if ($subcategory->id) {
            $products = Product::with('reviews')->where('subcategory_id', $subcategory->id)->paginate(15);
            return Inertia::render('Product/ProductsPage', compact('products'));
        }
        if ($value == 'top_rated') {
            $products = Product::with('reviews')->orderBy('reviews_count', 'desc')->paginate(15);
            return Inertia::render('Product/ProductsPage', compact('products'));
        }
        if ($value == 'top_selling') {
            $products = Product::with('reviews')->orderBy('sales_count', 'desc')->paginate(15);
            return Inertia::render('Product/ProductsPage', compact('products'));
        }
        if ($all_products) {
            $products = Product::with('reviews')->latest()->get();
            return Inertia::render('Product/ProductsPage', compact('products'));
        }
        $products = Product::with('reviews')->latest()->paginate(15);
        return Inertia::render('Product/ProductsPage', compact('products'));

    }
    public function productDetails(Product $product)
    {
        $relatedProducts = $product->with('reviews.user')->where('subcategory_id', $product->subcategory->id)->whereNot('id', $product->id)->get();
        $productDetails = $product->with('subcategory.category', 'reviews.user')->where('id', $product->id)->latest()->first();
        return Inertia::render('Product/ProductDetailsPage', [
            'product' => $productDetails,
            'relatedProducts' => $relatedProducts,
        ]);
    }
    public function sendReview(Request $request, Product $product)
    {
        $data = $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|integer',
            'user_id' => 'string',
            'product_id' => 'string',
        ]);
        $product->update([
            'reviews_count' => $product->reviews_count++
        ]);
        Review::create([
            'comment' => $data['comment'],
            'rating' => $data['rating'],
            'user_id' => $data['user_id'],
            'product_id' => $data['product_id'],
        ]);
        return redirect()->back();
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

// Setting::create([
//     'promotion' => true
// ]);