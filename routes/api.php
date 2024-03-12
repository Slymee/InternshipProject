<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\API\SellerProductAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserAPIController;

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


/**
 * Passport API authentication for user
 */
Route::controller(UserAPIController::class)->group(function (){
   Route::post('login', 'loginUser');
});

Route::controller(UserAPIController::class)->group(function (){
    Route::get('user', 'getUserDetail');
    Route::get('logout', 'userLogout');
})->middleware('auth:api_user');


/**
 * Protected API routes for seller
 */

Route::middleware(['auth:api_user'])->group(function () {
    Route::get('product-dashboard', [SellerProductAPIController::class, 'index'])->name('api.my-product-ads');
    Route::get('product-ad', [SellerProductAPIController::class, 'create'])->name('api.product-ad-form');
    Route::post('product-ad', [SellerProductAPIController::class, 'store'])->name('api.product-ad-post');
    Route::get('product/{productId}/edit', [SellerProductAPIController::class, 'edit'])->name('api.product-edit');
    Route::post('product/{productId}/update', [SellerProductAPIController::class, 'update'])->name('api.product-update');
    Route::get('product/{productId}/destroy', [SellerProductAPIController::class, 'destroy'])->name('api.product-destroy');

    Route::get('get-parent-category', [CategoryController::class, 'getPaginatedCategory'])->name('api.paginated-category');
    Route::get('get-child-option/{parentId}', [CategoryController::class, 'displayChildCategory'])->name('api.get-child-option');

    Route::post('post-comment', [CommentController::class, 'store'])->name('api.post-comment');
});
