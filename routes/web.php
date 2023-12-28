<?php

use App\Http\Controllers\AdminDataDetailsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordResetController;
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
Route::get('/admin-category', [CategoryController::class, 'index'])->middleware('auth')->name('category.and.subcategory');
Route::get('/admin-category/subcategory/{id}', [CategoryController::class, 'subCategoryIndex'])->middleware('auth')->name('admin.subcategory');
Route::get('/admin-category-add', [CategoryController::class, 'addCategoryFormDisplay'])->middleware('auth')->name('add.category.form');
Route::post('/admin-category-add/insert', [CategoryController::class, 'insertCategory'])->middleware('auth')->name('admin.insert.category');
Route::get('/admin-category-edit/{category_id}', [CategoryController::class, 'edit'])->middleware('auth')->name('admin.edit.category.form');
Route::post('/admin-category-edit/update', [CategoryController::class, 'update'])->middleware('auth')->name('admin.edit.category');
Route::get('/admin-delete-category/{category_id}', [CategoryController::class, 'destroy'])->middleware('auth')->name('admin.delete.category');


                //Forgot Password Routess
Route::get('/admin-forgot-password', [PasswordResetController::class, 'index'])->name('forgot-password-view');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetMail'])->name('admin.forgot.password');
Route::get('/admin-password-reset/{token}', [PasswordResetController::class, 'showNewPasswordForm'])->name('password.reset');
Route::post('/admin-password-reset', [PasswordResetController::class, 'submitNewPasswordForm']);
Route::post('/submit-new-password', [PasswordResetController::class, 'submitResetPasswordForm'])->name('admin.new.password');




