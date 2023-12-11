<?php

use App\Http\Controllers\AdminDataDetailsController;
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
                //admin login
Route::get('admin-login', [AdminDataDetailsController::class, 'showLoginForm']);
Route::post('admin-validate', [AdminDataDetailsController::class, 'login']);


                //admin dashboard
Route::get('dashboard', function (){
    return view('backend.index');
});


