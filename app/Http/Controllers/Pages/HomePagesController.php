<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\Promotion;
use App\Models\Admin\Subcategory;
use App\Models\Blog;
use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Newsletter;

class HomePagesController extends Controller
{

    //Home Page
    public function index()
    {
        $promotions = Promotion::orderBy('created_at', 'desc')->take(4)->get();
        $blogs = Blog::orderBy('created_at', 'desc')->take(4)->get();
        $products = Product::with('reviews.user')->latest()->paginate(12);
        return Inertia::render('HomePage', compact('products', 'promotions', 'blogs'));
    }
    /**
     * Search products
     *  $request->query
     */
    public function searchProducts(Request $request)
    {
        $data = $request->validate([
            'search' => 'string'
        ]);

        if (isset($data['search'])) {
            $products = Product::with('reviews')->where('title', 'like', '%' . $data['search'] . '%')
                ->orWhere('sub_title', 'like', '%' . $data['search'] . '%')
                ->orWhere('description', 'like', '%' . $data['search'] . '%')->get();
            return Inertia::render('Product/ProductsPage', compact('products'));
        } else {
            $products = Product::with('reviews')->latest()->get();
            return Inertia::render('Product/ProductsPage', compact('products'));
        }
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
        $product->update(["product_views" => ++$product->product_views]);
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
            'reviews_count' => ++$product->reviews_count
        ]);
        Review::create([
            'comment' => $data['comment'],
            'rating' => $data['rating'],
            'user_id' => $data['user_id'],
            'product_id' => $data['product_id'],
        ]);
        return redirect()->back();
    }

    public function subscribeToNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        if (!Newsletter::isSubscribed($request->email)) {
            Newsletter::subscribe($request->email);
        }
        return response()->json(['status' => 'successful'], 201);
    }

    //pages 
    public function blog()
    {
        $blogs = Blog::paginate();
        return Inertia::render('BlogPage', compact('blogs'));
    }
}

// Setting::create([
//     'promotion' => true
// ]);