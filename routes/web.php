<?php

//Admin
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminPromotionController;
use App\Http\Controllers\Admin\AdminSubcategoryController;
use App\Http\Controllers\Pages\HomePagesController;
// users 
use App\Http\Controllers\UploadController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\UserDashboardController;

use Illuminate\Support\Facades\Route;

// HomePages Controller
Route::get('/', [HomePagesController::class, 'index'])->name('home');
//Products
Route::post('/search-product', [HomePagesController::class, 'searchProducts'])->name('product.search');
Route::get('/products/{subcategory:slug?}', [HomePagesController::class, 'products'])->name('product-page');
Route::get('/product/{product:slug}', [HomePagesController::class, 'productDetails'])->name('product-details-page');
Route::post('/add-to-cart', [HomePagesController::class, 'addToCart'])->name('add-to-cart');
Route::get('/cart', [HomePagesController::class, 'getCart'])->name('cart');

//Admin routes
Route::name('admin.')->prefix('admin')->middleware(['auth', 'verified', 'isAdmin'])->group(function () {
    // Dashboard Routes 
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard.index');
    Route::delete('/user-delete/{user}', [AdminDashboardController::class, 'userDelete'])->name('user-delete');
    Route::post('/update-role/{user}', [AdminDashboardController::class, 'updateRole'])->name('update-role');
    // Route::get('/dashboard/edit', [AdminDashboardController::class, 'edit'])->name('dashboard.edit');
    // Route::patch('/dashboard', [AdminDashboardController::class, 'update'])->name('dashboard.update');
    // Route::delete('/dashboard', [AdminDashboardController::class, 'destroy'])->name('dashboard.destroy');

    //Admin dashbord
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('index');
    Route::post('/update-avatar/{user}', [AdminProfileController::class, 'updateAvatar'])->name('update-avatar');
    Route::post('/update-profile/{user}', [AdminProfileController::class, 'updateProfile'])->name('update-profile');

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

    //Admin Products
    Route::get('/products', [AdminProductController::class, 'index'])->name('product.index');
    Route::get('/product-create', [AdminProductController::class, 'create'])->name('product.create');
    Route::get('/product/{product}', [AdminProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/{product}', [AdminProductController::class, 'update'])->name('product.update');
    Route::post('/product', [AdminProductController::class, 'store'])->name('product.store');
    Route::delete('/product/{product}', [AdminProductController::class, 'destroy'])->name('product.destroy');
    //Admin Promotion 
    Route::get('/promotions', [AdminPromotionController::class, 'index'])->name('promotion.index');
    //Admin orders
    Route::get('/orders', [AdminPromotionController::class, 'index'])->name('order.index');
});

// Users 
// Authenticated and verified routes 
Route::name('user.')->prefix('user')->middleware(['auth', 'verified'])->group(function () {
    // Dashboard Routes 
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard.index');
    // Route::get('/dashboard/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    // Route::patch('/dashboard', [DashboardController::class, 'update'])->name('dashboard.update');
    // Route::delete('/dashboard', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
    Route::get('/orders', [UserDashboardController::class, 'order'])->name('order.index');


    // to be deleted 
    // Dashboard Routes 
    // Route::get('/dashboard/edit', [AdminDashboardController::class, 'edit'])->name('dashboard.edit');
    // Route::patch('/dashboard', [AdminDashboardController::class, 'update'])->name('dashboard.update');
    // Route::delete('/dashboard', [AdminDashboardController::class, 'destroy'])->name('dashboard.destroy');

    //Admin dashbord
    Route::get('/profile', [UserDashboardController::class, 'index'])->name('index');
    Route::post('/update-avatar/{user}', [UserDashboardController::class, 'updateAvatar'])->name('update-avatar');
    Route::post('/update-profile/{user}', [UserDashboardController::class, 'updateProfile'])->name('update-profile');

    //Admin Dashboard Category
    Route::get('/category', [AdminCategoryController::class, 'index'])->name('category.index');
    Route::get('/category/{category}', [AdminCategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/{category}', [AdminCategoryController::class, 'update'])->name('category.update');
    Route::post('/category', [AdminCategoryController::class, 'store'])->name('category.store');
    Route::delete('/category/{category}', [AdminCategoryController::class, 'destroy'])->name('category.destroy');

    //Admin Sub Category
    Route::get('/subcategory', [AdminSubcategoryController::class, 'index'])->name('subcategory.index');
    Route::post('/subcategory', [AdminSubcategoryController::class, 'store'])->name('subcategory.store');
    Route::delete('/subcategory/{subcategory}', [AdminSubcategoryController::class, 'destroy'])->name('subcategory.destroy');

    //Admin Dashboard Products
    Route::get('/products', [AdminProductController::class, 'index'])->name('product.index');
    Route::get('/product-create', [AdminProductController::class, 'create'])->name('product.create');
    Route::post('/product', [AdminProductController::class, 'store'])->name('product.store');
    Route::delete('/product/{product}', [AdminProductController::class, 'destroy'])->name('product.destroy');

});

//Authenticated User Routes
Route::name('user.')->prefix('user')->middleware(['auth'])->group(function () {
    Route::post('/send-review/{product}', [HomePagesController::class, 'sendReview'])->name('send-review');
    // Route::post('/send-review', [HomePagesController::class, 'sendReview'])->name('send-review');
});

require __DIR__ . '/auth.php';