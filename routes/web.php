<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

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
    return view('shop.home');
})->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware('auth', 'role:admin')->group(function ($route) {
    $route->get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('category', function ($rout) {
        $rout->get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
        $rout->get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
        $rout->post('/save/category', [CategoryController::class, 'store'])->name('admin.category.store');
        $rout->get('/show/category/{id}', [CategoryController::class, 'show'])->name('admin.category.show');
        $rout->get('/edit/category/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
        $rout->get('/update/category', [CategoryController::class, 'update'])->name('admin.category.update');
        $rout->post('/remove/category/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');
    });

    Route::prefix('product', function ($rout) {
        $rout->get('/products', [ProductController::class, 'index'])->name('admin.products');
        $rout->get('/product/create', [ProductController::class, 'create'])->name('admin.product.create');
        $rout->post('/save/product', [ProductController::class, 'store'])->name('admin.product.store');
        $rout->get('/show/product/{id}', [ProductController::class, 'show'])->name('admin.product.show');
        $rout->get('/edit/product/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        $rout->get('/update/product', [ProductController::class, 'update'])->name('admin.product.update');
        $rout->post('/remove/product/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');
    });
});

require __DIR__ . '/auth.php';
