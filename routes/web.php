<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Auth\Middleware\Authenticate as MiddlewareAuthenticate;
// php artisan route:clear

Route::get('/', [IndexController::class,'edit']
)->name('main');
//Routes with no authentication



Route::post('/send-message/{type}', [UsersController::class, "sendEmail"])->name('send-email');

///////////////////////////////////////////////////////////////
//auth

 Route::get('/register', [RegisteredUserController::class, 'create'])
                ->name('register');
                //reg
 Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
       //logout
     //login
  Route::get('/login', [AuthenticatedSessionController::class,'create'])->name('login');
  Route::post('/login', [AuthenticatedSessionController::class,'login'])->name('login.store');

  

  