<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});
Route::get("me",function (){
    $userInfo=auth()->guard('api')->user();
    if ($userInfo!==null)
    {
        return "User is logged in. id:".$userInfo;
    }else{
        return "User is not logged in.";
    }
});
Route::middleware('auth:sanctum')->group(function(){
    Route::controller(ProductCategoryController::class)->group(function () {
        Route::get('/product-categories', 'index');
        Route::post('/product-categories', 'store');
        Route::get('/product-categories/{id}', 'show');
        Route::patch('/product-categories/{id}', 'update');
        Route::delete('/product-categories/{id}', 'delete');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::post('/products', 'store');
        Route::get('/products/{id}', 'show');
        Route::patch('/products/{id}', 'update');
        Route::delete('/products/{id}', 'delete');
    });

    Route::controller(TransactionController::class)->group(function () {
        Route::get('/transaction', 'index');
        Route::post('/transaction', 'store');
        Route::get('/transaction/{id}', 'show');
    });
});


