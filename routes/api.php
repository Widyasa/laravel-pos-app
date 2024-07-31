<?php

use App\Http\Controllers\ProductCategoryController;
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
    Route::post('/product/categories/update/{id}', 'update');
    Route::post('/product/categories/delete/{id}', 'delete');
});
//Route::resource('products/categories', \App\Http\Controllers\ProductCategoryController::class);

