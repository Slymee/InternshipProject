<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerProductController;
use App\Http\Controllers\UserPasswordResetController;
use Illuminate\Support\Facades\Route;
//use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

//Route::get('/', function () {
//    return view('welcome');
//});


//admin routes
/**
 * Admin authentication routes
 */
Route::get('admin-login', [AdminController::class, 'index'])->name('admin.login');
Route::post('admin-validate', [AdminController::class, 'login'])->name('admin.validate');
Route::post('admin-logout', [AdminController::class, 'logout'])->name('admin.logout');


/**
 * Admin dashboard routes
 */
Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin-dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('admin-category', CategoryController::class, ['except' => ['destroy']]);
    Route::get('admin-category/{id}/destroy', [CategoryController::class, 'destroy'])->name('admin-category.destroy');
});


/**
 * User authentication routes
 */
Route::get('login', [UserController::class, 'userLoginForm'])->middleware('loginPage.auth')->name('user.login');
Route::post('validate', [UserController::class, 'loginUser'])->name('user.validate');
Route::post('register-user', [UserController::class,'registerUser'])->name('user.register');
Route::get('logout', [UserController::class, 'logoutUser'])->name('user.logout');


/**
 * Product related routes
 */
Route::get('/', [ProductController::class, 'index'])->name('user-home');
Route::get('/{categoryId}/products', [ProductController::class, 'categoryProductList'])->name('product-listing');
Route::get('/product/{productId}', [ProductController::class, 'show'])->name('product-display');


/**
 * Guest route protection for seller user
 */
Route::middleware(['guest.authenticate'])->group(function () {
    Route::get('product-dashboard', [SellerProductController::class, 'index'])->name('my-product-ads');
    Route::get('product-ad', [SellerProductController::class, 'create'])->name('product-ad-form');
    Route::post('product-ad', [SellerProductController::class, 'store'])->name('product-ad-post');
    Route::get('product/{productId}/edit', [SellerProductController::class, 'edit'])->name('product-edit');
    Route::put('product/{productId}/update', [SellerProductController::class, 'update'])->name('product-update');
    Route::get('product/{productId}/destroy', [SellerProductController::class, 'destroy'])->name('product-destroy');

    Route::get('get-parent-category', [CategoryController::class, 'getPaginatedCategory'])->name('paginated-category');
    Route::get('get-child-option/{parentId}', [CategoryController::class, 'displayChildCategory'])->name('get-child-option');
});


/**
 * Forgot password routes: Admin
 */
Route::get('admin-forgot-password', [PasswordResetController::class, 'index'])->name('forgot-password-view');
Route::post('admin-forgot-password', [PasswordResetController::class, 'sendResetMail'])->name('admin.forgot.password');
Route::get('admin-password-reset/{token}', [PasswordResetController::class, 'showNewPasswordForm'])->name('password.reset');
Route::post('admin-password-reset', [PasswordResetController::class, 'submitNewPasswordForm']);
Route::post('submit-new-password', [PasswordResetController::class, 'submitAdminNewPassword'])->name('admin.new.password');


/**
 * Forgot password routes: User
 */
Route::get('forgot-password', [UserPasswordResetController::class,'index'])->name('user-forgot-password-view');
Route::post('forgot-password', [UserPasswordResetController::class,'sendResetMail'])->name('user-forgot-password');
Route::get('password-reset/{token}', [UserPasswordResetController::class, 'showNewPasswordForm'])->name('password-reset');
Route::post('password-reset', [UserPasswordResetController::class, 'submitNewPassword'])->name('new-password');



