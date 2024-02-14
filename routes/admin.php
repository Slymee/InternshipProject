<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;


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
 * Forgot password routes: Admin
 */
Route::get('admin-forgot-password', [PasswordResetController::class, 'index'])->name('forgot-password-view');
Route::post('admin-forgot-password', [PasswordResetController::class, 'sendResetMail'])->name('admin.forgot.password');
Route::get('admin-password-reset/{token}', [PasswordResetController::class, 'showNewPasswordForm'])->name('password.reset');
Route::post('admin-password-reset', [PasswordResetController::class, 'submitNewPasswordForm']);
Route::post('submit-new-password', [PasswordResetController::class, 'submitAdminNewPassword'])->name('admin.new.password');
