<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Version\VersionController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Service\ServiceController;
use App\Http\Controllers\Brand\BrandController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/products',ProductController::class);

Route::get('/admin',[AdminController::class,'index']);

Route::get('/versions',[VersionController::class,'index']);
Route::post('/versions',[VersionController::class,'store']);
Route::delete('/versions/{version}',[VersionController::class,'destroy']);

Route::get('/customers',[CustomerController::class,'index']);
Route::post('/customers',[CustomerController::class,'store']);
Route::get('/customers/{id}',[CustomerController::class,'show']);
Route::DELETE('/delete-customer/{id}',[CustomerController::class,'destroy']);

Route::get('/posts',[PostController::class,'getAllPosts']);
Route::post('/posts',[PostController::class,'store']);

Route::get('/brands',[BrandController::class,'index']);

Route::get("/brand/{id}/products", [ProductController::class, "getAllProductByBrand"]);


Route::get("services", [ServiceController::class, "getAllServices"]);
Route::get("service/{id}", [ServiceController::class, "getProductsByServiceId"]);