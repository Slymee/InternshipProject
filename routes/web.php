<?php

use App\Http\Controllers\AdminDataDetailsController;
use App\Http\Controllers\DashboardController;
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
Route::get('admin-login', [AdminDataDetailsController::class, 'showLoginForm']);
Route::post('admin-validate', [AdminDataDetailsController::class, 'login']);


                //admin dashboard
Route::get('dashboard', [DashboardController::class, 'index']);


