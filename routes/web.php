<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\PetsController;
use App\Http\Controllers\ZoomController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AddPetController;
use App\Http\Controllers\CatApiController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FindPetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AllDoctorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\HowItWorksController;
use App\Http\Controllers\AcceptTermsController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClinicIndexController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AppointmentListController;
use App\Http\Controllers\SslCommerzPaymentController;

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\DoctorAppointmentListController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Auth\Middleware\Authenticate as MiddlewareAuthenticate;
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

    Route::get('/addfav/{petId}', [IndexController::class,'addFav'])->name('addfav');
    Route::get('/removefav/{petId}', [IndexController::class,'removeFav'])->name('removefav');

    ///////////////////////////////////////////////////////////
//            Remember ME 
    //////////////////////////////////////////////////////////

    Route::get('/test-cookie', function() {
      $token = Str::random(60);
      Cookie::queue('test_remember_token', 'test_user_id|'.$token, 1209600); // 14 days
      return 'Cookie has been set';
  });

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

    //setting password and id delete

    Route::get("/settings", [SettingsController::class, "edit"])->name('settings.edit');
    Route::put("/settings", [SettingsController::class, "update"])->name('settings.update');
    Route::delete("/settings", [SettingsController::class, "destroy"])->name('settings.destroy');
   

    //Favourites
    Route::get("/favourites", [FavouriteController::class, "edit"])->name('favourites');
    Route::post("/favourites", [FavouriteController::class, "addFav"])->name('favourites.addFav');

   //Send Mail
   Route::post('/send-message/{type}', [UsersController::class, "sendEmail"])->name('send-email');


 });

 //////////////////////////////////////////////////////////

//            admin
 /////////////////////////////////////////////////////////

Route::middleware(['auth_admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, "edit"])->name('dashboard.edit')->middleware('auth_admin');

    //  dd(User::Find(session()->get('user_id')));
  //  Route::get('/dashboard', [DashboardController::class, "edit"])->name('dashboard.edit');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Other routes that require authentication
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::patch('/profile/pet-update', [ProfileController::class, 'petUpdate'])->name('profile.pet-update');
    // Route::delete('/profile', [ProfileController::class, 'petDelete'])->name('profile.pet-delete');

   
    Route::get('/users', [UsersController::class, "edit"])->name('users.edit');
    Route::patch('/users', [UsersController::class, "update"])->name('users.update');
    Route::delete('/users', [UsersController::class, "destroy"])->name('users.destroy');
    

       //Doctor List
   Route::get('/doctors', [AllDoctorController::class, 'edit'])->name('doctors.edit');
   Route::patch('/doctors', [AllDoctorController::class, 'update'])->name('doctors.update');
   Route::delete('/doctors', [AllDoctorController::class, 'destroy'])->name('doctors.destroy');
   

    // Route::get("/settings", [SettingsController::class, "edit"])->name('settings.edit');
    // Route::put("/settings", [SettingsController::class, "update"])->name('settings.update');
    // Route::delete("/settings", [SettingsController::class, "destroy"])->name('settings.destroy');
   
    //  Route::put('/password', [PasswordController::class, 'update'])->name('password.update');


    Route::get('/pets', [PetsController::class, "edit"])->name('pets.edit');
    Route::patch('/pets', [PetsController::class, "update"])->name('pets.update');
    Route::delete('/pets', [PetsController::class, "destroy"])->name('pets.destroy');

   //Favourites
    // Route::get("/favourites", [FavouriteController::class, "edit"]);
    // Route::post("/favourites", [FavouriteController::class, "addFav"])->name('favourites.addFav');

     //Send Mail
  //  Route::post('/send-message/{type}', [UsersController::class, "sendEmail"])->name('send-email');

     //AppointmentList
     Route::get('/admin_app_list', [AppointmentListController::class, "edit"])->name('admin_app_list.edit');
     Route::get('/admin_app_list2/{id}', [AppointmentListController::class, "edit2"])->name('admin_app_list.edit2');

      Route::patch('/admin_app_list', [AppointmentListController::class, "update"])->name('admin_app_list.update');
     Route::delete('/admin_app_list', [AppointmentListController::class, "destroy"])->name('admin_app_list.destroy');

   

    //  Donation List
    Route::get('/donation_list', [DonationController::class, 'show'])->name('donation.show');


});



//Donation
    Route::get("/donation", [DonationController::class, "edit"])->name('donation');
    Route::post("/donation", [DonationController::class, "edit"])->name('donations.store');

//clinic 
//index
     Route::get("/clinic", [ClinicIndexController::class, "index"])->name('clinic');
//appointment_form

     Route::get("/appointment_form",[AppointmentController::class,'edit'])->name('appointment_form');
     Route::post("/appointment_form",[AppointmentController::class,'store'])->name('appointment_form.store');

    Route::get("/appointment_list", [AppointmentListController::class,'index'])->name('appointment_list');


    Route::get("/connect",function(){
        return view('clinic.connect');
    })->name('connect');


    /////////////////////////////////////////////////////////////////////////////
             //Zoom

    ////////////////////////////////////////////////////////////////////////////
Route::get('/zoom/pre_zoom_redirect/{id}', [ZoomController::class, 'preZoomRedirect'])->name('pre_zoom_redirect');

Route::get('/zoom', function () {
    return view('zoom.index')->with('status', 'zoom');
});
Route::get('start', [ZoomController::class, 'index']);
Route::any('/zoom/zoom-meeting-create', [ZoomController::class, 'index'])->name('zoom-meeting-create');




/////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////             Doctor               //////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////

  Route::get('/doctor/login', [AuthenticatedSessionController::class,'createDoc'])->name('loginDoc');
  Route::post('/doctor/login', [AuthenticatedSessionController::class,'loginDoc'])->name('loginDoc.store');
    Route::get('/doctor/logout', [LogoutController::class,'logoutDoc'])->name('logoutDoc');


  Route::get("/doctor/list",[DoctorAppointmentListController::class,'index'])->name('doctor_app_list');
        Route::patch('/doctor/list', [DoctorAppointmentListController::class, "update"])->name('doctor_app_list.update');
        Route::patch('/doctor/list/edit', [DoctorAppointmentListController::class, "edit"])->name('doctor_app_list.edit');

     Route::delete('/doctor/list', [DoctorAppointmentListController::class, "destroy"])->name('doctor_app_list.destroy');

/////////////////////////////////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////////////

Route::get('/breeds', [CatApiController::class, 'showBreeds'])->name("breeds");


Route::get('/example',function(){
  return view('exampleHosted');
});
// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

//Print prescription

Route::post('/print-prescription/{id}', [PrescriptionController::class,'printPrescription'])->name('printPrescription');
