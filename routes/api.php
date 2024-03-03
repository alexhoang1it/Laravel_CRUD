<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ProductController::class)
    ->prefix('products')->name('product.')->group(function () {
        Route::post('/add', 'create')->name('create');
        Route::get('/', 'getProducts')->name('getProducts');
        Route::get('/search', 'search')->name('search');
        Route::get('/{productId}', 'detail')->name('detail');
        Route::put('/{productId}', 'update')->name('update');
        Route::delete('/{productId}', 'delete')->name('delete');
    });
