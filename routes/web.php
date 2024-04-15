<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AddPetController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FindPetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\HowItWorksController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Auth\Middleware\Authenticate as MiddlewareAuthenticate;

Route::get('/', [IndexController::class,'edit']
)->name('main');
//Routes with no authentication
Route::get("/about-us", [AboutController::class, "index"])->name('about-us');

Route::get("/contact", [ContactController::class, "edit"]);
Route::get("/how-it-works", [HowItWorksController::class, "edit"]);
Route::get("/filter-pets", [FindPetController::class, "findDogs"]);

Route::get("/filter-pets", [FindPetController::class, "findDogs"]);
Route::get("/pet-profile/{id}/{type}", [FindPetController::class, "petProfile"])->name('pet-profile');

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

    Route::get('/addfav/{petId}', [IndexController::class,'addFav'])->name('addfav');
    Route::get('/removefav/{petId}', [IndexController::class,'removeFav'])->name('removefav');


  /////////////////////////////////////////////////
  //Profile

//  Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Other routes that require authentication
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/pet-update', [ProfileController::class, 'petUpdate'])->name('profile.pet-update');
    Route::delete('/profile', [ProfileController::class, 'petDelete'])->name('profile.pet-delete');

    Route::get('/logout', [LogoutController::class,'logout'])->name('logout');
   
    //Add Pet 
     Route::get('/add-pet', [AddPetController::class, "edit"])->name('add-pet.edit');
    Route::post('/add-pet', [AddPetController::class, "store"])->name('add-pet.store');

    //setting password and id delete

    Route::get("/settings", [SettingsController::class, "edit"])->name('settings.edit');
    Route::put("/settings", [SettingsController::class, "update"])->name('settings.update');
    Route::delete("/settings", [SettingsController::class, "destroy"])->name('settings.destroy');
   

    //Favourites
    Route::get("/favourites", [FavouriteController::class, "edit"]);
    Route::post("/favourites", [FavouriteController::class, "addFav"])->name('favourites.addFav');

   //Send Mail
   Route::post('/send-message/{type}', [UsersController::class, "sendEmail"])->name('send-email');

// });

// Route::middleware(['auth_admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, "edit"])->name('dashboard.edit');

    //  dd(User::Find(session()->get('user_id')));
  //  Route::get('/dashboard', [DashboardController::class, "edit"])->name('dashboard.edit');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Other routes that require authentication
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/pet-update', [ProfileController::class, 'petUpdate'])->name('profile.pet-update');
    Route::delete('/profile', [ProfileController::class, 'petDelete'])->name('profile.pet-delete');

   
    Route::get('/users', [UsersController::class, "edit"])->name('users.edit');
    Route::patch('/users', [UsersController::class, "update"])->name('users.update');
    Route::delete('/users', [UsersController::class, "destroy"])->name('users.destroy');
    

    Route::get("/settings", [SettingsController::class, "edit"])->name('settings.edit');
    Route::put("/settings", [SettingsController::class, "update"])->name('settings.update');
    Route::delete("/settings", [SettingsController::class, "destroy"])->name('settings.destroy');
   
     Route::put('/password', [PasswordController::class, 'update'])->name('password.update');


    Route::get('/pets', [PetsController::class, "edit"])->name('pets.edit');
    Route::patch('/pets', [PetsController::class, "update"])->name('pets.update');
    Route::delete('/pets', [PetsController::class, "destroy"])->name('pets.destroy');

   //Favourites
    Route::get("/favourites", [FavouriteController::class, "edit"]);
    Route::post("/favourites", [FavouriteController::class, "addFav"])->name('favourites.addFav');

     //Send Mail
   Route::post('/send-message/{type}', [UsersController::class, "sendEmail"])->name('send-email');


// });