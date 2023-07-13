<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //product
    Route::get('/add', [ProductController::class, 'add'])->name('product_add');
    Route::post('/insert', [ProductController::class, 'insert'])->name('product_insert');
    Route::get('/dashboard', [ProductController::class, 'list'])->name('dashboard');
    Route::post('/delete', [ProductController::class, 'delete'])->name('product_delete');
    Route::post('/edit', [ProductController::class, 'edit'])->name('product_edit');
    Route::post('/update', [ProductController::class, 'update'])->name('product_update');
    Route::get('/cartList', [ProductController::class, 'cart'])->name('product_cartList');
    Route::post('/cart', [ProductController::class, 'add_cart'])->name('product_cart');
    Route::post('/cartRemove', [ProductController::class, 'remove_cart'])->name('product_cart_remove');
});

require __DIR__.'/auth.php';
