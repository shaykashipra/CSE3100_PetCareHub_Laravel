<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
  public function create(){
    return view('auth.login');
  }

   public function login(Request $request)
{   
   // Validate
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        // Authentication successful
        //session data store
     Session::put('user_id', $user->id);
      Session::put('user_name', $user->fname . " " . $user->lname);
      Session::put('user_image', $user->image);
      Session::put('is_admin', $user->is_admin);

         $favorites = $user->favourites()->pluck('pet_id')->toArray();

            Session::put('favourites', $favorites);
      
        $request->session()->regenerate();
        

       if ($request->has('remember')) {
            $this->setRememberMeCookie($user);
        }

        return redirect('/')->with(compact('user'));
        
        // return redirect()->intended();
        // return redirect()->intended(RouteServiceProvider::HOME);

    }

    //  failed
        return redirect('/login')->withInput($request->except('password'))->withErrors(['email' => 'Invalid Email']);
}

///////////////////////////////////////////////////////////////////////////

/////////////////   Doctor   /////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////


public function createDoc(){
    return view('doctor.login');
  }

   public function loginDoc(Request $request)
{   
   // Validate
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    $doctor = Doctor::where('email', $request->email)->first();

    if ($doctor && Hash::check($request->password, $doctor->password)) {
       
     Session::put('doc_id', $doctor->id);
       Session::put('doc_name', $doctor->doctor_name);
      // Session::put('doc_image', $doctor->image);
      // Session::put('is_admin', $user->is_admin);
      $request->session()->regenerate();

        return redirect('/doctor/list')->with(compact('doctor'));
        
        // return redirect()->intended();
        // return redirect()->intended(RouteServiceProvider::HOME);

    }

    //  failed
        return redirect('/doctor/login')->withInput($request->except('password'))->withErrors(['email' => 'Invalid Email']);
}

 protected function setRememberMeCookie($user)
    {
        // Generate a unique token for the user
        $token = Str::random(60);

        // Save the token in the user table
        $user->updateRememberToken($token);
                $user->save();

        // Set the cookie
        Cookie::queue('remember_token', $user->id.'|'.$token, 1209600); // 14 days
    }
// public function toggleFavorite(Request $request, $petId)
//     {
//         if (Session::has('user_id')) {
//             $userId = Session::get('user_id');
//             $favorites = Session::get('favourites', []);

//             if (in_array($petId, $favorites)) {
//                 $key = array_search($petId, $favorites);
//                 unset($favorites[$key]);
//             } else {
//                 $favorites[] = $petId;
//             }

//             Session::put('favourites', $favorites);

//             return redirect()->back()->with('success', 'Pet added/removed from favorites successfully.');
//         } else {
//             return redirect('/login')->with('error', 'Please login to manage favorites.');
//         }
//     }
protected function handleRememberMeLogin() {
  if (!Session::has('user_id') && Cookie::has('remember_token')) {
      $rememberToken = Cookie::get('remember_token');
      list($userId, $token) = explode('|', $rememberToken);

      $user = User::find($userId);

      if ($user && $user->getRememberToken() === $token) {
          // Manually set session variables
          Session::put('user_id', $user->id);
          Session::put('user_name', $user->fname . " " . $user->lname);
          Session::put('user_image', $user->image);
          Session::put('is_admin', $user->is_admin);

          $favorites = $user->favourites()->pluck('pet_id')->toArray();
          Session::put('favourites', $favorites);
      }
  }
}

public function __construct() {
  $this->handleRememberMeLogin();
}
 }
