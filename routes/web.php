<?php

//Admin
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminPromotionController;
use App\Http\Controllers\Admin\AdminSubcategoryController;
use App\Http\Controllers\Admin\AdminTransactionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Pages\HomePagesController;
// users 
use App\Http\Controllers\Pages\PagesController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\UserDashboardController;

use Illuminate\Support\Facades\Route;

// HomePages Controller
Route::get('/', [HomePagesController::class, 'index'])->name('home');
//Products
Route::get('/search-product', [HomePagesController::class, 'searchProducts'])->name('product.search');
Route::get('/products/{subcategory:slug?}', [HomePagesController::class, 'products'])->name('product-page');
Route::get('/product/{product:slug}', [HomePagesController::class, 'productDetails'])->name('product-details-page');
//newsletter
Route::post('/subscribe-to-newsletter', [HomePagesController::class, 'subscribeToNewsletter'])->name('subscribe-to-newsletter');
//pages
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::post('/send-messsge', [PagesController::class, 'sendMessage'])->name('sendMessage');
//blogs
Route::get('/blogs', [PagesController::class, 'blogs'])->name('blog-page');
Route::get('/blogs/{blog:slug}', [PagesController::class, 'blogsDetails'])->name('blog-details');
//services
Route::get('/service/agro-input', [PagesController::class, 'agroInput'])->name('agro-input');
Route::get('/service/agricourt-ventures', [PagesController::class, 'agriCourt'])->name('agri-court');
Route::get('/service/harvest-yield-farm', [PagesController::class, 'harvestYield'])->name('harvest-yield');
//cart
Route::get('/cart', [CartController::class, 'cartList'])->name('cart');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::put('/update-cart', [CartController::class, 'updateCart'])->name('update-cart');
Route::put('/remove-cart', [CartController::class, 'removeCart'])->name('remove-cart');
Route::delete('/clear-cart', [CartController::class, 'clearAllCart'])->name('clear-cart');
//download receipt
Route::get('/order/{order}/receipt', [OrderController::class, 'showOrderReceipt'])->name('order.receipt');

//Admin routes
Route::name('admin.')->prefix('admin')->middleware(['auth', 'verified', 'isAdmin'])->group(function () {
    // Dashboard Routes
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard.index');
    Route::delete('/user-delete/{user}', [AdminDashboardController::class, 'userDelete'])->name('user-delete');
    Route::post('/update-role/{user}', [AdminDashboardController::class, 'updateRole'])->name('update-role');
    // Route::get('/dashboard/edit', [AdminDashboardController::class, 'edit'])->name('dashboard.edit');
    // Route::patch('/dashboard', [AdminDashboardController::class, 'update'])->name('dashboard.update');
    // Route::delete('/dashboard', [AdminDashboardController::class, 'destroy'])->name('dashboard.destroy');
    //Admin Products
    Route::get('/products', [AdminProductController::class, 'index'])->name('product.index');
    Route::get('/product-create', [AdminProductController::class, 'create'])->name('product.create');
    Route::get('/product/{product}', [AdminProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/{product}', [AdminProductController::class, 'update'])->name('product.update');
    Route::post('/product', [AdminProductController::class, 'store'])->name('product.store');
    Route::delete('/product/{product}', [AdminProductController::class, 'destroy'])->name('product.destroy');
    //Admin dashbord
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('index');
    Route::post('/update-avatar/{user}', [AdminProfileController::class, 'updateAvatar'])->name('update-avatar');
    Route::post('/update-profile/{user}', [AdminProfileController::class, 'updateProfile'])->name('update-profile');
    //Admin order
    Route::get('/order/{order}', [AdminOrderController::class, 'show'])->name('order.show');
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('order.index');
    Route::put('/order/{order}', [AdminOrderController::class, 'updateOrder'])->name('update.order');
    Route::put('/order-payment/{order}', [AdminOrderController::class, 'updatePayment'])->name('update.payment');
    //Admin Category
    Route::get('/category', [AdminCategoryController::class, 'index'])->name('category.index');
    Route::get('/category/{category}', [AdminCategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/{category}', [AdminCategoryController::class, 'update'])->name('category.update');
    Route::post('/category', [AdminCategoryController::class, 'store'])->name('category.store');
    Route::delete('/category/{category}', [AdminCategoryController::class, 'destroy'])->name('category.destroy');
    //Admin SubCategory
    Route::get('/subcategory', [AdminSubcategoryController::class, 'index'])->name('subcategory.index');
    Route::get('/subcategory/{subcategory}', [AdminSubcategoryController::class, 'edit'])->name('subcategory.edit');
    Route::post('/subcategory/{subcategory}', [AdminSubcategoryController::class, 'update'])->name('subcategory.update');
    Route::post('/subcategory', [AdminSubcategoryController::class, 'store'])->name('subcategory.store');
    Route::delete('/subcategory/{subcategory}', [AdminSubcategoryController::class, 'destroy'])->name('subcategory.destroy');
    //Admin Promotion
    Route::get('/promotions', [AdminPromotionController::class, 'index'])->name('promotion.index');
    Route::post('/promotions', [AdminPromotionController::class, 'store'])->name('promotion.store');
    Route::get('/promotions/{promotion}', [AdminPromotionController::class, 'edit'])->name('promotion.edit');
    Route::post('/promotions/{promotion}', [AdminPromotionController::class, 'update'])->name('promotion.update');
    Route::delete('/promotions/{promotion}', [AdminPromotionController::class, 'destroy'])->name('promotion.destroy');
    //Gallery
    Route::get('/gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/{gallery}', [AdminGalleryController::class, 'edit'])->name('gallery.edit');
    Route::post('/gallery/{gallery}', [AdminGalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{gallery}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');
    //Blog
    Route::get('/blog', [AdminBlogController::class, 'index'])->name('blog.index');
    Route::post('/blog', [AdminBlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/{promotion}', [AdminBlogController::class, 'edit'])->name('blog.edit');
    Route::post('/blog/{promotion}', [AdminBlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{promotion}', [AdminBlogController::class, 'destroy'])->name('blog.destroy');
    //Transaction
    Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('transaction.index');
});

// Users
// Authenticated and verified routes 
Route::name('user.')->prefix('user')->middleware(['auth'])->group(function () {
    // Dashboard Routes 
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/my-orders', [UserDashboardController::class, 'myOrders'])->name('order.index');
    // create orders from cart
    Route::get('/order/{order}', [OrderController::class, 'showOrder'])->name('order.show');
    Route::post('/order', [OrderController::class, 'createOrder'])->name('order.create');
    // update order
    Route::put('/order-paid/{order}', [OrderController::class, 'updateOrderPaid'])->name('order.update-paid');

    //checkout
    Route::get('/check-out', [OrderController::class, 'checkOut'])->name('check-out');

    //User Dashboard
    Route::get('/profile', [UserDashboardController::class, 'myProfile'])->name('profile.index');
    Route::post('/update-avatar/{user}', [UserDashboardController::class, 'updateAvatar'])->name('update-avatar');
    Route::post('/update-profile/{user}', [UserDashboardController::class, 'updateProfile'])->name('update-profile');
    Route::post('/update-profile-for-orders/{user}', [UserDashboardController::class, 'updateUserProfileForOrders'])->name('update-user');


    // Route::get('/category', [AdminCategoryController::class, 'index'])->name('category.index');
    // Route::get('/category/{category}', [AdminCategoryController::class, 'edit'])->name('category.edit');
    // Route::post('/category/{category}', [AdminCategoryController::class, 'update'])->name('category.update');
    // Route::post('/category', [AdminCategoryController::class, 'store'])->name('category.store');
    // Route::delete('/category/{category}', [AdminCategoryController::class, 'destroy'])->name('category.destroy');

    //Admin Sub Category
    // Route::get('/subcategory', [AdminSubcategoryController::class, 'index'])->name('subcategory.index');
    // Route::post('/subcategory', [AdminSubcategoryController::class, 'store'])->name('subcategory.store');
    // Route::delete('/subcategory/{subcategory}', [AdminSubcategoryController::class, 'destroy'])->name('subcategory.destroy');

    //Admin Dashboard Products
    // Route::get('/products', [AdminProductController::class, 'index'])->name('product.index');
    // Route::get('/product-create', [AdminProductController::class, 'create'])->name('product.create');
    // Route::post('/product', [AdminProductController::class, 'store'])->name('product.store');
    // Route::delete('/product/{product}', [AdminProductController::class, 'destroy'])->name('product.destroy');
});

//Authenticated User Routes
Route::name('user.')->prefix('user')->middleware(['auth'])->group(function () {
    Route::post('/send-review/{product}', [HomePagesController::class, 'sendReview'])->name('send-review');
});

require __DIR__ . '/auth.php';
