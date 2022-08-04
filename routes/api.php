<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\QA\QAController;
use App\Http\Controllers\Version\VersionController;

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
// Route::get('/products',[ProductController::class,'index']);
// Route::get('/products/{id}',[ProductController::class,'show']);
// Route::DELETE('/delete-product/{id}',[ProductController::class,'destroy']);
// Route::put('/update-product/{id}',[ProductController::class,'update']);
// Route::put('/products',[ProductController::class,'store']);

Route::get('/admin',[AdminController::class,'index']);

Route::get('/versions',[VersionController::class,'index']);
Route::post('/versions',[VersionController::class,'store']);
Route::delete('/versions/{version}',[VersionController::class,'destroy']);

Route::get('/customers',[CustomerController::class,'index']);
Route::get('/customers/{id}',[CustomerController::class,'show']);
Route::DELETE('/delete-customer/{id}',[CustomerController::class,'destroy']);

Route::get('/q&a', [QAController::class, 'index']);