<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
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
    
    // Admin Routes
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/userlist', [AdminController::class, 'userList'])->name('admin.userList');
        Route::get('/adduser', [AdminController::class, 'create'])->name('new.user');
        Route::post('/adduser', [AdminController::class, 'store'])->name('user.store');
        Route::get('/user/edit/{id}', [AdminController::class, 'edit'])->name('user.edit');
        Route::put('/user/edit/{id}', [AdminController::class, 'update'])->name('user.update');
        Route::delete('/user/{user}', [AdminController::class, 'destroy'])->name('user.destroy');
        //Make Post Routes:
            Route::prefix('posts')->group(function () {
                Route::get('/show',[PostController::class, 'show'])->name('post.show');
                Route::get('/create',[PostController::class,'index'])->name('post.create');
                Route::post('/create',[PostController::class,'store'])->name('post.store');
                Route::get('edit/{post}',[PostController::class,'edit'])->name('post.edit');
                Route::put('edit/{post}',[PostController::class,'update'])->name('post.update');
                Route::delete('/{post}',[PostController::class, 'destroy'])->name('post.destroy');
            });
    });

    // User Routes
    Route::prefix('user')->group(function () {
        Route::get('/', [HomeController::class, 'userPage'])->name('user.home');
        // Other user routes here
    });
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

