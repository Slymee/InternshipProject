<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPasswordResetController;
use Illuminate\Support\Facades\Route;


/**
 * User authentication routes
 */
Route::get('login', [UserController::class, 'userLoginForm'])->middleware('loginPage.auth')->name('user.login');
Route::post('validate', [UserController::class, 'loginUser'])->name('user.validate');
Route::post('register-user', [UserController::class,'registerUser'])->name('user.register');
Route::get('logout', [UserController::class, 'logoutUser'])->name('user.logout');



/**
 * Forgot password routes: User
 */
Route::get('forgot-password', [UserPasswordResetController::class,'index'])->name('user-forgot-password-view');
Route::post('forgot-password', [UserPasswordResetController::class,'sendResetMail'])->name('user-forgot-password');
Route::get('password-reset/{token}', [UserPasswordResetController::class, 'showNewPasswordForm'])->name('password-reset');
Route::post('password-reset', [UserPasswordResetController::class, 'submitNewPassword'])->name('new-password');
