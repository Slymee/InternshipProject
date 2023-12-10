<?php

use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Route;

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
Route::get('adminLogin', [AdminLoginController::class, 'showLoginForm']);
Route::post('adminValidate', [AdminLoginController::class, 'login']);
Route::get('dashboard', function (){
    return "login";
});

