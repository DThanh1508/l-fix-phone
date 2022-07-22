<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;

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
Route::get('/products',[APIController::class,'products']);
Route::get('/products/{id}',[APIController::class,'getProductDetail']);

// Route::get('versions', APIController::class, 'index');
// Route::get('products', APIController::class, 'product');

Route::get('/versions',[APIController::class,'version']);

Route::get('/customers',[APIController::class,'customer']);

