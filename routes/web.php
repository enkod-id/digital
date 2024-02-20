<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/dashboard/product', [ProductController::class, 'index'])->name('products.index');
    Route::get('/dashboard/product/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/dashboard/product/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/dashboard/product/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/dashboard/product/{id}/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/dashboard/product/{id}destroy', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::delete('/dashboard/product/{id}/show', [ProductController::class, 'show'])->name('products.show');

    Route::get('/dashboard/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/dashboard/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/dashboard/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/dashboard/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/dashboard/category/{id}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/dashboard/category/{id}destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
});

require __DIR__.'/auth.php';
