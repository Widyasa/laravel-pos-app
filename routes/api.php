<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::controller(ProductCategoryController::class)->group(function () {
    Route::get('/product/categories', 'index');
    Route::post('/product/categories', 'store');
    Route::get('/product/categories/{id}', 'show');
    Route::put('/product/categories/update/{id}', 'update');
    Route::delete('/product/categories/delete/{id}', 'delete');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index');
    Route::post('/products', 'store');
    Route::get('/products/{id}', 'show');
    Route::post('/products/update/{id}', 'update');
    Route::post('/products/delete/{id}', 'delete');
});

Route::controller(CartController::class)->group(function () {
    Route::get('/carts', 'index');
    Route::post('/carts', 'store');
//    Route::get('/products/{id}', 'show');
//    Route::post('/products/update/{id}', 'update');
//    Route::post('/products/delete/{id}', 'delete');
});
//Route::resource('products/categories', \App\Http\Controllers\ProductCategoryController::class);

