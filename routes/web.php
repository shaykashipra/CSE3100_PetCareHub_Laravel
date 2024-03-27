<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AddPetController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FindPetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HowItWorksController;
use App\Http\Controllers\AcceptTermsController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;


// php artisan route:clear

Route::get('/', [IndexController::class,'edit']
)->name('main');
//Routes with no authentication

Route::get("/filter-pets", [FindPetController::class, "findDogs"]);

Route::get("/filter-pets", [FindPetController::class, "findDogs"]);
Route::get("/pet-profile/{id}/{type}", [FindPetController::class, "petProfile"])->name('pet-profile');

Route::post('/send-message/{type}', [UsersController::class, "sendEmail"])->name('send-email');

Route::get("/conditions", [AcceptTermsController::class, "see_conditions"])->name('conditions');
Route::get("/how-it-works", [HowItWorksController::class, "edit"])->name('how-it-works');
Route::get("/about-us", [AboutController::class, "index"])->name('about-us');
Route::get("/contact", [ContactController::class, "edit"])->name('contact');
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

 

  /////////////////////////////////////////////////
  //Profile

  Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class,'edit'])->name('profile.edit');
    // Other routes that require authentication
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/pet-update', [ProfileController::class, 'petUpdate'])->name('profile.pet-update');
    Route::delete('/profile', [ProfileController::class, 'petDelete'])->name('profile.pet-delete');

    Route::get('/logout', [LogoutController::class,'logout'])->name('logout');
   
    //Add Pet 
     Route::get('/add-pet', [AddPetController::class, "edit"])->name('add-pet.edit');
    Route::post('/add-pet', [AddPetController::class, "store"])->name('add-pet.store');

   
   //Send Mail
   Route::post('/send-message/{type}', [UsersController::class, "sendEmail"])->name('send-email');


 });
