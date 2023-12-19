<?php

use App\Http\Controllers\AdminDataDetailsController;
use App\Http\Controllers\CategoryAndSubCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordResetController;
use App\Models\CategoryAndSubCategory;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', function () {
    return view('welcome');
});


//admin routes
                //admin login
Route::get('/admin-login', [AdminDataDetailsController::class, 'showLoginForm'])->name('login');
Route::post('/admin-validate', [AdminDataDetailsController::class, 'login']);
Route::post('/admin-logout', [AdminDataDetailsController::class, 'logout'])->name('logout');



                //admin dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('admin.dashboard');
Route::get('/admin-category', [CategoryAndSubCategoryController::class, 'index'])->middleware('auth')->name('category.and.subcategory');
Route::get('admin-category-add', [CategoryAndSubCategoryController::class, 'addCategoryFormDisplay'])->name('add.category.form');


                //Forgot Password Routess
Route::get('/admin-forgot-password', [PasswordResetController::class, 'index'])->name('forgot-password-view');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetMail'])->name('admin.forgot.password');
Route::get('/admin-password-reset/{token}', [PasswordResetController::class, 'showNewPasswordForm'])->name('password.reset');
Route::post('/admin-password-reset', [PasswordResetController::class, 'submitNewPasswordForm']);
Route::post('/submit-new-password', [PasswordResetController::class, 'submitResetPasswordForm'])->name('admin.new.password');




