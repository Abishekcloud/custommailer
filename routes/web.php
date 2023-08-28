<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//Forgot Password Route
Route::get('/forgotpassword',[ForgotPasswordController::class,'forgotPassword'])->name('forgotPassword');
Route::post('/forgotpassword',[ForgotPasswordController::class,'forgotPasswordPost'])->name('forgotPassword.store');
Route::get('/resetpassword',[ForgotPasswordController::class,'resetPassword'])->name('resetPassword');
Route::post('/resetpassword',[ForgotPasswordController::class,'resetPasswordPost'])->name('resetPassword.post');


Route::get('/', [HomeController::class,'index'])->name('home.index');


Route::get('/register', [RegisterController::class,'show'])->name('register.show');
Route::post('/register', [RegisterController::class,'register'])->name('register.perform');

/**
 * Login Routes
 */
Route::get('/login', [LoginController::class,'show'])->name('login.show');
Route::post('/login', [LoginController::class,'login'])->name('login.perform');

Route::middleware(['rolefinder'])->group(function () {
    
    //Admin Controllers and Routes
    Route::get('/admin',[AdminController::class,'index'])->name('admin.index');

    //user Controllers and Routes
    Route::get('/user',[UserController::class,'index'])->name('user.index');
});

Route::get('/logout', [LogoutController::class,'perform'])->name('logout.perform');

       
 




// routes/web.php
Route::get('/clear', function () {
    // Clear the application cache
    Artisan::call('cache:clear');

    // Clear compiled views
    Artisan::call('view:clear');

    // Clear configuration cache
    Artisan::call('config:clear');

    Artisan::call('optimize:clear');

    return "Cleared all caches and data.";
});

