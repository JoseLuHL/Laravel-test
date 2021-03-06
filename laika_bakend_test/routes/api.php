<?php

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Category\CategoryProductController;
use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\product\ProductController;
use App\Http\Middleware\signatureMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Categorys
Route::resource('categories', CategoryController::class)->middleware(signatureMiddleware::class);;
Route::resource('categories.products', CategoryProductController::class)->middleware(signatureMiddleware::class);;;

//Products
Route::resource('products', ProductController::class)->middleware(signatureMiddleware::class);;;
