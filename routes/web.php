<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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
Route::get('/admin-login', [AdminController::class, 'index'])->name('admin.login');
Route::post('/admin-validate', [AdminController::class, 'login'])->name('admin.validate');
Route::post('/admin-logout', [AdminController::class, 'logout'])->name('admin.logout');




                //Admin Dsahboard routes
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('admin-category', CategoryController::class, ['except' => ['destroy']]);
    Route::get('admin-category/{id}/destroy', [CategoryController::class, 'destroy'])->name('admin-category.destroy');
});


                //User Routes
Route::get('user/login', [UserController::class, 'userLoginForm'])->name('user.login');
Route::post('user/user-validate', [UserController::class, 'userLogin'])->name('user.validate');
Route::get('user/register', [UserController::class, 'userRegisterForm'])->name('user.register');







                //Forgot Password Routess
Route::get('/admin-forgot-password', [PasswordResetController::class, 'index'])->name('forgot-password-view');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetMail'])->name('admin.forgot.password');
Route::get('/admin-password-reset/{token}', [PasswordResetController::class, 'showNewPasswordForm'])->name('password.reset');
Route::post('/admin-password-reset', [PasswordResetController::class, 'submitNewPasswordForm']);
Route::post('/submit-new-password', [PasswordResetController::class, 'submitResetPasswordForm'])->name('admin.new.password');




