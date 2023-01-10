<?php

//Admin
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
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
Route::get('/products', [HomePagesController::class, 'productPage'])->name('product-page');
Route::get('/products/{category_slug}/{subcategory_slug}', [HomePagesController::class, 'productsBySubcategory'])->name('productsBySubcategory');
Route::post('/add-to-cart', [HomePagesController::class, 'addToCart'])->name('add-to-cart');
Route::get('/cart', [HomePagesController::class, 'getCart'])->name('cart');

//Admin routes
Route::name('admin.')->prefix('admin')->middleware(['auth', 'verified', 'isAdmin'])->group(function () {
    // Dashboard Routes 
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard.index');
    // Route::get('/dashboard/edit', [AdminDashboardController::class, 'edit'])->name('dashboard.edit');
    // Route::patch('/dashboard', [AdminDashboardController::class, 'update'])->name('dashboard.update');
    // Route::delete('/dashboard', [AdminDashboardController::class, 'destroy'])->name('dashboard.destroy');

    //Admin Dashboard Category
    Route::get('/category', [AdminCategoryController::class, 'index'])->name('category.index');
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

    //cloudinary upload
    Route::post('/cloudinary-upload', [UploadController::class, 'store'])->name('cloudinary.store');
});

// Users 
// Authenticated and verified routes 
Route::name('user.')->prefix('user')->middleware(['auth', 'verified'])->group(function () {
    // Dashboard Routes 
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard.index');
    // Route::get('/dashboard/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    // Route::patch('/dashboard', [DashboardController::class, 'update'])->name('dashboard.update');
    // Route::delete('/dashboard', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
});

//Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/track-order', [OrderController::class, 'trackOrder'])->name('track.order');
});

require __DIR__ . '/auth.php';