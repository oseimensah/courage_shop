<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Models\Category;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $featuredProducts = Product::where('featured', '1')->latest()->get();
    $products = Product::where('featured', '0')->latest()->get();
    $categories = Category::latest()->get();
    return view('shop.home', compact('featuredProducts', 'products', 'categories'));
})->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware('auth', 'role:admin')->group(function ($route) {
    $route->get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('category')->group(function ($route) {
        $route->get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
        $route->get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
        $route->post('/save/category', [CategoryController::class, 'store'])->name('admin.category.store');
        $route->get('/show/category/{id}', [CategoryController::class, 'show'])->name('admin.category.show');
        $route->get('/edit/category/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
        $route->get('/update/category', [CategoryController::class, 'update'])->name('admin.category.update');
        $route->post('/remove/category/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');
    });

    Route::prefix('product')->group(function ($route) {
        $route->get('/products', [ProductController::class, 'index'])->name('admin.products');
        $route->get('/product/create', [ProductController::class, 'create'])->name('admin.product.create');
        $route->post('/save/product', [ProductController::class, 'store'])->name('admin.product.store');
        $route->get('/show/product/{id}', [ProductController::class, 'show'])->name('admin.product.show');
        $route->get('/edit/product/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        $route->get('/update/product', [ProductController::class, 'update'])->name('admin.product.update');
        $route->post('/remove/product/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');
    });

    Route::prefix('order')->group(function ($route) {
        $route->get('/orders', [ProductController::class, 'index'])->name('admin.orders');
        $route->get('/order/{id}', [ProductController::class, 'index'])->name('admin.order');
    });
});

require __DIR__ . '/auth.php';
